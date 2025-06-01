<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\ContactSearch $model */
?>

<div class="contact-search mb-3">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'class' => 'row g-3'
        ],
    ]); ?>

    <div class="col-md-3">
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Поиск по имени']) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Поиск по email']) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'status')->dropDownList([
            $model::STATUS_NEW => 'Новый',
            $model::STATUS_PROCESSED => 'В обработке',
            $model::STATUS_COMPLETED => 'Завершен'
        ], ['prompt' => 'Все статусы']) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'created_at')->input('date', ['placeholder' => 'Дата создания']) ?>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <div class="mb-3">
            <?= Html::submitButton('<i class="fas fa-search"></i> Поиск', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fas fa-redo"></i> Сброс', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
