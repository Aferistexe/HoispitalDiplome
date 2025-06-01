<?php

use app\models\Status;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Update Order: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'feedback';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'feedback')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
