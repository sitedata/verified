<?php

use humhub\modules\verified\helpers\Url;

/* @var $this \humhub\modules\ui\view\components\View */
?>

<div class="panel panel-default">
    <div class="panel-heading"><?= \Yii::t('VerifiedModule.base', '<h1><b>Help Section</b></h1>') ?></div>
    <div class="panel-heading"><?= \Yii::t('VerifiedModule.base', '<h3>TBA</h3>') ?></div>
    <div class="panel-body">
      <p><strong>TBA</strong></p>
    </div>
    </br>
    <div class="container">
    <a class="btn btn-primary" href="<?= Url::getConfigUrl(); ?>" role="button">Configuration Settings</a>
    </div>
    </br>
</div>
