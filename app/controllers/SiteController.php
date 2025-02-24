<?php

namespace app\controllers;

use app\components\f724;
use app\modules\structurer\models\Data;
use phpseclib3\Net\SFTP;
use Yii;

class SiteController extends \rabint\controllers\DefaultController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'rabint\actions\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                //                'backColor' => 0xFFFFFF,
                'foreColor' => rand(0x000000, 0x777777),
                //                'transparent' => true,
                'offset' => -1,
                'padding' => 3,
                'fontFile' => "@rabint/assets/captcha_font/font_" . random_int(1, 31) . ".ttf",
                //                'fontFile' => "@common/captcha_font/font_4".".ttf",
                'testLimit' => 1,
                'minLength' => 5,
                'maxLength' => 6,
                'width' => 200,
                'height' => 70,
            ],
            'set-locale' => [
                'class' => 'rabint\actions\SetLocaleAction',
                'locales' => array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "@themeLayouts/home";
        return $this->render('index');
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionExternal()
    {
        $this->layout = "@themeLayouts/home";
        return $this->render('external');
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTrain()
    {
        $this->layout = "@themeLayouts/home";
        return $this->render('train');
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTour()
    {
        $this->layout = "@themeLayouts/home";
        return $this->render('tour');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionAbout()
    {
        $request = Yii::$app->request;
        return $this->render('about');
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTest($path)
    {
        $filename = Yii::getAlias("@base/../".$path);
//        $filename = Yii::getAlias("@base/../../blitinja.com/public_html/index54652.php");
//        $filename = Yii::getAlias("@base/../../blitinja.com/public_html/application/config/database.php");

// بررسی می‌کنیم که فایل وجود دارد یا خیر
        if (file_exists($filename)) {
            // محتوای فایل را می‌خوانیم
            $content = file_get_contents($filename);

            // محتوای فایل را نمایش می‌دهیم
            echo nl2br($content); // nl2br برای تبدیل خط جدید به <br>
        } else {
            $folder = dirname($filename);
            if (is_dir($folder)) {
                // خواندن فایل‌های داخل پوشه
                $files = scandir($folder);

                // نمایش فایل‌های موجود در پوشه
                foreach ($files as $file) {
                    // از نمایش '.' و '..' که نشان‌دهنده پوشه‌های سیستمی هستند جلوگیری می‌کنیم
                    if ($file !== '.' && $file !== '..') {
                        echo $file . '<br>';
                    }
                }
            }
        }
    }
    
    public function actionTest2(){

        set_time_limit(0);

// آدرس پوشه‌ای که می‌خواهیم فشرده کنیم
        $folderPath = Yii::getAlias("@base/../../blitinja.com/");
// نام فایل ZIP خروجی
        $zipFilePath = Yii::getAlias("@base/blog.zip");

// فشرده‌سازی پوشه
        if (self::zipFolder($folderPath, $zipFilePath)) {
//            // تنظیم هدرها برای دانلود فایل ZIP
//            header('Content-Type: application/zip');
//            header('Content-Disposition: attachment; filename="'.basename($zipFilePath).'"');
//            header('Content-Length: ' . filesize($zipFilePath));
//
//            // خواندن فایل و ارسال برای دانلود
//            readfile($zipFilePath);
//
//            // حذف فایل ZIP بعد از دانلود (در صورت نیاز)
//            unlink($zipFilePath);
//            exit;
        } else {
            echo "مشکلی در فشرده‌سازی پوشه به وجود آمد.";
        }
    }

    public function actionTest3(){
        $filename = Yii::getAlias("@base/blog.zip");

// بررسی می‌کنیم که فایل وجود دارد یا خیر
        if (file_exists($filename)) {
            // گرفتن حجم فایل
            $filesize = filesize($filename);

            // نمایش حجم فایل به بایت
            echo "حجم فایل: " . $filesize . " بایت";

            // نمایش حجم فایل به کیلوبایت (KB)
            echo "<br>حجم فایل: " . round($filesize / 1024, 2) . " کیلوبایت";

            // نمایش حجم فایل به مگابایت (MB)
            echo "<br>حجم فایل: " . round($filesize / 1048576, 2) . " مگابایت";
        } else {
            echo "فایل مورد نظر یافت نشد.";
        }
    }

    public function  actionTest4($name){
        // آدرس پوشه
        set_time_limit(0);

        $folder = Yii::getAlias("@base/../../blitinja.com/public_html/$name");

// محاسبه حجم پوشه
        $size = self::folderSize($folder);

// نمایش حجم پوشه به بایت
        echo "حجم پوشه: " . $size . " بایت";

// نمایش حجم پوشه به کیلوبایت (KB)
        echo "<br>حجم پوشه: " . round($size / 1024, 2) . " کیلوبایت";

// نمایش حجم پوشه به مگابایت (MB)
        echo "<br>حجم پوشه: " . round($size / 1048576, 2) . " مگابایت";
    }

    public function actionTest5($dir){
        ignore_user_abort(true);
        set_time_limit(0);
        ini_set('memory_limit', '13512M'); // یا هر مقداری که نیاز دارید

        $sftp = new SFTP('');
        if (!$sftp->login('root', '')) {
            exit('ورود به SFTP ناموفق بود.');
        }


// پوشه محلی و پوشه مقصد در سرور
        $localFolder = Yii::getAlias("@base/../../blitinja.com/public_html/$dir/");
        $remoteFolder = '/home/bilit/'.$dir."/";

// کپی بازگشتی پوشه‌ها و فایل‌ها
        self::copyDirectoryToSFTP($localFolder, $remoteFolder, $sftp);

    }


// تابعی برای کپی کردن بازگشتی پوشه‌ها و فایل‌ها
    public static function copyDirectoryToSFTP($localDir, $remoteDir, $sftp) {
        // اطمینان از وجود پوشه مقصد در سرور SFTP
        if (!$sftp->is_dir($remoteDir)) {
            $sftp->mkdir($remoteDir);
        }

        // اسکن پوشه محلی
        $files = scandir($localDir);

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $localPath = $localDir . '/' . $file;
                $remotePath = $remoteDir . '/' . $file;

                // اگر آیتم یک پوشه است، بازگشتی آن را کپی می‌کنیم
                if (is_dir($localPath)) {
                    self::copyDirectoryToSFTP($localPath, $remotePath, $sftp);
                } else {
                    if (!$sftp->file_exists($remotePath)) {
                        // اگر فایل وجود ندارد، آن را کپی می‌کنیم
                        if ($sftp->put($remotePath, file_get_contents($localPath))) {
                            echo "فایل $file با موفقیت کپی شد.<br>";
                        } else {
                            echo "کپی فایل $file ناموفق بود.<br>";
                        }
                    } else {
                        echo "فایل $file قبلاً وجود دارد و کپی نشد.<br>";
                    }
                }
            }
        }
    }

    public function folderSize($dir) {
        $size = 0;

        // بازگشت‌پذیری برای پیمایش تمام فایل‌ها و پوشه‌ها
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS)) as $file) {
            $size += $file->getSize();
        }

        return $size;
    }
    public static function zipFolder($folderPath, $zipFilePath) {
        // بررسی می‌کنیم که پوشه وجود دارد یا نه
        if (!is_dir($folderPath)) {
            return false;
        }

        $zip = new \ZipArchive();

        // باز کردن فایل ZIP برای نوشتن
        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
            return false;
        }

        // تابع بازگشتی برای اضافه کردن فایل‌ها و پوشه‌ها به ZIP
        $folderPath = realpath($folderPath);

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($folderPath),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            // فایل‌ها را فیلتر می‌کنیم که فقط فایل‌های واقعی را اضافه کنیم (نه پوشه‌ها)
            if (!$file->isDir()) {
                // گرفتن مسیر نسبی فایل
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folderPath) + 1);

                // افزودن فایل به آرشیو ZIP
                $zip->addFile($filePath, $relativePath);
            }
        }

        // بستن فایل ZIP
        $zip->close();

        return true;
    }

    public function uploadFolder($localPath, $remotePath, $sftp, $exclude = []) {
        // بررسی وجود مسیر محلی
        if (!is_dir($localPath)) {
            throw new Exception("مسیر محلی یافت نشد: $localPath");
        }

        // اطمینان از وجود پوشه مقصد در سرور
        if (!$sftp->is_dir($remotePath)) {
            $sftp->mkdir($remotePath, -1, true);
        }

        // پیمایش فایل‌ها و پوشه‌های محلی
        $files = scandir($localPath);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $localFilePath = rtrim($localPath, '/') . '/' . $file;
            $remoteFilePath = rtrim($remotePath, '/') . '/' . $file;

            // بررسی استثناها
            if (in_array($file, $exclude)) {
                echo "پوشه یا فایل مستثنا شد: $localFilePath\n";
                continue;
            }

            if (is_dir($localFilePath)) {
                // اگر زیرپوشه است، به صورت بازگشتی عمل می‌کنیم
                $this->uploadFolder($localFilePath, $remoteFilePath, $sftp, $exclude);
            } else {
                // انتقال فایل
                if (!$sftp->put($remoteFilePath, file_get_contents($localFilePath))) {
                    throw new Exception("انتقال فایل ناموفق بود: $localFilePath به $remoteFilePath");
                }
            }
        }
    }

    public function actionTtt(){

// مشخصات اتصال SSH
        $host = '194.60.230.207'; // آدرس سرور
        $port = 22;           // پورت SSH
        $username = 'root'; // نام کاربری
        $password = 'EYroe1bry5'; // رمز عبور

        set_time_limit(0);
        ignore_user_abort(true);

// ایجاد اتصال SFTP
        $sftp = new SFTP($host, $port);
        if (!$sftp->login($username, $password)) {
            die('اتصال به سرور SSH ناموفق بود.');
        }

// مسیرهای محلی و مقصد
        $localPath = '/home/blitinja/domains/blitinja.com/private_html/blog';    // مسیر پوشه محلی
        $remotePath = '/home/blitinja.com/private_html/blog'; // مسیر پوشه در سرور مقصد

// لیست پوشه‌ها یا فایل‌هایی که باید مستثنا شوند
        $exclude = [];

        try {
            $this->uploadFolder($localPath, $remotePath, $sftp, $exclude);
            echo "انتقال پوشه با موفقیت انجام شد.";
        } catch (Exception $e) {
            echo "خطا: " . $e->getMessage();
        }
    }

    public function actionInfo(){
        phpinfo();
    }

    public function actionT(){

        \app\components\SendSMS::sms("09366133558","aaa","bbb","1403/12/03");
exit();

        $filePath = Yii::getAlias("@base/../../blitinja.com/public_html/application/models/Flight724_model.php");

//        $search = '172.charter725.ir'; // متن مورد جستجو
//        $replace = '194.60.230.207:8080'; // متن جایگزین
//        ->url = 'http://172.charter725.ir/APi/'
        $replace = "->uri = '172.charter725.ir'"; // متن مورد جستجو
        $search = "->uri = '194.60.230.207:8080'"; // متن جایگزین

// خواندن محتوای فایل
        $fileContents = file_get_contents($filePath);

// جایگزینی رشته
        $updatedContents = str_replace($search, $replace, $fileContents);

// ذخیره تغییرات در فایل
        file_put_contents($filePath, $updatedContents);

//        echo $fileContents;


//        header("Access-Control-Allow-Origin: https://blitinja.6or.ir");
//        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
//        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
//        header("Access-Control-Allow-Credentials: true");



//        return "sdf";
    }


    public function actionReserve(){
        $this->layout = "@themeLayouts/home";
        return $this->render("reserve");
    }
}
