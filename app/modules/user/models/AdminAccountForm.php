<?php
namespace app\modules\user\models;

use yii\base\Model;
use Yii;

/**
 * Account form
 */
class AdminAccountForm extends Model
{
    public $redirect="";
    public $username;
    public $email;
    public $password;
    public $password_confirm;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['redirect', 'safe'],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique',
                'targetClass'=>'\app\modules\user\models\User',
                'message' => Yii::t('rabint', 'This username has already been taken.'),
                'filter' => function ($query) {
                    $query->andWhere(['not', ['id' => Yii::$app->user->id]]);
                }
            ],
            ['username', 'string', 'min' => 1, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass'=>'\app\modules\user\models\User',
                'message' => Yii::t('rabint', 'This email has already been taken.'),
                'filter' => function ($query) {
                    $query->andWhere(['not', ['id' => Yii::$app->user->getId()]]);
                }
            ],
            ['password', 'string'],
            [['password_confirm'], 'compare', 'compareAttribute' => 'password']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('rabint', 'Username'),
            'email' => Yii::t('rabint', 'Email'),
            'password' => Yii::t('rabint', 'Password'),
            'password_confirm' => Yii::t('rabint', 'Password Confirm')
        ];
    }
}
