<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

/** @var app\models\Contact $model */

$this->registerCssFile('@web/css/contact.css');

$toggleUrl = Url::to(['contact/toggle-completed', 'id' => $model->id]);
$csrfToken = Yii::$app->request->csrfToken;
?>

<div class="contact-card card mb-3 <?= $model->is_completed ? 'completed' : '' ?> status-<?= $model->getStatusClass() ?>">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <?= Html::checkbox('is_completed', $model->is_completed, [
                'class' => 'contact-completed me-2',
                'data-id' => $model->id,
                'data-url' => $toggleUrl,
                'data-csrf' => $csrfToken,
                'aria-label' => 'Отметить как выполненное',
                'disabled' => $model->is_completed ? true : false
            ]) ?>

            <h5 class="card-title mb-0">
                <?= Html::encode($model->name) ?>
                <span class="badge bg-<?= $model->getStatusClass() ?> ms-2 status-badge">
                    <?= $model->getStatusText() ?>
                </span>
            </h5>
        </div>

        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                    data-bs-toggle="dropdown" aria-expanded="false" <?= $model->is_completed ? 'disabled' : '' ?>>
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <?php if (!$model->is_completed): ?>
                    <li>
                        <?= Html::a('<i class="fas fa-eye me-2"></i>Просмотр', ['view', 'id' => $model->id], ['class' => 'dropdown-item']) ?>
                    </li>
                <?php endif; ?>
                <li>
                    <?= Html::a('<i class="fas fa-trash me-2"></i>Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'dropdown-item text-danger',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить этот контакт?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </li>
            </ul>
        </div>
    </div>

    <div class="card-body">
        <div class="contact-info">
            <div class="row mb-2">
                <div class="col-md-3 fw-bold">Телефон:</div>
                <div class="col-md-9">
                    <?= Html::a(Html::encode($model->phone), "tel:{$model->phone}", [
                        'class' => 'text-decoration-none',
                        'style' => $model->is_completed ? 'pointer-events: none; color: #6c757d;' : ''
                    ]) ?>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 fw-bold">Email:</div>
                <div class="col-md-9">
                    <?= Html::a(Html::encode($model->email), "mailto:{$model->email}", [
                        'class' => 'text-decoration-none',
                        'style' => $model->is_completed ? 'pointer-events: none; color: #6c757d;' : ''
                    ]) ?>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 fw-bold">Сообщение:</div>
                <div class="col-md-9">
                    <div class="message-text" data-fulltext="<?= Html::encode($model->message) ?>">
                        <?= nl2br(Html::encode(StringHelper::truncate($model->message, 200))) ?>
                        <?php if (mb_strlen($model->message) > 200): ?>
                            <a href="#" class="read-more text-primary" style="<?= $model->is_completed ? 'pointer-events: none; color: #6c757d;' : '' ?>">
                                Показать полностью
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if (!empty($model->ip_address)): ?>
                <div class="row">
                    <div class="col-md-3 fw-bold">IP адрес:</div>
                    <div class="col-md-9 text-muted">
                        <?= Html::encode($model->ip_address) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card-footer bg-transparent">
        <div class="d-flex justify-content-between text-muted small">
            <span>
                <i class="far fa-calendar-plus me-1"></i>
                <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
            </span>
            <span>
                <i class="far fa-calendar-check me-1"></i>
                <?= Yii::$app->formatter->asDatetime($model->updated_at) ?>
            </span>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).on('change', '.contact-completed:not(:disabled)', function() {
    const checkbox = $(this);
    const id = checkbox.data('id');
    const url = checkbox.data('url');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    
    checkbox.prop('disabled', true);
    
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            _csrf: csrfToken
        },
        success: function(data) {
            if (data.success) {
                const card = checkbox.closest('.contact-card');
                const badge = card.find('.status-badge');
                
                badge.text(data.statusText);
                badge.removeClass('bg-secondary bg-success').addClass('bg-' + data.statusClass);
                
                card.removeClass('status-secondary status-success completed')
                    .addClass('status-' + data.statusClass);
                
                if (data.isCompleted) {
                    card.addClass('completed');
                    // Блокируем элементы после завершения
                    card.find('.contact-completed').prop('disabled', true);
                    card.find('.dropdown-toggle').prop('disabled', true);
                    card.find('a').css({'pointer-events': 'none', 'color': '#6c757d'});
                }
            } else {
                alert('Ошибка: ' + (data.message || 'Неизвестная ошибка'));
                checkbox.prop('checked', !checkbox.is(':checked'));
            }
        },
        error: function(xhr) {
            let errorMsg = 'Ошибка связи с сервером';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            alert(errorMsg);
            checkbox.prop('checked', !checkbox.is(':checked'));
        },
        complete: function() {
            if (!checkbox.closest('.contact-card').hasClass('completed')) {
                checkbox.prop('disabled', false);
            }
        }
    });
});
JS;

$this->registerJs($js);
?>