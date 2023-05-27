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
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['paypalId'], 'required'],
            [['paypalId'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'paypalId' => Yii::t('VerifiedModule.base', 'PayPal Client ID:'),
        ];
    }

    public function loadSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        $this->paypalId = $settings->get('paypalId');

        return true;
    }

    public function saveSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        $settings->set('paypalId', $this->paypalId);

        return true;
    }
}
