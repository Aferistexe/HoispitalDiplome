<?php

use yii\bootstrap5\Html;

?>
<p?php


?>





<div class="card" >
  <div class="card-body">
    <p class="card-title fs-4">Orders №<?= $model->id?> </p>
    <p class="card-text">Full name <?= $model->user->full_name?> </p>
    <p class="card-text">Service <?= $model->service->title?> </p>
    <p class="card-text">DeviceType <?= $model->deviceType->title?> </p>
    <p class="card-text">Brand <?= $model->brand?> </p>
    <p class="card-text">Model <?= $model->model?> </p>
    <p class="card-text">Year <?= $model->year?> </p>
    <p class="card-text">serial_number <?= $model->serial_number?> </p>
    <p class="card-text">appointment_date <?= $model->appointment_date . ' ' . $model->appointment_time?> </p>
    <p class="card-text">status_id  <?= $model->status->title?> </p>
    <p class="card-text">feedback <?= $model->feedback?> </p>


    <?= Html::a('feedback', ['feedback','id' => $model->id], ['class' => 'btn btn-success']) ?>

  </div>
</div>