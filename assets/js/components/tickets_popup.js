import 'magnific-popup';

$(document).ready(function() {
    $('.buy-tickets__link').magnificPopup({
        type: 'inline',
        midClick: true,
        showCloseBtn: false
    });

    $('.popup__close-btn').on( "click", function() {
        $.magnificPopup.close();
    });
});