<?php

namespace humhub\modules\verified\notifications;

use humhub\modules\notification\components\BaseNotification;
use humhub\modules\verified\notifications\VerifiedNotificationCategory;
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
    
    public function category()
    {
        return new VerifiedNotificationCategory();
    }
    public function html()
    {
        return Yii::t('VerifiedModule.notifications', "Your account has been verified.");
    }
}
