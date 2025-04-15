<?php

namespace app\modules\api\controllers;


use app\modules\user\behaviors\UserHttpHeaderAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\Controller;

/**
 * Default controller for the `api` module
 */
class ApiController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // اضافه کردن HttpBearerAuth و تنظیمات احراز هویت اختیاری برای تمام اکشن‌ها
        $behaviors['authenticator'] = [
            'class' => UserHttpHeaderAuth::class,
            'optional' => ['*'], // '*' به معنای اینکه احراز هویت برای تمام اکشن‌ها اختیاری است
        ];
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'], // یا لیست دامنه‌های مجاز
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
//                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Allow-Headers' => ['Authorization', 'Content-Type'],
            ],
        ];

        return $behaviors;
    }

    public function actionOptions()
    {
        \Yii::$app->response->statusCode = 200;
    }

}
