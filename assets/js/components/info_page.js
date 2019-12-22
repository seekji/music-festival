$(document).ready(function () {
    var indexUrl = window.location.origin;

    if ($('.info-page__back-button').length) {

        $('.info-page__back-button').on('click', function () {
            var referrer =  document.referrer;
            console.log(referrer);
            history.back();


            if (referrer.indexOf(indexUrl) >= 0) {
                history.back();
            } else {
                window.location.href = "/";
            }
        });
    }
});