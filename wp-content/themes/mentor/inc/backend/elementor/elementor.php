<?php
// Load the theme's custom Widgets so that they appear in the Elementor element panel.
add_action( 'elementor/widgets/widgets_registered', 'mentor_register_elementor_widgets' );
function mentor_register_elementor_widgets() {

    require_once( get_template_directory() . '/inc/backend/elementor/widgets/widgets.php' );
    require_once( get_template_directory() . '/inc/backend/elementor/widgets/header/widgets.php' );

}

// Add a custom 'category_mentor' category for to the Elementor element panel so that our theme's widgets have their own category.
add_action( 'elementor/init', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_mentor',
        [
            'title' => __( 'Mentor', 'mentor' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        1 // position
    );
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_mentor_header',
        [
            'title' => __( 'OT Header', 'mentor' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        2 // position
    );
});

// Post types with Elementor
function mentor_add_cpt_support() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'ot_portfolio', 'ot_header_builders', 'ot_footer_builders' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    
    //if it DOES exist, but portfolio is NOT defined
    else {
        $ot_portfolio       = in_array( 'ot_portfolio', $cpt_support );
        $ot_header_builders = in_array( 'ot_header_builders', $cpt_support );
        $ot_footer_builders = in_array( 'ot_footer_builders', $cpt_support );
        if( !$ot_portfolio ){
            $cpt_support[] = 'ot_portfolio'; //append to array
        }
        if( !$ot_header_builders ){
            $cpt_support[] = 'ot_header_builders'; //append to array
        }
        if( !$ot_footer_builders ){
            $cpt_support[] = 'ot_footer_builders'; //append to array
        }
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    
    //otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action( 'elementor/init', 'mentor_add_cpt_support' );

// Upload SVG for Elementor
function mentor_unfiltered_files_upload() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_unfiltered_files_upload' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = '1'; //create string value default to enable upload svg
        update_option( 'elementor_unfiltered_files_upload', $cpt_support ); //write it to the database
    }
}
add_action( 'elementor/init', 'mentor_unfiltered_files_upload' );

// Header post type
add_action( 'init', 'mentor_create_header_builder' ); 
function mentor_create_header_builder() {
    register_post_type( 'ot_header_builders',
        array(
            'labels' => array(
                'name'              => esc_html__( 'Header Builders', 'mentor' ),
                'singular_name'     => esc_html__( 'Header Builder', 'mentor' ),
                'add_new'           => esc_html__( 'Add New', 'mentor' ),
                'add_new_item'      => esc_html__( 'Add New Header Builder', 'mentor' ),
                'edit'              => esc_html__( 'Edit', 'mentor' ),
                'edit_item'         => esc_html__( 'Edit Header Builder', 'mentor' ),
                'new_item'          => esc_html__( 'New Header Builder', 'mentor' ),
                'view'              => esc_html__( 'View', 'mentor' ),
                'view_item'         => esc_html__( 'View Header Builder', 'mentor' ),
                'search_items'      => esc_html__( 'Search Header Builders', 'mentor' ),
                'not_found'         => esc_html__( 'No Header Builders found', 'mentor' ),
                'not_found_in_trash'=> esc_html__( 'No Header Builders found in Trash', 'mentor' ),
                'parent'            => esc_html__( 'Parent Header Builder', 'mentor' )
            ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'menu_position'         => 60,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'             => 'dashicons-editor-kitchensink',
            'publicly_queryable'    => true,
            'exclude_from_search'   => false,
            'has_archive'           => true,
            'query_var'             => true,
            'can_export'            => true,
            'capability_type'       => 'post'
        )
    );
}

// Footer post type
add_action( 'init', 'mentor_create_footer_builder' ); 
function mentor_create_footer_builder() {
    register_post_type( 'ot_footer_builders',
        array(
            'labels' => array(
                'name'              => esc_html__( 'Footer Builders', 'mentor' ),
                'singular_name'     => esc_html__( 'Footer Builder', 'mentor' ),
                'add_new'           => esc_html__( 'Add New', 'mentor' ),
                'add_new_item'      => esc_html__( 'Add New Footer Builder', 'mentor' ),
                'edit'              => esc_html__( 'Edit', 'mentor' ),
                'edit_item'         => esc_html__( 'Edit Footer Builder', 'mentor' ),
                'new_item'          => esc_html__( 'New Footer Builder', 'mentor' ),
                'view'              => esc_html__( 'View', 'mentor' ),
                'view_item'         => esc_html__( 'View Footer Builder', 'mentor' ),
                'search_items'      => esc_html__( 'Search Footer Builders', 'mentor' ),
                'not_found'         => esc_html__( 'No Footer Builders found', 'mentor' ),
                'not_found_in_trash'=> esc_html__( 'No Footer Builders found in Trash', 'mentor' ),
                'parent'            => esc_html__( 'Parent Footer Builder', 'mentor' )
            ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'menu_position'         => 60,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'             => 'dashicons-editor-kitchensink',
            'publicly_queryable'    => true,
            'exclude_from_search'   => false,
            'has_archive'           => true,
            'query_var'             => true,
            'can_export'            => true,
            'capability_type'       => 'post'
        )
    );
}

/*Fix Elementor Pro*/
function mentor_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'mentor_register_elementor_locations' );

/*** add options to sections ***/
add_action('elementor/element/section/section_structure/after_section_end', function( $section, $args ) {

    /* header options */
    $section->start_controls_section(
        'section_custom_class',
        [
            'label' => __( 'For Header', 'mentor' ),
            'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $section->add_control(
        'sticky_class',
        [
            'label'        => __( 'Sticky On/Off', 'mentor' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'is-fixed',
            'prefix_class' => '',
        ]
    );
    $section->add_control(
        'sticky_background',
        [
            'label'     => __( 'Background Scroll', 'mentor' ),
            'type'      => Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}.is-stuck' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]
    );
    $section->add_responsive_control(
        'offset_space',
        [
            'label' => __( 'Offset', 'mentor' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}.is-stuck' => 'top: {{SIZE}}{{UNIT}};',
                '.admin-bar {{WRAPPER}}.is-stuck' => 'top: calc({{SIZE}}{{UNIT}} + 32px);',
            ],
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]
    );

    $section->end_controls_section();

}, 10, 2 );

/*** add options to columns ***/
if ( did_action( 'elementor/loaded' ) ) {
    require get_template_directory() . '/inc/backend/elementor/column.php';
}