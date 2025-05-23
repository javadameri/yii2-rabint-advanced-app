<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\FinanceDraft */


$this->title = Yii::t('rabint', 'Create') .  ' ' . Yii::t('rabint', 'Finance Draft') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'Finance Drafts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-form finance-draft-create"  id="ajaxCrudDatatable">

    <h2 class="ajaxModalTitle" style="display: none"><?=  $this->title; ?></h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
