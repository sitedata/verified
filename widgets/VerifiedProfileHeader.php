<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\content\widgets\ContainerProfileHeader;
use Yii;

class VerifiedProfileHeader extends ContainerProfileHeader
{	
	public function getViewPath() {
		return Yii::$app->getModule('verified')->basePath . '/widgets/views/';
	}
}
