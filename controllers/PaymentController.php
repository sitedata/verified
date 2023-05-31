<?php

namespace humhub\modules\verified\controllers;

use Yii;
use humhub\modules\user\components\BaseAccountController;
use humhub\modules\verified\models\PaymentOptions;

class PaymentController extends BaseAccountController
{

    /**
     * Model Settings Loading
     */
    public function actionIndex()
    {

        $model = new PaymentOptions();

        return $this->renderAjax('index', ['model' => $model]);
    }
}
