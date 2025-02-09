<?php

/* @var $this \yii\web\View */
/* @var $content string */

$bundleBaseUrl = $this->getAssetManager()->getBundle('app\themes\bilit\ThemeAsset')->baseUrl;

$this->beginContent('@themeLayouts/common.php');
?>
<?= $content ?>
<?php $this->endContent() ?>