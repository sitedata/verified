<?php

use humhub\modules\verified\Module;
use humhub\modules\verified\Events;
use humhub\modules\content\widgets\ContainerProfileHeader;

return [
    'id' => 'verified',
    'class' => Module::class,
    'namespace' => 'humhub\modules\verified',
    'events' => [
	    [
			'class' => ContainerProfileHeader::class,
			'event' => ContainerProfileHeader::EVENT_CREATE,
			'callback' => [Events::class, 'onContainerProfileHeaderBeforeRun']
		],
    ],
];
