<?php

use app\models\DeviceType;
use app\models\Service;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Create Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="order-form">

<?php $form = ActiveForm::begin(); ?>


<?= $form->field($model, 'service_id')->dropDownList(ArrayHelper::map(Service::find()->all(),'id','title')) ?>

<?= $form->field($model, 'device_type_id')->dropDownList(ArrayHelper::map(DeviceType::find()->all(),'id','title'))  ?>

<?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'year')->textInput() ?>

<?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'appointment_date')->textInput(['type'=>'date']) ?>

<?= $form->field($model, 'appointment_time')->textInput(['type'=>'time']) ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>


</div>
