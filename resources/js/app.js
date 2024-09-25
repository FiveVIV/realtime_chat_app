import './bootstrap';
import './echo.js';
import anchor from '@alpinejs/anchor';

Alpine.plugin(anchor);

/*
window.activeNotifications = [];

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
            activeNotifications.push(response);
            $('#notification-box').append(response);
        },
        error: function (error) {
            console.log("Error:", error);
        }
    });
}

window.closeNotification = message => {

}
*/
