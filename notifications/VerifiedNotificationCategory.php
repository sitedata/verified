<?php

namespace humhub\modules\verified\notifications;

use Yii;
use humhub\modules\notification\components\NotificationCategory;

/**
 * VerifiedNotificationCategory
 *
 */
class VerifiedNotificationCategory extends NotificationCategory
{
    /**
     * @inheritdoc
     */
    public $id = 'verified';

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return Yii::t('VerifiedModule.base', 'Verified Notifications');
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return Yii::t('VerifiedModule.notifications', 'Receive Notifications if your account receives a verified tick.');
    }

}
