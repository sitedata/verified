<?php

namespace humhub\modules\verified\notifications;

use Yii;
use humhub\modules\notification\components\NotificationCategory;

class VerifiedNotificationCategory extends NotificationCategory
{
    public $id = 'verified';
    
    public function getTitle()
    {
        return Yii::t('VerifiedModule.notifications', 'Verified');
    }
    
    public function getDescription()
    {
        return Yii::t('VerifiedModule.notifications', 'Receive Notifications when your account or one of your spaces is verified.');
    }
    
    public function isVisible(User $user = null)
    {
        if ($user == null) {
            // Show in admin section
            return true;
        }
        // Hide in account settings
        return false;
    }
}
