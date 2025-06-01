<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\Role;
use app\models\User;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionRegister()
    {
        $model = new User();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->generateAuthKey();
                $model->generatePassword($model->password);
                $model->role_id = Role::$NEW_USER;

                if ($model->save()) {
                    return $this->redirect(['login']);
                } else {
                    // Для отладки ошибок сохранения:
                    Yii::error('Ошибка при сохранении пользователя: ' . json_encode($model->errors));
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
             return $this->redirect(['site/index']);
        }
    
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
}
