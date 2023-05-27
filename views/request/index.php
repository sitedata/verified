<?php

use humhub\modules\verified\models\RequestBadge;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\widgets\ModalButton;
use humhub\widgets\ModalDialog;
use humhub\libs\Html;

if(!isset($model)) {
    $model = new RequestBadge();
}

/** @var $model RequestBadge */

?>

<?php ModalDialog::begin(['header' => Yii::t('VerifiedModule.base', '<strong>Verification</strong> Payment Options')]); ?>
<?php $form = ActiveForm::begin();?>
<div class="modal-body">

    <?= Html::beginTag('div') ?>
    <script src="https://www.paypal.com/sdk/js?client-id=<?= Yii::$app->getModule('verified')->settings->get('paypalId'); ?>&enable-funding=venmo&components=buttons,funding-eligibility"></script>
    <div id="paypal-button-container">
    <script>
        // Loop over each funding source
        paypal.getFundingSources().forEach(function(fundingSource) {
        	// Initialize the buttons
        	var button = paypal.Buttons({
        		fundingSource: fundingSource,
        		  style: {
        		      tagline: false,
        		      layout: 'horizontal',
        		      shape:  'rect',
        		      label:  'paypal'
        		  }
        	})
        	// Check if the button is eligible
        	if (button.isEligible()) {
        		// Render the standalone button for that funding source
        		button.render('#paypal-button-container')
        	}
        })
    </script>
    </div>
    <?= Html::endTag('div'); ?>
</div>
<div class="modal-footer">
    <?= ModalButton::cancel() ?>
</div>
<?php ActiveForm::end();?>
<?php ModalDialog::end(); ?>
