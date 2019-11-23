$(document).ready(function() {
    var menuToggler = $('.menu-toggler');
    var menu = $('.main-nav');

    menuToggler.on('click', function() {
        menuToggler.toggleClass('menu-toggler--close');
        menu.toggleClass('main-nav--visible');
    });
});