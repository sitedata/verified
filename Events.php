<?php

namespace humhub\modules\verified;

use humhub\modules\verified\widgets\ContainerProfileHeaderOverwrite;
use humhub\libs\WidgetCreateEvent;

class Events
{
	public static function onContainerProfileHeaderBeforeRun(WidgetCreateEvent $event)
	{
		    $event->config['class'] = ContainerProfileHeaderOverwrite::class;
	}
}
