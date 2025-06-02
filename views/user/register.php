<?php
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Создание пользователя';


// Подключение CSS
$this->registerCssFile('@web/css/user-form.css', [
    'depends' => [\yii\bootstrap5\BootstrapAsset::class]
]);
?>

<div class="user-create-container">
    <div class="user-form-card">
        <h1 class="form-title"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'user-form',
            'options' => ['class' => 'user-form'],
            'fieldConfig' => [
                'options' => ['class' => 'form-group'],
                'inputOptions' => ['class' => 'form-input'],
                'labelOptions' => ['class' => 'form-label'],
                'errorOptions' => ['class' => 'form-error'],
                'template' => "{label}\n{input}\n{error}",
            ],
        ]); ?>

        <div class="form-row">
            <?= $form->field($model, 'full_name')->textInput([
                'maxlength' => true,
                'placeholder' => 'Введите полное имя'
            ])->label('Полное имя') ?>
        </div>

        <div class="form-row">
            <?= $form->field($model, 'phone')->textInput([
                'maxlength' => true,
                'placeholder' => 'Номер телефона'
            ])->label('Телефон') ?>
        </div>

        <div class="form-row">
            <?= $form->field($model, 'email')->textInput([
                'maxlength' => true,
                'type' => 'email',
                'placeholder' => 'Адрес электронной почты'
            ])->label('Email') ?>
        </div>

        <div class="form-row">
            <?= $form->field($model, 'login')->textInput([
                'maxlength' => true,
                'placeholder' => 'Придумайте логин'
            ])->label('Логин') ?>
        </div>

        <div class="form-row">
            <?= $form->field($model, 'password')->passwordInput([
                'maxlength' => true,
                'placeholder' => 'Создайте пароль'
            ])->label('Пароль') ?>
        </div>

        <div class="form-actions">
            <?= Html::submitButton('Создать пользователя', [
                'class' => 'submit-button',
                'name' => 'create-button'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
