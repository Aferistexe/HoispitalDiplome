<?php
use app\models\DeviceType;
use app\models\Service;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->registerCssFile('@web/css/order_create.css', [
    'depends' => [\yii\bootstrap5\BootstrapAsset::class]
]);

$this->title = 'Создание заказа';
?>

<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="order-form">
        <?php $form = ActiveForm::begin([
            'id' => 'order-form',
            'options' => ['class' => 'needs-validation'],
            'enableClientValidation' => true,
        ]); ?>

        <?= $form->field($model, 'service_id')->dropDownList(
            ArrayHelper::map(Service::find()->all(), 'id', 'title'),
            ['prompt' => 'Выберите услугу...']
        )->label('Услуга') ?>

        <?= $form->field($model, 'device_type_id')->dropDownList(
            ArrayHelper::map(DeviceType::find()->all(), 'id', 'title'),
            ['prompt' => 'Выберите тип устройства...']
        )->label('Тип устройства') ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'brand')->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Например: Apple'
                ])->label('Бренд') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'model')->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Например: iPhone 13'
                ])->label('Модель') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'year')->textInput([
                    'type' => 'number',
                    'min' => 2000,
                    'max' => date('Y'),
                    'placeholder' => 'Год выпуска'
                ])->label('Год выпуска') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'serial_number')->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Серийный номер'
                ])->label('Серийный номер') ?>
            </div>
        </div>

        <div class="date-time-fields">
            <?= $form->field($model, 'appointment_date')->textInput([
                'type' => 'date',
                'min' => date('Y-m-d')
            ])->label('Дата приёма') ?>

            <?= $form->field($model, 'appointment_time')->textInput([
                'type' => 'time',
                'min' => '09:00',
                'max' => '18:00'
            ])->label('Время приёма') ?>
        </div>

        <div class="form-group mt-3">
            <?= Html::submitButton('Создать заказ', [
                'class' => 'btn btn-success',
                'name' => 'create-button'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
