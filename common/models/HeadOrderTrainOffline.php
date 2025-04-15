<?php

namespace common\models;

use Yii;
use common\models\User;

/**
* This is the model class for table "head_order_train_offline".
*
    * @property integer $id
    * @property string $full_name
    * @property string $cell
    * @property string $code
    * @property string $description
    * @property integer $user_id
    * @property integer $from
    * @property integer $to
    * @property string $date
    * @property string $type
    * @property integer $status
    * @property integer $price
    * @property integer $transaction_id
    * @property integer $ticket_file
    * @property integer $request_type
    * @property integer $reserve_time
    * @property integer $created_at
    * @property integer $updated_at
    * @property integer $created_by
    * @property integer $updated_by
    *
            * @property FinanceTransactions $financeTransactions
            * @property ItemOrderTrainOffline[] $itemOrderTrainOfflines
    */
class HeadOrderTrainOffline extends \common\models\base\ActiveRecord     /* \yii\db\ActiveRecord */
{
const SCENARIO_CUSTOM = 'custom';
/* statuses */
const STATUS_DRAFT = 0;//ثبت شده
const STATUS_ACTIVE = 1;// موبایل تایید شده
const STATUS_RESERVED = 2;//رزرو انجام شده
const STATUS_PAYED = 3;//پرداخت شده
const STATUS_CANCELED = 4;//کنسل شده

    const CLIENT_TYPES=[
        1=>"عادی",
        2=>"شاهد",
        3=>"اتباع",
    ];

/**
* @inheritdoc
*/
public static function tableName()
{
return 'head_order_train_offline';
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
        static::STATUS_DRAFT => ['title' => \Yii::t('rabint', 'ثبت شده')],
        static::STATUS_ACTIVE => ['title' => \Yii::t('rabint', 'در انتطار رزرو')],
        static::STATUS_RESERVED => ['title' => \Yii::t('rabint', 'رزرو شده')],
        static::STATUS_PAYED => ['title' => \Yii::t('rabint', 'پرداخت شده')],
        static::STATUS_CANCELED => ['title' => \Yii::t('rabint', 'کنسل شده')],
    ];
}

/* ====================================================================== */

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['full_name', 'cell', 'code', 'description', 'user_id', 'from', 'to', 'date', 'type', 'status', 'price', 'transaction_id', 'ticket_file', 'request_type', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['description'], 'string'],
            [['user_id', 'from', 'to', 'status', 'price', 'transaction_id', 'ticket_file', 'request_type', 'created_at', 'updated_at', 'created_by', 'updated_by','reserve_time'], 'integer'],
            [['full_name', 'cell', 'date', 'type'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 50],
            [['transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => FinanceTransactions::class, 'targetAttribute' => ['transaction_id' => 'id']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('rabint', 'شناسه'),
    'full_name' => Yii::t('rabint', 'معرف'),
    'cell' => Yii::t('rabint', 'شماره تماس'),
    'code' => Yii::t('rabint', 'کد'),
    'description' => Yii::t('rabint', 'توضیحات'),
    'user_id' => Yii::t('rabint', 'کاربر'),
    'from' => Yii::t('rabint', 'مبدا'),
    'to' => Yii::t('rabint', 'مقصد'),
    'date' => Yii::t('rabint', 'تاریخ'),
    'type' => Yii::t('rabint', 'نوع قطار'),
    'status' => Yii::t('rabint', 'وضعیت'),
    'price' => Yii::t('rabint', 'قیمت'),
    'transaction_id' => Yii::t('rabint', 'فاکتور'),
    'ticket_file' => Yii::t('rabint', 'فایل بلیت'),
    'reserve_time' => Yii::t('rabint', 'زمان انجام رزرو'),
    'request_type' => Yii::t('rabint', 'نوع درخواست'),
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

public function afterSave($insert, $changedAttributes)
{


    if($this->status==self::STATUS_ACTIVE){

        $token = 'bot195910:1372ccc9-0d72-45e4-8d28-0f2b8d62b834';
        $chat_id = 10561026;

        $from = TrainStation::findOne($this->from)->name;
        $to = TrainStation::findOne($this->to)->name;

        $caption = <<<EOL
درخواست جدید:
شماره پیگیری:$this->id
مبدا:$from
مقصد:$to
تاریخ حرکت:$this->date
نوع قطار:$this->type
معرف:$this->full_name
شماره تماس:$this->cell
توضیحات:$this->description
مسافران

EOL;
        foreach ($this->itemOrderTrainOfflines as $item){
            $type = self::CLIENT_TYPES[$item->client_type];
            $caption.=<<<EOL

نوع:$type
نام:$item->full_name
کدملی:$item->melli_code
تاریخ تولد:$item->birthdate
EOL;
        }


// initialise the curl request
        $request = curl_init('https://eitaayar.ir/api/' . $token . '/sendMessage');

// send a file
        curl_setopt($request, CURLOPT_POST, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $request, CURLOPT_POSTFIELDS,
            array(
                'chat_id' => $chat_id,
                'text' => $caption,
            ));

// output the response
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_exec($request);

// close the session
        curl_close($request);
    }

    parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
}


    /**
    * @return \common\models\base\ActiveQuery
    */
    public function getFinanceTransactions()
    {
    return $this->hasOne(FinanceTransactions::class, ['id' => 'transaction_id']);
    }

    /**
    * @return \common\models\base\ActiveQuery
    */
    public function getItemOrderTrainOfflines()
    {
    return $this->hasMany(ItemOrderTrainOffline::class, ['order_id' => 'id']);
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
