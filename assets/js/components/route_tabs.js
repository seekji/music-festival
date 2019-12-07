/* global document window history location Element */

document.addEventListener('DOMContentLoaded', function () {

    if (location.hash) {
        showTab(location.hash);
    }

    document.addEventListener('click', function (event) {
        if (event.target.dataset.toggle === 'tab') {
            event.preventDefault();
            var target = event.target.hash === undefined ? event.target.dataset.target : event.target.hash;
            if (target !== undefined) {
                showTab(target);
                if (history && history.pushState && history.replaceState) {
                    var stateObject = {'url': target};
                    if (window.location.hash && stateObject.url !== window.location.hash) {
                        window.history.pushState(stateObject, document.title, window.location.pathname + target);
                    } else {
                        window.history.replaceState(stateObject, document.title, window.location.pathname + target);
                    }
                }
            }
        }
    });

    /**
     * @param  {string} tabId ID
     */
    function showTab(tabId) {
        var element = document.querySelector(tabId);
        if (element && element.classList.contains('route__content-item')) {
            var tabsParent = document.querySelector('[href="' + tabId + '"]').closest('.route');
            var activeTabClassName = 'route__link-wrap--active';
            var activeTabContentClassName = 'route__content-item--active';
            // tab
            tabsParent.querySelector('.' + activeTabClassName).classList.remove(activeTabClassName);
            var activeTab = tabsParent.querySelector('[href="' + tabId + '"]') ? tabsParent.querySelector('[href="' + tabId + '"]') : tabsParent.querySelector('[data-target="' + tabId + '"]')
            activeTab.closest('.route__link-wrap').classList.add(activeTabClassName);
            // tab content
            var tabsItems = tabsParent.querySelector('.route__tabs-content').children;
            [].forEach.call( tabsItems, function(item) {
                item.classList.remove(activeTabContentClassName);
            });
            tabsParent.querySelector(tabId).classList.add(activeTabContentClassName);
        }
    }

    (function (e) {
        e.closest = e.closest || function (css) {
            var node = this;
            while (node) {
                if (node.matches(css)) return node;
                else node = node.parentElement;
            }
            return null;
        }
    })(Element.prototype);
});