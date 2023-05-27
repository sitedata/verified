<?php

namespace humhub\modules\verified\controllers;

use Yii;
use humhub\widgets\ModalClose;
use humhub\modules\user\components\BaseAccountController;
use humhub\modules\verified\models\RequestBadge;

class RequestController extends BaseAccountController
{

    /**
     * Model Settings Loading
     */
    public function actionIndex()
    {

        $model = new RequestBadge();
        $model->loadSettings();

        if ($model->load(Yii::$app->request->post()) && $model->saveSettings()) {
            return ModalClose::widget();

        }
        return $this->renderAjax('index', ['model' => $model]);
    }
}
