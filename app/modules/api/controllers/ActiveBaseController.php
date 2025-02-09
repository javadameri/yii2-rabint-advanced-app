<?php
namespace app\modules\api\controllers;

use rabint\option\models\Option;
use yii\rest\ActiveController;
use Yii;


class ActiveBaseController extends ActiveController
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

}