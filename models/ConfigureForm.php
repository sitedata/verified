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
    const REGEX_COLOR = '/(#([0-9a-f]{3}){1,2}|(rgba|hsla)\(\d{1,3}%?(,\s?\d{1,3}%?){2},\s?(1|0?\.\d+)\)|(rgb|hsl)\(\d{1,3}%?(,\s?\d{1,3}%?\)){2})/';

    /**
     * @inheritdoc
     */
    public $verifyUser;

    /**
     * @inheritdoc
     */
    public $verifySpace;

    /**
     * @inheritdoc
     */
    public $maxNumber;
    /**
     * @inheritdoc
     */
    public $maxSpaces;

    /**
     * @inheritdoc
     */
    public $icon;

    /**
     * @inheritdoc
     */
    public $color;

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
            [['maxNumber', 'maxSpaces'], 'integer'],
            [['verifyUser', 'verifySpace', 'icon'], 'safe'],
            ['color', 'string'],
            ['color', 'validateColor'],
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
     * Validate the used color
     */
    public function validateColor()
    {
        if(empty($this->color)) {
            return;
        }

        preg_match_all(static::REGEX_COLOR, $this->color, $matches, PREG_SET_ORDER);
        if(!isset($matches[0][0])) {
            $this->addError('color', Yii::t('VerifiedModule.base', 'Invalid color!'));
        } else {
            $this->color = $matches[0][0];
        }
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
            'verifySpace' => Yii::t('VerifiedModule.base', 'Verify Selected Space(s):'),
            'icon' => Yii::t('VerifiedModule.base', 'Custom Icon used:'),
            'color' => Yii::t('VerifiedModule.base', 'Custom Icon color:'),
            'maxNumber' => Yii::t('VerifiedModule.base', 'Maximum number of verified users allowed:'),
            'maxSpaces' => Yii::t('VerifiedModule.base', 'Maximum number of verified spaces allowed:'),
        ];
    }

    public function loadSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        $this->icon = $settings->get('icon', 'check-circle');
        $this->maxNumber = $settings->get('maxNumber');
        $this->maxSpaces = $settings->get('maxSpaces');
        $this->verifyUser = (array)$settings->getSerialized('verifyUser');
        $this->verifySpace = (array)$settings->getSerialized('verifySpace');
        $this->color = $settings->get('color', Yii::$app->getView()->theme->variable('primary'));

        return true;
    }

    public function saveSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        if(empty($this->color)) {
            $this->color = Yii::$app->getView()->theme->variable('default');
        }

        $settings->set('icon', $this->icon);
        $settings->set('color', $this->color);
        $settings->set('maxNumber', $this->maxNumber);
        $settings->set('maxSpaces', $this->maxSpaces);
        $settings->setSerialized('verifyUser', (array)$this->verifyUser);
        $settings->setSerialized('verifySpace', (array)$this->verifySpace);

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
