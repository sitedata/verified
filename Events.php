<?php

namespace humhub\modules\verified;

use Yii;
use humhub\modules\verified\widgets\VerifiedProfileHeader;
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
	    $enabled = models\PaymentOptions::getInstance()->enabled;

        if (!empty($enabled)) {
	    $menu->addEntry(new MenuLink([
	        'icon' => 'fa-check-circle',
	        'label' => Yii::t('VerifiedModule.base', 'Verification Center'),
	        'url' => '#',
	        'htmlOptions' => [
	            'data-action-click' => 'ui.modal.load',
	            'data-action-click-url' => helpers\Url::getOptionsUrl(),
	            'data-pjax-prevent' => ''
	       ],
	        'sortOrder' => 1000,
        ]));

        }
        return $enabled;

    }
}
