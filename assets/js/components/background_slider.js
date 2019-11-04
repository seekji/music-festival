import $ from 'jquery';
import 'slick-carousel';

$(document).ready(function() {
    $('.background-slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '0',
        prevArrow: $('.background-slider__prev-btn'),
        nextArrow: $('.background-slider__next-btn')
    });
});