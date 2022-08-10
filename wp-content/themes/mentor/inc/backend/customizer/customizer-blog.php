<?php
function blog_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'mentor',
	);

	$panels = array(	
	    'blog'        => array(
			'title'      => esc_html__( 'Blog', 'mentor' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
	);

	$sections = array(
		'blog_page'           => array(
			'title'       => esc_html__( 'Blog Page', 'mentor' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
        'single_post'           => array(
			'title'       => esc_html__( 'Single Post', 'mentor' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
	);

	$fields = array(
		/* blog settings */
		'blog_layout'           => array(
			'type'        => 'radio-image',
			'label'       => esc_html__( 'Blog Layout', 'mentor' ),
			'section'     => 'blog_page',
			'default'     => 'content-sidebar',
			'priority'    => 7,
			'description' => esc_html__( 'Select default sidebar for the blog page.', 'mentor' ),
			'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
		),	
		'post_entry_meta'              => array(
            'type'     => 'multicheck',
            'label'    => esc_html__( 'Entry Meta', 'mentor' ),
            'section'  => 'blog_page',
            'default'  => array( 'cats', 'date', 'author' ),
            'choices'  => array(
                'cats'    => esc_html__( 'Categories', 'mentor' ),
                'date'    => esc_html__( 'Date', 'mentor' ),
                'author'  => esc_html__( 'Author', 'mentor' ),
            ),
            'priority' => 10,
        ),
        'blog_read_more'      => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Details Button', 'mentor' ),
			'section'         => 'blog_page',
			'default'         => esc_html__( 'READ MORE', 'mentor' ),
			'priority'        => 11,
		),
        /* single blog */
        'single_post_layout'           => array(
            'type'        => 'radio-image',
            'label'       => esc_html__( 'Layout', 'mentor' ),
            'section'     => 'single_post',
            'default'     => 'content-sidebar',
            'priority'    => 10,
            'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
        ),
        'ptitle_post'               => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Page Title', 'mentor' ),
			'section'         => 'single_post',
			'default'         => esc_html__( 'Blog Single', 'mentor' ),
			'priority'        => 10,
		),

	);

	$settings['panels']   = apply_filters( 'mentor_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'mentor_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'mentor_customize_fields', $fields );

	return $settings;
}

$mentor_customize = new Mentor_Customize( blog_customize_settings() );