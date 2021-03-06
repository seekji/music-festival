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
    var headerRellax = new Rellax('.page-header__logo', {
        speed: 2,
    });

    var startScreenRellax = new Rellax('.start-screen__title', {
        speed: 2,
    });

    var promoRellax = new Rellax('.promo__start-timer', {
        speed: 2,
        wrapper: '.promo',
        relativeToWrapper: true,
    });

    var partnersRellax = Rellax('.partners__title', {
        speed: 1,
        wrapper: '.page-footer',
        relativeToWrapper: true,
    });

    var lineupRellax = new Rellax('#lineup .buy-tickets__link', {
        speed: 0.1,
        wrapper: '.lineup__buy-tickets',
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

    var destroyRellax = function (selector, functionName) {
        if ($(selector).length) {
            functionName.destroy();
        }
    };

    var refreshRellax = function (selector, functionName) {
        if ($(selector).length) {
            functionName.refresh();
        }
    };

    var destroyRellaxEntities = function () {
        destroyRellax('.page-header__logo', headerRellax);
        destroyRellax('.start-screen__title', startScreenRellax);
        destroyRellax('.promo__start-timer', promoRellax);
        destroyRellax('#lineup .buy-tickets__link', lineupRellax);
        destroyRellax('.partners__title', partnersRellax);
        destroyRellax('.place__content', placeRellax);
        destroyRellax('.short-history__top-block', historyRellax);
    };

    var refreshRellaxEntities = function () {
        refreshRellax('.page-header__logo', headerRellax);
        refreshRellax('.start-screen__title', startScreenRellax);
        refreshRellax('.promo__start-timer', promoRellax);
        refreshRellax('#lineup .buy-tickets__link', lineupRellax);
        refreshRellax('.partners__title', partnersRellax);
        refreshRellax('.place__content', placeRellax);
        refreshRellax('.short-history__top-block', historyRellax);
    };

    if ($(window).width() <= 1023 ) {
        destroyRellaxEntities();
    } else {
        refreshRellaxEntities()
    }

    $(window).resize(function() {

        if ($(window).width() <= 1023 ) {
            destroyRellaxEntities();
        } else {
            refreshRellaxEntities();
        }
    })
});