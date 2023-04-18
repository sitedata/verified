<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\space\widgets\SpaceDirectoryCard;
use Yii;

class VerifiedSpaceCard extends SpaceDirectoryCard
{
	public function getViewPath() {
		return Yii::$app->getModule('verified')->basePath . '/widgets/views/';
	}
}
