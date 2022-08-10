<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Workshops 
 */
class Mentor_Workshops extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iworkshops';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Workshops', 'mentor' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-calendar';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_mentor' ];
	}

	protected function register_controls() {

		//Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'mentor' ),
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'mentor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'mentor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mentor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mentor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'mentor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				// 'prefix_class' => 'mentor%s-align-',
				'selectors' => [
					'{{WRAPPER}} .workshop-list' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_control(
			'column',
			[
				'label' => __( 'Columns', 'mentor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'6'  	=> __( '2 Column', 'mentor' ),
					'4' 	=> __( '3 Column', 'mentor' ),
					'3' 	=> __( '4 Column', 'mentor' ),
				],
			]
		);	
		$this->add_control(
			'ws_num',
			[
				'label' => __( 'Show Number', 'mentor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '6',
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'ws_style_section',
			[
				'label' => __( 'Style', 'mentor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Date
		$this->add_control(
			'date_title',
			[
				'label' => __( 'Date', 'mentor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'date_spacing',
			[
				'label' => __( 'Spacing', 'mentor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .workshop-list .date' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'date_color',
			[
				'label' => __( 'Color', 'mentor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .workshop-list .date' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'selector' => '{{WRAPPER}} .workshop-list .date',
			]
		);

		//Location
		$this->add_control(
			'place_title',
			[
				'label' => __( 'Location', 'mentor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'place_spacing',
			[
				'label' => __( 'Spacing', 'mentor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .workshop-list .place' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'place_color',
			[
				'label' => __( 'Color', 'mentor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .workshop-list .place' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'place_typography',
				'selector' => '{{WRAPPER}} .workshop-list .place',
			]
		);

		//Time
		$this->add_control(
			'time_title',
			[
				'label' => __( 'Time', 'mentor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'time_spacing',
			[
				'label' => __( 'Spacing', 'mentor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .workshop-list .time' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'time_color',
			[
				'label' => __( 'Color', 'mentor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .workshop-list .time' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'time_typography',
				'selector' => '{{WRAPPER}} .workshop-list .time',
			]
		);

		//Title
		$this->add_control(
			'title_title',
			[
				'label' => __( 'Title', 'mentor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Spacing', 'mentor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .workshop-list .workshop h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'mentor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .workshop-list .workshop h4 a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Hover Color', 'mentor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .workshop-list .workshop h4 a:hover' => 'color: {{VALUE}}; opacity: 1;',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .workshop-list .workshop h4',
			]
		);

		//Description
		$this->add_control(
			'des_title',
			[
				'label' => __( 'Description', 'mentor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'des_color',
			[
				'label' => __( 'Color', 'mentor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .workshop-list .workshop p' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .workshop-list .workshop p',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		
		<div class="workshop-list">

	            <?php 

	            $recent = new \WP_Query( array(

	            'post_type' => 'tribe_events', 

	            'posts_per_page' => $settings['ws_num']
	            ) );

	            $i = 1;

	            while ($recent->have_posts()) :$recent-> the_post();

	            $date = tribe_get_start_date( null, false,'d.m.Y' );
	            $starttime = tribe_get_start_time( null, false );
	            $locate = tribe_get_venue();           
	            $starttime = date('H:i', strtotime($starttime));
	            $event_ex = get_post_meta(get_the_ID(),'_cmb_event_ex', true);
            	$event_btext = get_post_meta(get_the_ID(),'_cmb_event_btext', true);
            	$event_blink = get_post_meta(get_the_ID(),'_cmb_event_blink', true);


	            ?>
	            <div class="col-md-<?php echo($settings['column']) ?> col-sm-6">
	                <div class="workshop">
	                <div class="date-info">
	                    <div class="date"><?php echo esc_html($date); ?></div>
	                    <div class="place"><?php echo esc_html($locate); ?></div>
	                    <div class="time"><i class="icon_clock"></i><?php echo esc_html($starttime) ?></div>
	                </div>
	                <h4><a href="#" data-toggle="modal" data-target="#id<?php echo esc_attr($i) ?>"><?php the_title(); ?></a></h4>
	                
	                    <p><?php echo esc_html($event_ex); ?></p>
	                
	                </div>
	            </div>

	            <div class="modal fade workshop-detail" id="id<?php echo esc_attr($i) ?>">
	                <div class="modal-dialog">
	                    <div class="modal-content">
	                        <div class="modal-header">
	                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                            <h2 class="modal-title"><?php the_title(); ?></h2>
	                            <p class="date"><?php echo esc_html($date); ?></p>
	                            <p class="place"><?php echo esc_html($locate); ?></p>
	                            <figure class="time"><i class="icon_clock"></i><?php echo esc_html($starttime) ?></figure>
	                        </div>
	                        <div class="modal-body">
	                            <div class="thumb"><?php the_post_thumbnail(); ?></div>
	                            <?php the_content(); ?>
	                            <div class="clearfix">
	                                <?php if($event_btext != ''){ ?><a href="<?php echo esc_url($event_blink); ?>" class="octf-btn octf-btn-border"><?php echo esc_html($event_btext); ?></a><?php } ?>
	                            </div>
	                        </div><!-- /.modal-body -->
	                    </div><!-- /.modal-content -->
	                </div><!-- /.modal-dialog -->
	            </div>

	            <?php $i++; endwhile; wp_reset_postdata(); ?>
	    </div>

	    <?php
	}

	protected function _content_template() {}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new Mentor_Workshops() );