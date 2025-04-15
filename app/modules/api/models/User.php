<?php

namespace app\modules\api\models;

use app\modules\finance\models\FinanceWallet;
use common\models\EventActor;
use rabint\attachment\models\Attachment;
use yii\helpers\ArrayHelper;


class User extends \common\models\User
{
    const SCENARIO_MORE = "more";
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_MORE] = [
            "id",
            "title",
            "image_url_id",
            "mobile_banner_id",
            "description",
        ];
        return $scenarios;
    }
    public function fields()
    {
        if($this->scenario==self::SCENARIO_MORE)
            return [
                "id",
                "username",
                "email",
                "userProfile",
                "wallet",
                "logged_at"
            ];
        return [
            "id",
            "username",
            "email",
            "userProfile",
            "wallet",
            "logged_at"
        ];
    }

    public function getWallet(){
        return \app\modules\finance\models\FinanceWallet::cash($this->id);
    }
}