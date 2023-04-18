<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\user\widgets\PeopleCard;
use Yii;

class VerifiedPeopleCard extends PeopleCard
{	
	public function getViewPath() {
		return Yii::$app->getModule('verified')->basePath . '/widgets/views/';
	}
}
