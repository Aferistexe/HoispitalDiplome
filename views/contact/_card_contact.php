<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;

?>
<head>
    <link rel="stylesheet" href="/web/css/contact.css">
</head>

<div class="contact-card <?= $model->is_completed ? 'completed' : '' ?>">
    <?= Html::checkbox('is_completed', $model->is_completed, [
        'class' => 'contact-completed',
        'data-id' => $model->id,
    ]) ?>
    
    <div class="contact-info">
        <p>
            <strong>Name:</strong>
            <span class="value"><?= Html::encode($model->name) ?></span>
        </p>
        
        <p>
            <strong>Phone:</strong>
            <span class="value"><?= Html::encode($model->phone) ?></span>
        </p>
        
        <p>
            <strong>Email:</strong>
            <span class="value"><?= Html::encode($model->email) ?></span>
        </p>
        
        <p>
            <strong>Message:</strong>
            <span class="value"><?= nl2br(Html::encode($model->message)) ?></span>
        </p>
    </div>
</div>