<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "train_stations".
 *
 * @property int $id
 * @property int $code
 * @property string $name
 * @property string $english_name
 * @property string|null $tel_code
 * @property string|null $station_group
 * @property bool|null $is_car_ticket
 * @property bool|null $is_exclusion
 */
class TrainStation extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'train_stations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'english_name'], 'required'],
            [['code'], 'integer'],
            [['name', 'english_name', 'tel_code', 'station_group'], 'string', 'max' => 255],
            [['is_car_ticket', 'is_exclusion'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'کد ایستگاه',
            'name' => 'نام فارسی',
            'english_name' => 'نام انگلیسی',
            'tel_code' => 'کد تلفن',
            'station_group' => 'دسته‌بندی ایستگاه',
            'is_car_ticket' => 'آیا بلیت خودرو دارد؟',
            'is_exclusion' => 'آیا استثنا است؟',
        ];
    }
}
