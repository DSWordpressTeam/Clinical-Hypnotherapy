( function( $ ) {
    'use strict';

    /* rtl check */
	function rtl_owl(){
	if ($('body').hasClass("rtl")) {
		return true;
	} else {
		return false;
	}};

	/* --------------------------------------------------
    * preloader
    * --------------------------------------------------*/
	if ( $('#royal_preloader').length ) {
		var $selector       = $('#royal_preloader'),
			$width          = $selector.data('width'),
			$height         = $selector.data('height'),
			$color          = $selector.data('color'),
			$bgcolor        = $selector.data('bgcolor'),
			$logourl        = $selector.data('url');
		
		Royal_Preloader.config({
			mode           : 'logo',
			logo           : $logourl,
			logo_size      : [$width, $height],
			showProgress   : true,
			showPercentage : true,
			text_colour: $color,
			background:  $bgcolor,
		});        
	};

    /* --------------------------------------------------
    * sticky header
    * --------------------------------------------------*/
	$('.header-static .is-fixed').parent().append('<div class="header-clone"></div>');
	$('.header-clone').height($('#site-header .is-fixed').outerHeight());
	$('.header-static .header-clone').hide();	
	$(window).on("scroll", function(){
		var site_header = $('#site-header').outerHeight() + 1;	
			
		if ($(window).scrollTop() >= site_header) {	    	
			$('.site-header .is-fixed').addClass('is-stuck');	
			$('.header-static .header-clone').show();	
		}else {
			$('.site-header .is-fixed').removeClass('is-stuck');		              
			$('.header-static .header-clone').hide();
		}
	});

    /* --------------------------------------------------
    * mobile menu
    * --------------------------------------------------*/
    $('.mmenu_wrapper li:has(ul)').prepend('<span class="arrow"><i class="fas fa-plus"></i></span>');
    $(".mmenu_wrapper .mobile_mainmenu > li span.arrow").on('click',function() {
        $(this).parent().find("> ul").stop(true, true).slideToggle()
        $(this).toggleClass( "active" ); 
    });
	
	$( "#mmenu_toggle" ).on('click', function() {
		$(this).toggleClass( "active" );
		$(this).parents('.header_mobile').toggleClass( "open" );
		if ($(this).hasClass( "active" )) {
			$('.mobile_nav').stop(true, true).slideDown(100);
		}else{
			$('.mobile_nav').stop(true, true).slideUp(100);
		}		
	});

	/* --------------------------------------------------
    * gallery post
    * --------------------------------------------------*/
	$('.gallery-post').each( function () {
		var selector = $(this);
		selector.owlCarousel({
			rtl: rtl_owl(),
			loop:true,
			margin:0,
			responsiveClass:true,
			items:1,
			dots:true,
			nav:true
		});
	});

	/* --------------------------------------------------
    * popup video
    * --------------------------------------------------*/
  	var video_popup = $('.video-popup');
   	if (video_popup.length > 0 ) {
	   	video_popup.each( function(){
		   	$(this).lightGallery({
			   selector: '.btn-play',
		   	});
	   	});
   	};

    /* --------------------------------------------------
    * back to top
    * --------------------------------------------------*/
    if ($('#back-to-top, #to-top').length) {
	    var scrollTrigger = 500, // px
	        backToTop = function () {
	            var scrollTop = $(window).scrollTop();
	            if (scrollTop > scrollTrigger) {
	                $('#back-to-top').addClass('show');
	            } else {
	                $('#back-to-top').removeClass('show');
	            }
	        };
	    backToTop();
	    $(window).on('scroll', function () {
	        backToTop();
	    });
	    $('#back-to-top, #to-top').on('click', function (e) {
	        e.preventDefault();
	        $('html,body').animate({
	            scrollTop: 0
	        }, 700);
	    });	
	}

} )( jQuery );
