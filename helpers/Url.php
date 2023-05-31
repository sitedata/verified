<?php

namespace humhub\modules\verified\helpers;

use Yii;
use yii\helpers\Url as BaseUrl;

class Url extends BaseUrl
{
    const ROUTE_ADMIN = '/verified/admin/index';
    const ROUTE_OPTIONS = '/verified/payment/index';

    public static function getConfigUrl()
    {
        return static::toRoute(static::ROUTE_ADMIN);
    }

    public static function getOptionsUrl()
    {
        return static::toRoute(static::ROUTE_OPTIONS);
    }
}
