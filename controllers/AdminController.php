<?php

namespace humhub\modules\verified\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\verified\models\ConfigureForm;
use humhub\modules\verified\models\RequestBadge;
use humhub\modules\verified\models\RequestSearch;
use humhub\modules\verified\Module;
use Yii;
use yii\data\Pagination;

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

    public function actionRequests()
    {

        $model = new RequestBadge();
        $model->loadSettings();

        if ($model->load(Yii::$app->request->post()) && $model->saveSettings()) {
            $this->view->saved();
        }

        return $this->render('options', ['model' => $model]);
    }
}
