<?php
namespace app\modules\api\controllers;

use \rabint\user\behaviors\UserHttpHeaderAuth;
use common\models\User;
use rabint\option\models\Option;
use yii\debug\models\search\Base;
use yii\rest\ActiveController;
use Yii;


class PrivateActiveBaseController extends ActiveBaseController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['basicAuth'] = [
            'class' => UserHttpHeaderAuth::class,
            'user' => new User(),
        ];

        return $behaviors;
    }

}