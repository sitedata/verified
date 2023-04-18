<?php

namespace humhub\modules\verified\widgets;

use humhub\modules\comment\widgets\Comment;
use Yii;
use yii\helpers\Url;

class VerifiedComment extends Comment
{	
    public $verifiedIcon = '';

    public function init()
    {
        parent::init();
        
        $verifiedUsers = Yii::$app->getModule('verified')->getVerifyUser();
        
        if (in_array($this->comment->createdBy->guid, $verifiedUsers)) {
            $this->verifiedIcon = ' ' . Yii::$app->getModule('verified')->getUserIcon();
        }
    }
	
    public function run()
    {
        return $this->isBlockedAuthor()
            ? $this->renderBlockedComment()
            : $this->renderComment();
    }
    
    public function renderComment(): string
    {
        $deleteUrl = Url::to(['/comment/comment/delete',
            'objectModel' => $this->comment->object_model, 'objectId' => $this->comment->object_id, 'id' => $this->comment->id]);
        $editUrl = Url::to(['/comment/comment/edit',
            'objectModel' => $this->comment->object_model, 'objectId' => $this->comment->object_id, 'id' => $this->comment->id]);
        $loadUrl = Url::to(['/comment/comment/load',
            'objectModel' => $this->comment->object_model, 'objectId' => $this->comment->object_id, 'id' => $this->comment->id]);

        return $this->render('comment', [
            'comment' => $this->comment,
            'user' => $this->comment->user,
            'createdAt' => $this->comment->created_at,
            'class' => trim($this->defaultClass . ' ' . $this->additionalClass),
            'verifiedIcon' => $this->verifiedIcon,
        ]);
    }
	    /**
     * Check if author of the Comment is blocked for the current User
     *
     * @return bool
     */
    private function isBlockedAuthor(): bool
    {
        if ($this->showBlocked) {
            return false;
        }

        if (Yii::$app->user->isGuest) {
            return false;
        }

        return Yii::$app->user->getIdentity()->isBlockedForUser($this->comment->createdBy);
    }

    public function getViewPath() {
        return Yii::$app->getModule('verified')->basePath . '/widgets/views/';
    }
}
