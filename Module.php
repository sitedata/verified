<?php

namespace humhub\modules\verified;

use Yii;
use humhub\modules\ui\icon\widgets\Icon;

class Module extends \humhub\components\Module
{
    /**
     * @inheritdoc
     */
    public $resourcesPath = 'resources';

    public function getVerifyUser()
    {
        $verifyUser = $this->settings->getSerialized('verifyUser');

        if (empty($verifyUser)) {
            return [];
        }

        return $verifyUser;
    }
	
    public function getVerifySpace()
    {
        $verifySpace = $this->settings->getSerialized('verifySpace');

        if (empty($verifySpace)) {
            return [];
        }

        return $verifySpace;
    }

    public function getMaxNumber()
    {
        $maxNumber = $this->settings->get('maxNumber');

        if (empty($maxNumber)) {
            return [];
        }
    }

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return helpers\Url::ROUTE_ADMIN;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return Yii::t('VerifiedModule.base', 'Verified');
    }
}
