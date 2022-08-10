<?php

//Admin Style
if ( ! function_exists( 'mentor_custom_wp_admin_style' ) ) :
    function mentor_custom_wp_admin_style() {
        wp_register_style( 'mentor_custom_wp_admin_css', get_template_directory_uri() . '/inc/backend/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'mentor_custom_wp_admin_css' );
    }
    add_action( 'admin_enqueue_scripts', 'mentor_custom_wp_admin_style' );
endif;

//Upload SVG file
function mentor_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'mentor_mime_types', 10, 1);