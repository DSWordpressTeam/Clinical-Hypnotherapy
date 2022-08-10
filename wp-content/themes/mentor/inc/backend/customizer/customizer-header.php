<?php
function header_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'mentor',
	);

	$sections = array(
        'main_header'     => array(
            'title'       => esc_html__( 'Header', 'mentor' ),
            'description' => '',
            'priority'    => 8,
            'capability'  => 'edit_theme_options',
        ),
	);

	$fields = array(
		/* header settings */
		'header_layout'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Desktop', 'mentor' ), 
	 		'description' => esc_attr__( 'Choose the header on desktop.', 'mentor' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 3,
	 		'placeholder' => esc_attr__( 'Select a header', 'mentor' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
		),
		'header_fixed'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Transparent?', 'mentor' ),
	 		'description' => esc_attr__( 'Enable when your header is transparent.', 'mentor' ), 
            'section'     => 'main_header',
			'default'     => '1',
			'priority'    => 4,
        ),
        'header_mobile'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Mobile', 'mentor' ), 
	 		'description' => esc_attr__( 'Choose the header on mobile.', 'mentor' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 5,
	 		'placeholder' => esc_attr__( 'Select a header', 'mentor' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
        ),
		
	);

	$settings['sections'] = apply_filters( 'mentor_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'mentor_customize_fields', $fields );

	return $settings;
}

$mentor_customize = new Mentor_Customize( header_customize_settings() );