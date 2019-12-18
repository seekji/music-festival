import 'jquery.cookie';

$(document).ready(function () {
    $.cookie('previousUrl', window.location.href, {path:'/'});
    var previuosUrl = $.cookie('previousUrl');

    if ($('.info-page__back-button').length) {

        $('.info-page__back-button').on('click', function () {

            if (previuosUrl) {
                window.location.href = previuosUrl;
            } else {
                window.location.href = '/';
            }
        });
    }
});