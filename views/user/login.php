<?php
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Вход';
$this->registerCssFile('@web/css/login.css', [
    'depends' => [\yii\bootstrap5\BootstrapAsset::class],
    'position' => $this::POS_HEAD
]);
?>

<div class="login-container">
    <div class="login-card">
        <h1 class="login-title"><?= Html::encode($this->title) ?></h1>
        <p class="login-subtitle">Пожалуйста, заполните следующие поля для входа:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'login-form'],
            'fieldConfig' => [
                'options' => ['class' => 'form-group'],
                'inputOptions' => ['class' => 'form-input'],
                'errorOptions' => ['class' => 'error-message'],
                'labelOptions' => ['class' => 'form-label'],
                'template' => "{label}\n{input}\n{error}",
            ],
        ]); ?>

        <div class="form-group">
            <?= $form->field($model, 'username')
                ->textInput(['autofocus' => true, 'placeholder' => 'Введите ваш логин'])
                ->label('Логин') ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'password')
                ->passwordInput(['placeholder' => 'Введите ваш пароль'])
                ->label('Пароль') ?>
        </div>

        <div class="form-group remember-me">
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "{input} {label}",
                'labelOptions' => ['class' => 'remember-label'],
            ]) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'login-button', 'name' => 'login-button']) ?>
        </div>



        <?php ActiveForm::end(); ?>
    </div>
</div>