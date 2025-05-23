<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $title
 * @var $redirect
 */
if (rabint\helpers\user::isGuest()) {
    /* ################################################################### */
    ?>
    <div class="site-login">
        <div class="box-header">
            <span><?= $title; ?></span>
        </div>
        <div class="clearfix spacer"></div>

        <div class="row">
            <div class="col-sm-12">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'action' => \yii\helpers\Url::to(['/users/sign-in/login']),
                ]);
                ?>
                <?= $form->field($model, 'identity') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div style="color:#999;margin:1em 0">
                    <?php
                    echo Yii::t('rabint', 'اگر رمز خود را فراموش کرده اید  <a href="{link}">اینجا کلیک نمایید</a>', [
                        'link' => yii\helpers\Url::to(['/users/sign-in/request-password-reset'])
                    ])
                    ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('rabint', 'ورود'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <div class="form-group">
                    <?php echo Html::a(Yii::t('rabint', 'عضویت در سایت'), ['/users/sign-in/signup']) ?>
                </div>
                <?php /*
                  <h2><?php echo Yii::t('rabint', 'ورود با')  ?>:</h2>
                  <div class="form-group">
                  <?= yii\authclient\widgets\AuthChoice::widget([
                  'baseAuthUrl' => ['/users/sign-in/oauth']
                  ]) ?>
                  </div> */ ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <?php
} else {
    /* ################################################################### */
    $user = \rabint\helpers\user::object();
    ?>
    <div class="site-user-panel">
        <div class="row">
            <div class="center">
                <div class="user-image-box center-block <?= $user->isOfficial ? 'official_user' : '' ?>">
                    <img src = "<?php echo $user->userProfile->getAvatar(\yii\helpers\Url::home() . '/img/noAvatarMedium.png', 'medium') ?>" class = "user-image">
                    <?= $user->isOfficial==1 ? '<i class="fas fa-check"></i>' : ''; ?>
                    <?= $user->isOfficial==2 ? '<i class="master_channel"></i>' : ''; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="center text-center">
                <?= \Yii::t('rabint', 'wellcome {username}', ['username' => rabint\helpers\user::name()]); ?>
            </div>
            <div class="col-sm-12">
                <?= app\modules\user\widget\UserMenu::widget(); ?>
            </div>
        </div>
    </div>

<?php } ?>
