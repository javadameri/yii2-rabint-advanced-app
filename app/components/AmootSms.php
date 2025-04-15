<?php
namespace app\components;





use rabint\services\sms\ServiceAbstract;
use yii\helpers\Url;

class AmootSms extends ServiceAbstract
{
    public $token = "EDDA3F7C74C984C1496B9B6E2F112ED3CDF6F825";


    public function send($to, $message, $sender = null)
    {
        // TODO: Implement send() method.
    }

    public function sendToken($to, $code)
    {
        $url = "https://portal.amootsms.com/rest/SendQuickOTP";

        $url = $url."?"."Token=".urlencode($this->token);
        $url = $url."&"."Mobile=$to";
        $url = $url."&"."CodeLength=".strlen($code);
        $url = $url."&"."OptionalCode=$code";

        $json = file_get_contents($url);
        $result = json_decode($json);
        return $result->Status;
    }

    public function sendBulk($to, $message, $sender = null)
    {
        // TODO: Implement sendBulk() method.
    }

    public function getCredit()
    {
        // TODO: Implement getCredit() method.
    }
}