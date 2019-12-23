if ($('#place-map').length) {
    var mapElement = $('#place-map');
    var lat = mapElement.data('lat');
    var lng = mapElement.data('lng');
    var coordinates = [lat, lng];
    var icon = require('../../images/place_map_pin.png');

    var isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    ymaps.ready(function () {
        var placeMap = new ymaps.Map('place-map', {
                center: coordinates,
                zoom: 16
            }),
            placemark = new ymaps.Placemark(placeMap.getCenter(), {}, {
                iconLayout: 'default#image',
                iconImageHref: icon,
                iconImageSize: [47, 65],
                iconImageOffset: [-47, -65]
            });

        placeMap.geoObjects.add(placemark);

        placeMap.behaviors.disable(['scrollZoom']);

        if (isMobile.any()) {
            placeMap.behaviors.disable('drag');
        }
    });
}