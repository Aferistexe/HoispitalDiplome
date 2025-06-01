<?php

namespace app\controllers;

use app\models\Contact;
use app\models\ContactSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class ContactController extends Controller
{


    public function actionIndex()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination = ['pageSize' => 8];

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
        $model->created_at = time();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "В скором времени с вами свяжутся");
                return $this->redirect(['site/index']);
            }
            
            Yii::$app->session->setFlash('error', "Ошибка при сохранении данных");
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionToggleStatus()
    {
        if (!Yii::$app->request->isAjax) {
            throw new \yii\web\BadRequestHttpException('Only AJAX requests allowed');
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        
        // Переключаем is_completed
        $model->is_completed = $model->is_completed ? 0 : 1;
        
        if ($model->save(false)) {
            return [
                'success' => true,
                'is_completed' => (bool)$model->is_completed,
                'statusText' => $model->is_completed ? 'Выполнено' : 'Не выполнено'
            ];
        }
        
        return [
            'success' => false,
            'errors' => $model->errors
        ];
    }

    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
    public function actionAdminConfirm()
{
    if (!Yii::$app->request->isPost) {
        throw new \yii\web\BadRequestHttpException('Only POST allowed');
    }

    $id = Yii::$app->request->post('id');
    $model = $this->findModel($id);
    
    // Здесь ваша логика подтверждения
    $model->status = 2; // Например, отмечаем как завершённое
    $model->is_completed = 1;
    
    if ($model->save()) {
        Yii::$app->session->setFlash('success', 'Действие подтверждено');
    } else {
        Yii::$app->session->setFlash('error', 'Ошибка подтверждения');
    }

    return $this->redirect(['view', 'id' => $model->id]);
}
}