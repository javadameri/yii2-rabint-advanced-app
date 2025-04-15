<?php
/**
 * Created by PhpStorm.
 * User: gisheh
 * Date: 7/22/23
 * Time: 1:38 PM
 */

namespace app\modules\api\controllers;



use app\modules\api\models\User;
use app\modules\user\behaviors\UserHttpHeaderAuth;
use app\modules\user\models\LoginForm;
use app\modules\user\models\UserToken;
use common\models\UserProfile;
use rabint\attachment\models\Attachment;
use rabint\helpers\locality;
use rabint\helpers\str;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\widgets\ActiveForm;

class UserController extends ApiController
{

    public function behaviors()
    {
        $ret = parent::behaviors();
        return array_merge($ret,[
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'get-mobile' => ['get'],
                    'register' => ['post'],
                    'send-token' => ['post'],
                    'check-token' => ['get'],
                    'login' => ['post'],
                    'set-password' => ['post'],
                    'update' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['get-mobile','register','send-token','check-token','login'],
                        'allow' => true,
                    ],
                    [
                        'actions'=>['set-password','profile','update'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],

        ]);
    }

    public function actionGetMobile($mobile){
        $user = User::findOne(['username'=>str::formatCellphone($mobile)]);
        return ["data"=>["register"=>$user!==null,"are_password"=>!empty($user->password_hash)]];
    }

    public function actionRegister($mobile){
        $user = User::findOne(['username'=>str::formatCellphone($mobile)]);
        if($user!==null)
            return ["data"=>["success"=>true]];
        $cell = $mobile;
        $user = new User();
        $user->username = str::formatCellphone($cell);
        $error = null;
        if ($user->validate(null, false) && $user->save(false)) {
            $profile = new UserProfile();
            $profile->user_id = $user->id;
            $profile->cell = str::formatCellphone($cell, "+98");
            $profile->save();

            $auth = Yii::$app->authManager;
            $auth->assign($auth->getRole(User::ROLE_USER), $user->id);

            $createdList[] = $cell;
        }else{
            $error = $user->errors;
            return ["data"=>["success"=>false,"error"=>$error]];
        }
        return ["data"=>["success"=>true]];
    }

    public function actionSendToken($mobile){
        $user = User::findOne([
            'username' => Str::formatCellphone(locality::convertToEnglish($mobile)),
        ]);

        if ($user === null) {
            //کاربر یاف نشد پس ثبت نام میشه
            $cell = $mobile;
            $user = new User();
            $user->username = str::formatCellphone($cell);
            $user->mobile = str::formatCellphone($cell);
            $user->status = User::STATUS_ACTIVE;
            if ($user->validate(null, false) && $user->save(false)) {
                $profile = new UserProfile();
                $profile->user_id = $user->id;
                $profile->cell = Str::formatCellphone($cell, "+98");
                $profile->save();
                $auth = Yii::$app->authManager;
                $auth->assign($auth->getRole(User::ROLE_USER), $user->id);
            }else{
                $error = $user->errors;
                return ["data"=>["success"=>false,"error"=>$error]];
            }
        }
        $result = UserToken::sendSmsToken($user, UserToken::TYPE_ACTIVATION);
        return ["data"=>["success"=>$result]];
    }

    public function actionCheckToken($mobile,$token){
        $user = User::findOne([
            'username' => Str::formatCellphone(locality::convertToEnglish($mobile)),
        ]);
        if($user===null)
            throw new ForbiddenHttpException();
        $t = UserToken::find()
            ->notExpired()
            ->byType(UserToken::TYPE_ACTIVATION)
            ->byToken($token)
            ->byUserId($user->id)
            ->one();

        if (!$t) {
            $key = "user-token-".$user->id;
            $number = Yii::$app->cache->get($key)?:0;
            if($number>10){
                $t = UserToken::find()
                    ->notExpired()
                    ->byType(UserToken::TYPE_ACTIVATION)
                    ->byUserId($user->id)
                    ->one();
                 $t->delete();
            }
            Yii::$app->cache->set($key,$number+1,60*5);
            throw new ForbiddenHttpException("توکن اشتباه است.");
        }
        $user->status = User::STATUS_ACTIVE;
        $user->save();
        return ["data"=>["token"=>$user->access_token]];
    }


    public function actionLogin($mobile,$password){
        $errormsg = "نام کاربری یا رمز عبور اشتباه است.";
        $user = User::findOne([
            'username' => Str::formatCellphone(locality::converttoEnglish($mobile)),
        ]);
        if($user===null)
            throw new ForbiddenHttpException($errormsg);


        $model = new LoginForm();

        $model->scenario = LoginForm::SCENARIO_FIRST_TRY;
        $model->password = $password;
        $model->identity = $user->username;
        if($model->login()){
            return ["data"=>["token"=>$user->access_token]];
        }else{
            throw new ForbiddenHttpException($errormsg);
        }
    }

    public function actionSetPassword($password,$confirm){
        return ["data"=>["success"=>true]];
    }

    public function actionProfile(){
        return User::findOne(Yii::$app->user->id);
    }

    public function actionUpdate(){
        $post = Yii::$app->request->post();
        $error = [];
        if($post["email"]||$post["password"]){
            $user = Yii::$app->user->identity;
            $user->email = $post["email"];
            if($post["password"]&&strlen($post["password"])>5)
                $user->setPassword($post["password"]);
            if(!$user->save()){
                $error[]=$user->errors;
            }
        }
        $profile = UserProfile::findOne(["user_id"=>Yii::$app->user->id]);
        if(empty($profile)){
            $profile = new UserProfile();
            $profile->user_id = Yii::$app->user->id;
        }
        $profile->cell = $post["cell"];
        $profile->phone = $post["phone"];
        $profile->nickname = $post["nickname"];
        $profile->brithdate = $post["brithdate"];
        $profile->melli_code = $post["melli_code"];
        $profile->firstname = $post["firstname"];
        $profile->lastname = $post["lastname"];
        $profile->shaba = $post["shaba"];
        $profile->hesab = $post["hesab"];
        $profile->cart_no = $post["cart_no"];
        $profile->gender = $post["gender"];
        if($post["avatar_id"]){
            $profile["avatar_url"]=Attachment::getUrlById($post["avatar_id"]);
        }
        if(!$profile->save()){
            $error[]=$profile->errors;
        }
        return empty($error)?true:$error;
    }





}