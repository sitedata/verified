<?php

namespace humhub\modules\verified;

use Yii;
use humhub\modules\verified\widgets\VerifiedProfileHeader;
use humhub\modules\verified\widgets\VerifiedUserWall;
use humhub\modules\verified\widgets\VerifiedPeopleCard;
use humhub\modules\verified\widgets\VerifiedSpaceCard;
use humhub\modules\verified\widgets\VerifiedComment;
use humhub\modules\ui\menu\MenuLink;
use humhub\libs\WidgetCreateEvent;

class Events
{
	public static function onContainerProfileHeaderBeforeRun(WidgetCreateEvent $event)
	{
		    $event->config['class'] = VerifiedProfileHeader::class;
	}

	public static function onPeopleCardBeforeRun(WidgetCreateEvent $event)
	{
		    $event->config['class'] = VerifiedPeopleCard::class;
	}

	public static function onSpaceDirectoryCardBeforeRun(WidgetCreateEvent $event)
	{
		    $event->config['class'] = VerifiedSpaceCard::class;
	}

	public static function onWallStreamEntryWidgetBeforeRun(WidgetCreateEvent $event)
	{
		$event->config['layoutHeader'] = '@verified/widgets/views/wallStreamEntryHeader';
	}

	public static function onCommentBeforeRun(WidgetCreateEvent $event)
	{
		$event->config['class'] = VerifiedComment::class;
	}

	public static function onAccountMenuInit($event)
	{
	    $menu = $event->sender;

	    $menu->addEntry(new MenuLink([
	        'icon' => 'fa-exclamation-circle',
	        'label' => Yii::t('VerifiedModule.base', 'Verification Request'),
	        'url' => '#',
	        'htmlOptions' => [
	            'data-action-click' => 'ui.modal.load',
	            'data-action-click-url' => helpers\Url::getRequestUrl()
	       ],
	        'sortOrder' => 1000,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id === 'verified' || Yii::$app->controller->id === 'index')
        ]));
    }
}
