<?php

namespace humhub\modules\verified\widgets;

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
    
    public $verifiedIcon = '';
    
    public function init()
    {
        parent::init();
        
        $verifiedUser = Yii::$app->getModule('verified')->getVerifyUser();
        $verifiedSpace = Yii::$app->getModule('verified')->getVerifySpace();
        
        if (in_array($this->container->guid, $verifiedUser))
        {
            $this->verifiedIcon = Yii::$app->getModule('verified')->getUserIcon();
            
        } elseif (in_array($this->container->guid, $verifiedSpace))
        {
            $this->verifiedIcon = Yii::$app->getModule('verified')->getSpaceIcon();
        }
        
        if ($this->leadingSpace && !empty($this->verifiedIcon)) {
            $this->verifiedIcon = ' ' . $this->verifiedIcon;
        }
    }
    
    public function run()
    {
        return $this->verifiedIcon;
    }
}
