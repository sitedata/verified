<?php

namespace humhub\modules\verified\helpers;

use Yii;
use humhub\modules\verified\models\ConfigureForm;
use yii\helpers\Url as BaseUrl;

class Url extends BaseUrl
{
    const ROUTE_ADMIN = '/verified/admin/index';
    const ROUTE_REQUEST = '/verified/payment/index';

    public static function getConfigUrl()
    {
        return static::toRoute(static::ROUTE_ADMIN);
    }

    public static function getRequestUrl()
    {
        return static::toRoute(static::ROUTE_REQUEST);
    }
}
