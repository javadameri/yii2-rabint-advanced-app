<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\themes\bilit\ThemeAsset;
ThemeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html >
<html lang="<?= Yii::$app->language ?>" dir="rtl">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
</head>
<body>
<?php $this->beginBody() ?>
<?php echo  $content; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
