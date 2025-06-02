<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Contact $model */

$this->registerCssFile('@web/css/contact-view.css');

$this->title = Html::encode($model->name);
\yii\web\YiiAsset::register($this);

function getStatusText($status) {
    $statuses = [
        0 => '<span class="badge bg-secondary">Новый</span>',
        1 => '<span class="badge bg-success">Выполнен</span>',
        2 => '<span class="badge bg-primary">В процессе</span>',
        3 => '<span class="badge bg-warning text-dark">Отложен</span>',
        4 => '<span class="badge bg-danger">Отменён</span>',
    ];
    return $statuses[$status] ?? '<span class="badge bg-light text-dark">Неизвестно</span>';
}

function getStatusClass($status) {
    $classes = [
        0 => 'status-new',
        1 => 'status-completed',
        2 => 'status-in-progress',
    ];
    return $classes[$status] ?? '';
}

// Предварительно вычисляем значения для полей
$phoneValue = Html::a(Html::encode($model->phone), 'tel:' . $model->phone);
$emailValue = Html::mailto($model->email);
$statusValue = getStatusText($model->is_completed);
$statusClass = getStatusClass($model->is_completed);

?>
<div class="contact-view container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4"><?= $this->title ?></h1>
        
        <div class="btn-group">
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-striped detail-view'],
                'attributes' => [
                    [
                        'attribute' => 'name',
                        'label' => 'Имя',
                        'contentOptions' => ['class' => 'fw-bold'],
                    ],
                    [
                        'attribute' => 'phone',
                        'label' => 'Телефон',
                        'format' => 'raw',
                        'value' => $phoneValue,
                    ],
                    [
                        'attribute' => 'email',
                        'label' => 'Email',
                        'format' => 'raw',
                        'value' => $emailValue,
                    ],
                    [
                        'attribute' => 'message',
                        'label' => 'Сообщение',
                        'format' => 'ntext',
                        'contentOptions' => ['class' => 'message-content'],
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Статус',
                        'value' => $statusValue,
                        'format' => 'raw',
                        'contentOptions' => ['class' => $statusClass],
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => 'Дата создания',
                        'format' => ['datetime', 'php:d.m.Y H:i'],
                        'contentOptions' => ['class' => 'text-muted'],
                    ],
                    [
                        'attribute' => 'updated_at',
                        'label' => 'Дата обновления',
                        'format' => ['datetime', 'php:d.m.Y H:i'],
                        'contentOptions' => ['class' => 'text-muted'],
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="mt-4">
        <?= Html::a('← Назад к списку', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
</div>