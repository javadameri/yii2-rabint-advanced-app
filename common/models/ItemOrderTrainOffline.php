<?php

namespace common\models;

use Yii;
use common\models\User;

/**
* This is the model class for table "item_order_train_offline".
*
    * @property integer $id
    * @property integer $client_type
    * @property string $full_name
    * @property string $melli_code
    * @property string $birthdate
    * @property string $description
    * @property integer $order_id
    * @property integer $shahed_cart
    * @property integer $shahed_back
    * @property integer $created_at
    * @property integer $updated_at
    * @property integer $created_by
    * @property integer $updated_by
    *
            * @property HeadOrderTrainOffline $headOrderTrainOffline
    */
class ItemOrderTrainOffline extends \common\models\base\ActiveRecord     /* \yii\db\ActiveRecord */
{
const SCENARIO_CUSTOM = 'custom';
/* statuses */
const STATUS_DRAFT = 0;
const STATUS_PENDING = 1;
const STATUS_PUBLISH = 2;

    const PASSENGER_TYPE_NORMAL = 1;
    const PASSENGER_TYPE_WITNESS = 2;
    const PASSENGER_TYPE_FOREIGN = 3;

/**
* @inheritdoc
*/
public static function tableName()
{
return 'item_order_train_offline';
}


public function behaviors() {
return [
[
'class' => \yii\behaviors\TimestampBehavior::class,
'createdAtAttribute' => 'created_at',
'updatedAtAttribute' => 'updated_at',
'value' => time(),
],
[
'class' => \yii\behaviors\BlameableBehavior::class,
'createdByAttribute' => 'created_by',
'updatedByAttribute' => 'updated_by',
],
// [
//     'class' =>\rabint\behaviors\SoftDeleteBehavior::class,
//     'attribute' => 'deleted_at',
//     'attribute' => 'deleted_by',
// ],
/*[
'class' => \rabint\behaviors\Slug::class,
'sourceAttributeName' => 'title', // If you want to make a slug from another attribute, set it here
'slugAttributeName' => 'slug', // Name of the attribute containing a slug
],*/
];
}

public function scenarios() {
$scenarios = parent::scenarios();
// $scenarios[self::SCENARIO_CUSTOM] = ['status'];
return $scenarios;
}


/* ====================================================================== */

public static function statuses() {
return [
static::STATUS_DRAFT => ['title' => \Yii::t('rabint', 'draft')],
static::STATUS_PENDING => ['title' => \Yii::t('rabint', 'pending')],
static::STATUS_PUBLISH => ['title' => \Yii::t('rabint', 'publish')],
];
}
public static function passengerType() {
return [
    static::PASSENGER_TYPE_NORMAL => ['title' => \Yii::t('rabint', 'عادی')],
    static::PASSENGER_TYPE_WITNESS => ['title' => \Yii::t('rabint', 'شاهد')],
    static::PASSENGER_TYPE_FOREIGN => ['title' => \Yii::t('rabint', 'اتباع خارجی')],
];
}

/* ====================================================================== */

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['client_type', 'full_name', 'melli_code', 'birthdate', 'description', 'order_id', 'shahed_cart', 'shahed_back', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['client_type', 'order_id', 'shahed_cart', 'shahed_back', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['full_name'], 'string', 'max' => 255],
            [['melli_code', 'birthdate'], 'string', 'max' => 20],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => HeadOrderTrainOffline::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('rabint', 'شناسه'),
    'client_type' => Yii::t('rabint', 'نوع مسافر'),
    'full_name' => Yii::t('rabint', 'نام و نام خانوادگی'),
    'melli_code' => Yii::t('rabint', 'کدملی'),
    'birthdate' => Yii::t('rabint', 'تاریخ تولد'),
    'description' => Yii::t('rabint', 'توضیحات'),
    'order_id' => Yii::t('rabint', 'سفارش'),
    'shahed_cart' => Yii::t('rabint', 'کارت شاهد'),
    'shahed_back' => Yii::t('rabint', 'پشت کارت شاهد'),
    'created_at' => Yii::t('rabint', 'ایجاد شده در'),
    'updated_at' => Yii::t('rabint', 'بروزرسانی شده در'),
    'created_by' => Yii::t('rabint', 'ایجاد شده توسط'),
    'updated_by' => Yii::t('rabint', 'بروزرسانی شده توسظ'),
];
}

/**
* @inheritdoc
*/
public function beforeSave($insert)
{
//if(!empty($this->publish_at)){
//    $this->publish_at = \rabint\helpers\locality::anyToGregorian($this->publish_at);
//    $this->publish_at = strtotime($this->publish_at);// if timestamp needs
//}
return parent::beforeSave($insert);
}



    /**
    * @return \common\models\base\ActiveQuery
    */
    public function getHeadOrderTrainOffline()
    {
    return $this->hasOne(HeadOrderTrainOffline::class, ['id' => 'order_id']);
    }
    /**
    * @inheritdoc
    * @return \rabint\models\query\PublishQuery the active query used by this AR class.
    */
    //public static function find()
    //{
    //    $publishQuery = new \rabint\models\query\PublishQuery(get_called_class());
    //    $publishQuery->statusField="status";
    //    $publishQuery->activeStatusValue=self::STATUS_PUBLISH;
    //    $publishQuery->ownerField="creator_id";
    //    $publishQuery->showNotActiveToOwners=true;
    //    return $publishQuery;
    //}

}
