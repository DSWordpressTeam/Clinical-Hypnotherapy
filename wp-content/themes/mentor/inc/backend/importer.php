<?php
/**
 * Hooks for importer
 *
 * @package Mentor
 */


/**
 * Importer the demo content
 *
 * @since  1.0
 *
 */
function mentor_importer() {
	return array(
		array(
			'name'       => 'Home',
			'preview'    => get_template_directory_uri().'/inc/backend/data/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
	);
}

add_filter( 'soo_demo_packages', 'mentor_importer', 30 );