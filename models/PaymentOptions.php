<?php

namespace humhub\modules\verified\models;

use Yii;
use yii\base\Model;

class PaymentOptions extends Model
{
    /**
     * @var bool
     */
    public $enabled;

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
            [['enabled'], 'boolean']
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
            'enabled' => Yii::t('VerifiedModule.base', 'Enable'),
        ];
    }

    public function loadSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        $this->paypalId = $settings->get('paypalId');
        $this->planId = $settings->get('planId');
        $this->enabled = (boolean)$settings->get('enabled');

        return true;
    }

    public function saveSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        $settings->set('paypalId', $this->paypalId);
        $settings->set('planId', $this->planId);
        $settings->set('enabled', (boolean)$this->enabled);

        return true;
    }

    /**
     * Returns a loaded instance of this configuration model
     */
    public static function getInstance()
    {
        $config = new static;
        $config->loadSettings();

        return $config;
    }
}
