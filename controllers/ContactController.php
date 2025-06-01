<?php

namespace app\controllers;

use app\models\Contact;
use app\models\ContactSearch;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response as WebResponse;
use yii\web\ServerErrorHttpException;

class ContactController extends Controller
{


    public function actionIndex()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Contact();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Контакт успешно создан');
            return $this->redirect(['site/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionToggleCompleted()
    {
        Yii::$app->response->format = WebResponse::FORMAT_JSON;
        
        $id = Yii::$app->request->post('id');
        if (!$id) {
            throw new BadRequestHttpException('ID контакта не указан');
        }
        
        $model = $this->findModel($id);
        
        if ($model->toggleCompleted()) {
            return [
                'success' => true,
                'statusText' => $model->getStatusText(),
                'statusClass' => $model->getStatusClass(),
                'isCompleted' => $model->is_completed
            ];
        }
        
        throw new ServerErrorHttpException('Не удалось обновить статус контакта');
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Контакт успешно удален');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
}