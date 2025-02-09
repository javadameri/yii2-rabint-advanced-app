<?php

namespace app\modules\api\controllers;


use app\modules\user\models\form\RegisterForm;
use \app\modules\user\models\form\LoginForm;
use common\models\User;
use rabint\helpers\locality;
use yii\db\ActiveRecord;
use yii\log\Logger;
use yii\rest\ActiveController;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UnauthorizedHttpException;
use Yii;

class AuthController extends ActiveController
{
    public $modelClass = User::class;

    /** @return array|string[][] */
    public function verbs()
    {
        return [
            'login' => ['POST'],
            'logout' => ['POST'],
            'register' => ['POST'],
        ];
    }

    /**
     * @api {POST} /api/auth/login Login a user
     * @apiName Login a user
     * @apiDescription A user can login to account
     * @apiGroup Account
     * @apiVersion 1.0.0
     * @apiPermission POST-loginAccount
     * 
     * @apiParam (Body) {String{11}} username Cellphone for login
     * @apiParam (Body) {String{11}} password Password for login
     */
    public function actionLogin()
    {
        $params = Yii::$app->request->post();
        if (empty($params)) {
            throw new NotFoundHttpException('وارد کردن نام کاربری و رمزعبور الزامی است');
        }
        if (!isset($params['email']) || empty($params['email'])) {
            throw new NotFoundHttpException('نام کاربری را وارد نمایید');
        }
        if (!isset($params['password']) || empty($params['password'])) {
            throw new NotFoundHttpException('رمز عبور را وارد نمایید');
        }

        if (Yii::$app->user->isGuest) {
            $model = new LoginForm();
            $model->identity = $params['email'];
            $model->password = $params['password'];

            if (!$model->login() || !isset(Yii::$app->user) || !isset(Yii::$app->user->identity)) {

                // if(Yii::$app->request->userIP == '89.235.78.219') {
                //     var_dump($model->getErrors());exit;
                // }

                // var_dump($model->getErrors());
                // exit;

                throw new UnauthorizedHttpException('اطلاعات وارد شده صحیح نیست');
            } 
        }

        return [
            'token' => Yii::$app->user->identity->access_token,
        ];
    }

    /**
     * @api {POST} /api/auth/logout Logout a user
     * @apiName Logout a user
     * @apiDescription A user can logout to account
     * @apiGroup Account
     * @apiVersion 1.0.0
     * @apiPermission POST-logoutAccount
     */
    public function actionLogout()
    {
        if(!Yii::$app->user->isGuest) {
            return Yii::$app->user->logout();
        }
        throw new NotFoundHttpException();
    }

    public function actionRegister()
    {
        $params = Yii::$app->request->post();
        if (empty($params) || !isset($params['email']) || empty($params['email'])) {
            throw new NotFoundHttpException('شماره موبایل الزامی است');
        }

        $model = new RegisterForm();
        $model->username = $params['email'];
        $model->password = $params['password'];
        $model->confirm = $params['confirm'];
        $model->identity = $params['email'];

        if ($model->signUp(false)) {
            return 'Registered';
        } else {
            foreach($model->getErrors() as $error) {
                $errMessage = is_array($error) ? $error[0] : $error;
                throw new NotAcceptableHttpException($errMessage);
            }
        }
        throw new NotAcceptableHttpException('درخواست عضویت معتبر نیست');
    }

    /**
     * Finds the Cinema model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActiveRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;

        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('مدل انتخابی در سیستم موجود نیست!');
    }
}