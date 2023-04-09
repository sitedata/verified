<?php

use humhub\modules\verified\helpers\Url;
use humhub\modules\user\widgets\UserPickerField;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\libs\Html;

/* @var $this \humhub\modules\ui\view\components\View */
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= \Yii::t('VerifiedModule.base', '<strong>Verified</strong> module configuration') ?></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'configure-form']); ?>
            <div class="form-group">
                <?= $form->field($model, 'verifyUser')->widget(UserPickerField::class, ['id' => 'user_id', 'maxSelection' => Yii::$app->getModule('verified')->getMaxNumber(), 'disabledItems' => [Yii::$app->user->guid], 'placeholder' => Yii::t('VerifiedModule.base', 'Add a member to verify')]); ?>
                <?= $form->field($model, 'maxNumber'); ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton(\Yii::t('VerifiedModule.base', 'Save'), ['class' => 'btn btn-primary', 'data-ui-loader' => '']); ?>
                <a class="btn btn-primary" href="<?= Url::getHelpUrl(); ?>" role="button">Help</a>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
