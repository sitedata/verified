<?php

namespace humhub\modules\verified;

use Yii;
use humhub\modules\content\components\ContentContainerModule;
use humhub\modules\user\models\User;

class Module extends ContentContainerModule
{
    /**
     * @inheritdoc
     */
    public $resourcesPath = 'resources';

    /**
    * @inheritdoc
    */
    public function getContentContainerTypes()
    {
        return [
            User::class,
        ];
    }

    public function getVerifyUser()
    {
        $verifyUser = $this->settings->getSerialized('verifyUser');

        if (empty($verifyUser)) {
            return [];
        }

        return $verifyUser;
    }

    public function getMaxNumber()
    {
        $maxNumber = $this->settings->get('maxNumber');

        if (empty($maxNumber)) {
            return '3';
        }

    /**
     * @return bool
     */
    public function getSEnabled()
    {
        return (boolean)$this->settings->space()->get('senabled');
    }

    /**
     * @inheritdoc
     */
    public function getNotifications()
    {
        return [
            notifications\Verified::class
        ];
    }

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return helpers\Url::to(['/verified/admin/index']);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return Yii::t('VerifiedModule.base', 'Verified');
    }
}
