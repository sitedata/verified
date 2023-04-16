<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\space\widgets\SpaceDirectoryCard;
use Yii;

class VerifiedSpaceCard extends SpaceDirectoryCard
{
    public $verifiedIcon;
	
    public function init()
	{
	    parent::init();
		
		$verifiedSpace = Yii::$app->getModule('verified')->getVerifySpace();
		
		if (in_array($this->space->guid, $verifiedSpace)) {
		    $this->verifiedIcon = ' ' . Yii::$app->getModule('verified')->getSpaceIcon();
		}
    }
	
    public function run()
    {
        $card = $this->render('spaceDirectoryCard', [
            'space' => $this->space,
            'verifiedIcon' => $this->verifiedIcon
        ]);

        return str_replace('{card}', $card, $this->template);
    }
	
	public function getViewPath() {
		return Yii::$app->getModule('verified')->basePath . '/widgets/views/';
	}
}
