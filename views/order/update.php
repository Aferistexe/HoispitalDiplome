<?php

use app\models\Status;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->registerCssFile('@web/css/order_update.css', [
    'depends' => [\yii\bootstrap5\BootstrapAsset::class],
]);

$this->title = 'Редактирование заказа: ' . $model->id;
?>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
</head>



<div class="order-update container py-4">
    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <div class="order-form">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'needs-validation'],
            'enableClientValidation' => true,
        ]); ?>

        <?= $form->field($model, 'status_id')->dropDownList(
            ArrayHelper::map(Status::find()->all(), 'id', 'title'),
            [
                'prompt' => 'Выберите статус...',
                'class' => 'form-select',
            ]
        ) ?>

        <div class="form-group mt-4">
            <?= Html::submitButton('Сохранить', [
                'class' => 'btn btn-success px-4 py-2 fw-semibold',
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
