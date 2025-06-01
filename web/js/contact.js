$(document).on('change', '.contact-completed', function() {
    const checkbox = $(this);
    const id = checkbox.data('id');
    const isCompleted = checkbox.is(':checked') ? 1 : 0;
    
    $.ajax({
        url: '/contact/toggle-completed',
        type: 'POST',
        data: {
            id: id,
            is_completed: isCompleted
        },
        success: function(response) {
            if (response.success) {
                checkbox.closest('.contact-card').toggleClass('completed', response.completed);
            } else {
                checkbox.prop('checked', !checkbox.prop('checked'));
            }
        },
        error: function(xhr) {
            alert('Ошибка: ' + xhr.statusText);
            checkbox.prop('checked', !checkbox.prop('checked'));
        }
    });
});