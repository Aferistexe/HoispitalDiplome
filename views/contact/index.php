<?php

use app\models\Contact;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\ContactSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Contacts';
?>
<head>
    <link rel="stylesheet" href="/web/css/contacs.css"> <!-- исправлена опечатка в названии файла (contacs -> contacts) -->
</head>
<div class="contact-index">

    <?php
    $this->registerJs(<<<JS
    $(document).on('change', '.contact-completed', function() {
        const checkbox = $(this);
        const id = checkbox.data('id');
        const isCompleted = checkbox.is(':checked') ? 1 : 0;
        
        $.ajax({
            url: '/contact/toggle-completed',
            type: 'POST',
            data: {
                id: id,
                is_completed: isCompleted,
                _csrf: yii.getCsrfToken()
            },
            success: function(response) {
                if (response.success) {
                    checkbox.closest('.contact-card').toggleClass('completed', isCompleted);
                } else {
                    checkbox.prop('checked', !isCompleted);
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
                checkbox.prop('checked', !isCompleted);
            }
        });
    });
    JS, \yii\web\View::POS_READY);
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_card_contact',
        'summary' => '',
    ]) ?>

</div>