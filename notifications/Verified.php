<?php

namespace humhub\modules\verified\notifications;

use Yii;
use yii\bootstrap\Html;
use humhub\modules\notification\components\BaseNotification;

/**
 * DiscussionsComment for new comments
 *
 */
class Verified extends BaseNotification
{

    /**
     * @inheritdoc
     */
    public $moduleId = 'verified';

    /**
     *  @inheritdoc
     */
    public function category()
    {
        return new VerifiedNotificationCategory();
    }

    /**
     *  @inheritdoc
     */
    public function html()
    {
        return Yii::t('VerifiedModule.notifications', 'Congratulations, your account is now verified!');
    }

    /**
     *  @inheritdoc
     */
    public function getMailSubject()
    {
        return Yii::t('VerifiedModule.notifications', 'Congratulations, your account is now verified!');
    }

}
