<?php
namespace app\modules\api\controllers;



use app\components\f724;
use app\components\kavenegar;
use app\components\StaticData;
use common\models\HeadOrderTrainOffline;
use common\models\ItemOrderTrainOffline;
use common\models\Language;
use common\models\Passengers;
use common\models\Payments;
use common\models\Tickets;
use common\models\TrainStation;
use rabint\attachment\actions\UploadAction;
use rabint\attachment\models\Tmpupload;
use rabint\option\models\Option;
use yii\helpers\Url;
use yii\rest\Controller;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;

class PublicController extends Controller
{

    public function behaviors()
    {
//        return parent::behaviors();
        return array_merge(parent::behaviors(),[
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
                'cors' => [
                    // تنظیم مبدأ‌های مجاز
                    'Access-Control-Allow-Origin' => ['https://blitinja.6or.ir'], // یا ['http://example.com']
//                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
//                    'Access-Control-Max-Age' => 3600, // کش برای 1 ساعت
//                    'Access-Control-Allow-Headers' => ['*'],
                ],
            ],
        ]);
    }


    public function actions()
    {
        return [
            'file-upload' => [
                'class' => UploadAction::class,
                'modelName' => Tmpupload::class,
                'attribute' => 'attachment_id',
                // the type of the file (`image` or `file`)
                'type' => 'file',
                'inputName' => 'file',
                'guestCanUpload'=>"guest"
            ],
//            'wysiwyg-upload' => [
//                'class' => UploadRedactorAction::class,
//                'modelName' => Tmpupload::class,
//                'attribute' => 'attachment_id',
//                'inputName' => 'file',
//                // the type of the file (`image` or `file`)
//                'type' => 'file',
//            ],
        ];
    }


    public function beforeAction($action)
    {
        $allowed_origins = [
            'https://blitinja.6or.ir',
            'http://localhost',
            'https://example.com'
        ];

        $origin = $_SERVER['HTTP_ORIGIN'] ?? 'localhost';

//        header("HTTP/1.1 200 OK");
//        var_dump($origin);
//        exit();

        if (true||in_array($origin, $allowed_origins)) {
            header("Access-Control-Allow-Origin: $origin");
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("HTTP/1.1 200 OK");
            exit();
        }

        $language = Yii::$app->request->cookies->getValue('language', null);
        if($language){
            Yii::$app->language = $language;
        }else{
            // بررسی اینکه آیا کوکی زبان وجود دارد
            $acceptLanguage = Yii::$app->request->headers->get('Accept-Language');

            if ($acceptLanguage) {
                // پردازش مقدار Accept-Language
                $languages = array_map('trim', explode(',', $acceptLanguage));
                $primaryLanguage = explode(';', $languages[0])[0];
                // تنظیم زبان به صورت معتبر
                Yii::$app->language = $primaryLanguage;
            }
        }


        return parent::beforeAction($action);
    }

    public function actionInfo($item = "translate"){
        $options = Option::get($item);
        if($lang = Yii::$app->language){
            foreach ($options as $op){
                if($op['language']==$lang){
                    $l = Language::findOne(['code'=>$lang]);
                    $op['dir'] = $l->dir===1?"rtl":"ltr";
                    return $op;
                }
            }
            return $options[0];
        }else
            return $options[0];
    }


    public function actionFlights($from,$to,$date){
//        header("Access-Control-Allow-Origin: https://blitinja.6or.ir");
//        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
//        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
//        header("Access-Control-Allow-Credentials: true");
        $model = new f724;
        return $model->search($from,$to,$date);
    }


    public function actionCityFlights(){

//        header("Access-Control-Allow-Origin: https://blitinja.6or.ir");
//        header("Access-Control-Allow-Credentials: true");
        $model = new StaticData();
        return json_decode($model->json_city(),true);
    }

    public function actionPreviewFlights($from,$to){
        $model = new f724;
        return $model->Available15Days($from,$to);
    }

    function actionCaptcha(){
        $post = Yii::$app->request->post();
        $final = (new f724)->get_captcha($post['from'],$post['to'],$post['date'],$post['time'],$post['number'],$post['agancy'],$post['cabin'],$post['airline']);
        if ($final['true']==1)
        {
            $b64image = base64_encode(file_get_contents($final['data']->link_captcha));
            $id_req = $final['data']->id_request;
            return ['code'=> 200 , 'msg' => 'ok' , 'data'=>$b64image,'id_req'=>$id_req];
        }
        else
        {
            return ['code'=> 201 , 'msg' => 'no flight' , 'data'=>''];
        }
    }

    function actionReserve()
    {
        $post = Yii::$app->request->post();

        $model = new Tickets();
        $model->regdate = time();
        $model->ip = Yii::$app->request->userIP;
        $model->from = $post['from'];
        $model->to = $post['to'];
        $model->tdate = $post['date'];
        $model->ttime = $post['time'];
        $model->status = 2;
        $model->fnumber = $post['number'];
        $model->airline = $post['airline'];
        $model->mobile = $post['mobile'];
        $model->email = $post['email'];
        $model->class = $post['class']??'';
        $model->request_api = '';
        $model->ticketid = '';
        $model->price = 0;
        $model->fprice = 0;
        $model->refund = 0;
        $model->pnr = 0;
        $model->ticketp = 0;
        $model->systemiparams = 0;
        $model->error = '';
        $model->refunddescribe = '';
        $model->all_error = '';
        $model->user_discount = 0;
        $model->temps = 0;
        $model->lastclass = 0;
        $model->payment_type = 0;
        $model->namep1 = 0;
        $model->namep2 = 0;
        $model->finalprice = 0;
        $model->refunddate = 0;
        $model->cachout = 0;
        $model->code_error = 0;
        $model->user_id = 0;
        $model->ticket_iduser = 0;
        $model->pid = 0;
        $model->passenger_sepehr = 0;
        $model->random = 0;
        $model->payID = 0;
        $model->pay_status = 0;
        $model->user_level = 0;
        $model->apiID = 0;
        $model->user_markup = 0;
        $model->numberp = $post['infant']+$post['child']+$post['adult'];
        $model->api = '724';
        $model->adl = $post['adult'];
        $model->chd = $post['child'];
        $model->inf = $post['infant'];
        $model->captcha = intval($post['captcha']);
        $model->captcha_id = intval($post['captchaID']);
        if ($model->save(false)) {
            $ticket_i = $model->id;
            foreach ($post['passengers'] as $final_passenger) {
//                array(10) { ["id"]=> string(1) "1" ["first_name_english"]=> string(5) "javad" ["last_name_english"]=> string(9) "amerikiya" ["gender"]=> string(4) "male" ["documentType"]=> string(13) "national_code" ["type"]=> string(3) "ADL" ["defult"]=> string(4) "true" ["flight_type"]=> string(7) "charter" ["birthDate"]=> string(10) "1999-12-06" ["national_code"]=> string(10) "0950341398" }                $final_passenger['birthday']='';
//                $final_passenger['birthday']='';
//                $final_passenger['exPass']='';
//                $final_passenger['passNumber']='';
//                $final_passenger['nationality']='';
                $final_passenger['nationalityId']='1';
                if (isset($final_passenger['national_code']))
                {
                    if (strlen($final_passenger['national_code'])>4)
                    {
                        $final_passenger['nationality']='1';
                        $final_passenger['passport_expire_date']='';
                        $final_passenger['passport_number']='';
                        $final_passenger['nationality_code']='';
                    }
                    else
                    {
                        $final_passenger['national_code'] = ''  ;
                        $final_passenger['nationality']='2';
                    }

                }
                else
                {
                    $final_passenger['national_code'] = ''  ;
                    $final_passenger['nationality']='2';
                }

                if ($final_passenger['gender']=='male')
                    $final_passenger['gender']=1;
                else
                    $final_passenger['gender']=2;

                $passenger = new Passengers();
                $passenger->ticket_id = $model->id;
                $passenger->gender = $final_passenger['gender'];
                $passenger->name = 'علی';
                $passenger->family = 'جواهری';
                $passenger->ename = $final_passenger['first_name_english'];
                $passenger->efamily = $final_passenger['last_name_english'];
                $passenger->dob = $final_passenger['birthday'];
                $passenger->expdate = $final_passenger['passport_expire_date'];
                $passenger->nid = $final_passenger['national_code'];
                $passenger->type = $final_passenger['type'];
                $passenger->passport_number = $final_passenger['passport_number'];
                $passenger->nationality = $final_passenger['nationality'];
                $passenger->nationalitycode = $final_passenger['nationality_code'];
                if(!$passenger->save()){
                    echo "<pre>";
                    var_dump($passenger->errors);exit();
                }




//                if ($final_passenger['national_code']!='')
//                    if ($nic = $this->base_model->get_st('nic_id', array('nic' => $final_passenger['national_code']), 'id'))
//                    {
//
//                    }
//                    else
//                    {
//                        $insert211 = array(
//                            "nic" => $final_passenger['national_code'] ,
//                            "name" => strtolower($final_passenger['first_name_english']) ,
//                            "family" => strtolower($final_passenger['last_name_english']) ,
//                            "gender" => strtolower($final_passenger['gender']) ,
//                        );
//                        $this->base_model->insert_get_id('nic_id', $insert211);
//                    }
            }
            $allpassengers = Passengers::find()->where(["ticket_id"=>$model->id])->all();

            foreach ($allpassengers as $p){
                if ($p->expdate=='0000-00-00')
                    $p->expdate='';
                if ($p->nationality==2)
                {
                    if ($p->nationalitycode  == 'IRQ' || $p->nationalitycode  == 'AFG' || $p->nationalitycode  == 'ARM' || $p->nationalitycode  == 'BHR' || $p->nationalitycode  == 'CHN' || $p->nationalitycode  == 'IND' || $p->nationalitycode  == 'KWT' || $p->nationalitycode  == 'MYS' || $p->nationalitycode  == 'SYR' || $p->nationalitycode  == 'TUR' || $p->nationalitycode  == 'QAT')
                        $p->nationalitycode  = $p->nationalitycode ;
                    else
                        $p->nationalitycode  = 'IRQ' ;

                    $passe[] = array(
                        'passengerType'=> $p->type,
                        'fnamefa'=> $p->name ,
                        'lnamefa'=> $p->family ,
                        'fnameen'=> $p->ename ,
                        'lnameen'=> $p->efamily ,
                        'gender'=> $p->gender ,
                        'nationality'=> $p->nationality ,
                        'passengerCode'=> $p->passport_number ,
                        'nationalitycode'=> $p->nationalitycode ,
                        'expdate'=> $p->expdate ,
                        'birthday'=>  $p->expdate ,
                    );
                }
                else
                {
                    $passe[] = array(
                        'passengerType'=> $p->type,
                        'fnamefa'=> $p->name ,
                        'lnamefa'=> $p->family ,
                        'fnameen'=> $p->ename ,
                        'lnameen'=> $p->efamily ,
                        'gender'=> $p->gender ,
                        'nationality'=> $p->nationality ,
                        'passengerCode'=> $p->nid ,
                        'nationalitycode'=> $p->nationalitycode ,
                        'expdate'=> $p->expdate ,
                        'birthday'=>  $p->expdate ,
                    );
                }


            }

            $data = array(
                'id_request'=> $post['captchaID'],
                'captchcode'=>  $post['captcha'],
                'Mobile'=>  $post['mobile'],
                'Email'=>  $post['email'],
                'Passengers'=>  $passe,
            );

            $final1 = (new f724)->reserve($data);
            if ($final1['resutl']==0)
                $final=json_decode($final1['data'])->Data;
            else
                $final=$final1['data'];
            $alert_price = 0 ;
            if (isset($final->id_request) && !isset($final->link_captcha))
                if (strlen($final->id_request)>5)
                {
                    foreach ($allpassengers  as $aa)
                    {
                        foreach ($final->passenger_info as $a)
                        {
                            if ($a->type==$aa->type){
                                if ($aa->type=='ADL')
                                {
                                    if ($post['price_site'] != $a->real_price)
                                        $alert_price = 1 ;
                                }
                                $passenger = Passengers::findOne($aa->id);
                                $passenger->pda = $post['price_site'];
                                $passenger->price = $a->real_price;
                                $passenger->fprice = $a->fare;
                                $passenger->tfc = $a->real_price-$a->fare;
                                $passenger->save();
                            }
                        }
                    }
                    $allpassengers = Passengers::find()->where(["ticket_id"=>$model->id])->all();
                    $pass222 = array() ;
                    foreach ($allpassengers as $p){
                        if ($p->expdate=='0000-00-00')
                            $p->expdate='';
                        if ($p->nationality==2)
                        {
                            $pass222[] = array(
                                'passengerType'=> $p->type,
                                'fnamefa'=> $p->name ,
                                'lnamefa'=> $p->family ,
                                'fnameen'=> $p->ename ,
                                'lnameen'=> $p->efamily ,
                                'gender'=> $p->gender ,
                                'nationality'=> $p->nationality ,
                                'passengerCode'=> $p->passport_number ,
                                'nationalitycode'=> $p->nationalitycode ,
                                'expdate'=> $p->expdate ,
                                'birthday'=>  $p->expdate ,
                                'price'=>  $p->price ,
                                'fareprice'=>  $p->fprice ,
                                'taxprice'=>  $p->tfc ,
                            );
                        }
                        else
                        {
                            $pass222[] = array(
                                'passengerType'=> $p->type,
                                'fnamefa'=> $p->name ,
                                'lnamefa'=> $p->family ,
                                'fnameen'=> $p->ename ,
                                'lnameen'=> $p->efamily ,
                                'gender'=> $p->gender ,
                                'nationality'=> $p->nationality ,
                                'passengerCode'=> $p->nid ,
                                'nationalitycode'=> $p->nationalitycode ,
                                'expdate'=> $p->expdate ,
                                'birthday'=>  $p->expdate ,
                                'price'=>  $p->price ,
                                'fareprice'=>  $p->fprice ,
                                'taxprice'=>  $p->tfc ,
                            );
                        }
                    }
                    $detail=array('from'=>(new StaticData())->check_city($post['from']),'to'=>(new StaticData())->check_city($post['to']) , 'number'  => $post['number'] , 'airline'=>$post['airline'] , 'time'=>$post['time'],'date'=>$post['date']);
                    $model->price = $final->totalprice_request;
                    $model->fprice = $final->totalprice_request;
                    $model->passenger_sepehr = $final->id_request;
                    $model->random = $final->id_faktor;
                    $model->payID = rand(9999,99999);
                    $model->status = 5;
                    $model->request_api = serialize($final);
                    if(!$model->save(false)){
                        var_dump($model->errors);
                        exit();
                    }
                    return ['code'=> 200 , 'msg' => 'ok','data'=>array('alert_price'=>$alert_price,'price'=>$final->totalprice_request , 'detail' => $detail ,'passenger'=>$pass222,'id_factor'=>$ticket_i)];
                }
            $model->status = 4;
            $model->request_api = serialize($final);
            $model->save();
            if (isset($final->link_captcha))
            {
                $b64image = base64_encode(file_get_contents($final->link_captcha));
                $id_req = $final->id_request;
                $reload=1;
            }
            else
            {
                $b64image = '' ;
                $id_req = '' ;
                $reload=0;
            }
            $refresh=0;
            $msg='رزرو با مورد مواجه شد';
            if (!is_object($final))
            {
                if (strpos($final, 'problem in reserve') !== false) {
                    $refresh=1;
                    $msg='رزرو با مشکل مواجه شد دوباره تلاش کنید';
                }
                if (strpos($final, 'Not Valid Info id_reques') !== false) {
                    $refresh=1;
                }
            }
            if (is_object($final))
            {
                if (strpos($final->message, 'No Validated captchcode') !== false) {
                    $msg='کپچا را با دقت وارد نمایید';
                }
            }

            return ['code'=> 400 , 'msg' => $msg ,'data'=>$b64image,'id_req'=>$id_req,'reaload_captcha'=>$reload,'refresh'=>$refresh];
        }
        echo "<pre>";
        var_dump($model->errors);exit();

    }


    function actionPay($id)
    {
        $allpay = Tickets::find()->where(['id' => $id,'status'=>5,'pay_status'=>0])->one();
        if ($allpay)
        {
//            if($allpay->pay_status!=0)
//            {
//                $code=0;
//                $msg='زمان پرداخت انجام شده یا پرداخت انجام شده است';
//                return  json_encode( array('msg'=>$msg,'code'=>$code));
//            }
//            $this->load->model('main_model');
            $payment_describe = 'خرید بلیط هواپیما';
            $payment_username = 999 ;
            $payment_rand='flight';
            $infodargah['payment_rand'] = $payment_rand ;
//            $infodargah['bankselect'] = 'maniar';
//            $infodargah['pinmaniar']='250db501-e8c8-4ece-a96f-211a4af681df';
//            $infodargah['tokenmaniar']='D6buMUPEtfG-kTtDd4qh6VzMaFo6-l06WMILfm8q-x-1DjCsIunJmafCABlwhp9CyJJ4RDYVD5ziUE9epqDgt0IlgTr8-to0KuKulL9Gf77rCwjV1yqkY30MCW_SWi2pxZtIH2BODTTz7HpyFpHmPzgiM-3SvtMmrTOM5juJDYoUfAfp_XdF1L6VF0fLjDU2UZekqTY-K7vn-gGjB99z5yiGxhRWCwy3efETc-KCwiJ7w8qE8y_9HZ7vyVMQYZzUX_jOMiUrHtwkLMDvdtjh-Q';

            $infodargah['bankselect'] = 'saman';
            $infodargah['pinsaman'] = '50203106,5267373';

            $insertpay = array(
                'payment_describe' =>$payment_describe,
                'payment_username' => $payment_username,
                'payment_cellphone' => $allpay->mobile,
                'peymentAmount' => $allpay->fprice,
                'payment_email' => $allpay->email,
                'paymentDate' => time(),
                'bank_name' => $infodargah['bankselect'],
                'paymentType' => 'sell',
                'payment_ip' => Yii::$app->request->userIP,
                'payment_rand' => $infodargah['payment_rand'],
                'peymentAmountD' => $id,
                'user_id' => 9999,
                'payment_status' => 0,
                'paymentCode' => '',
                'paymentcodesale' => '',
                'requestPay' => '',
                'payOnlineV' => '',
                'requestVer' => '',
                'payment_au' => '',
                'respinaID' => 1,
                'payment_au2' => '',
                'payment_rs' => '',
                'payment_urlback' => '',
                'payment_describes' => '',
                'payment_describesadmin' => '',
            );
            $payment  = new Payments();
            foreach ($insertpay as $key=>$value){
                $payment->$key =$insertpay[$key];
            }
            $payment->save(false);
            if ($payments = $payment->paymentID)
            {
                Payments::paybank($insertpay,$infodargah,$allpay->fprice,'/',Url::to(['/api/public/payback',"verify"=>$allpay->payID,"id"=>$payments]),$payments,$allpay->mobile);
            }else
            {
//                $this->session->set_flashdata('msgER', 'خطا در اتصال به درگاه بانک  لطفا دوباره تلاش کنید .');
                exit('خطا');
            }

        }

        exit('asdasd333');
    }


    function actionPayback($verify,$id)
    {

        if ($id=='')
            exit();

//        $this->load->model('main_model');
        $id=trim(filter_var($id,FILTER_SANITIZE_NUMBER_INT));
        $POST=$_POST;
        $GET=$_GET;
        $REQUEST=$_REQUEST;
        if($payment=Payments::paymentresivebank('sell',$id,$REQUEST,$POST,$GET))
        {
//            $pay = $this->base_model->get_st('payments', array('paymentID' => $id), 'payment_rand,peymentAmountD');
            $pay = Payments::findOne($id);

            if ($pay->payment_rand == 'flight' )
            {
                $insertOrder2 = array(
                    "pay_status" => 1 ,
                );
                Tickets::updateAll($insertOrder2,['id' => $pay->peymentAmountD]);
//                $this->base_model->update_entry('irtour_tickets', $insertOrder2, array('id' => $pay->peymentAmountD ));
                Payments::maketicket($pay->peymentAmountD);
            }

//            $this->session->set_flashdata('msgER', 'پرداخت موفق');
            $url  = 'https://bl.6or.ir/flight-in-tickets/order/ticket-successfull?verify='.$verify.'&peymentID='.$pay->peymentAmountD;
            redirect($url);
            exit;
        }
        else
        {
//            $pay = $this->base_model->get_st('payments', array('paymentID' => $id), 'peymentAmountD');
            $pay = Payments::findOne($id);
//            $this->session->set_flashdata('msgER', 'پرداخت ناموفق دوباره تلاش کنید');
//            redirect(base_url('flights/ticket/'.$verify.'/'.$pay->peymentAmountD));

            $url  = 'https://bl.6or.ir/flight-in-tickets/order/ticket-unsuccessfull?verify='.$verify.'&peymentID='.$pay->peymentAmountD;
            redirect($url);
//            return $this->redirect($url);
            exit;
        }
    }

    public function actionGetData($verify,$id){
        $ticket = Tickets::findOne(["payID"=>$verify]);
        return $ticket->pdflink;
    }



    public function actionTranStation($q=null){
        $models = TrainStation::find()->filterWhere(["like","name",$q])->all();
        return $models;
    }


    public function actionSaveTrain(){
        $post = Yii::$app->request->post();
        if(empty($post)) {
            throw new BadRequestHttpException();
        }
        $head = new HeadOrderTrainOffline();
        $head->date = $post["departureDate"];
        $head->description = $post["description"];
        $head->to = $post["destination"]['id'];
        $head->from = $post["origin"]['id'];
        $head->cell = $post["phoneNumber"];
        $head->code = strval(rand(1000,9999));
        $head->full_name = $post["referrer"];
        $head->type = json_encode($post["trainType"]);
        $head->status = HeadOrderTrainOffline::STATUS_DRAFT;
        if(!$head->save()){
            var_dump($head->errors);exit();
        }
        foreach ($post['passengers'] as $item){
                $m = new ItemOrderTrainOffline();
                $m->order_id = $head->id;
                $m->birthdate = $item["birthDate"];
                $m->full_name = $item["fullName"];
                $m->melli_code = $item["nationalCode"];
                $m->client_type = $item["passengerType"];
                $m->shahed_cart = json_decode($item["witnessImages"])->front;
                $m->shahed_back = json_decode($item["witnessImages"])->back;
                $m->save();
                if(!$m->save()){
                    var_dump($head->errors);exit();
                }
        }


        (new kavenegar("3553546C423131534E6A724F64465946384137326F6B46733955715A6D5A4E30"))->VerifyLookup($head->cell,$head->code,"activecode");


        return $head->id;
    }

    public function actionCheckToken($id,$token){
        $model = HeadOrderTrainOffline::findOne($id);
        $key="code_offline".$id;
        $count = Yii::$app->cache->get($key)?:0;
        if($count>10)
            return false;
        Yii::$app->cache->set($key,$count+1,1000);

        if($model->code==$token&&$model->status==HeadOrderTrainOffline::STATUS_DRAFT){
            $model->status=HeadOrderTrainOffline::STATUS_ACTIVE;
             $model->save();
             return true;
        }
        return false;
    }







}