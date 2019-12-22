$(document).ready(function () {
    var indexUrl = window.location.origin;

    if ($('.info-page__back-button').length) {

        $('.info-page__back-button').on('click', function (evt) {
            evt.preventDefault();

            var referrer =  document.referrer;

            if (referrer.indexOf(indexUrl) >= 0) {
                window.history.back();
            } else {
                window.location.href = "/";
            }
        });
    }
});