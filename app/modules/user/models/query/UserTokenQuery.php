<?php

namespace app\modules\user\models\query;

use common\models\base\ActiveQuery;

/**
 * Class UserTokenQuery
 * @package app\modules\user\models\query
 * @author Eugene Terentev <eugene@terentev.net>
 */
class UserTokenQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function notExpired()
    {
        $this->andWhere(['>', 'expire_at', time()]);
        return $this;
    }

    /**
     * @param $type
     * @return $this
     */
    public function byType($type)
    {
        $this->andWhere(['type' => $type]);
        return $this;
    }

    /**
     * @param $token
     * @return $this
     */
    public function byToken($token)
    {
        $this->andWhere(['token' => $token]);
        return $this;
    }

     /**
     * @param $token
     * @return $this
     */
    public function byUserId($user_id)
    {
        $this->andWhere(['user_id' => $user_id]);
        return $this;
    }
}