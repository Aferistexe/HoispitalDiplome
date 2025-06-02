<?php

use app\models\Status;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
$this->registerCssFile('@web/css/order_feedback.css');

$this->title = 'Редактирование отзыва: заказ №' . $model->id;

?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="order-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'feedback')->textarea([
            'rows' => 6,
            'placeholder' => 'Напишите ваш отзыв здесь...'
        ])->label('Отзыв') ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
