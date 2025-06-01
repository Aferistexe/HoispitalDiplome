<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\Role;
use app\models\User;
use app\models\UserSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
  
    public function actionRegister()
    {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $model -> generateAuthKey();
                $model -> generatePassword($model->password);
                $model->role_id = Role::$NEW_USER;
                
                
                $model->save();

                return $this->redirect(['login']);
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
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
}
