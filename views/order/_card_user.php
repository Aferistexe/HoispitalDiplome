<?php

use yii\bootstrap5\Html;

?>

<div class="card">
  <div class="card-body">
    <p class="card-title fs-4">Заказ №<?= Html::encode($model->id) ?></p>
    <p class="card-text">ФИО: <?= Html::encode($model->user->full_name) ?></p>
    <p class="card-text">Услуга: <?= Html::encode($model->service->title) ?></p>
    <p class="card-text">Тип устройства: <?= Html::encode($model->deviceType->title) ?></p>
    <p class="card-text">Бренд: <?= Html::encode($model->brand) ?></p>
    <p class="card-text">Модель: <?= Html::encode($model->model) ?></p>
    <p class="card-text">Год: <?= Html::encode($model->year) ?></p>
    <p class="card-text">Серийный номер: <?= Html::encode($model->serial_number) ?></p>
    <p class="card-text">Дата и время записи: <?= Html::encode($model->appointment_date . ' ' . $model->appointment_time) ?></p>
    <p class="card-text">Статус: <?= Html::encode($model->status->title) ?></p>
    <p class="card-text">Отзыв: <?= Html::encode($model->feedback) ?></p>

    <?= Html::a('Оставить отзыв', ['feedback', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
  </div>
</div>
