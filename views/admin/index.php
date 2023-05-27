<?php

use kartik\widgets\ColorInput;
use humhub\modules\ui\form\widgets\IconPicker;
use humhub\modules\user\widgets\UserPickerField;
use humhub\modules\space\widgets\SpacePickerField;
use humhub\modules\ui\icon\widgets\Icon;
use humhub\widgets\Button;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\libs\Html;

/* @var $this \humhub\modules\ui\view\components\View */
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Button::asLink(Icon::get('credit-card') . Icon::get('cog'))->link(['options'])->cssClass('pull-right btn btn-default')->tooltip(Yii::t('AdminModule.base', 'Payment Options')) ?>
            <?= \Yii::t('VerifiedModule.base', '<strong>Verified</strong> module configuration') ?>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'configure-form']); ?>
                <div class="form-group">
                    <?= $form->field($model, 'verifyUser')->widget(UserPickerField::class, ['id' => 'user_id', 'maxSelection' => \Yii::$app->getModule('verified')->getMaxUsers()]); ?>
                    <?= $form->field($model, 'maxUsers'); ?>
                </div>

                <div class"form-group">
                    <?= $form->field($model, 'verifySpace')->widget(SpacePickerField::class, ['id' => 'space_id', 'maxSelection' => \Yii::$app->getModule('verified')->getMaxSpaces()]); ?>
                    <?= $form->field($model, 'maxSpaces'); ?>
                </div>

                <div class"form-group">
                    <?= $form->field($model, 'icon')->widget(IconPicker::class); ?>
                    <?= $form->field($model, 'color')->widget(ColorInput::class); ?>
                    <?= $form->field($model, 'sendNotifications')->checkbox(); ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton(\Yii::t('base', 'Save'), ['class' => 'btn btn-primary', 'data-ui-loader' => '']); ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
