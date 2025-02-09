<?php

namespace common\models;

use Yii;
use common\models\User;

/**
* This is the model class for table "city".
*
    * @property integer $id
    * @property integer $sep_id
    * @property string $raja_id
    * @property string $name
    * @property integer $status
    * @property integer $created_at
    * @property integer $updated_at
*/
class City extends \common\models\base\ActiveRecord     /* \yii\db\ActiveRecord */
{
const SCENARIO_CUSTOM = 'custom';
/* statuses */
const STATUS_DRAFT = 0;
const STATUS_PENDING = 1;
const STATUS_PUBLISH = 2;

/**
* @inheritdoc
*/
public static function tableName()
{
return 'city';
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

/* ====================================================================== */

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['sep_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['raja_id', 'name'], 'string', 'max' => 255],
            [['sep_id'], 'unique'],
            [['raja_id'], 'unique'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('rabint', 'ID'),
    'sep_id' => Yii::t('rabint', 'شناسه شهر در سپهر360'),
    'raja_id' => Yii::t('rabint', 'شناسه شهر در رجا'),
    'name' => Yii::t('rabint', 'نام شهر'),
    'status' => Yii::t('rabint', 'وضعیت'),
    'created_at' => Yii::t('rabint', 'ایجاد شده در'),
    'updated_at' => Yii::t('rabint', 'بروزرسانی شده در'),
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
