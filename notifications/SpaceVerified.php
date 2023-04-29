<?php

namespace humhub\modules\verified\notifications;

use humhub\modules\notification\components\BaseNotification;
use Yii;
use yii\helpers\Html;

/**
 * Notifies a user when a space is verified
 */
class SpaceVerified extends BaseNotification
{
    /**
     * @inheritdoc
     */
    public $moduleId = "verified";
    /**
     * @inheritdoc
     */
    public $requireOriginator = false;
    
    public function html()
    {
        return Yii::t('VerifiedModule.notifications', "The space {space} has been verified.",
            ['space' => '"' . Html::encode($this->source->displayName) . '"']
        );
    }
}
