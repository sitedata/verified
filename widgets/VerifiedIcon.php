<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\verified\models\ConfigureForm;
use humhub\modules\ui\icon\widgets\Icon;
use Yii;
use yii\base\Widget;

/**
 * VerifiedIcon returns the verified icon if the given user or space is verified.
 * Otherwise it returns an empty string.
 */

class VerifiedIcon extends Widget
{	
    /**
     * @var \humhub\modules\user\models\User OR \humhub\modules\space\models\Space
     */
    public $container;
    
    /**
     * @var string icon
     */
    public $icon;
    
    /**
     * @var string color
     */
    public $color;
    
    /**
     * @var boolean adds a leading space
     */
    public $leadingSpace = true;
    
    protected $verified;
    
    protected $tooltip;
    
    public function init()
    {
        parent::init();
        
        $module = Yii::$app->getModule('verified');
        
        if (in_array($this->container->guid, $module->getVerifyUser()))
        {
            $this->verified = true;
            $this->tooltip = Yii::t('VerifiedModule.base', 'Verified User');
            
        } elseif (in_array($this->container->guid, $module->getVerifySpace()))
        {
            $this->verified = true;
            $this->tooltip = Yii::t('VerifiedModule.base', 'Verified Space');
            
        } else {
            $this->verified = false;
        }
    }
    
    public function run()
    {
        if (!$this->verified) {
            return;
        }
        
        $module = Yii::$app->getModule('verified');
        
        if ($this->icon === null) {
            $this->icon = $module->settings->get('icon');
        }
        
        if ($this->color === null) {
            $this->color = $module->settings->get('color'); 
        }
        
        $verifiedIcon = Icon::get($this->icon, ['color' => $this->color, 'tooltip' => $this->tooltip]);
        
        if ($this->leadingSpace) {
            $verifiedIcon = ' ' . $verifiedIcon;
        }
        
        return $verifiedIcon;
    }
}
