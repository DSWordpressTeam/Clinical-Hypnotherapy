( function( $ ) {
    'use strict';

    /* rtl check */
	function rtl_owl(){
	if ($('body').hasClass("rtl")) {
		return true;
	} else {
		return false;
	}};
    
    function rtl_isotop(){
    if ($('body').hasClass("rtl")) {
        return false;
    } else {
        return true;
    }};

    /* --------------------------------------------------
    * testimonials
    * --------------------------------------------------*/
    var testiGrid = function () {
        $('.ot-testimonials').each( function(){
            var $testi = $(this); 
            $testi.imagesLoaded(function(){
                $testi.isotope({ 
                    itemSelector : '.item', 
                    isOriginLeft: rtl_isotop(),
                });
            });
        });
    };
    
    /* --------------------------------------------------
     * counter
     * --------------------------------------------------*/
    var iCounter = function () {
        $('.icounter[data-counter]').each( function () {
            var scrollTop   = $(document).scrollTop() + $(window).height();
            var counter     = $(this).find('span.num'),
                countTo     = counter.attr('data-to'),
                during      = parseInt( counter.attr('data-time') );

            if ( scrollTop > counter.offset().top + counter.height() ) {
                $(this).removeAttr('data-counter');
                $({
                    countNum: counter.text()
                }).animate({
                    countNum: countTo
                },
                {
                    duration: during,
                    easing: 'swing',
                    step: function() {
                        counter.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        counter.text(this.countNum);
                    }
                });
            }
        });
    };

    /* --------------------------------------------------
    * handle after scroll/load/resize
    * --------------------------------------------------*/
    $(window).on('scroll', function() {
        iCounter();
    });

    $(window).on('load', function () {
        iCounter();
    });

    /**
     * Elementor JS Hooks
     */
    $(window).on("elementor/frontend/init", function () {

        /*testimonials*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/itestimonials.default",
            testiGrid
        );
        /* counter */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/icounter.default",
            iCounter
        );

    });

} )( jQuery );