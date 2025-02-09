<?php
namespace app\modules\api\controllers;

use app\modules\api\models\News;
use app\modules\api\models\User;
use rabint\attachment\actions\UploadAction;
use rabint\attachment\actions\UploadRedactorAction;
use rabint\attachment\models\Tmpupload;
use rabint\helpers\str;

class ProfileController extends PrivateBaseController
{
    /** @return array|\string[][] */
    public function verbs()
    {
        return [
            'view' => ['GET'],
            'update' => ['POST'],
        ];
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
            ],
            'wysiwyg-upload' => [
                'class' => UploadRedactorAction::class,
                'modelName' => Tmpupload::class,
                'attribute' => 'attachment_id',
                'inputName' => 'file',
                // the type of the file (`image` or `file`)
                'type' => 'file',
            ],
        ];
    }

    public function actionView()
    {
        $id = \Yii::$app->user->id;
        $user = User::findOne($id);
        if ($user) {
            return $user;
        }

        return ['error' => 'User not found'];
    }

    public function actionUpdate(){
        $post  = \Yii::$app->request->post();

        $user = \Yii::$app->user->identity;
        
        $profile = $user->userProfile;

        if(isset($post["mobile"])){
            $user->email = \Yii::$app->user->identity->username;
            $user->mobile = $post["mobile"];
        }
        if(isset($post["nickname"]))
            $profile->nickname = $post["nickname"];
        if(isset($post["avatar_url"]))
            $profile->avatar_url = $post["avatar_url"];
        if(isset($post["gender"]))
            $profile->gender = $post["gender"];
        if(isset($post["phone"]))
            $profile->phone = $post["phone"];
        if(isset($post["postal_code"]))
            $profile->postal_code = $post["postal_code"];
        if(isset($post["brithdate"]))
            $profile->brithdate = $post["brithdate"];
        if(isset($post["country"]))
            $profile->country = $post["country"];
        if(isset($post["state"]))
            $profile->state = $post["state"];
        if(isset($post["city"]))
            $profile->city = $post["city"];
        if(isset($post["address"]))
            $profile->address = $post["address"];
        if(isset($post["mobile"])&&!$user->save()){
            return ["message"=>"در ذخیره سازی اطلاعات مشکلی ایجاد شده است.".str::modelErrToStr($user->errors)];
        }
        if ($profile->save()) {
            return ["message"=>"اطلاعات حساب کاربری شما با موفقیت ذخیره شده"];
        } else {
            return ["message"=>"در ذخیره سازی اطلاعات مشکلی ایجاد شده است.".PHP_EOL.str::modelErrToStr($profile->errors).PHP_EOL.str::modelErrToStr($user->errors)];
        }
    }
}
