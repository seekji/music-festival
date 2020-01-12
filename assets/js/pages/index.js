import $ from 'jquery';
import 'slick-carousel/slick/slick.js';
import 'slick-carousel/slick/slick.css';
import Rellax from 'rellax';
// import 'scrollmagic/scrollmagic/minified/ScrollMagic.min';
// import 'gsap/all.js';

import backgroundSlider from '../components/background_slider.js';
import menuToggler from '../components/menu_toggler.js';
import buyTicketrs from '../components/buy_tickets.js';
import placeMap from '../components/place_map.js';
import tabs from '../components/tabs.js';
import routeTabs from '../components/route_tabs.js';
import infoPage from '../components/info_page.js';
import ticketsPopup from '../components/tickets_popup.js';
import faqAccordion from '../components/faq_accordion.js';

$(document).ready(function () {

    // Unable to pass array of elements to plugin
    // Issue: https://github.com/dixonandmoe/rellax/pull/160
    var promoRellax = new Rellax('.promo__start-timer', {
        speed: 2,
        wrapper: '.promo',
        relativeToWrapper: true,
    });

    var partnersRellax = Rellax('.partners__title', {
        speed: 2,
        wrapper: '.page-footer',
        relativeToWrapper: true,
    });

    var lineupRellax = new Rellax('#lineup .buy-tickets__link', {
        speed: 1,
        wrapper: '#lineup',
        relativeToWrapper: true,
    });

    var placeRellax = new Rellax('.place__content', {
        speed: 2,
        wrapper: '.place',
        relativeToWrapper: true,
    });

    var historyRellax = new Rellax('.short-history__top-block', {
        speed: 3,
        wrapper: '.short-history',
        relativeToWrapper: true,
    });

    var destroyRellaxEntities = function () {
        lineupRellax.destroy();
        placeRellax.destroy();
        historyRellax.destroy();
    };

    var refreshRellaxEntities = function () {
        lineupRellax.refresh();
        placeRellax.refresh();
        historyRellax.refresh();
    };

    if ($(window).width() <= 1024 ) {
        destroyRellaxEntities();
    } else {
        refreshRellaxEntities()
    }

    $(window).resize(function() {

        if ($(window).width() <= 1024 ) {
            destroyRellaxEntities();
        } else {
            refreshRellaxEntities();
        }
    })

});