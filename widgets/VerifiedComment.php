<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\comment\widgets\Comment;
use Yii;

class VerifiedComment extends Comment
{	
    public function getViewPath() {
        return Yii::$app->getModule('verified')->basePath . '/widgets/views/';
    }
}
