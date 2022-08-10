<?php
/**
 * Registering meta boxes
 *
 * Using Meta Box plugin: http://www.deluxeblogtips.com/meta-box/
 *
 * @see https://docs.metabox.io/
 *
 * @param array $meta_boxes Default meta boxes. By default, there are no meta boxes.
 *
 * @return array All registered meta boxes
 */
function mentor_register_meta_boxes( $meta_boxes ) {

	// Page Settings
	$meta_boxes[] = array(
		'id'       => 'page-settings',
		'title'    => esc_html__( 'Page Header Settings', 'mentor' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
            array(
                'id'        			=> 'page_layout',
                'name'      			=> esc_html__( 'Page Layout', 'mentor' ),
                'type'      			=> 'image_select',
                'options'   			=> array(
                    'full-content'    	=> get_template_directory_uri() . '/inc/backend/images/full.png',
                    'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
                    'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
                ),
                'std'       			=> 'full-content'
            ),
            array(
                'name'             => esc_html__( 'Page Header On/Off', 'mentor' ),
                'id'               => 'pheader_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => esc_html__( 'On', 'mentor' ),
                'off_label'        => esc_html__( 'Off', 'mentor' ),
                'std'              => 'on'
            ),
            array(
                'name'             => esc_html__( 'Background Page Header', 'mentor' ),
                'id'               => 'pheader_bg_image',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            )
		),
	);
    
	$meta_boxes[] = array (
      	'id' 			=> 'select-header-footer',
      	'title' 		=> esc_html__( 'Header/Footer Settings', 'mentor' ),
      	'pages' 		=> array ('page'),
      	'context' 		=> 'normal',
      	'priority' 		=> 'high',
      	'autosave' 		=> false,
      	'fields' 		=>   array (  
        	array(
        		'name' 					=> esc_html__( 'Header Layout', 'mentor' ),
				'id' 					=> 'select_header',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_header_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a header', 'mentor' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
			),
			array(
                'name'             		=> esc_html__( 'Header Transparent?', 'mentor' ),
                'id'               		=> 'is_trans',
				'type'             		=> 'select',
				'options'   			=> array(
                    'default'   		=> esc_html__( 'Default', 'mentor' ),
                    'yes' 				=> esc_html__( 'Yes', 'mentor' ),
                    'no' 				=> esc_html__( 'No', 'mentor' ),
                ),
                'std'       			=> 'default'
            ),
			array(
        		'name' 					=> esc_html__( 'Header Mobile Layout', 'mentor' ),
				'id' 					=> 'select_header_mobile',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_header_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a header mobile', 'mentor' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
			),
			array (
        		'name' 					=> esc_html__( 'Footer Layout', 'mentor' ),
				'id' 					=> 'select_footer',
				'type'  				=> 'post',
		    	'post_type'   			=> 'ot_footer_builders',
		    	'field_type'  			=> 'select_advanced',
		    	'placeholder' 			=> esc_html__( 'Select a footer', 'mentor' ),
		    	'query_args'  			=> array(
		        	'post_status'    	=> 'publish',
		        	'posts_per_page' 	=> - 1,
		        	'orderby' 		 	=> 'date',
		        	'order' 		 	=> 'ASC',
		    	),
        	),
      	),
	);

	$meta_boxes[] = array(
		'id'       => 'event_dt',
		'title'    => esc_html__( 'Event Details', 'mentor' ),
		'pages'    => array( 'tribe_events' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(				
			array(
				'name'  => esc_html__( 'Event Excerpt', 'mentor' ),
				'id'    => '_cmb_event_ex',
				'type'  => 'textarea',
				'class' => '',
			),
			array(
				'name'  => esc_html__( 'id', 'mentor' ),
				'id'    => '_cmb_event_id',
				'type'  => 'text',
				'class' => '',
			),				
			array(
				'name'  => esc_html__( 'Label Button', 'mentor' ),
				'id'    => '_cmb_event_btext',
				'type'  => 'text',
				'class' => '',
			),
			array(
				'name'  => esc_html__( 'Button Link', 'mentor' ),
				'id'    => '_cmb_event_blink',
				'type'  => 'text',
				'class' => '',
			),
		),
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'mentor_register_meta_boxes' );
