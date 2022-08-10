<?php

function mentor_preloader_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'mentor',
	);

	$panels = array(

	);

	$sections = array(
		'preload_section'     => array(
			'title'       => esc_attr__( 'Preloader', 'mentor' ),
			'description' => '',
			'priority'    => 22,
			'capability'  => 'edit_theme_options',
		),
	);

	$fields = array(	
        /* preloader */
        'preload'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Preloader', 'mentor' ),
            'section'     => 'preload_section',
            'default'     => 1,
            'priority'    => 10,
        ),
        'preload_logo'    => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Logo Preload', 'mentor' ),
            'section'  => 'preload_section',
            'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo.png',
            'priority' => 11,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_width'     => array(
            'type'     => 'slider',
            'label'    => esc_html__( 'Logo Width', 'mentor' ),
            'section'  => 'preload_section',
            'default'  => 151,
            'priority' => 12,
            'choices'   => array(
                'min'  => 0,
                'max'  => 400,
                'step' => 1,
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_height'    => array(
            'type'     => 'slider',
            'label'    => esc_html__( 'Logo Height', 'mentor' ),
            'section'  => 'preload_section',
            'default'  => 67,
            'priority' => 13,
            'choices'   => array(
                'min'  => 0,
                'max'  => 200,
                'step' => 1,
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_text_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Percent Text Color', 'mentor' ),
            'section'  => 'preload_section',
            'default'  => '#000',
            'priority' => 14,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'mentor' ),
            'section'  => 'preload_section',
            'default'  => '#fff',
            'priority' => 15,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_typo' => array(
            'type'        => 'typography',
            'label'       => esc_attr__( 'Percent Preload Font', 'mentor' ),
            'section'     => 'preload_section',
            'default'     => array(
                'font-family'    => 'Lato',
                'variant'        => 'regular',
                'font-size'      => '14px',
                'line-height'    => '40px',
                'letter-spacing' => '2px',
                'subsets'        => array( 'latin-ext' ),                
                'text-transform' => 'none',
                'text-align'     => 'center'
            ),
            'priority'    => 16,
            'output'      => array(
                array(
                    'element' => '#royal_preloader.royal_preloader_logo .royal_preloader_percentage',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
	);

	$settings['panels']   = apply_filters( 'mentor_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'mentor_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'mentor_customize_fields', $fields );

	return $settings;
}

$mentor_customize = new Mentor_Customize( mentor_preloader_customize_settings() );

if( mentor_get_option('preload') != false ){

    function mentor_body_classes( $classes ) {

        $classes[] = 'royal_preloader';

        return $classes;
    }
    add_filter( 'body_class', 'mentor_body_classes' );

    function mentor_preload_body_open_script() {
        echo '<div id="royal_preloader" data-width="'.mentor_get_option('preload_logo_width').'" data-height="'.mentor_get_option('preload_logo_height').'" data-url="'.mentor_get_option('preload_logo').'" data-color="'.mentor_get_option('preload_text_color').'" data-bgcolor="'.mentor_get_option('preload_bgcolor').'"></div>';
        
    }
    add_action( 'wp_body_open', 'mentor_preload_body_open_script' );

    function mentor_preload_scripts() {
        wp_enqueue_style('mentor-preload', get_template_directory_uri().'/css/royal-preload.css');
    }
    add_action( 'wp_enqueue_scripts', 'mentor_preload_scripts' );

}