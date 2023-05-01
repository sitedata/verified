<?php

namespace humhub\modules\verified\models;

use humhub\modules\verified\notifications\UserVerified;
use humhub\modules\verified\notifications\SpaceVerified;
use Yii;
use yii\web\BadRequestHttpException;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;
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
    public $maxUsers;
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
    public $sendNotifications;

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
            [['maxUsers', 'maxSpaces'], 'integer'],
            [['verifyUser', 'verifySpace', 'icon'], 'safe'],
            ['color', 'string'],
            ['color', 'validateColor'],
            ['sendNotifications', 'boolean']
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
            'maxUsers' => Yii::t('VerifiedModule.base', 'Maximum number of verified users allowed:'),
            'maxSpaces' => Yii::t('VerifiedModule.base', 'Maximum number of verified spaces allowed:'),
            'sendNotifications' => Yii::t('VerifiedModule.base', 'Notify new verified users and space owners.'),
        ];
    }

    public function loadSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        $this->icon = $settings->get('icon', 'check-circle');
        $this->maxUsers = $settings->get('maxUsers');
        $this->maxSpaces = $settings->get('maxSpaces');
        $this->verifyUser = (array)$settings->getSerialized('verifyUser');
        $this->verifySpace = (array)$settings->getSerialized('verifySpace');
        $this->color = $settings->get('color', Yii::$app->getView()->theme->variable('primary'));
        $this->sendNotifications = (bool)$settings->get('sendNotifications', true);

        return true;
    }

    public function saveSettings()
    {
        if(!$this->validate()) {
            return false;
        }
        
        /** @var Module $module */
        $module = Yii::$app->getModule('verified');
        $settings = $module->settings;

        $oldVerifyUsers = (array)$settings->getSerialized('verifyUser');
        $oldVerifySpaces = (array)$settings->getSerialized('verifySpace');

        if(empty($this->color)) {
            $this->color = Yii::$app->getView()->theme->variable('default');
        }

        $settings->set('icon', $this->icon);
        $settings->set('color', $this->color);
        $settings->set('maxUsers', $this->maxUsers);
        $settings->set('maxSpaces', $this->maxSpaces);
        $settings->setSerialized('verifyUser', (array)$this->verifyUser);
        $settings->setSerialized('verifySpace', (array)$this->verifySpace);
        $settings->set('sendNotifications', $this->sendNotifications);

		if ($this->sendNotifications) {
            // Send notification to new verified users
            $newUsersGuid = array_diff((array)$this->verifyUser, $oldVerifyUsers);
            self::notifyUsers($newUsersGuid);
            
            // Send notification for new verified spaces
            $newSpacesGuid = array_diff((array)$this->verifySpace, $oldVerifySpaces);
            self::notifySpaces($newSpacesGuid);
		}
        return true;
    }
    
    /*
     * Notifies users that their account has been verified.
     */
    protected function notifyUsers($usersGuid)
    {
        $originator = Yii::$app->user->getIdentity();
        foreach($usersGuid as $guid) {
            if (empty($guid)) {
                continue;
            }
		    $user = User::findOne(['guid' => $guid]);
		    
		    UserVerified::instance()->from($originator)->about($user)->send($user);
        }
    }
    
    /*
     * Notifies space owners that their space has been verified.
     */
    protected function notifySpaces($spacesGuid)
    {
        $originator = Yii::$app->user->getIdentity();
        foreach($spacesGuid as $guid) {
            if (empty($guid)) {
                continue;
            }
            $space = Space::findOne(['guid' => $guid]);
            $owner = $space->ownerUser;
            SpaceVerified::instance()->from($originator)->about($space)->send($owner);
        }
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
