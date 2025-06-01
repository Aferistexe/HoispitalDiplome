<?php

namespace app\controllers;

use app\models\Contact;
use app\models\ContactSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class ContactController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'toggle-completed' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Только для авторизованных
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination = [
            'pageSize' => 8,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Contact();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', "В скором времени с вами свяжутся");
                return $this->redirect(['site/index']);
            }
            
            Yii::$app->session->setFlash('error', "Ошибка при сохранении данных");
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionToggleCompleted()
    {
        if (!Yii::$app->request->isAjax) {
            throw new \yii\web\BadRequestHttpException('Only AJAX requests allowed');
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $id = Yii::$app->request->post('id');
        $isCompleted = (int)Yii::$app->request->post('is_completed', 0);
        
        $model = $this->findModel($id);
        $model->is_completed = $isCompleted;
        
        if ($model->save(false)) {
            return [
                'success' => true,
                'completed' => (bool)$model->is_completed
            ];
        }
        
        return [
            'success' => false,
            'errors' => $model->errors
        ];
    }

    protected function findModel($id)
    {
        if ($model = Contact::findOne($id)) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
}