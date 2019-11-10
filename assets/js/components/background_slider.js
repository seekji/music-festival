import $ from 'jquery';
import 'slick-carousel';

$(document).ready(function () {
    var backgroundSlider = $('.background-slider__track');
    var artistNameElement = $('.background-slider__name');

    var setArtistName = function (slideIndex) {
        slideIndex = typeof slideIndex !== 'undefined' ? slideIndex : '0';

        var slideElement = $('[data-slick-index=' + slideIndex + ']').find('.background-slider__slide');
        var artistName = slideElement.attr('data-artist-name');
        artistNameElement.text(artistName);
    };

    backgroundSlider.on('init.slick', function () {
        setArtistName();
    });

    backgroundSlider.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '0',
        nextArrow: $('.background-slider__next-btn'),
        prevArrow: $('.background-slider__prev-btn')
    });

    backgroundSlider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        setArtistName(nextSlide);
    });
});