<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\verified\Module;
use humhub\modules\verified\models\ConfigureForm;
use humhub\modules\content\widgets\ContainerProfileHeader;
use humhub\modules\user\models\User;
use Yii;

class ContainerProfileHeaderOverwrite extends ContainerProfileHeader
{	
	public function init()
	{
        parent::init();
		
		$verifiedUser = Yii::$app->getModule('verified')->getVerifyUser();
		
		if (!empty($verifiedUser)) {
		    $this->classPrefix .= ' verified';
		}
	}
	
	public function getViewPath() {
		return Yii::$app->getModule('content')->basePath . '/widgets/views/';
	}
}
