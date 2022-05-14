<?php

namespace humhub\modules\verified\models;

use Yii;
use yii\web\BadRequestHttpException;
use humhub\modules\user\models\User;
use humhub\components\ActiveRecord;
use humhub\components\behaviors\PolymorphicRelation;

/**
 * This is the model class for table "verified".
 * 
 */
class ConfigureForm extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $verifyUser;

    /**
     * @inheritdoc
     */
    public $maxNumber;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'verified';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maxNumber'], 'integer'],
            [['verifyUser'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => PolymorphicRelation::class,
                'mustBeInstanceOf' => [ActiveRecord::class]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function getUser()
    {
        $user = $this->hasOne(User::class, ['id' => 'user_id']);

        return $user;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyUser' => Yii::t('VerifiedModule.base', 'Verify Selected User(s):'),
            'maxNumber' => Yii::t('VerifiedModule.base', 'Maximum number of verified allowed:'),
        ];
    }

    public function loadSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        $this->maxNumber = $settings->get('maxNumber');
        $this->verifyUser = (array)$settings->getSerialized('verifyUser');

        return true;
    }

    public function saveSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

            $settings->set('maxNumber', $this->maxNumber);
            $settings->setSerialized('verifyUser', (array)$this->verifyUser);

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
