<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "payments".
 *
 * @property string $paymentID
 * @property string $user_id
 * @property string $payment_cellphone
 * @property string $payment_username
 * @property string $payment_email
 * @property string $payment_describe
 * @property string $peymentAmount
 * @property string $peymentAmountD
 * @property string $payment_ip
 * @property string $paymentDate
 * @property string $bank_name
 * @property int $payment_status
 * @property string $paymentType
 * @property string $paymentCode
 * @property string $paymentcodesale
 * @property string $requestPay
 * @property string $payOnlineV
 * @property string $requestVer
 * @property string $payment_au
 * @property string $payment_rand
 * @property string $respinaID
 * @property string $payment_au2
 * @property string $payment_rs
 * @property string $payment_urlback
 * @property string $payment_describes
 * @property string $payment_describesadmin
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'payment_cellphone', 'payment_username', 'payment_email', 'payment_describe', 'peymentAmount', 'peymentAmountD', 'payment_ip', 'paymentDate', 'bank_name', 'payment_status', 'paymentType', 'paymentCode', 'paymentcodesale', 'requestPay', 'payOnlineV', 'requestVer', 'payment_au', 'payment_rand', 'respinaID', 'payment_au2', 'payment_rs', 'payment_urlback', 'payment_describes', 'payment_describesadmin'], 'required'],
            [['user_id', 'peymentAmount', 'respinaID'], 'integer'],
            [['payment_describe', 'payment_urlback', 'payment_describes', 'payment_describesadmin'], 'string'],
            [['payment_cellphone'], 'string', 'max' => 12],
            [['payment_username'], 'string', 'max' => 150],
            [['payment_email'], 'string', 'max' => 100],
            [['peymentAmountD'], 'string', 'max' => 50],
            [['payment_ip', 'paymentDate', 'bank_name', 'paymentType', 'paymentCode', 'paymentcodesale', 'requestPay', 'payOnlineV', 'requestVer', 'payment_au', 'payment_rand', 'payment_au2', 'payment_rs'], 'string', 'max' => 255],
            [['payment_status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'paymentID' => 'Payment ID',
            'user_id' => 'User ID',
            'payment_cellphone' => 'Payment Cellphone',
            'payment_username' => 'Payment Username',
            'payment_email' => 'Payment Email',
            'payment_describe' => 'Payment Describe',
            'peymentAmount' => 'Peyment Amount',
            'peymentAmountD' => 'Peyment Amount D',
            'payment_ip' => 'Payment IP',
            'paymentDate' => 'Payment Date',
            'bank_name' => 'Bank Name',
            'payment_status' => 'Payment Status',
            'paymentType' => 'Payment Type',
            'paymentCode' => 'Payment Code',
            'paymentcodesale' => 'Payment Code Sale',
            'requestPay' => 'Request Pay',
            'payOnlineV' => 'Pay Online V',
            'requestVer' => 'Request Ver',
            'payment_au' => 'Payment AU',
            'payment_rand' => 'Payment Rand',
            'respinaID' => 'Respina ID',
            'payment_au2' => 'Payment AU2',
            'payment_rs' => 'Payment RS',
            'payment_urlback' => 'Payment URL Back',
            'payment_describes' => 'Payment Describes',
            'payment_describesadmin' => 'Payment Describes Admin',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PaymentsQuery the active query used by this AR class.
     */
//    public static function find()
//    {
//        return new PaymentsQuery(get_called_class());
//    }




    public static function paybank($insert,$infodargah,$peymentAmount,$Erurler,$BackUrl,$payments,$mobile)
    {
        if ($peymentAmount < 1000)
        {
//            $this->session->set_flashdata('msgER', 'مبلغ وارد شده کمتر از 1000 ریال می باشد .');
//            redirect(base_url() . $Erurler);
        }else
        {
            $callBackUrl = Url::base(). $BackUrl .'/' . $payments;

            if($insert['bank_name']=='melat')
            {
                $BankMelat=$infodargah['pinmelat'];

                $melatup=explode(',',$BankMelat);
                $userNamemelat=$melatup[0];
                $userPasswordmelat=$melatup[1];
                $MelatTerminalId=$melatup[2];
                set_time_limit(0);
//                $this->load->helper('melat');
                $status= @requestPay($payments,$peymentAmount,$callBackUrl,$insert['payment_describe'],$insert['user_id'],$userNamemelat,$userPasswordmelat,$MelatTerminalId);
                //$this->base_model->insert_get_id('test',array('data'=>json_encode($status)));
                $error_num[20] = 'پین فروشنده درست نیست';
                $error_num[22] = 'آی پی فروشنده مطابقت ندارد';
                $error_num[23] = 'عملیات قبلاً با موفقیت انجام شده';
                $error_num[34] = 'شماره تراکنش درست نیست !';
                $error_num[0] = 'تایید اولیه اتصال';
                $update = array(
                    'paymentCode' =>$BankMelat ,
                    'payment_au' => @$status['res'][1],
                    'requestPay' => @$status['res'][0],
                    'payment_urlback' => $callBackUrl,
                    'payment_describes' => 'er'.$status['er'].' وضعیت اتصال به درگاه :  ' . @$status['res'][0] . '  کد پرداخت : '.@$status['res'][1].' - '.@$error_num[$status['res'][0]].' - ' ,
                );
                $m = Payments::findOne($payments);
                $m->paymentCode = $update["paymentCode"];
                $m->payment_au = $update["payment_au"];
                $m->requestPay = $update["requestPay"];
                $m->payment_urlback = $update["payment_urlback"];
                $m->payment_describes = $update["payment_describes"];
                $m->save();
                if($status['res'][0]==0)
                {
                    $text="<form action='https://bpm.shaparak.ir/pgwchannel/startpay.mellat' method='post' name='frm'>";
                    $text=$text. "<input type='hidden' name='RefId' value='".htmlentities($status['res'][1])."'>";
                    $text=$text.'</form><script type="text/javascript">document.frm.submit();</script>';
                    echo $text;
                    exit();
                    die();
                    return;
                } else {
                    //return $status['res'][0];
//                    $this->session->set_flashdata('msgER', 'خطا در اتصال به درگاه بانک  لطفا دوباره تلاش کنید .');
                    redirect(Url::base());
                    exit();
                }
            }
            elseif($insert['bank_name']=='saman')
            {

                $BankSaman=$infodargah['pinsaman'];
                $melatup=explode(',',$BankSaman);
                $userNameSman=$melatup[0];
                $userPasswordsaman=$melatup[1];


                set_time_limit(0);
//                $this->load->helper('saman');
                $update = array(
                    'paymentCode' =>$BankSaman ,
                    'payment_au' => $payments,
                    'requestPay' => 0,
                    'payment_urlback' => $callBackUrl,
                    'payment_describes' => ' وضعیت  : اتصال به درگاه  ' ,
                );

                $m = Payments::findOne($payments);
                $m->paymentCode = $update["paymentCode"];
                $m->payment_au = $update["payment_au"];
                $m->requestPay = $update["requestPay"];
                $m->payment_urlback = $update["payment_urlback"];
                $m->payment_describes = $update["payment_describes"];
                $m->save();

                $sep_MID	 		= $userNameSman;
                $sep_Amount 		= $peymentAmount;
                $sep_ResNum 		= $payments;
                $sep_RedirectURL 	= $callBackUrl;
                $token = getTokenSaman($sep_MID,$sep_Amount,$sep_ResNum,$sep_RedirectURL,$insert['payment_cellphone']);

//                var_dump($sep_MID);
//                var_dump($sep_Amount);
//                var_dump($sep_ResNum);
//                var_dump($token);
//                exit;

                /*$param = array(
                    'Token'=>$token,
                    'RedirectURL'=>$sep_RedirectURL,
                );
                $url='https://sep.shaparak.ir/MobilePG/MobilePayment';
                $data = http_build_query($param);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL            => $url,
                    CURLOPT_RETURNTRANSFER => false,
                    CURLOPT_ENCODING       => "",
                    CURLOPT_POSTFIELDS     => $data,
                    CURLOPT_MAXREDIRS      => 30,
                    CURLOPT_FRESH_CONNECT      => false,
                    CURLOPT_TIMEOUT        => 10,
                    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST  => 'POST',
                    CURLOPT_CONNECTTIMEOUT     => 200,
                ));
                $response = curl_exec($curl);
                echo $response;
                exit();
                die();
                return;*/


                echo '<form id="__PostForm" name="__PostForm" action="https://sep.shaparak.ir/MobilePG/MobilePayment" method="POST"><input type="hidden" name="Token" value="'.$token.'"/><input type="hidden" name="RedirectURL" value="'.$sep_RedirectURL.'"/></form><script language="javascript">var v__PostForm=document.__PostForm;v__PostForm.submit();</script>';
                exit();
                die();
                return;
            }

        }
    }

}
