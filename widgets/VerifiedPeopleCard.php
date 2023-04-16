<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\user\widgets\PeopleCard;
use Yii;

class VerifiedPeopleCard extends PeopleCard
{	
    public $verifiedIcon;
	
    public function init()
	{
	    parent::init();
		
		$verifiedUser = Yii::$app->getModule('verified')->getVerifyUser();
		
		if (in_array($this->user->guid, $verifiedUser)) {
		    $this->verifiedIcon = ' ' . Yii::$app->getModule('verified')->getUserIcon();
		}
    }
	
    public function run()
    {
        $card = $this->render('peopleCard', [
            'user' => $this->user,
            'verifiedIcon' => $this->verifiedIcon
        ]);

        return str_replace('{card}', $card, $this->template);
    }
	
	public function getViewPath() {
		return Yii::$app->getModule('verified')->basePath . '/widgets/views/';
	}
}
