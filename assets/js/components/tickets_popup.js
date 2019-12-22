import 'magnific-popup';

$(document).ready(function() {
    $('.tickets-popup-trigger').magnificPopup({
        type: 'inline',
        midClick: true,
        showCloseBtn: false
    });

    $('.popup__close-btn').on( "click", function() {
        $.magnificPopup.close();
    });
});