<?php

use yii\helpers\Html;
use yii\helpers\Form;
use yii\widgets\DetailView;
use app\modules\finance\Config;
use function GuzzleHttp\json_decode;
use app\modules\financefinance;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\finance\models\FinanceTransactions */


$this->title = \Yii::t('rabint', 'خطای پرداخت- شماره  :') . $error_number;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finance-transactions-view">
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="alert alert-<?= $error_type ?>">
        <h5><?= $this->title; ?></h5>
        <p><?= $error_text; ?></p>
    </div>

    <div class="spacer"></div>
    <div class="spacer"></div>
    
</div>
<div class="center discounter">
    <p><?= Yii::t('rabint', 'تا لحظاتی دیگر به صفحه مربوطه هدایت می شوید!'); ?></p>
    <span id="discount_number">10</span>
    <br/>
    <a href="<?= $redirect; ?>" class="btn btn-link return_link "><?= \Yii::t('rabint', 'بازگشت'); ?></a>
    <!-- <meta http-equiv="refresh" content="10;url=<?= $redirect; ?>" /> -->

</div>
<script>
    <?php ob_start(); ?>
    function discounter() {
        var count = $('#discount_number').html();
        var count = parseInt(count);
        if(count<=0){
            $('#discount_number').html('<?= Yii::t('rabint','در حال انتقال');?>');
            window.location.replace('<?= $redirect; ?>');        
        }else{
            count--;
            setTimeout(discounter, 1000);
            $('#discount_number').html(count);
        }
    }
    discounter();

    <?php
    $script = ob_get_clean();
    $this->registerJs($script, $this::POS_END);
    ?>
</script>