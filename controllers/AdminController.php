<?php

namespace humhub\modules\verified\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\verified\models\ConfigureForm;
use Yii;

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

    public function actionHelp()
    {
        return $this->render('help', []);
    }
}
