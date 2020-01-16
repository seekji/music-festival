$(document).ready(function () {
    var indexUrl = window.location.origin;

    if ($('.info-page__back-button').length) {

        $('.info-page__back-button').on('click', function (evt) {
            evt.preventDefault();

            var referrer = document.referrer;

            if (referrer.indexOf(indexUrl) >= 0) {
                window.history.back();
            } else {
                window.location.href = "/";
            }
        });
    }

    $('.info-page__list-item').each(function (i) {
        $(this).css('animation-delay', 0.3 * i + 's');
    });

    $('.info-page__list-item:even').each(function (i) {
        $(this).addClass('animated fadeInLeft');
    });

    $('.info-page__list-item:odd').each(function (i) {
        $(this).addClass('animated fadeInRight');
    });
});