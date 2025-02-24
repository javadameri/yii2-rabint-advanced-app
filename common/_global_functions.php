<?php

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

/**
 * @param $key
 * @param bool $default
 * @param bool $explode
 * @return array|bool|mixed
 */
function config($key, $default = false, $explode = false)
{
    return configApp(basename(RABINT_APP_DIR), $key, $default, $explode);
}


/**
 * @param $app
 * @return array
 */
function getEnvConfigs($app)
{
    static $envCache = false;
    if (!isset($envCache[$app])) {

//        if (RABINT_ENV == 'test') {
//            $app_env = 'test';
//        }elseif (file_exists(RABINT_BASE_DIR . '/' . $app . '/env.php')) {
//            $app_env = require RABINT_BASE_DIR . '/' . $app . '/env.php';
//        } else {
//            $app_env = require RABINT_BASE_DIR . '/env.php';
//        }

        $app_env = RABINT_ENV;

        $appEnvFile = RABINT_BASE_DIR . '/' . $app . '/_env/' . $app_env . '.php';
        $appBaseEnvFile = RABINT_BASE_DIR . '/' . $app . '/_env/base_env.php';
        $commonEnvFile = RABINT_BASE_DIR . '/_env/' . $app_env . '.php';
        $baseEnvFile = RABINT_BASE_DIR . '/_env/base_env.php';

        if (file_exists($appEnvFile) && file_exists($commonEnvFile)) {
            $envCache[$app] = config_deep_merge(include($commonEnvFile), include($appEnvFile));
        } elseif (file_exists($appEnvFile)) {
            $envCache[$app] = include($appEnvFile);
        } else {
            $envCache[$app] = include($commonEnvFile);
        }
        /**
         * merge with base
         */
        if (file_exists($appBaseEnvFile)) {
            $envCache[$app] = config_deep_merge(include($appBaseEnvFile), $envCache[$app]);
        }
        $envCache[$app] = config_deep_merge(include($baseEnvFile), $envCache[$app]);
    }
    return $envCache[$app];
}

function configApp($app, $key, $default = false, $explode = false)
{
    /**
     * caching
     */
    static $cache = [];

    if (isset($cache[$app . $key])) {
        return $cache[$app . $key];
    }

    $env = getEnvConfigs($app);

    if (strpos($key, '.')) {
        $keys = explode('.', $key);
        $ret = $env;
        foreach ($keys as $k) {
            if (isset($ret[$k])) {
                $ret = $ret[$k];
            } else {
                return $default;
                break;

            }
        }
        $return = $ret;
    } else {
        if (isset($env[$key])) {
            $return = $env[$key];
        }
    }
    if (!isset($return)) {
        $return = $default;
    }
    /* ------------------------------------------------------ */
    if ($explode) {
        $return = explode(',', $return);
        $return = array_map('trim', $return);
    }
    $cache[$app . $key] = $return;
    return $return;
}


/**
 * @return int|string
 */
function getMyId()
{
    return Yii::$app->user->getId();
}

/**
 * @param array $uri
 * @return string
 */
function combineParsedUrl($uri = [])
{
    $return = '';

    $return .= isset($uri['scheme']) ? $uri['scheme'] . "://" : "";

    $return .= isset($uri['user']) ? $uri['user'] : "";
    $return .= isset($uri['pass']) ? ":" . $uri['pass'] : "";
    $return .= (isset($uri['user']) or isset($uri['pass'])) ? "@" : "";

    $return .= isset($uri['host']) ? $uri['host'] : "";
    $return .= isset($uri['path']) ? $uri['path'] : "";
    $return .= isset($uri['query']) ? "?" . http_build_query($uri['query']) : "";
    $return .= isset($uri['fragment']) ? "#" . 'fragment' : "";
    return $return;
}

/**
 * @param array $uri
 * @return string
 */
function appHostInfo($uri)
{
    if (isset($uri['host'])) {
        $return = isset($uri['scheme']) ? $uri['scheme'] . "://" : "http://";
        $return .= $uri['host'];
    } else {
        $return = "";
    }
    return $return;
}

/**
 * @param string $view
 * @param array $params
 * @return string
 */
function render($view, $params = [])
{
    return Yii::$app->controller->render($view, $params);
}

/**
 * @param $url
 * @param int $statusCode
 * @return \yii\web\Response
 */
function redirect($url)
{
//    return Yii::$app->controller->redirect($url, $statusCode);
    if (is_array($url) && isset($url[0])) {
// ensure the route is absolute
        $url[0] = '/' . ltrim($url[0], '/');
    }
    $url = yii\helpers\Url::to($url);
    if (strpos($url, '/') === 0 && strpos($url, '//') !== 0) {
        $url = Yii::$app->getRequest()->getHostInfo() . $url;
    }
    if (headers_sent()) {
        echo '<META http-equiv="refresh" content="0;URL=' . $url . '">';
    } else {
        header("location: $url");
    }
    die();
}

function homeUrl()
{
    return Yii::$app->homeUrl;
}

function url($url = '', $scheme = false)
{
    return \yii\helpers\Url::to($url, $scheme);
}

function config_deep_merge($a, $b)
{
    $args = func_get_args();
    $res = array_shift($args);
    while (!empty($args)) {
        $next = array_shift($args);
        foreach ($next as $k => $v) {
//            if ($v instanceof UnsetArrayValue) {
//                die('p----');
//                unset($res[$k]);
//            } elseif ($v instanceof ReplaceArrayValue) {
//                die('p----');
//                $res[$k] = $v->value;
//            } else
            if (is_int($k)) {
                if (isset($res[$k])) {
                    $res[] = $v;
                } else {
                    $res[$k] = $v;
                }
            } elseif (is_array($v) && isset($res[$k]) && is_array($res[$k])) {
                $res[$k] = config_deep_merge($res[$k], $v);
            } else {
                $res[$k] = $v;
            }
        }
    }
//
    return $res;
}

function userCanDebug($debugersIp)
{
    if (empty($debugersIp)) {
        return false;
    }
    $debugersIp = explode(',', $debugersIp);
    $debugersIp = array_map(function ($item) {
        return trim($item);
    }, $debugersIp);

    $ip = getRealUserIp();
    if (in_array($ip, $debugersIp)) {
        return true;
    }
    return false;
}

function getRealUserIp()
{
    if ($isCLI = (php_sapi_name() == 'cli')) {
        return "";
    }
    if (isset($_SERVER['HTTP_X_REAL_IP'])) {
        return $_SERVER['HTTP_X_REAL_IP'];
    }
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $_SERVER['REMOTE_ADDR'];
}


function pr($str, $exit = false)
{
    echo "<pre>";
    print_r($str);
    echo "</pre>";
    if ($exit) {
        exit;
    }
}

function debug($str, $exit = false)
{
    echo "<pre>";
    var_dump($str);
    echo "</pre>";
    if ($exit) {
        exit;
    }
}


function modulesPath($postfix = "", $returnOnlyExists = true)
{
    $apps = include __DIR__ . '/config/apps.php';

    $return = [];
    /**
     * ineer modules
     */
    $modules = include RABINT_APP_DIR . '/config/modules.php';
    foreach ($modules as $name => $class) {
        $moduleDir = substr($class['class'], 0, 1 + strrpos($class['class'], '\\'));
        foreach ($apps as $appKey => $appData) {
            $moduleDir = str_replace($appKey.'\\', RABINT_BASE_DIR . '/'.$appKey.'/', $moduleDir);
        }
        $moduleDir = str_replace('\\', '/', $moduleDir);
        $moduleDir .= $postfix;
        if (!$returnOnlyExists) {
            $return[] = $moduleDir;
        } else if (file_exists($moduleDir)) {
            $return[] = $moduleDir;
        }
    }
    /**
     * vendor modules
     */
    $autoloadFile = include dirname(__DIR__) . '/vendor/composer/autoload_psr4.php';
    foreach ($modules as $name => $class) {
        $moduleNamespase = substr($class['class'], 0, 1 + strrpos($class['class'], '\\'));
        if (isset($autoloadFile[$moduleNamespase])) {
            foreach ($autoloadFile[$moduleNamespase] as $mns) {
                if (file_exists($mns)) {
                    $moduleDir = $mns;
                }
            }
        } else {
            $moduleDir = $moduleNamespase;
        }
        $moduleDir .= '/' . $postfix;
        if (!$returnOnlyExists) {
            $return[] = $moduleDir;
        } else if (file_exists($moduleDir)) {
            $return[] = $moduleDir;
        }
    }
    return $return;
}


function vd($str, $exit = false)
{
    echo "<pre>";
    var_dump($str);
    echo "</pre>";
    if ($exit) {
        exit;
    }
}

function explode_options($string, $delimiter = ',')
{
    return explode($delimiter, $string);
}

/**
 * @param $str
 * @param null $file_path full file path
 * @param string $separator
 * @return false|int
 */
function prf($str,$filename='flog.log',$filepath=null,$separator="\n"){

    if(empty($filepath)){
        $filepath = Yii::getAlias("@runtime");
    }
    $filepath .='/'.$filename;
    if(!is_string($str)){
        $str = var_export($str,1);
    }
    $comment = date("Y-m-d H:i:s") . " | " . $str . "\n";
    return file_put_contents($filepath, $comment, FILE_APPEND);
}

function requestPay($amount,$callBackUrl,$payerId,$pin='')
{
    $er='';
    $rest=array('status'=>'','au'=>'');
    $url = 'https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx';
    $soapclient = new SoapClient($url . '?WSDL', array('trace' => 1, 'location' => $url));
    $ClientSalePaymentRequestData = new stdClass();
    $amount = intval($amount);
    $ClientSalePaymentRequestData->requestData->LoginAccount =$pin; // 'w85a22EEYRqt27jYM2Yx';
    $ClientSalePaymentRequestData->requestData->Amount = $amount;
    $ClientSalePaymentRequestData->requestData->OrderId = $payerId;
    $ClientSalePaymentRequestData->requestData->CallBackUrl = $callBackUrl;
    $ClientSalePaymentRequestData->requestData->AdditionalData = $payerId;
//    var_dump($ClientSalePaymentRequestData);

    $res = $soapclient->SalePaymentRequest($ClientSalePaymentRequestData);
    if($res)
    {
        if(isset($res->SalePaymentRequestResult->Status) && $res->SalePaymentRequestResult->Status == 0)
        {
            $rest['status'] = $res->SalePaymentRequestResult->Status;
            $rest['au'] = $res->SalePaymentRequestResult->Token;
        }
        else
        {
            $rest['status'] = $res->SalePaymentRequestResult->Status;
            $rest['au'] = $res->SalePaymentRequestResult->Token;
            $er = $res->SalePaymentRequestResult->Message;
        }
    }
    else
    {
        $rest['status'] = 0;
        $rest['au'] = 0;
    }
    $result=array(
        'eror'=>$er,
        'res'=>$rest
    );
    return $result;
}

function getTokenSaman($sep_MID,$sep_Amount,$sep_ResNum,$sep_RedirectURL,$sep_Cellphone)
{
    $param = array(
        'action' => 'token',
        'TerminalId' => $sep_MID,
        'RedirectUrl' => $sep_RedirectURL,
        'ResNum' => $sep_ResNum,
        'Amount' => $sep_Amount,
        'CellNumber' => $sep_Cellphone,
    );
    $url='https://sep.shaparak.ir/MobilePG/MobilePayment';
    $data = http_build_query($param);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => "",
        CURLOPT_POSTFIELDS     => $data,
        CURLOPT_MAXREDIRS      => 30,
        CURLOPT_FRESH_CONNECT      => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'POST',
        CURLOPT_CONNECTTIMEOUT     => 200,
    ));
    $response = curl_exec($curl);
//    var_dump($response);
//    exit;
    //$err      = curl_error($curl);
    if($data = json_decode($response))
    {
        if(isset($data->status) && intval($data->status) == 1 && strlen($data->token) > 0)
        {
            return $data->token;
        }
    }
    return false;
}

function requestVer($verifySaleReferenceId,$userPasswordsaman,$MTID,$amount)
{
//    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
//    require_once Yii::getAlias('@nusoap');
//    var_dump(22);
//    exit;
    $Status['er']='';
    $Status['code']=false;
    $Status['res']=array();

//  $soapclient = @new nusoap_client('https://acquirer.samanepay.com/payments/referencepayment.asmx?WSDL','wsdl');
    //$soapclient = @new nusoap_client('https://sep.shaparak.ir/payments/referencepayment.asmx?WSDL','wsdl');

//    require_once Yii::getAlias('@app/components/nusoap/Nusoap.php');
//use app\components\nusoap\nusoap_client;
    $soapclient = new nusoap_client('https://verify.sep.ir/Payments/ReferencePayment.asmx?WSDL','wsdl');
//    $soapclient = @nusoap_client('https://verify.sep.ir/Payments/ReferencePayment.asmx?WSDL','wsdl');

    // تعریف آدرس WSDL
//    $wsdl = 'https://verify.sep.ir/Payments/ReferencePayment.asmx?WSDL';

// ایجاد شیء nusoap_client برای ارتباط با وب‌سرویس
//    $soapclient = new nusoap_client($wsdl, 'wsdl');

    $soapProxy = $soapclient->getProxy();
    $res=  $soapProxy->VerifyTransaction($verifySaleReferenceId,$MTID);


    if($res > 0)
    {

        if($amount==$res)
        {
            $Status['code']=true;
            $Status['res'][0] = '0';
            $Status['res'][1] =$res;

            return $Status;
        }else{
            $refund=$soapProxy->reverseTransaction($verifySaleReferenceId,$MTID,$userPasswordsaman,$res);

            $Status['code']=false;
            $Status['res'][0] = '-1';
            $Status['res'][1] = $res;
            $Status['er']='عدم تطابق مبلغ پرداختی';

            return $Status;
        }

    }else
    {
        $Status['code']=false;
        $Status['res'][0] = $res;
        $Status['res'][1] = $res;
        $Status['er']='خطا در پرداخت در صورت کسر مبلغ و عدم بازگشت تا 24 ساعت با مدیر سایت تماس حاصل فرمایید .';
        return $Status;
    }



}
function jdate($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'){

    $T_sec=0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

    if($time_zone!='local')date_default_timezone_set(($time_zone=='')?'Asia/Tehran':$time_zone);
    $ts=$T_sec+(($timestamp=='' or $timestamp=='now')?time():tr_num($timestamp));
    $date=explode('_',date('H_i_j_n_O_P_s_w_Y',$ts));
    list($j_y,$j_m,$j_d)=gregorian_to_jalali($date[8],$date[3],$date[2]);
    $doy=($j_m<7)?(($j_m-1)*31)+$j_d-1:(($j_m-7)*30)+$j_d+185;
    $kab=($j_y%33%4-1==(int)($j_y%33*.05))?1:0;
    $sl=strlen($format);
    $out='';
    for($i=0; $i<$sl; $i++){
        $sub=substr($format,$i,1);
        if($sub=='\\'){
            $out.=substr($format,++$i,1);
            continue;
        }
        switch($sub){

            case'E':case'R':case'x':case'X':
            $out.='http://jdf.scr.ir';
            break;

            case'B':case'e':case'g':
            case'G':case'h':case'I':
            case'T':case'u':case'Z':
            $out.=date($sub,$ts);
            break;

            case'a':
                $out.=($date[0]<12)?'ق.ظ':'ب.ظ';
                break;

            case'A':
                $out.=($date[0]<12)?'قبل از ظهر':'بعد از ظهر';
                break;

            case'b':
                $out.=(int)($j_m/3.1)+1;
                break;

            case'c':
                $out.=$j_y.'/'.$j_m.'/'.$j_d.' ،'.$date[0].':'.$date[1].':'.$date[6].' '.$date[5];
                break;

            case'C':
                $out.=(int)(($j_y+99)/100);
                break;

            case'd':
                $out.=($j_d<10)?'0'.$j_d:$j_d;
                break;

            case'D':
                $out.=jdate_words(array('kh'=>$date[7]),' ');
                break;

            case'f':
                $out.=jdate_words(array('ff'=>$j_m),' ');
                break;

            case'F':
                $out.=jdate_words(array('mm'=>$j_m),' ');
                break;

            case'H':
                $out.=$date[0];
                break;

            case'i':
                $out.=$date[1];
                break;

            case'j':
                $out.=$j_d;
                break;

            case'J':
                $out.=jdate_words(array('rr'=>$j_d),' ');
                break;

            case'k';
                $out.=tr_num(100-(int)($doy/($kab+365)*1000)/10,$tr_num);
                break;

            case'K':
                $out.=tr_num((int)($doy/($kab+365)*1000)/10,$tr_num);
                break;

            case'l':
                $out.=jdate_words(array('rh'=>$date[7]),' ');
                break;

            case'L':
                $out.=$kab;
                break;

            case'm':
                $out.=($j_m>9)?$j_m:'0'.$j_m;
                break;

            case'M':
                $out.=jdate_words(array('km'=>$j_m),' ');
                break;

            case'n':
                $out.=$j_m;
                break;

            case'N':
                $out.=$date[7]+1;
                break;

            case'o':
                $jdw=($date[7]==6)?0:$date[7]+1;
                $dny=364+$kab-$doy;
                $out.=($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y);
                break;

            case'O':
                $out.=$date[4];
                break;

            case'p':
                $out.=jdate_words(array('mb'=>$j_m),' ');
                break;

            case'P':
                $out.=$date[5];
                break;

            case'q':
                $out.=jdate_words(array('sh'=>$j_y),' ');
                break;

            case'Q':
                $out.=$kab+364-$doy;
                break;

            case'r':
                $key=jdate_words(array('rh'=>$date[7],'mm'=>$j_m));
                $out.=$date[0].':'.$date[1].':'.$date[6].' '.$date[4]
                    .' '.$key['rh'].'، '.$j_d.' '.$key['mm'].' '.$j_y;
                break;

            case's':
                $out.=$date[6];
                break;

            case'S':
                $out.='ام';
                break;

            case't':
                $out.=($j_m!=12)?(31-(int)($j_m/6.5)):($kab+29);
                break;

            case'U':
                $out.=$ts;
                break;

            case'v':
                $out.=jdate_words(array('ss'=>substr($j_y,2,2)),' ');
                break;

            case'V':
                $out.=jdate_words(array('ss'=>$j_y),' ');
                break;

            case'w':
                $out.=($date[7]==6)?0:$date[7]+1;
                break;

            case'W':
                $avs=(($date[7]==6)?0:$date[7]+1)-($doy%7);
                if($avs<0)$avs+=7;
                $num=(int)(($doy+$avs)/7);
                if($avs<4){
                    $num++;
                }elseif($num<1){
                    $num=($avs==4 or $avs==(($j_y%33%4-2==(int)($j_y%33*.05))?5:4))?53:52;
                }
                $aks=$avs+$kab;
                if($aks==7)$aks=0;
                $out.=(($kab+363-$doy)<$aks and $aks<3)?'01':(($num<10)?'0'.$num:$num);
                break;

            case'y':
                $out.=substr($j_y,2,2);
                break;

            case'Y':
                $out.=$j_y;
                break;

            case'z':
                $out.=$doy;
                break;

            default:$out.=$sub;
        }
    }
    return($tr_num!='en')?tr_num($out,'fa','.'):$out;
}
