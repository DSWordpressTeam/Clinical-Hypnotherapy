<?php
/**
 * Theme customizer
 *
 * @package Mentor
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Mentor_Customize {
	/**
	 * Customize settings
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * The class constructor
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$this->register();
	}

	/**
	 * Register settings
	 */
	public function register() {

		/**
		 * Add the theme configuration
		 */
		if ( ! empty( $this->config['theme'] ) ) {
			Kirki::add_config(
				$this->config['theme'], array(
					'capability'  => 'edit_theme_options',
					'option_type' => 'theme_mod',
				)
			);
		}

		/**
		 * Add panels
		 */
		if ( ! empty( $this->config['panels'] ) ) {
			foreach ( $this->config['panels'] as $panel => $settings ) {
				Kirki::add_panel( $panel, $settings );
			}
		}

		/**
		 * Add sections
		 */
		if ( ! empty( $this->config['sections'] ) ) {
			foreach ( $this->config['sections'] as $section => $settings ) {
				Kirki::add_section( $section, $settings );
			}
		}

		/**
		 * Add fields
		 */
		if ( ! empty( $this->config['theme'] ) && ! empty( $this->config['fields'] ) ) {
			foreach ( $this->config['fields'] as $name => $settings ) {
				if ( ! isset( $settings['settings'] ) ) {
					$settings['settings'] = $name;
				}

				Kirki::add_field( $this->config['theme'], $settings );
			}
		}
	}

	/**
	 * Get config ID
	 *
	 * @return string
	 */
	public function get_theme() {
		return $this->config['theme'];
	}

	/**
	 * Get customize setting value
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option( $name ) {

		$default = $this->get_option_default( $name );

		return get_theme_mod( $name, $default );
	}

	/**
	 * Get default option values
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function get_option_default( $name ) {
		if ( ! isset( $this->config['fields'][ $name ] ) ) {
			return false;
		}

		return isset( $this->config['fields'][ $name ]['default'] ) ? $this->config['fields'][ $name ]['default'] : false;
	}
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function mentor_get_option( $name ) {
	global $mentor_customize;

	$value = false;

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( 'mentor', $name );
	} elseif ( ! empty( $mentor_customize ) ) {
		$value = $mentor_customize->get_option( $name );
	}

	return apply_filters( 'mentor_get_option', $value, $name );
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function mentor_get_option_default( $name ) {
	global $mentor_customize;

	if ( empty( $mentor_customize ) ) {
		return false;
	}

	return $mentor_customize->get_option_default( $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function mentor_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'mentor_customize_modify' );


/**
 * Get customize settings
 *
 * Priority (Order) WordPress Live Customizer default: 
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @return array
 */
function mentor_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'mentor',
	);

	$panels = array(
		'general'     => array(
			'priority' => 5,
			'title'    => esc_html__( 'General', 'mentor' ),
		),
	);

	$sections = array(
		/* typography */
		'typography'           => array(
            'title'       => esc_html__( 'Typography', 'mentor' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
        ),
		/* 404 */
		'error_404'       => array(
            'title'       => esc_html__( '404', 'mentor' ),
            'description' => '',
            'priority'    => 11,
            'capability'  => 'edit_theme_options',
        ),
        /* color scheme */
        'color_scheme'   => array(
			'title'      => esc_html__( 'Color Scheme', 'mentor' ),
			'priority'   => 200,
			'capability' => 'edit_theme_options',
		),
		/* js code */
		'script_code'   => array(
			'title'      => esc_html__( 'Google Analytics(Script Code)', 'mentor' ),
			'priority'   => 210,
			'capability' => 'edit_theme_options',
		),
	);

	$fields = array(
		/* typography */
        'typography_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Typography Customize?', 'mentor' ),
            'section'     => 'typography',
            'default'     => 0,
            'priority'    => 1,
        ),
        'body_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body Font', 'mentor' ),
            'section'  => 'typography',
            'priority' => 2,
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => 'regular',
                'font-size'      => '16px',
                'line-height'    => '1.875',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#555555',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'body, p',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading1_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 1', 'mentor' ),
            'section'  => 'typography',
            'priority' => 3,
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => '400',
                'font-size'      => '42px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h1',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading2_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 2', 'mentor' ),
            'section'  => 'typography',
            'priority' => 4,
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => '400',
                'font-size'      => '36px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h2',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading3_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 3', 'mentor' ),
            'section'  => 'typography',
            'priority' => 5,
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => '400',
                'font-size'      => '30px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h3',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading4_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 4', 'mentor' ),
            'section'  => 'typography',
            'priority' => 6,
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => '400',
                'font-size'      => '24px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h4',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading5_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 5', 'mentor' ),
            'section'  => 'typography',
            'priority' => 7,
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => '400',
                'font-size'      => '18px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h5',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading6_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 6', 'mentor' ),
            'section'  => 'typography',
            'priority' => 8,
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => '400',
                'font-size'      => '16px',
                'line-height'    => '1.4',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1a1a',
                'text-transform' => 'h6',
            ),
            'output'      => array(
                array(
                    'element' => 'h6',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

		/* 404 */
		'custom_404'      => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Customize?', 'mentor' ),
            'section'     => 'error_404',
			'default'     => 0,
			'priority'    => 3,
		),
		'page_404'   	  => array(
			'type'        => 'dropdown-pages',  
	 		'label'       => esc_attr__( 'Select Page', 'mentor' ), 
	 		'description' => esc_attr__( 'Choose a template in pages.', 'mentor' ), 
	 		'section'     => 'error_404', 
	 		'default'     => '', 
			 'priority'    => 3,
			 'active_callback' => array(
				array(
					'setting'  => 'custom_404',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		/*color scheme*/
        'bg_body'      => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Body', 'mentor' ),
            'section'  => 'color_scheme',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => 'body, .site-content',
                    'property' => 'background-color',
                ),
            ),
        ),
        'main_color'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Primary Color', 'mentor' ),
            'section'  => 'color_scheme',
            'default'  => '#37b048',
            'priority' => 10,
        ),

        /*google atlantic*/
        'js_code'  => array(
            'type'        => 'code',
            'label'       => esc_html__( 'Code', 'mentor' ),
            'section'     => 'script_code',
            'choices'     => [
				'language' => 'js',
			],
            'priority'    => 3,
        ),
		
	);
	$settings['panels']   = apply_filters( 'mentor_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'mentor_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'mentor_customize_fields', $fields );

	return $settings;
}

$mentor_customize = new Mentor_Customize( mentor_customize_settings() );

require get_template_directory() . '/inc/backend/customizer/customizer-blog.php';
require get_template_directory() . '/inc/backend/customizer/customizer-header.php';
require get_template_directory() . '/inc/backend/customizer/customizer-page-header.php';
require get_template_directory() . '/inc/backend/customizer/customizer-footer.php';
