<?php
namespace app\components;


use yii\base\Component;
use Yii;



class StaticData extends Component
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set('Asia/Tehran');
//        $this->lang->load('validation','fa');
    }

    function index()
    {

    }

    function check_city($c)
    {
        switch ($c)
        {
            case 'THR':
                $result='تهران';
                $eng='Tehran';
                break;
            case 'MHD':
                $result='مشهد';
                $eng='Mashhad';
                break;
            case 'IFN':
                $result='اصفهان';
                $eng='Isfahan';
                break;
            case 'TBZ':
                $result='تبریز';
                $eng='Tabriz';
                break;
            case 'SYZ':
                $result='شیراز';
                $eng='Shiraz';
                break;
            case 'ABD':
                $result='آبادان';
                $eng='Abadan';
                break;
            case 'AJK':
                $result='اراک';
                $eng='Araak';
                break;
            case 'ADU':
                $result='اردبیل';
                $eng='Ardabil';
                break;
            case 'OMH':
                $result='ارومیه';
                $eng='Urumieh';
                break;
            case 'AWZ':
                $result='اهواز';
                $eng='Ahvaz';
                break;
            case 'IHR':
                $result='ایرانشهر';
                $eng='Iran Shahr';
                break;
            case 'IIL':
                $result='ایلام';
                $eng='Ilaam';
                break;
            case 'BJB':
                $result='بجنورد';
                $eng='Bojnord';
                break;
            case 'BXR':
                $result='بم';
                $eng='Bam';
                break;
            case 'BDH':
                $result='بندر لنگه';
                $eng='Bandar Lengeh';
                break;
            case 'BND':
                $result='بندر عباس';
                $eng='Bandar Abbas';
                break;
            case 'BUZ':
                $result='بوشهر';
                $eng='Bushehr';
                break;
            case 'XBJ':
                $result='بیرجند';
                $eng='Birjand';
                break;
            case 'IKA':
                $result=' تهران';
                $eng='Imam Khomaini';
                break;
            case 'ZBR':
                $result='چابهار';
                $eng='Chah bahar';
                break;
            case 'KHD':
                $result='خرم آباد';
                $eng='Khorramabad';
                break;
            case 'KHY':
                $result='خوی';
                $eng='Khoy';
                break;
            case 'DEF':
                $result='دزفول';
                $eng='Dezful';
                break;
            case 'RZR':
                $result='رامسر';
                $eng='Ramsar';
                break;
            case 'RAS':
                $result='رشت';
                $eng='Rasht';
                break;
            case 'RJN':
                $result='رفسنجان';
                $eng='Rafsanjan';
                break;
            case 'ACZ':
                $result='زابل';
                $eng='Zabol';
                break;
            case 'BUZ':
                $result='زابل';
                $eng='Zabol';
                break;
            case 'ZAH':
                $result='زاهدان';
                $eng='Zahedan';
                break;
            case 'ZWN':
                $result='زابل';
                $eng='Zabol';
                break;
            case 'BUZ':
                $result='زنجان';
                $eng='Zanjan';
                break;
            case 'SRY':
                $result='ساری';
                $eng='Sary';
                break;
            case 'AFZ':
                $result='سبزوار';
                $eng='Sabzevar';
                break;
            case 'SDG':
                $result='سنندج';
                $eng='Sanandaj';
                break;
            case 'SYJ':
                $result='سیرجان';
                $eng='Sirjan';
                break;
            case 'RUD':
                $result='شاهرود';
                $eng='Shahroud';
                break;
            case 'CQD':
                $result='شهرکرد';
                $eng='Shahre kord';
                break;
            case 'TCX':
                $result='طبس';
                $eng='Tabas';
                break;
            case 'PGU':
                $result='عسلویه';
                $eng='Assaluyeh';
                break;
            case 'GZW':
                $result='قزوین';
                $eng='Ghazvin';
                break;
            case 'GSM':
                $result='قشم';
                $eng='Gheshm';
                break;
            case 'KER':
                $result='کرمان';
                $eng='Kerman';
                break;
            case 'KSH':
                $result='کرمانشاه';
                $eng='Kermanshah';
                break;
            case 'GCH':
                $result='گچساران';
                $eng='Gachsaran';
                break;
            case 'GBT':
                $result='گرگان';
                $eng='Gorgan';
                break;
            case 'LRR':
                $result='لارستان';
                $eng='Lar';
                break;
            case 'LFM':
                $result='لامرد';
                $eng='Lamerd';
                break;
            case 'MRX':
                $result='ماهشهر';
                $eng='Mahshahr';
                break;
            case 'NSH':
                $result='نوشهر';
                $eng='Now Shahr';
                break;
            case 'HDM':
                $result='همدان';
                $eng='Hamadan';
                break;
            case 'YES':
                $result='یاسوج';
                $eng='Yasouj';
                break;
            case 'KIH':
                $result='کیش';
                $eng='Kish';
                break;
            case 'AZD':
                $result='یزد';
                $eng='Yazd';
                break;
            case 'KSN':
                $result='کاشان';
                $eng='Kashan';
                break;
            case 'JYR':
                $result='جیرفت';
                $eng='jyroft';
                break;
            case 'IST':
                $result='استانبول';
                $eng='Istanbul';
                break;
            case 'DXB':
                $result='دبی';
                $eng='Dubai';
                break;
            case 'NJF':
                $result='نجف';
                $eng='Najaf';
                break;
            case 'BGW':
                $result='بغداد';
                $eng='Baghdad';
                break;
            case 'PYK':
                $result='کرج';
                $eng='karaj';
                break;
            default:
                $result='';
        }
        return $result;
    }


    function costflight($c)
    {

        switch ($c)
        {
//                case 'THR-KIH':
//                case 'KIH-THR':
//                    $result=9960000;
//                    break;
            case 'IFN-KIH':
            case 'KIH-IFN':
                $result=7384000;
                break;
            case 'BND-KIH':
            case 'KIH-BND':
                $result=5052000;
                break;
            case 'RAS-KIH':
            case 'KIH-RAS':
                $result=10521000;
                break;
            case 'SYZ-KIH':
            case 'KIH-SYZ':
                $result=5762000;
                break;
//                case 'MHD-KIH':
//                case 'KIH-MHD':
//                    $result=10935000;
//                    break;
            case 'MHD-THR':
            case 'THR-MHD':
                $result=7812000;
                break;
            default:
                $result=0;
        }
        return $result;

    }


    function json_city()
    {
        $json='{
  "code": 1,
  "msg": "Ok",
  "data": [
    {
      "name": "THR",
      "value": "Tehran - THR - تهران",
      "eng": "Tehran",
      "far": "تهران"
    },
    {
      "name": "MHD",
      "value": "Mashhad - MHD - مشهد",
      "eng": "Mashhad",
      "far": "مشهد"
    },
    {
      "name": "IFN",
      "value": "Isfahan - IFN - اصفهان",
      "eng": "Isfahan",
      "far": "اصفهان"
    },
    {
      "name": "TBZ",
      "value": "Tabriz - TBZ - تبریز",
      "eng": "Tabriz",
      "far": "تبریز"
    },
    {
      "name": "SYZ",
      "value": "Shiraz - SYZ - شیراز",
      "eng": "Shiraz",
      "far": "شیراز"
    },
    {
      "name": "ABD",
      "value": "Abadan - ABD - آبادان",
      "eng": "Abadan",
      "far": "آبادان"
    },
    {
      "name": "AJK",
      "value": "Araak - AJK - اراک",
      "eng": "Araak",
      "far": "اراک"
    },
    {
      "name": "ADU",
      "value": "Ardabil - ADU - اردبیل",
      "eng": "Ardabil",
      "far": "اردبیل"
    },
    {
      "name": "OMH",
      "value": "Urumieh - OMH - ارومیه",
      "eng": "Urumieh",
      "far": "ارومیه"
    },
    {
      "name": "AWZ",
      "value": "Ahvaz - AWZ - اهواز",
      "eng": "Ahvaz",
      "far": "اهواز"
    },
    {
      "name": "IHR",
      "value": "Iran Shahr - IHR - ایرانشهر",
      "eng": "Iran Shahr",
      "far": "ایرانشهر"
    },
    {
      "name": "IIL",
      "value": "Ilaam - IIL - ایلام",
      "eng": "Ilaam",
      "far": "ایلام"
    },
    {
      "name": "BJB",
      "value": "Bojnord - BJB - بجنورد",
      "eng": "Bojnord",
      "far": "بجنورد"
    },
    {
      "name": "BXR",
      "value": "Bam - BXR - بم",
      "eng": "Bam",
      "far": "بم"
    },
    {
      "name": "BDH",
      "value": "Bandar Lengeh - BDH - بندر لنگه",
      "eng": "Bandar Lengeh",
      "far": "بندر لنگه"
    },
    {
      "name": "BND",
      "value": "Bandar Abbas - BND - بندر عباس",
      "eng": "Bandar Abbas",
      "far": "بندر عباس"
    },
    {
      "name": "BUZ",
      "value": "Bushehr - BUZ - بوشهر",
      "eng": "Bushehr",
      "far": "بوشهر"
    },
    {
      "name": "XBJ",
      "value": "Birjand - XBJ - بیرجند",
      "eng": "Birjand",
      "far": "بیرجند"
    },
    {
      "name": "IKA",
      "value": "Imam Khomaini - IKA - امام خمینی تهران",
      "eng": "Imam Khomaini",
      "far": "امام خمینی تهران"
    },
    {
      "name": "ZBR",
      "value": "Chah bahar - ZBR - چابهار",
      "eng": "Chah bahar",
      "far": "چابهار"
    },
    {
      "name": "KHD",
      "value": "Khorramabad - KHD - خرم آباد",
      "eng": "Khorramabad",
      "far": "خرم آباد"
    },
    {
      "name": "KHY",
      "value": "Khoy - KHY - خوی",
      "eng": "Khoy",
      "far": "خوی"
    },
    {
      "name": "DEF",
      "value": "Dezful - DEF - دزفول",
      "eng": "Dezful",
      "far": "دزفول"
    },
    {
      "name": "RZR",
      "value": "Ramsar - RZR - رامسر",
      "eng": "Ramsar",
      "far": "رامسر"
    },
    {
      "name": "RAS",
      "value": "Rasht - RAS - رشت",
      "eng": "Rasht",
      "far": "رشت"
    },
    {
      "name": "RJN",
      "value": "Rafsanjan - RJN - رفسنجان",
      "eng": "Rafsanjan",
      "far": "رفسنجان"
    },
    {
      "name": "ACZ",
      "value": "Zabol - ACZ - زابل",
      "eng": "Zabol",
      "far": "زابل"
    },
    {
      "name": "ZAH",
      "value": "Zahedan - ZAH - زاهدان",
      "eng": "Zahedan",
      "far": "زاهدان"
    },
    {
      "name": "ZWN",
      "value": "Zanjan - JWN - زنجان",
      "eng": "Zanjan",
      "far": "زنجان"
    },
    {
      "name": "SRY",
      "value": "Sary - SRY - ساری",
      "eng": "Sary",
      "far": "ساری"
    },
    {
      "name": "AFZ",
      "value": "Sabzevar - AFZ - سبزوار",
      "eng": "Sabzevar",
      "far": "سبزوار"
    },
    {
      "name": "SDG",
      "value": "Sanandaj - SDG - سنندج",
      "eng": "Sanandaj",
      "far": "سنندج"
    },
    {
      "name": "SYJ",
      "value": "Sirjan - SYJ - سیرجان",
      "eng": "Sirjan",
      "far": "سیرجان"
    },
    {
      "name": "RUD",
      "value": "Shahroud - RUD - شاهرود",
      "eng": "Shahroud",
      "far": "شاهرود"
    },
    {
      "name": "CQD",
      "value": "Shahre kord - CQD - شهرکرد",
      "eng": "Shahre kord",
      "far": "شهرکرد"
    },
    {
      "name": "TCX",
      "value": "Tabas - TCX - طبس",
      "eng": "Tabas",
      "far": "طبس"
    },
    {
      "name": "PGU",
      "value": "Assaluyeh - PGU - عسلویه",
      "eng": "Assaluyeh",
      "far": "عسلویه"
    },
    {
      "name": "GZW",
      "value": "Ghazvin - GZW - قزوین",
      "eng": "Ghazvin",
      "far": "قزوین"
    },
    {
      "name": "GSM",
      "value": "Gheshm - GSM - قشم",
      "eng": "Gheshm",
      "far": "قشم"
    },
    {
      "name": "KER",
      "value": "Kerman - KER - کرمان",
      "eng": "Kerman",
      "far": "کرمان"
    },
    {
      "name": "KSH",
      "value": "Kermanshah - KSH - کرمانشاه",
      "eng": "Kermanshah",
      "far": "کرمانشاه"
    },
    {
      "name": "GCH",
      "value": "Gachsaran - GCH - گچساران",
      "eng": "Gachsaran",
      "far": "گچساران"
    },
    {
      "name": "GBT",
      "value": "Gorgan - GBT - گرگان",
      "eng": "Gorgan",
      "far": "گرگان"
    },
    {
      "name": "LRR",
      "value": "Lar - LRR - لارستان",
      "eng": "Lar",
      "far": "لارستان"
    },
    {
      "name": "LFM",
      "value": "Lamerd - LFM - لامرد",
      "eng": "Lamerd",
      "far": "لامرد"
    },
    {
      "name": "MRX",
      "value": "Mahshahr - MRX - ماهشهر",
      "eng": "Mahshahr",
      "far": "ماهشهر"
    },
    {
      "name": "NSH",
      "value": "Now Shahr - NSH - نوشهر",
      "eng": "Now Shahr",
      "far": "نوشهر"
    },
    {
      "name": "HDM",
      "value": "Hamadan - HDM - همدان",
      "eng": "Hamadan",
      "far": "همدان"
    },
    {
      "name": "YES",
      "value": "Yasouj - YES - یاسوج",
      "eng": "Yasouj",
      "far": "یاسوج"
    },
    {
      "name": "KIH",
      "value": "Kish - KIH - کیش",
      "eng": "Kish",
      "far": "کیش"
    },
    {
      "name": "AZD",
      "value": "Yazd - AZD - یزد",
      "eng": "Yazd",
      "far": "یزد"
    },
    {
      "name": "KSN",
      "value": "Kashan - KSN - کاشان",
      "eng": "Kashan",
      "far": "کاشان"
    },
    {
      "name": "PYK",
      "value": "Karaj - PYK - کرج",
      "eng": "Karaj",
      "far": "کرج"
    },
    {
      "name": "JYR",
      "value": "Jyroft - JYR - جیرفت",
      "eng": "Byroft",
      "far": "جیرفت"
    },
    {
      "name": "IST",
      "value": "Istanbul - IST - استانبول",
      "eng": "Istanbul",
      "far": "استانبول"
    },
    {
      "name": "DXB",
      "value": "Dubai - DXB - دبی",
      "eng": "Dubai",
      "far": "دبی"
    },
    {
      "name": "NJF",
      "value": "Najaf - NJF - نجف",
      "eng": "Najaf",
      "far": "نجف"
    },
    {
      "name": "BGW",
      "value": "Baghdad - BGW - بغداد",
      "eng": "Baghdad",
      "far": "بغداد"
    },
    {
      "name": "ANK",
      "value": "Ankara - ANK - آنکارا",
      "eng": "Ankara",
      "far": "آنکارا"
    }
  ]
}';
        return $json;
    }

    public function citycheck($type)
    {
        switch ($type) {

            case 'DXB':

                return true;

                break;
            case 'IST':

                return true;

                break;

            case 'NJF':

                return true;

                break;

            case 'BGW':

                return true;

                break;

            default :

                return false;

                break;

        }
    }

    public function convert_flight_type($type)
    {
        switch ($type)
        {
            case 'Aseman':
            case 'aseman':
            case 'EP':

                return 'EP';

                break;
            case 'Mahan':
            case 'W5':

                return 'W5';

                break;

            case 'meraj':
            case 'Meraj':
            case 'Meraj':
            case 'JI':

                return 'JI';

                break;

            case 'Atrak':
            case 'AK':

                return 'AK';

                break;
            case 'Iran Air':
            case 'iranair':
            case 'IR':
            case 'IRanair':

                return 'IR';

                break;
            case 'Naft':
            case 'naft':
            case 'NV':

                return 'NV';

                break;
            case 'Ata':
            case 'ata':
            case 'ATA':
            case 'I3':

                return 'I3';

                break;
            case 'Air tour':
            case 'airtour':
            case 'B9':

                return 'B9';

                break;
            case 'Taban':
            case 'taban':
            case 'HH':

                return 'HH';

                break;
            case 'Qeshm Air':
            case 'qeshm':
            case 'qheshm':
            case 'QB':

                return 'QB';
                break;
            case 'KishAir':
            case 'kishair':
            case 'Kish Air':
            case 'Kish':
            case 'Y9':

                return 'Y9';
                break;

            case 'Caspian':
            case 'IV':

                return 'IV';
                break;
            case 'Varesh':
            case 'VR':
            case 'VR1':

                return 'VR';
                break;
            case 'Saha':
            case 'saha':
            case 'IRZ':

                return 'IRZ';
                break;

            case 'Zagros':
            case 'ZV':

                return 'ZV';
                break;

            case 'Sepehran':
            case 'sepehran':
            case 'IS':
                return 'SR';
                break;

            case 'IA':
                return 'IA';
                break;

            case 'flypersia':
                return 'FP';
                break;

            case 'A9':

                return 'A9';
                break;

            case 'pegasus':

                return 'PC';
                break;


            case 'parsair':

                return 'PSA';
                break;

            default :

                return $type;

                break;

        }

    }

    public function convert_flight_persian_name($type)
    {
        switch ($type)
        {
            case 'Aseman':
            case 'aseman':
            case 'EP':

                return 'آسمان';

                break;
            case 'Mahan':
            case 'W5':

                return 'ماهان';

                break;

            case 'meraj':
            case 'Meraj':
            case 'Meraj':
            case 'JI':

                return 'معراج';

                break;

            case 'Atrak':
            case 'AK':

                return 'اترک';

                break;
            case 'Iran Air':
            case 'iranair':
            case 'IR':
            case 'IRanair':

                return 'ایران ایر';

                break;
            case 'Naft':
            case 'naft':
            case 'NV':

                return 'کارون';

                break;
            case 'Ata':
            case 'ata':
            case 'ATA':
            case 'I3':

                return 'آتا';

                break;
            case 'Air tour':
            case 'airtour':
            case 'B9':

                return 'ایر تور';

                break;
            case 'Taban':
            case 'taban':
            case 'HH':

                return 'تابان';

                break;
            case 'Qeshm Air':
            case 'qeshm':
            case 'qheshm':
            case 'QB':

                return 'قشم ایر';
                break;
            case 'KishAir':
            case 'kishair':
            case 'Kish Air':
            case 'Kish':
            case 'Y9':

                return 'کیش ایر';
                break;

            case 'Caspian':
            case 'IV':

                return 'کاسپین';
                break;
            case 'Varesh':
            case 'VR':
            case 'VR1':

                return 'وارش';
                break;
            case 'Saha':
            case 'saha':
            case 'IRZ':

                return 'ساها';
                break;

            case 'Zagros':
            case 'ZV':

                return 'زاگرس';
                break;

            case 'Sepehran':
            case 'sepehran':
            case 'IS':
                return 'سپهران';
                break;

            case 'flypersia':
                return 'فلای پرشیا';
                break;

            case 'IA':
                return 'العراقیه';
                break;

            case 'A9':

                return 'گرجستان ایر';
                break;

            case 'pegasus':

                return 'پگاسوس';
                break;

            case 'parsair':

                return 'پارس ایر';
                break;

            case 'Turkish':

                return 'ترکیش';
                break;
            case 'fly_dubai':

                return 'فلای دبی';
                break;
            default :

                return $type;

                break;

        }

    }

    function convert_number($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }


    public function cap(){
        $this->load->helper('captcha');
        $vals = array(
            'word'          => rand(100,999),
            'img_path'      => './cap/',
            'img_url'       => base_url('cap').'/',
            'font_path'     => FCPATH.'fonts/iransans/IRANSansWebFaNum.ttf',
            'img_width'     => 200,
            'img_height'    => 30,
            'colors'        => array(
                'background'     => array(255, 255, 255),
                'border'         => array(255, 255, 255),
                'text'           => array(0, 0, 0),
                'grid'           => array(255, 255, 255)
            )
        );
        $data['captcha'] = create_captcha($vals);
        $this->session->set_userdata('captcha_info', ['code'=>$data['captcha']['word']]);
        $data['image'] = $data['captcha']['image'];
        return json_encode(array('code'=> 400 , 'msg' => 'ok' ,'data'=>base_url('cap/'.$data['captcha']['filename'])));
    }

    function city_tour()
    {
        return array(array('name'=>'تهران','value'=>'THR')
        ,array('name'=>'مشهد','value'=>'MHD'),
            array('name'=>'کیش','value'=>'KIH'),
            array('name'=>'قشم','value'=>'GSM'),
            array('name'=>'رشت','value'=>'RAS'),
            array('name'=>'اهواز','value'=>'AWZ'),
            array('name'=>'بندر عباس','value'=>'BND'),
            array('name'=>'شیراز','value'=>'SYZ'),
            array('name'=>'اصفهان','value'=>'IFN'),
            array('name'=>'تهران','value'=>'IKA'),
            array('name'=>'استانبول','value'=>'IST'),
            array('name'=>'دبی','value'=>'DXB'),
            array('name'=>'وان','value'=>'VAN'),
            array('name'=>'اسپارتا','value'=>'ISE'),
            array('name'=>'دنیزلی','value'=>'DNZ'),
            array('name'=>'آلانیا','value'=>'GZP'),
            array('name'=>'ترابزون','value'=>'TZX'),
            array('name'=>'قونیه','value'=>'KYA'),
            array('name'=>'نوشهیر کاپادوکیا','value'=>'NAV'),
            array('name'=>'ازمیر','value'=>'ADB'),
            array('name'=>'صبیحا گوچن استانبول','value'=>'SAW'),
            array('name'=>'فرودگاه میلاس بدروم','value'=>'BJV'),
            array('name'=>'آنتالیا','value'=>'AYT'),
            array('name'=>'دالامان مارماریس','value'=>'DLM'),
            array('name'=>'آنکارا','value'=>'ESB'),
            array('name'=>'آدانا','value'=>'ADA'),
            array('name'=>'تفلیس','value'=>'TBS'),
            array('name'=>'باتومی','value'=>'BUS'),
            array('name'=>'نخجوان','value'=>'NAJ'),
            array('name'=>'بغداد','value'=>'BGW'),
            array('name'=>'پیام کرج','value'=>'PYK'),
            array('name'=>'همدان','value'=>'HDM'),
            array('name'=>'بیرجند','value'=>'XBJ'),
            array('name'=>'مسکو ونوکوا','value'=>'vko'),
            array('name'=>'لارناکا','value'=>'lca'),
            array('name'=>'پوکت','value'=>'hkt'),
            array('name'=>'وارنا بلغارستان','value'=>'var'),
            array('name'=>'سنت پترز بورگ','value'=>'led'),
            array('name'=>'ارجان قبرس شمالی','value'=>'ecn'),
            array('name'=>'هامبورگ','value'=>'ham'),
            array('name'=>'آمستردام','value'=>'ams'),
            array('name'=>'دوسلدورف','value'=>'dus'),
            array('name'=>'بارسلونا','value'=>'bcn'),
            array('name'=>'خوی','value'=>'khy'),
            array('name'=>'مونیخ','value'=>'muc'),
            array('name'=>'دوحه','value'=>'doh'),
            array('name'=>'مسکو شرمیتوا','value'=>'svo'),
            array('name'=>'شارلز دوگو پاریس','value'=>'cdg'),
            array('name'=>'فرانکفورت','value'=>'fra'),
            array('name'=>'بانکوک','value'=>'bkk'),
            array('name'=>'کوالالامپور','value'=>'kul'),
            array('name'=>'ایروان','value'=>'evn'),
            array('name'=>'رامسر','value'=>'rzr'),
            array('name'=>'مسقط','value'=>'mct'),
            array('name'=>'تبریز','value'=>'tbz'),
            array('name'=>'نجف','value'=>'NJF'));
    }


    function check_city_train($c)
    {
        switch ($c)
        {
            case 1:
                $result='تهران';
                break;
            case 191:
                $result='مشهد';
                break;
            case 161:
                $result='قم';
                break;
            case 165:
                $result='کرج';
                break;
            case 160:
                $result='قزوین';
                break;
            case 25:
                $result='اهواز';
                break;
            case 72:
                $result='خرمشهر';
                break;
            case 451:
                $result='رشت';
                break;
            default:
                $result='';
        }
        return $result;
    }

    function city_train()
    {
        $rr='
{"ExceptionId":0,"ExceptionMessage":null,"Result":[{"Code":1,"Name":"تهران","IsVisible":true,"DisplayPriority":1,"PromotionsByFromStation":[],"PromotionsByToStation":[],"WagonFilters":[],"WagonFilters1":[]},{"Code":191,"Name":"مشهد","IsVisible":true,"DisplayPriority":2,"PromotionsByFromStation":[],"PromotionsByToStation":[],"WagonFilters":[],"WagonFilters1":[]},{"Code":161,"Name":"قم","IsVisible":true,"DisplayPriority":3,"PromotionsByFromStation":[],"PromotionsByToStation":[],"WagonFilters":[],"WagonFilters1":[]},{"Code":165,"Name":"کرج","IsVisible":true,"DisplayPriority":6,"PromotionsByFromStation":[],"PromotionsByToStation":[],"WagonFilters":[],"WagonFilters1":[]},{"Code":160,"Name":"قزوین","IsVisible":true,"DisplayPriority":7,"PromotionsByFromStation":[],"PromotionsByToStation":[],"WagonFilters":[],"WagonFilters1":[]},{"Code":25,"Name":"اهواز","IsVisible":true,"DisplayPriority":8,"PromotionsByFromStation":[],"PromotionsByToStation":[],"WagonFilters":[],"WagonFilters1":[]},{"Code":72,"Name":"خرمشهر","IsVisible":true,"DisplayPriority":10,"PromotionsByFromStation":[],"PromotionsByToStation":[],"WagonFilters":[],"WagonFilters1":[]},{"Code":451,"Name":"رشت","IsVisible":true,"DisplayPriority":12,"PromotionsByFromStation":[],"PromotionsByToStation":[],"WagonFilters":[],"WagonFilters1":[]}]}';
        $a=json_decode($rr);

        foreach ($a->Result as $b)
        {
            $city[]=array('name'=>$b->Name,'code'=>$b->Code);
        }
        return json_encode(array('code'=>200,'data'=>$city));
    }

}
