<?php
namespace app\components;

use yii\base\Component;
use Yii;

class f724 extends Component
{

    public $username;
    public $password;
    public $url;
    public $uri;
    private $authorization;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->username = 'ctp724ch724' ;
        $this->password = '1WR$6yu709' ;
//        $this->url = 'http://172.charter725.ir/APi/' ;
        $this->url = 'http://194.60.230.207:8080/APi/' ;
        $this->uri = '172.charter725.ir' ;
        $this->authorization ;

    }

    function set_login()
    {
        $data = '{"UserPassBase64":"Basic '.base64_encode($this->username.':'.$this->password).'"}';
        $response = $this->curl('Login',$data);
        $result = json_decode($response);
        if ($result->Result == true)
        {
            $this->authorization = "Bearer {$result->Data->access_token}";
            Yii::$app->session->set('charter724-auth' , $this->authorization);
        }
        return true;
    }

    public function login()
    {
        if(Yii::$app->session->get('charter724-auth')) {
            $result = Yii::$app->session->get('charter724-auth') ;
        } else {

            $data = '{"UserPassBase64":"Basic '.base64_encode($this->username.':'.$this->password).'"}';
            $response = $this->curl('Login',$data);
            $result = json_decode($response);
            if ($result->Result == true)
            {
                $this->authorization = "Bearer {$result->Data->access_token}";
                Yii::$app->session->set('charter724-auth' , $this->authorization);
            }
            else
            {
                return false ;
            }
        }

        return true;

    }

    function Available15Days ($from='' , $to='')
    {
        $this->get_auth();

        $data = '{"from_flight":"'.$from.'","to_flight":"'.$to.'"}';
        $response = $this->curl('WebService/Available15Days',$data,1);
        if (strpos($response, 'Authorization has been denied') !== false) {
            $this->set_login();
            $response = $this->curl('WebService/Available15Days',$data,1);
        }
        $result = json_decode($response);
        if ($result->Result == true)
        {
            return array('data'=>$result->Data);
        }
        else
        {
            return false ;
        }
    }

    function search ($from='' , $to='' , $date ='')
    {
        $this->get_auth();

        $data = '{"from_flight":"'.$from.'","to_flight":"'.$to.'","date_flight":"'.$date.'"}';
        $response = $this->curl('WebService/Available',$data,1);
        if (strpos($response, 'Authorization has been denied') !== false) {
            $this->set_login();
            $response = $this->curl('WebService/Available',$data,1);
        }
        $result = json_decode($response);
        if ($result->Result == true)
        {
            return array('data'=>$result->Data);
        }
        else
        {
            return false ;
        }
    }

    function get_captcha ($from='' , $to='' , $date ='' , $time ='' , $number = '' , $agancy = '' , $cabin = '' , $airline = '')
    {
        $this->get_auth();

        $data = '{"from_flight":"'.$from.'","to_flight":"'.$to.'","date_flight":"'.$date.'","time_flight":"'.$time.'","number_flight":"'.$number.'","ajency_online_ID":"'.$agancy.'","cabinclass":"'.$cabin.'","airline":"'.$airline.'"}';
        $response = $this->curl('WebService/GetCaptcha',$data,1);
        if (strpos($response, 'Authorization has been denied') !== false) {
            $this->set_login();
            $response = $this->curl('WebService/GetCaptcha',$data,1);
        }
        $result = json_decode($response);
        if ($result->Result == 'true')
        {
            return array('true'=>1,'data'=>($result->Data));
        }
        else
        {
            return array('true'=>0) ;
        }
    }

    function reserve ($data)
    {
        $this->get_auth();

        $data = json_encode($data) ;
        $response = $this->curl('WebService/Reservation',$data,1);
        if (strpos($response, 'Authorization has been denied') !== false) {
            $this->set_login();
            $response = $this->curl('WebService/Reservation',$data,1);
        }
        $result = json_decode($response);
        if ($result->Result == 'true')
        {
            return array('resutl'=>1,'data'=>$result->Data);
        }
        else
        {
            return array('resutl'=>0,'data'=>$response) ;
        }
    }

    public  function maketicket($data)
    {
        $this->get_auth();

        $data = json_encode($data) ;
        $response = $this->curl('WebService/BuyTicket',$data,1);
        if (strpos($response, 'Authorization has been denied') !== false) {
            $this->set_login();
            $response = $this->curl('WebService/BuyTicket',$data,1);
        }
        $result = json_decode($response);
        if ($result->Result == 'true')
        {
            return array('resutl'=>1,'data'=>$result->Data);
        }
        else
        {
            return array('resutl'=>0,'data'=>$response) ;
        }
    }

    public function get_auth()
    {
        if(!Yii::$app->session->get('charter724-auth')){
            $this->login();
        }
    }

    public function curl($url='',$data,$header='')
    {
        if($url=='')
            return 0;

        set_time_limit(0);
        $url=$this->url.$url;
        $headers = array(
            'Host: '.$this->uri,
            'Content-Type:application/json'
        );
        if ($header != '')
        {
            $headers = array(
                'Host: '.$this->uri,
                'Content-Type:application/json',
                'Authorization:' . Yii::$app->session->get('charter724-auth')
        );
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST ,'POST');
        curl_setopt($ch, CURLOPT_URL, $url); // Define target site
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Return page in string
        $url1 = curl_getinfo($ch , CURLINFO_EFFECTIVE_URL);
        $sss=curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        $page = curl_exec($ch);
        curl_close($ch);

        return $page ;

    }

}
