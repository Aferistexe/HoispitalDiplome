<?php
use app\models\DeviceType;
use app\models\Doctors;
use app\models\Service;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->registerCssFile('@web/css/order_create.css', [
    'depends' => [\yii\bootstrap5\BootstrapAsset::class]
]);

$this->title = 'Создание медицинской заявки';
?>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
</head>



<div class="order-create">
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h1 class="h3 mb-0 text-center"><?= Html::encode($this->title) ?></h1>
            </div>
            
            <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'order-form',
                    'options' => ['class' => 'needs-validation'],
                    'enableClientValidation' => true,
                ]); ?>

                <?= $form->field($model, 'insurance_policy')->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Например: 123456789012',
                ])->label('Страховой полис') ?>

                <?= $form->field($model, 'medical_record_number')->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Например: МК-12345',
                ])->label('Номер медицинской карты') ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'passport_series')->textInput([
                            'maxlength' => 4,
                            'placeholder' => 'Например: 1234',
                        ])->label('Серия паспорта') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'passport_number')->textInput([
                            'maxlength' => 6,
                            'placeholder' => 'Например: 567890',
                        ])->label('Номер паспорта') ?>
                    </div>
                </div>

                <?= $form->field($model, 'birthday')->input('date', [
                    'max' => date('Y-m-d'),
                ])->label('Дата рождения') ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'service_id')->dropDownList(
                            ArrayHelper::map(Service::find()->orderBy('title')->all(), 'id', 'title'),
                            ['prompt' => 'Выберите услугу...']
                        )->label('Медицинская услуга') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'device_type_id')->dropDownList(
                            ArrayHelper::map(DeviceType::find()->orderBy('title')->all(), 'id', 'title'),
                            ['prompt' => 'Выберите тип устройства...']
                        )->label('Тип медицинского устройства') ?>
                    </div>
                </div>

                <?= $form->field($model, 'doctor_id')->dropDownList(
                    ArrayHelper::map(Doctors::find()->orderBy('first_name')->all(), 'id', 'first_name'),
                    ['prompt' => 'Выберите врача...']
                )->label('Лечащий врач') ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'appointment_date')->input('date', [
                            'min' => date('Y-m-d'),
                        ])->label('Дата приёма') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'appointment_time')->input('time', [
                            'min' => '08:00',
                            'max' => '20:00',
                            'step' => '900',
                        ])->label('Время приёма') ?>
                    </div>
                </div>

                <?= $form->field($model, 'status_id')->hiddenInput(['value' => 1])->label(false) ?>

                <div class="d-flex justify-content-end mt-4">
                    <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-outline-secondary me-2']) ?>
                    <?= Html::submitButton('Создать заявку', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
