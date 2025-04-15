<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\HeadOrderTrainOfflineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card block block-rounded block-mode-loading-refresh">
    <div class="card-header block-header">
        <h3 class="card-title block-title float-start">
            <?=  \Yii::t('rabint', 'جستجو'); ?>
        </h3>
        <div class="block-options card-header-actions float-end">
            <button type="button" class="card-header-action btn-minimize btn-block-option block-minimize-btn btn btn-sm btn-link">
                <i class="btnicon fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php $form = ActiveForm::begin([
    //'action' => ['index'],
    'method' => 'get',
    ]); ?>

    <div class="card-body block-content bg-body-light" style="display: none;">
        <div class="search_box head-order-train-offline-search">
            <div class="row">
                                <div class="col-sm-4"><?= $form->field($model, 'id') ?></div>

                <div class="col-sm-4"><?= $form->field($model, 'full_name') ?></div>

                <div class="col-sm-4"><?= $form->field($model, 'cell') ?></div>

                <div class="col-sm-4"><?= $form->field($model, 'code') ?></div>

                <div class="col-sm-4"><?= $form->field($model, 'description') ?></div>

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'user_id') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'from') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'to') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'date') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'type') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'status') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'price') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'transaction_id') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'ticket_file') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'request_type') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'created_at') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'updated_at') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'created_by') ?></div>-->

                <!--<div class="col-sm-4"><?php // echo $form->field($model, 'updated_by') ?></div>-->


                <?php  /* ************************************************** * / ?>
                <div class="col-sm-4">
                    <div class="form-group field-cdrsearch-duration has-success">
                        <label class="control-label" for="cdrsearch-duration"><?= \Yii::t('app', 'تاریخ');
                            ?></label>
                        <div class="input-group">
                            <?= Html::activeInput('date', $model, 'calldate_from', ['class' => 'form-control',
                            'placeholder' => 'از']) ?>
                            <?= Html::activeInput('date', $model, 'calldate_to', ['class' => 'form-control',
                            'placeholder' => 'تا']) ?>
                        </div>
                        <div class="help-block">
                            <?= \Yii::t('app', 'بازه تاریخ مورد نظر بصورت شمسی یا قمری');?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group field-cdrsearch-duration has-success">
                        <label class="control-label" for="cdrsearch-duration"><?= \Yii::t('app', 'مدت مکالمه');
                            ?></label>
                        <div class="input-group">
                            <?=  Html::activeInput('number', $model, 'duration_from', ['class' =>
                            'form-control', 'placeholder' => 'از']) ?>
                            <?=  Html::activeInput('number', $model, 'duration_to', ['class' => 'form-control',
                            'placeholder' => 'تا']) ?>
                        </div>
                        <div class="help-block">
                            <?= \Yii::t('app', 'مدت مکالمه به ثانیه'); ?>
                        </div>
                    </div>
                </div>
                <?php  /* ************************************************** */ ?>

            </div>
            <div class="row">
                <div class="card-body block-content block-content-full">
                    <div class=" center center-block">
                        <?=  Html::submitButton(Yii::t('rabint', 'Search'), ['class' => 'btn btn-info
                        btn-noborder']) ?>
                                                <?=  Html::a(Yii::t('rabint', 'Reset'), ['index'], ['class' => 'btn btn-outline-info'])
                        ?>
                    </div>
                </div>
            </div>

        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>