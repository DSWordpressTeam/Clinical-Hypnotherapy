<?php 

//Custom Style Frontend
if(!function_exists('mentor_color_scheme')){
    function mentor_color_scheme(){
        $color_scheme = '';

        //Main Color
        if( mentor_get_option('main_color') != '#37b048' ){
            $color_scheme = 
            '
        /****Main Color****/

        	/*Background Color*/
            blockquote:before,
            .bg-primary,
            .octf-btn,.octf-btn:visited,
            .octf-btn.octf-btn-light:hover, .octf-btn.octf-btn-light:focus,
            .octf-btn.octf-btn-dark:hover, .octf-btn.octf-btn-dark:focus,
            .octf-btn.octf-btn-border:hover, .octf-btn.octf-btn-border:focus,
            .main-navigation ul li li a:hover,
            .post-box .post-cat a,
            .post-box .entry-meta .posted-in a:hover,
            .page-pagination li span, .page-pagination li a:hover,
            .post-nav a:before,
            .search-form .search-submit,
            .ot-pricing-table.featured .inner-table,
            .ot-step .sbar div,
            #back-to-top,
            .error-404 .page-content form button:hover{background:'.mentor_get_option('main_color').';}

            /*Border Color*/
            .octf-btn.octf-btn-border,
            .post-box .entry-meta .posted-in a,
            .page-pagination li span, .page-pagination li a:hover{border-color:'.mentor_get_option('main_color').';}

            /*Color*/
            h2,
            .text-primary,
            .octf-btn.octf-btn-light,
            .octf-btn.octf-btn-border,
            a:hover, a:focus, a:active,
            .header_mobile .mobile_nav .mobile_mainmenu li li a:hover,.header_mobile .mobile_nav .mobile_mainmenu ul > li > ul > li.current-menu-ancestor > a,
            .header_mobile .mobile_nav .mobile_mainmenu > li > a:hover, .header_mobile .mobile_nav .mobile_mainmenu > li.current-menu-item > a,.header_mobile .mobile_nav .mobile_mainmenu > li.current-menu-ancestor > a,
            .page-header .breadcrumbs li:before,
            .post-box .entry-meta a:hover,
            .post-box .entry-title a,
            .comment-respond .comment-reply-title small a:hover,
            .comment-form .logged-in-as a:hover,
            .ot-icon-box .icon-main i,
            .ot-icon-box .title-box a,
            .ot-pricing-table .details ul li .icon_check,
            .ot-pricing-table.featured .octf-btn:hover,
            .ot-step h3,
            .ot-counter span,
            .workshop-list .workshop .date-info .time i,
            .workshop-list .workshop h4 a,
            .modal.workshop-detail .modal-header .time i,
            div.elementor-widget-heading.elementor-widget-heading .elementor-heading-title{color: '.mentor_get_option('main_color').';}
            .ot-icon-box .icon-main svg{fill: '.mentor_get_option('main_color').';}

			';
        }

        if(! empty($color_scheme)){
			echo '<style type="text/css">'.$color_scheme.'</style>';
		}
    }
}
add_action('wp_head', 'mentor_color_scheme');