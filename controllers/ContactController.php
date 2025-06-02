<?php

namespace app\controllers;

use app\models\Contact;
use app\models\ContactSearch;
use app\models\Order;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\Response as WebResponse;
use yii\web\ServerErrorHttpException;

class ContactController extends Controller
{


    public function actionIndex()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 2) {
            throw new ForbiddenHttpException('Доступ запрещён.');
        }
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 2) {
        throw new ForbiddenHttpException('Доступ запрещён.');
    }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Доступ запрещён.');
        }
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
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 2) {
            throw new ForbiddenHttpException('Доступ запрещён.');
        }
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
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 2) {
            throw new ForbiddenHttpException('Доступ запрещён.');
        }
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
    public function actionComplete()
{
    $request = Yii::$app->request;
    $id = $request->post('id');

    $order = $this->findModel($id);

    // Только если врач — и заказ его
    if (Yii::$app->user->identity->role_id == 3) {
        $doctor = \app\models\Doctors::find()->where(['user_id' => Yii::$app->user->id])->one();

        if ($order->doctor_id != $doctor->id) {
            throw new \yii\web\ForbiddenHttpException('Вы не можете завершить чужой заказ.');
        }
    }

    $order->is_completed = 1;
    $order->save(false);

    Yii::$app->session->setFlash('success', 'Заказ помечен как выполненный.');

    return $this->redirect(['index']);
}


}