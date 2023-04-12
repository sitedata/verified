<?php

namespace humhub\modules\verified;

use humhub\modules\verified\widgets\ContainerProfileHeaderOverwrite;
use humhub\modules\verified\widgets\PeopleCardOverwrite;
use humhub\modules\verified\widgets\SpaceDirectoryCardOverwrite;

use humhub\libs\WidgetCreateEvent;

class Events
{
	public static function onContainerProfileHeaderBeforeRun(WidgetCreateEvent $event)
	{
		    $event->config['class'] = ContainerProfileHeaderOverwrite::class;
	}
	public static function onPeopleCardBeforeRun(WidgetCreateEvent $event)
	{
		    $event->config['class'] = PeopleCardOverwrite::class;
	}
	public static function onSpaceDirectoryCardBeforeRun(WidgetCreateEvent $event)
	{
		    $event->config['class'] = SpaceDirectoryCardOverwrite::class;
	}
}
