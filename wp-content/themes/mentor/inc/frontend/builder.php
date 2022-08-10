<?php
/** header desktop **/
if ( ! function_exists( 'mentor_header_builder' ) ) {
    function mentor_header_builder (){
        $header_builder = '';    

        if ( is_page() ) {
            if ( function_exists('rwmb_meta') ) {
                global $wp_query;
                $metabox_fb = rwmb_meta( 'select_header', 'field_type=select_advanced', $wp_query->get_queried_object_id() ); 
                if ($metabox_fb != '') {
                    $header_builder = $metabox_fb;
                }else{
                    $header_builder = mentor_get_option('header_layout');
                }
            } 
        }else{
            $header_builder = mentor_get_option('header_layout');
        }

        if( !$header_builder ) {
            get_template_part('inc/frontend/header/header-default');
        }else{
            echo '<div class="header-desktop">';
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $header_builder ); 
            }
            echo '</div>';
        }
    }
}

/** header mobile **/
if ( ! function_exists( 'mentor_mobile_builder' ) ) {
    function mentor_mobile_builder (){
        
        if ( is_page() ) {
            if ( function_exists('rwmb_meta') ) {
                global $wp_query;
                $metabox_hmb = rwmb_meta( 'select_header_mobile', 'field_type=select_advanced', $wp_query->get_queried_object_id() ); 
                if ($metabox_hmb != '') {
                    $mobile_builder = $metabox_hmb;
                }else{
                    $mobile_builder = mentor_get_option('header_mobile');
                }
            } 
        }else{
            $mobile_builder = mentor_get_option('header_mobile');
        }

        if( !$mobile_builder ) {
            get_template_part('inc/frontend/header/header-mobile');
        }else{
            echo '<div class="header-mobile">';
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $mobile_builder ); 
            }
            echo '</div>';
        }
    }
}

/** 404 template **/
if ( ! function_exists( 'mentor_404_builder' ) ) {
    function mentor_404_builder (){

        $error_builder = mentor_get_option('page_404');

        if( !$error_builder ) { ?>
            <div class="error-404 not-found text-center">
                <div class="container">
                    <h2><?php esc_html_e( 'Oops! That page can’t be found.', 'mentor' ); ?></h2>
                    <div class="page-content">
                        <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'mentor' ); ?></p>
                        <?php get_search_form(); ?>
                        <a class="octf-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'take me home', 'mentor' ); ?></a>
                    </div>
                </div>
            </div>
        <?php }else{
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $error_builder ); 
            }
        }
    }
}

/** footer **/
if ( ! function_exists( 'mentor_footer_builder' ) ) {
    function mentor_footer_builder (){
        $footer_builder = '';    

        if ( is_page() ) {
            if ( function_exists('rwmb_meta') ) {
                global $wp_query;
                $metabox_fb = rwmb_meta( 'select_footer', 'field_type=select_advanced', $wp_query->get_queried_object_id() ); 
                if ($metabox_fb != '') {
                    $footer_builder = $metabox_fb;
                }else{
                    $footer_builder = mentor_get_option('footer_layout');
                }
            } 
        }else{
            $footer_builder = mentor_get_option('footer_layout');
        }

        if( !$footer_builder ) {
            return;
        }else{
            echo '<footer id="site-footer" class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">';
            if ( did_action( 'elementor/loaded' ) ) {               
                echo \Elementor\Plugin::$instance->frontend->get_builder_content( $footer_builder ); 
            }
            echo '</footer>';
        }
    }
}