<?php

namespace humhub\modules\verified;

use humhub\modules\verified\widgets\VerifiedProfileHeader;
use humhub\modules\verified\widgets\VerifiedPeopleCard;
use humhub\modules\verified\widgets\VerifiedSpaceCard;

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
}
