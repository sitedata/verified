<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\ui\icon\widgets\Icon;
use Yii;
use yii\base\Widget;

/**
 * VerifiedIcon returns the verified icon if the given user or space is verified.
 * Otherwise it returns an empty string.
 */

class VerifiedIcon extends Widget
{	
    // user or space
    public $container;
    
    // add a leading space
    public $leadingSpace = true;
    
    public $icon;
    
    public $color;
        
    public $verified;
    
    public $tooltip_message;
    
    public function init()
    {
        parent::init();
        
        $verifiedUser = Yii::$app->getModule('verified')->getVerifyUser();
        $verifiedSpace = Yii::$app->getModule('verified')->getVerifySpace();
        
        if (in_array($this->container->guid, $verifiedUser))
        {
            $this->verified = true;
            $this->tooltip_message = Yii::t('VerifiedModule.base', 'Verified User');
            
        } elseif (in_array($this->container->guid, $verifiedSpace))
        {
            $this->verified = true;
            $this->tooltip_message = Yii::t('VerifiedModule.base', 'Verified Space');
        } else {
            $this->verified = false;
        }
    }
    
    public function run()
    {
        if (!$this->verified) {
            return;
        }
        
        if ($this->icon === null) {
            $this->icon = Yii::$app->getModule('verified')->settings->get('icon');
        }
        
        if ($this->color === null) {
            $this->color = Yii::$app->getModule('verified')->settings->get('color'); 
        }
        
        $verified_icon = Icon::get($this->icon, ['color' => $this->color, 'tooltip' => $this->tooltip_message]);
        
        if ($this->leadingSpace) {
            $verified_icon = ' ' . $verified_icon;
        }
        
        return $verified_icon;
    }
}
