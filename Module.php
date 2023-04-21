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
		return $this->settings->get('maxNumber');
    }

    public function getUserIcon()
    {
        $icon = $this->settings->get('icon');
        $color = $this->settings->get('color');

		    $tooltip_message = Yii::t('VerifiedModule.base', 'Verified User');
		
		    return Icon::get($icon, ['color' => $color, 'tooltip' => $tooltip_message]);
    }
	
    public function getSpaceIcon()
    {
        $icon = $this->settings->get('icon');
        $color = $this->settings->get('color');

		    $tooltip_message = Yii::t('VerifiedModule.base', 'Verified Space');

		    return Icon::get($icon, ['color' => $color, 'tooltip' => $tooltip_message]);
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
