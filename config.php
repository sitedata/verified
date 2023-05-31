<?php

use humhub\modules\verified\Module;
use humhub\modules\verified\Events;
use humhub\modules\content\widgets\ContainerProfileHeader;
use humhub\modules\user\widgets\PeopleCard;
use humhub\modules\space\widgets\SpaceDirectoryCard;
use humhub\modules\content\widgets\stream\WallStreamEntryWidget;
use humhub\modules\comment\widgets\Comment;
use humhub\modules\user\widgets\AccountMenu;

return [
    'id' => 'verified',
    'class' => Module::class,
    'namespace' => 'humhub\modules\verified',
    'events' => [
	    ['class' => ContainerProfileHeader::class, 'event' => ContainerProfileHeader::EVENT_CREATE, 'callback' => [Events::class, 'onContainerProfileHeaderBeforeRun']],
		['class' => PeopleCard::class, 'event' => PeopleCard::EVENT_CREATE, 'callback' => [Events::class, 'onPeopleCardBeforeRun']],
		['class' => SpaceDirectoryCard::class, 'event' => SpaceDirectoryCard::EVENT_CREATE, 'callback' => [Events::class, 'onSpaceDirectoryCardBeforeRun']],
        ['class' => WallStreamEntryWidget::class, 'event' => WallStreamEntryWidget::EVENT_CREATE, 'callback' => [Events::class, 'onWallStreamEntryWidgetBeforeRun']],
        ['class' => Comment::class, 'event' => Comment::EVENT_CREATE, 'callback' => [Events::class, 'onCommentBeforeRun']],
		['class' => AccountMenu::class, 'event' => AccountMenu::EVENT_INIT, 'callback' => [Events::class, 'onAccountMenuInit']],
    ],
];
