<?php

use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\widgets\ModalButton;
use humhub\widgets\ModalDialog;
use humhub\libs\Html;

/** @var $model \humhub\modules\verified\models\PaymentOptions[] */

?>

<?php ModalDialog::begin(['header' => Yii::t('VerifiedModule.base', '<strong>Verification</strong> Payment Options')]); ?>
<?php $form = ActiveForm::begin(['options' => ['data-pjax' => 0]]); ?> 
<div class="modal-body">
    <?= Yii::t('VerifiedModule.base', 'Welcome to ' . Yii::$app->name . ' verification center, once we confirm the payment you will receive a notification stating that your account has been verified.') ?>
    <hr>
    <?= Html::beginTag('div') ?>
    <div id="paypal-button-container"></div>
    <script <?= Html::nonce() ?>>
    function loadAsync(url, callback) {
    	var s = document.createElement('script');
    	s.setAttribute('src', url);
    	s.onload = callback;
    	document.head.insertBefore(s, document.head.firstElementChild);
    }

    loadAsync('https://www.paypal.com/sdk/js?client-id=<?= Yii::$app->getModule('verified')->settings->get('paypalId');?>&vault=true&intent=subscription', function() {
    		paypal.Buttons({
    			style: {
    				tagline: false,
    				layout: 'vertical',
    				shape: 'rect',
    				label: 'subscribe'
    			},
    			createSubscription: function(data, actions) {
    				return actions.subscription.create({
    					/* Creates the subscription */
    					plan_id: '<?= Yii::$app->getModule('verified')->settings->get('planId'); ?>'
    				});
    			},
    			onApprove: function(data, actions) {
    				alert(data.subscriptionID); // You can add optional success message for the subscriber here
    			}
    		}).render('#paypal-button-container');
    	});
    </script>
    <?= Html::endTag('div'); ?>
</div>
<div class="modal-footer">
    <?= ModalButton::cancel() ?>
</div>
<?php ActiveForm::end();?>
<?php ModalDialog::end(); ?>
