import './bootstrap';
import './echo.js';
import anchor from '@alpinejs/anchor';

Alpine.plugin(anchor);

window.showNotification = message => {
    $.ajax({
        url: '/notification/basic',
        type: 'POST',
        data: {
            message: message,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            // Inject the rendered Blade component into a DOM element
            $('#notification-box').html(response);
        },
        error: function (error) {
            console.log("Error:", error);
        }
    });
}
