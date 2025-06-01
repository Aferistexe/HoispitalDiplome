<?php

use app\models\Contact;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\ContactSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Управление контактами';
?>
<div class="contact-index">
    <div class="card-body">
        <?php Pjax::begin(['id' => 'contact-pjax-container']); ?>
        
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_card_contact',
            'summary' => '',
            'emptyText' => '<div class="alert alert-info">Контакты не найдены</div>',
            'options' => ['class' => 'contact-list'],
            'pager' => [
                'options' => ['class' => 'pagination justify-content-center'],
                'linkOptions' => ['class' => 'page-link'],
                'activePageCssClass' => 'active',
                'disabledPageCssClass' => 'disabled',
            ],
        ]) ?>
        
        <?php Pjax::end(); ?>
    </div>
</div>

<?php
$this->registerJs(<<<JS
$(document).on('change', '.contact-completed', function() {
    const checkbox = $(this);
    const card = checkbox.closest('.contact-card');
    const id = checkbox.data('id');
    const isCompleted = checkbox.is(':checked') ? 1 : 0;
    
    card.addClass('loading');
    
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
                // Обновляем только два состояния: завершено или новое
                card.toggleClass('completed', isCompleted);
                card.find('.status-badge')
                    .text(isCompleted ? 'Завершено' : 'Новый')
                    .removeClass('bg-secondary bg-warning bg-success')
                    .addClass(isCompleted ? 'bg-success' : 'bg-secondary');
            } else {
                checkbox.prop('checked', !isCompleted);
                if (response.message) {
                    alert(response.message);
                }
            }
        },
        error: function(xhr) {
            alert('Произошла ошибка: ' + xhr.statusText);
            checkbox.prop('checked', !isCompleted);
        }
    });
});
JS, \yii\web\View::POS_READY);
?>