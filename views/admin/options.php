<?php

/* @var $this \humhub\modules\ui\view\components\View */
/* @var $model \humhub\modules\verified\models\PaymentOptions[] */

use humhub\modules\ui\icon\widgets\Icon;
use humhub\widgets\Button;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\libs\Html;

?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
        <?= Button::asLink(Icon::get('cog'))
        ->link(['index'])
        ->cssClass('pull-right btn btn-default')
        ->tooltip(Yii::t('AdminModule.base', 'Settings')) ?>

    <?= Yii::t('VerifiedModule.base', '<strong>Payment</strong> Clients') ?></div>
    <div class="panel-body">
        <p>
            <?= Html::a(Yii::t('VerifiedModule.base', 'PayPal Documentation'), 'https://developer.paypal.com/dashboard/applications/live/', ['class' => 'btn btn-primary pull-right btn-sm', 'target' => '_blank']); ?>
            <?= Yii::t('VerifiedModule.base', 'Please follow the PayPal instructions to create the required credentials.'); ?>
            <br/>
        </p>
        <br/>
        <?php $form = ActiveForm::begin(['id' => 'configure-form']); ?>
        <div class="form-group">
            <?= $form->field($model, 'paypalId')->textInput(['type' => 'password']); ?>
            <?= $form->field($model, 'planId')->textInput(['type' => 'password']); ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(\Yii::t('VerifiedModule.base', 'Save'), ['class' => 'btn btn-primary', 'data-ui-loader' => '']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>
