<?php

namespace humhub\modules\verified\helpers;

use Yii;
use humhub\modules\verified\models\ConfigureForm;
use yii\helpers\Url as BaseUrl;

/* @var $space Space */

class Url extends BaseUrl
{
    const ROUTE_HELP = '/verified/admin/help';
    const ROUTE_ADMIN = '/verified/admin/index';

    public static function getHelpUrl()
    {
        return static::toRoute(static::ROUTE_HELP);
    }

    public static function getConfigUrl()
    {
        return static::toRoute(static::ROUTE_ADMIN);
    }

}
