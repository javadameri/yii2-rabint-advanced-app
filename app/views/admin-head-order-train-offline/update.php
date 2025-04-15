<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HeadOrderTrainOffline */

$this->title = Yii::t('rabint', 'Update') .  ' ' . Yii::t('rabint', 'Head Order Train Offline') . ' «' . $model->id .'»';
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'Head Order Train Offlines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('rabint', 'Update');
?>

<div class="box-form head-order-train-offline-update"  id="ajaxCrudDatatable">

    <h2 class="ajaxModalTitle" style="display: none"><?=  $this->title; ?></h2>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
