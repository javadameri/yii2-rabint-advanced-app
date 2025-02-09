<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "irtour_ticket_passengers".
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $gender
 * @property string $name
 * @property string $family
 * @property string $ename
 * @property string $efamily
 * @property string $nid
 * @property string $dob
 * @property string $type
 * @property int $meli
 * @property int $price
 * @property int $fprice
 * @property string $tfc
 * @property string $nationality
 * @property string $nationalitycode
 * @property string $expdate
 * @property int $vilcher
 * @property string $ticket_number
 * @property string $ticket_link
 * @property string $pnr
 * @property int $ticket_iduser
 * @property string $tktinfo
 * @property string $pda
 * @property string $passport_number
 * @property int $user_id
 * @property int $passengers_id
 * @property string $jarimerefund
 * @property string $pnrrefund
 * @property string $daterefund
 * @property int $refund
 * @property int $user_id_refund
 * @property string $user_type_refund
 * @property int $discoun
 * @property int $markup
 * @property int $finalprice
 * @property string $split
 * @property int $pricejarime
 * @property string $expnr
 * @property int $ticketrefund
 * @property string $airline
 * @property string $tdate
 * @property string $ttick
 * @property int $tticket
 * @property string $fnumber
 * @property string $dmmd
 * @property string $sacnumber
 * @property string $exprice
 * @property string $etr
 * @property string $rf
 * @property int $payment_status
 * @property int $payment_type
 * @property string $paymentID
 * @property string $namep2
 */
class Passengers extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%irtour_ticket_passengers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['ticket_id', 'gender', 'name', 'family', 'ename', 'efamily', 'nid', 'dob', 'type', 'meli', 'price', 'fprice', 'tfc', 'nationality', 'nationalitycode', 'expdate', 'vilcher', 'ticket_number', 'ticket_link', 'pnr', 'ticket_iduser', 'tktinfo', 'pda', 'passport_number', 'user_id', 'passengers_id', 'jarimerefund', 'pnrrefund', 'daterefund', 'refund', 'user_id_refund', 'user_type_refund', 'discoun', 'markup', 'finalprice', 'split', 'pricejarime', 'expnr', 'ticketrefund', 'airline', 'tdate', 'ttick', 'tticket', 'fnumber', 'dmmd', 'sacnumber', 'exprice', 'etr', 'rf', 'payment_status', 'payment_type', 'paymentID', 'namep2'], 'required'],
            [['ticket_id', 'gender', 'meli', 'price', 'fprice', 'vilcher', 'ticket_iduser', 'user_id', 'passengers_id', 'refund', 'user_id_refund', 'discoun', 'markup', 'finalprice', 'pricejarime', 'ticketrefund', 'tticket', 'payment_status', 'payment_type'], 'integer'],
            [['ticket_link', 'tktinfo', 'pda', 'expnr', 'dmmd', 'exprice', 'etr', 'rf'], 'string'],
            [['expdate'], 'safe'],
            [['name', 'ename'], 'string', 'max' => 25],
            [['family', 'efamily'], 'string', 'max' => 30],
            [['nid'], 'string', 'max' => 50],
            [['dob', 'type'], 'string', 'max' => 10],
            [['tfc', 'sacnumber'], 'string', 'max' => 255],
            [['nationality', 'nationalitycode', 'airline'], 'string', 'max' => 20],
            [['ticket_number', 'pnr', 'passport_number', 'paymentID', 'namep2'], 'string', 'max' => 100],
            [['jarimerefund', 'pnrrefund', 'daterefund'], 'string', 'max' => 50],
            [['user_type_refund'], 'string', 'max' => 50],
            [['split'], 'string', 'max' => 500],
            [['tdate'], 'string', 'max' => 20],
            [['ttick'], 'string', 'max' => 30],
            [['fnumber'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Ticket ID',
            'gender' => 'Gender',
            'name' => 'First Name',
            'family' => 'Last Name',
            'ename' => 'First Name (English)',
            'efamily' => 'Last Name (English)',
            'nid' => 'National ID',
            'dob' => 'Date of Birth',
            'type' => 'Type',
            'meli' => 'Is National?',
            'price' => 'Price',
            'fprice' => 'Final Price',
            'tfc' => 'TFC',
            'nationality' => 'Nationality',
            'nationalitycode' => 'Nationality Code',
            'expdate' => 'Passport Expiry Date',
            'vilcher' => 'Vilcher',
            'ticket_number' => 'Ticket Number',
            'ticket_link' => 'Ticket Link',
            'pnr' => 'PNR',
            'ticket_iduser' => 'Ticket User ID',
            'tktinfo' => 'Ticket Info',
            'pda' => 'PDA',
            'passport_number' => 'Passport Number',
            'user_id' => 'User ID',
            'passengers_id' => 'Passenger ID',
            'jarimerefund' => 'Penalty Refund',
            'pnrrefund' => 'PNR Refund',
            'daterefund' => 'Refund Date',
            'refund' => 'Refund',
            'user_id_refund' => 'User ID (Refund)',
            'user_type_refund' => 'User Type (Refund)',
            'discoun' => 'Discount',
            'markup' => 'Markup',
            'finalprice' => 'Final Price',
            'split' => 'Split',
            'pricejarime' => 'Penalty Price',
            'expnr' => 'EXPNR',
            'ticketrefund' => 'Ticket Refund',
            'airline' => 'Airline',
            'tdate' => 'Travel Date',
            'ttick' => 'TTick',
            'tticket' => 'TTicket',
            'fnumber' => 'Flight Number',
            'dmmd' => 'DMMD',
            'sacnumber' => 'SAC Number',
            'exprice' => 'Extra Price',
            'etr' => 'ETR',
            'rf' => 'RF',
            'payment_status' => 'Payment Status',
            'payment_type' => 'Payment Type',
            'paymentID' => 'Payment ID',
            'namep2' => 'Passenger Name 2',
        ];
    }
}
