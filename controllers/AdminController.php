<?php

namespace humhub\modules\verified\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\verified\models\ConfigureForm;
use humhub\modules\verified\models\PaymentOptions;
use humhub\modules\verified\Module;
use Yii;

/**
 * AdminController
 *
 * @property Module $module
 */
class AdminController extends Controller
{

    public function actionIndex()
    {
        $model = new ConfigureForm();
        $model->loadSettings();

        if ($model->load(Yii::$app->request->post()) && $model->saveSettings()) {
            $this->view->saved();
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionOptions()
    {

        $model = new PaymentOptions();
        $model->loadSettings();

        if ($model->load(Yii::$app->request->post()) && $model->saveSettings()) {
            $this->view->saved();
        }

        return $this->render('options', ['model' => $model]);
    }
}
