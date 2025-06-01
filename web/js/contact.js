$(document).on('change', '.contact-completed', function() {
    const $checkbox = $(this);
    const id = $checkbox.data('id');
    const isCompleted = $checkbox.is(':checked') ? 1 : 0;
    

    
    $.ajax({
        url: $checkbox.data('url') || '/contact/toggle-completed', // Можно задать URL через data-атрибут
        type: 'POST',
        data: {
            id: id,
            is_completed: isCompleted,
            _csrf: yii.getCsrfToken() // Используем встроенный метод Yii2 для CSRF
        },
        dataType: 'json',
        success: function(response) {
            if (response && response.success) {
                $checkbox.closest('.contact-card')
                    .toggleClass('completed', isCompleted)
                    .find('.status-badge')
                    .text(isCompleted ? 'Выполнено' : 'Новое');
                
                // Обновляем статус в таблице, если нужно
                if (response.newStatus) {
                    $checkbox.closest('tr').find('.status-column').text(response.newStatus);
                }
            } else {
                yii.handleAjaxError(response);
                $checkbox.prop('checked', !isCompleted);
            }
        },
        error: function(xhr) {
            yii.handleAjaxError(xhr.responseJSON || xhr.statusText);
            $checkbox.prop('checked', !isCompleted);
        },
        complete: function() {
            $checkbox.prop('disabled', false);
        }
    });
});