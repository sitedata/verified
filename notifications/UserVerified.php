<?php

namespace humhub\modules\verified\notifications;

use humhub\modules\notification\components\BaseNotification;
use Yii;

/**
 * Notifies a user when his account is verified
 */
class UserVerified extends BaseNotification
{
    /**
     * @inheritdoc
     */
    public $moduleId = "verified";
    
    public function html()
    {
        return Yii::t('VerifiedModule.notifications', "Your account has been verified.");
    }
}
