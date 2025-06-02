<?php

use yii\bootstrap5\Html;
$this->registerCssFile('@web/css/doctor_orders.css', [
  'depends' => [\yii\bootstrap5\BootstrapAsset::class]
]);
?><head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
</head>



<div class="card">
  <div class="card-body">
    <p class="card-title fs-4">Заявка №<?= $model->id ?></p>
    <p class="card-text">ФИО: <?= Html::encode($model->user->full_name) ?></p>
    <p class="card-text">Услуга: <?= Html::encode($model->service->title) ?></p>
    <p class="card-text">Тип устройства: <?= Html::encode($model->deviceType->title) ?></p>
    <p class="card-text">Врач: <?= Html::encode($model->doctor ? $model->doctor->first_name : 'Не назначен') ?></p>
    
    <p class="card-text">Страховой полис: <?= Html::encode($model->insurance_policy) ?></p>
    <p class="card-text">Номер мед. карты: <?= Html::encode($model->medical_record_number) ?></p>
    <p class="card-text">Паспорт: серия <?= Html::encode($model->passport_series) ?> номер <?= Html::encode($model->passport_number) ?></p>
    <p class="card-text">Дата рождения: <?= Html::encode($model->birthday) ?></p>
    
    <p class="card-text">Дата и время записи: <?= Html::encode($model->appointment_date . ' ' . $model->appointment_time) ?></p>
    <p class="card-text">Статус: <?= Html::encode($model->status->title) ?></p>
    <p class="card-text">Отзыв: <?= Html::encode($model->feedback) ?></p>

    <?= Html::a('Обновить статус', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
  </div>
</div>