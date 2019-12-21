$(document).ready(function() {

    if ($('.faq-accordion').length) {

        $('.faq-accordion__button').click(function(evt) {
            evt.preventDefault();

            var $this = $(this);
            var accordion = $(this).parents('.faq-accordion');
            var accordionItem = $this.parent();
            var accordionText = $this.next();

            if (accordionItem.hasClass('faq-accordion__item--active')) {
                accordionItem.removeClass('faq-accordion__item--active');
                $this.next().slideUp(350);
            } else {
                accordion.find('.faq-accordion__item--active').removeClass('faq-accordion__item--active');
                accordion.find('.faq-accordion__text').slideUp(350);
                accordionItem.addClass('faq-accordion__item--active');
                accordionText.slideToggle(350);
            }
        });
    }
});