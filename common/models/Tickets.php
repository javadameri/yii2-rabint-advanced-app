<?php
namespace common\models;

use yii\base\Model;


/**
 * This is the model class for table "irtour_tickets".
 *
 * @property int $id
 * @property string $regdate
 * @property string $ticketid
 * @property string $ip
 * @property string $from
 * @property string $to
 * @property int $price
 * @property int $fprice
 * @property string $tdate
 * @property string $ttime
 * @property int $status
 * @property int $refund
 * @property string $fnumber
 * @property string $airline
 * @property string $mobile
 * @property string $email
 * @property string $class
 * @property string $pnr
 * @property string $api
 * @property string $ticketp
 * @property int $numberp
 * @property string $systemiparams
 * @property string $error
 * @property int $code_error
 * @property string $request_api
 * @property int $user_id
 * @property int $ticket_iduser
 * @property int $adl
 * @property int $chd
 * @property int $inf
 * @property int $pid
 * @property string $passenger_sepehr
 * @property int $random
 * @property string $payID
 * @property int $pay_status
 * @property string $user_level
 * @property int $apiID
 * @property int $user_markup
 * @property string $all_error
 * @property int $user_discount
 * @property int $payment_type
 * @property string $namep1
 * @property string $namep2
 * @property int $finalprice
 * @property string $refunddate
 * @property int $cachout
 * @property string $refunddescribe
 * @property string $temps
 * @property string $lastclass
 * @property string|null $captcha
 * @property int|null $captcha_id
 * @property string|null $log_payment
 * @property string|null $pdflink
 */

class Tickets extends \common\models\base\ActiveRecord
{
    public static function tableName()
    {
        return '{{%irtour_tickets}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regdate', 'ticketid', 'ip', 'from', 'to', 'price', 'fprice', 'tdate', 'ttime', 'status', 'refund', 'fnumber', 'airline', 'mobile', 'email', 'class', 'pnr', 'api', 'ticketp', 'numberp', 'systemiparams', 'error', 'code_error', 'request_api', 'user_id', 'ticket_iduser', 'adl', 'chd', 'inf', 'pid', 'passenger_sepehr', 'random', 'payID', 'pay_status', 'user_level', 'apiID', 'user_markup', 'all_error', 'user_discount', 'payment_type', 'namep1', 'namep2', 'finalprice', 'refunddate', 'cachout', 'refunddescribe', 'temps', 'lastclass'], 'required'],
            [['price', 'fprice', 'status', 'refund', 'numberp', 'code_error', 'user_id', 'ticket_iduser', 'adl', 'chd', 'inf', 'pid', 'random', 'pay_status', 'apiID', 'user_markup', 'user_discount', 'payment_type', 'finalprice', 'cachout', 'captcha_id'], 'integer'],
            [['tdate'], 'safe'],
            [['ticketp', 'systemiparams', 'error', 'request_api', 'passenger_sepehr', 'all_error', 'temps', 'pdflink'], 'string'],
            [['regdate', 'refunddate'], 'string', 'max' => 50],
            [['ticketid', 'ip', 'api'], 'string', 'max' => 20],
            [['from', 'to', 'fnumber', 'airline', 'mobile', 'lastclass'], 'string', 'max' => 15],
            [['ttime'], 'string', 'max' => 5],
            [['email'], 'string', 'max' => 125],
            [['class'], 'string', 'max' => 20],
            [['pnr'], 'string', 'max' => 40],
            [['payID'], 'string', 'max' => 100],
            [['user_level'], 'string', 'max' => 12],
            [['namep1', 'namep2', 'refunddescribe', 'log_payment'], 'string', 'max' => 500],
            [['captcha'], 'string', 'max' => 9],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'regdate' => 'Registration Date',
            'ticketid' => 'Ticket ID',
            'ip' => 'IP',
            'from' => 'From',
            'to' => 'To',
            'price' => 'Price',
            'fprice' => 'Final Price',
            'tdate' => 'Travel Date',
            'ttime' => 'Travel Time',
            'status' => 'Status',
            'refund' => 'Refund',
            'fnumber' => 'Flight Number',
            'airline' => 'Airline',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'class' => 'Class',
            'pnr' => 'PNR',
            'api' => 'API',
            'ticketp' => 'Ticket Details',
            'numberp' => 'Number of Passengers',
            'systemiparams' => 'System Parameters',
            'error' => 'Error',
            'code_error' => 'Error Code',
            'request_api' => 'API Request',
            'user_id' => 'User ID',
            'ticket_iduser' => 'Ticket User ID',
            'adl' => 'Adults',
            'chd' => 'Children',
            'inf' => 'Infants',
            'pid' => 'PID',
            'passenger_sepehr' => 'Passenger Sepehr',
            'random' => 'Random',
            'payID' => 'Payment ID',
            'pay_status' => 'Payment Status',
            'user_level' => 'User Level',
            'apiID' => 'API ID',
            'user_markup' => 'User Markup',
            'all_error' => 'All Errors',
            'user_discount' => 'User Discount',
            'payment_type' => 'Payment Type',
            'namep1' => 'Passenger 1 Name',
            'namep2' => 'Passenger 2 Name',
            'finalprice' => 'Final Price',
            'refunddate' => 'Refund Date',
            'cachout' => 'Cash Out',
            'refunddescribe' => 'Refund Description',
            'temps' => 'Temporary Data',
            'lastclass' => 'Last Class',
            'captcha' => 'Captcha',
            'captcha_id' => 'Captcha ID',
            'log_payment' => 'Payment Log',
            'pdflink' => 'PDF Link',
        ];
    }
}