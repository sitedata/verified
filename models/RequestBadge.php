<?php

namespace humhub\modules\verified\models;

use Yii;
use yii\base\Model;

class RequestBadge extends Model
{

    /**
     * @var string
     */
    public $paypalId;

    /**
     * @var string
     */
    public $planId;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['paypalId', 'planId'], 'required'],
            [['paypalId', 'planId'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'paypalId' => Yii::t('VerifiedModule.base', 'PayPal Client ID:'),
            'planId' => Yii::t('VerifiedModule.base', 'PayPal Plan ID:'),
        ];
    }

    public function loadSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        $this->paypalId = $settings->get('paypalId');
        $this->planId = $settings->get('planId');

        return true;
    }

    public function saveSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        $settings->set('paypalId', $this->paypalId);
        $settings->set('planId', $this->planId);

        return true;
    }
}
