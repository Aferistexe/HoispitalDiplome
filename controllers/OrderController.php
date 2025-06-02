<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderSearch;
use app\models\Status;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
 
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 1) {
            throw new ForbiddenHttpException('Доступ запрещён.');
        }
        $searchModel = new OrderSearch();
        
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy(["created_at"=>SORT_DESC]),
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDoctor()
{
    if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 3) {
        throw new ForbiddenHttpException('Доступ запрещён.');
    }

    $doctorId = \app\models\Doctors::find()
        ->select('id')
        ->where(['user_id' => Yii::$app->user->id])
        ->scalar();

    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => Order::find()->where(['doctor_id' => $doctorId])->orderBy(['created_at' => SORT_DESC]),
        'pagination' => ['pageSize' => 8],
    ]);

    return $this->render('doctor', [
        'dataProvider' => $dataProvider,
    ]);
}
    public function actionAdmin()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 2) {
            throw new ForbiddenHttpException('Доступ запрещён.');
        }
        $searchModel = new OrderSearch();
        
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->orderBy(["created_at"=>SORT_DESC]),
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);


        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionCreate()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 1) {
            throw new ForbiddenHttpException('Доступ запрещён.');
        }
        $model = new Order();
        $model->status_id = Status::$STATUS_NEW;
        $model->user_id = Yii::$app->user->id;

        $model->save();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 2) {
            throw new ForbiddenHttpException('Доступ запрещён.');}
        $model = $this->findModel($id);
        

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['admin']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionUpdate_doctors($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 3) {
            throw new ForbiddenHttpException('Доступ запрещён.');
        }
        $model = $this->findModel($id);
        

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['doctor']);
        }

        return $this->render('update_doctors', [
            'model' => $model,
        ]);
    }
    public function actionFeedback($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id != 1) {
            throw new ForbiddenHttpException('Доступ запрещён.');
        }
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('feedback', [
            'model' => $model,
        ]);
    }



    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
