<?php
namespace app\modules\api\controllers;

use rabint\option\models\Option;
use yii\rest\Controller;
use Yii;


class BaseController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // حذف احراز هویت (دسترسی برای همه آزاد باشد)
        unset($behaviors['authenticator']);

        // افزودن CORS برای دسترسی همه
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
        ];

        return $behaviors;
    }

    public function beforeAction($action)
    {

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
}