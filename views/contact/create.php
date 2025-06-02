<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Contact $model */

$this->title = 'Создание контакта';


?>

<div class="contact-create">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom-0">
                        <h1 class="h3 mb-0 text-center"><?= Html::encode($this->title) ?></h1>
                    </div>
                    
                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'contact-form',
                            'options' => ['class' => 'needs-validation'],
                            'enableClientValidation' => true,
                        ]); ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <?= $form->field($model, 'name', [
                                    'inputOptions' => [
                                        'class' => 'form-control',
                                        'placeholder' => 'Введите полное имя'
                                    ],
                                    'labelOptions' => ['class' => 'form-label']
                                ])->textInput(['maxlength' => true]) ?>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <?= $form->field($model, 'phone', [
                                    'inputOptions' => [
                                        'class' => 'form-control',
                                        'placeholder' => '+7 (XXX) XXX-XX-XX'
                                    ]
                                ])->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <?= $form->field($model, 'email', [
                                'inputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'example@domain.com',
                                    'type' => 'email'
                                ]
                            ])->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="mb-4">
                            <?= $form->field($model, 'message', [
                                'inputOptions' => [
                                    'class' => 'form-control',
                                    'rows' => 5,
                                    'placeholder' => 'Введите ваше сообщение...'
                                ]
                            ])->textarea() ?>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <?= Html::a('Отмена', ['index'], [
                                'class' => 'btn btn-outline-secondary me-md-2'
                            ]) ?>
                            
                            <?= Html::submitButton('Сохранить', [
                                'class' => 'btn btn-primary',
                                'name' => 'contact-button'
                            ]) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>