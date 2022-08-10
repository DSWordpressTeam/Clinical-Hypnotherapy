(function($) {
    "use strict";
  
    /* --------------------------------------------------
    * mobile menu
    * --------------------------------------------------*/
    var mmenuPanel  = function(){
          var element = $('#mmenu-toggle'),
              mmenu   = $('#mmenu-wrapper');
  
          function mmenu_handler() {
              var isActive = !element.hasClass('active');
  
              element.toggleClass('active', isActive);
              mmenu.toggleClass('mmenu-open', isActive);
              $('body').toggleClass('mmenu-active', isActive);
              return false;
          }
  
          $('#mmenu-toggle, .mmenu-close, .mmenu-overlay').on('click', mmenu_handler);
  
          $('.mmenu-wrapper li:has(ul)').prepend('<span class="arrow"><i class="fas fa-chevron-right"></i></span>');
          $(".mmenu-wrapper .mobile_mainmenu > li span.arrow").on('click',function() {
              $(this).parent().find("> ul").stop(true, true).slideToggle()
              $(this).toggleClass( "active" ); 
          });
      };
  
      /**
       * Elementor JS Hooks
       */
      $(window).on("elementor/frontend/init", function () {
  
          /*mmenu*/
          elementorFrontend.hooks.addAction(
              "frontend/element_ready/imenu_mobile.default",
              mmenuPanel
          );
  
    });
  
  })(jQuery);