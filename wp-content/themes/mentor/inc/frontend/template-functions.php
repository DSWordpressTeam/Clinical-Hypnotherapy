<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Mentor
 */

/** Add body class by filter **/
add_filter( 'body_class', 'mentor_body_class_names', 999 );
function mentor_body_class_names( $classes ) {
	
	$theme = wp_get_theme();
	if( is_child_theme() ) { $theme = wp_get_theme()->parent(); }

  	$classes[] = 'mentor-theme-ver-'.$theme->version;

  	$classes[] = 'wordpress-version-'.get_bloginfo( 'version' );

  	return $classes;
}

/**
 *  Add specific CSS class to header
 */
function mentor_header_class() {

	$header_classes = '';

	if ( mentor_get_option('header_fixed') != false ){
		$header_classes = 'header-transparent';
	}else{
		$header_classes = 'header-static';
	}
	if ( function_exists('rwmb_meta') ) {
		if( rwmb_meta('is_trans') == 'yes'){
			$header_classes = 'header-transparent';
		}elseif( rwmb_meta('is_trans') == 'no'){
			$header_classes = 'header-static';
		}
	}
	
    echo $header_classes;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function mentor_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'mentor_pingback_header' );

//Get layout post & page.
if ( ! function_exists( 'mentor_get_layout' ) ) :
	function mentor_get_layout() {
		// Get layout.
		if( is_page() && !is_home() && function_exists( 'rwmb_meta' ) ) {
			$page_layout = rwmb_meta('page_layout');
		}elseif( is_single() ){
			$page_layout = mentor_get_option( 'single_post_layout' );
		}else{
			$page_layout = mentor_get_option( 'blog_layout' );
		}

		return $page_layout;
	}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'mentor_content_columns' ) ) :
	function mentor_content_columns() {

		$blog_content_width = array();

		// Check if layout is one column.
		if ( 'content-sidebar' === mentor_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
		}elseif ('sidebar-content' === mentor_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right';
		}else{
			$blog_content_width[] = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
		}

		// return the $classes array
    	echo implode( ' ', $blog_content_width );
	}
endif;

/**
 * Portfolio Columns
 */
if ( ! function_exists( 'mentor_portfolio_option_class' ) ) :
	function mentor_portfolio_option_class() {

		$portfolio_option_class = array();

		if( mentor_get_option('portfolio_column') == "2cl" ){
			$portfolio_option_class[] = 'pf_2_cols';
		}elseif( mentor_get_option('portfolio_column') == "4cl" ) {
			$portfolio_option_class[] = 'pf_4_cols';
		}elseif( mentor_get_option('portfolio_column') == "5cl" ) {
			$portfolio_option_class[] = 'pf_5_cols';
		}else{
			$portfolio_option_class[] = '';
		}

		if( mentor_get_option('portfolio_style') == "style2" ) {
			$portfolio_option_class[] = 'style-2';
		}elseif( mentor_get_option('portfolio_style') == "style3" ) {
			$portfolio_option_class[] = 'style-3';
		}else{
			$portfolio_option_class[] = 'style-1';
		}

	    // return the $classes array
	    echo implode( ' ', $portfolio_option_class );
	}
endif;

/**
 * Change Posts Per Page for Portfolio Archive.
 * 
 * @param object $query data
 *
 */
function mentor_change_portfolio_posts_per_page( $query ) {
	$portfolio_ppp = (!empty( mentor_get_option('portfolio_posts_per_page') ) ? mentor_get_option('portfolio_posts_per_page') : '6');

	if ( !is_singular() && !is_admin() ) {		
	    if ( $query->is_post_type_archive( 'ot_portfolio' ) || $query->is_tax('portfolio_cat') && ! is_admin() && $query->is_main_query() ) {
	        $query->set( 'posts_per_page', $portfolio_ppp );
	    }
	}
    return $query;
}
add_filter( 'pre_get_posts', 'mentor_change_portfolio_posts_per_page' );

/**
 * Back-To-Top on Footer
 */
if( !function_exists('mentor_custom_back_to_top') ) {
    function mentor_custom_back_to_top() {     
	    if( mentor_get_option('backtotop') != false ){
	    	echo '<a id="back-to-top" href="#" class="show"><i class="arrow_up"></i></a>';
	    }
    }
}
add_action('wp_footer', 'mentor_custom_back_to_top');

/**
 * Google Analytics
 */
if ( ! function_exists( 'mentor_hook_javascript' ) ) {
	function mentor_hook_javascript() {
		if ( mentor_get_option('js_code') != '' ) {
	    ?>
	    	<!-- Google Analytics code -->
	    	<script type="text/javascript">
	            <?php echo mentor_get_option('js_code'); ?>
	        </script>
	    <?php
	    }
	}
}
add_action('wp_head', 'mentor_hook_javascript');