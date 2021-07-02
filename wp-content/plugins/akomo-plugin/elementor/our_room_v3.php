<?php

namespace AKOMOPLUGIN\Element;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Our_Room_V3 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akomo_our_room_v3';
	}

	/**
	 * Get widget title.
	 * Retrieve button widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Our Room V3', 'akomo' );
	}

	/**
	 * Get widget icon.
	 * Retrieve button widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-briefcase';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the button widget belongs to.
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'akomo' ];
	}
	
	/**
	 * Register button widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'our_room_v3',
			[
				'label' => esc_html__( 'Our Room V3', 'akomo' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label'       => __( 'Sub Title', 'akomo' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Sub Title', 'akomo' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => __( 'title', 'akomo' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Title', 'akomo' ),
			]
		);
		$this->add_control(
              'room_tab', 
			  	[
            		'type' => Controls_Manager::REPEATER,
            		'separator' => 'before',
					'default' => 
						[
                			['tab_btn_title' => esc_html__('Deluxe', 'akomo')],
                			['tab_btn_title' => esc_html__('Luxury', 'akomo')],
							['tab_btn_title' => esc_html__('Queen', 'akomo')],
							['tab_btn_title' => esc_html__('Single', 'akomo')],
							['tab_btn_title' => esc_html__('Suites', 'akomo')]
            			],
            		'fields' => 
						[
                			[
                    			'name' => 'tab_btn_title',
                    			'label' => esc_html__('Tab Button Title', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
                    			'default' => esc_html__('', 'akomo')
                			],
							[
								'name' => 'query_number',
								'label'   => esc_html__( 'Number of post', 'akomo' ),
								'type'    => Controls_Manager::NUMBER,
								'default' => 3,
								'min'     => 1,
								'max'     => 100,
								'step'    => 1,
							],
							[
								'name' => 'query_orderby',
								'label'   => esc_html__( 'Order By', 'akomo' ),
								'label_block' => true,
								'type'    => Controls_Manager::SELECT,
								'default' => 'date',
								'options' => array(
									'date'       => esc_html__( 'Date', 'akomo' ),
									'title'      => esc_html__( 'Title', 'akomo' ),
									'menu_order' => esc_html__( 'Menu Order', 'akomo' ),
									'rand'       => esc_html__( 'Random', 'akomo' ),
								),
							],
							[
								'name' => 'query_order',
								'label'   => esc_html__( 'Order', 'akomo' ),
								'label_block' => true,
								'type'    => Controls_Manager::SELECT,
								'default' => 'DESC',
								'options' => array(
									'DESC' => esc_html__( 'DESC', 'akomo' ),
									'ASC'  => esc_html__( 'ASC', 'akomo' ),
								),
							],
							[
							  'name' => 'query_category',
							  'type' => Controls_Manager::SELECT,
							  'label' => esc_html__('Category', 'akomo'),
							  'label_block' => true,
							  'options' => get_hb_room_categories()
							],
						],
					'title_field' => '{{tab_btn_title}}',
                 ]
        );
		$this->end_controls_section();
	}

	/**
	 * Render button widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	 protected function render() {
		$settings = $this->get_settings_for_display();
		
		?>
		
        <!-- Rooms Section Four -->
        <section class="rooms-section-four">
            <div class="auto-container">
                <?php if($settings['subtitle'] || $settings['title']) {?>
                <!-- Sec Title -->
                <div class="sec-title text-center">
                    <?php if($settings['subtitle']) { ?><span class="sub-title-three"><?php echo wp_kses( $settings['subtitle'], true );?></span><?php } ?>
                    <?php if($settings['title']) { ?><h2><?php echo wp_kses( $settings['title'], true );?></h2><?php } ?>
                </div>
    			<?php } ?>
    
                <div class="content-box">
                    <!--Porfolio Tabs-->
                    <div class="room-tabs">
    
                        <ul class="room-tab-btns clearfix">
                            <?php $count = 1; foreach($settings['room_tab'] as $key => $item):?>
                            <li class="tab-btn <?php if($count == 2) echo 'active-btn';?>" data-tab="#room-tab-<?php echo esc_attr($count);?>"><?php echo wp_kses($item['tab_btn_title'], true);?></li>
                            <?php $count++; endforeach; ?>
                        </ul>
                        
                        <!--Tabs Content-->  
                        <div class="tabs-content">
							<?php $count = 1; foreach($settings['room_tab'] as $keys => $item):
                                                        
                                $paged = akomo_set($_POST, 'paged') ? esc_attr($_POST['paged']) : 1;
								
                                $this->add_render_attribute( 'wrapper', 'class', 'templatepath-akomo' );
                                $args = array(
                                    'post_type'      => 'hb_room',
                                    'posts_per_page' => akomo_set( $item, 'query_number' ),
                                    'orderby'        => akomo_set( $item, 'query_orderby' ),
                                    'order'          => akomo_set( $item, 'query_order' ),
                                    'paged'         => $paged
                                );
                                if( akomo_set( $item, 'query_category' ) ) $args['hb_room_type'] = akomo_set( $item, 'query_category' );
								$query = new \WP_Query( $args );
                                if ( $query->have_posts()):	
                            ?>
                            <!--Portfolio Tab / Active Tab-->
                            <div class="room-tab <?php if($count == 2) echo 'active-tab';?>" id="room-tab-<?php echo esc_attr($count);?>">
                                <div class="carouse-outer">
                                    <div class="rooms-carousel-two owl-carousel owl-theme default-dots">
                                        <?php 
											while ( $query->have_posts() ) : $query->the_post();
										?>
                                        <!-- Room Block -->
                                        <div class="room-block-three">
                                            <div class="inner-box">
                                                <figure class="image"><?php the_post_thumbnail('akomo_400x600'); ?></figure>
                                                <?php echo hotel_booking_loop_room_price(); ?>
                                                <div class="overlay-cotnent">
                                                    <div class="rating">
                                                        <?php
															$ratting = get_post_meta( get_the_id(), 'room_rating', true );
															for ($x = 1; $x <= 5; $x++) {
																if($x <= $ratting) echo '<i class="fa fa-star"></i>'; else echo '<i class="fa fa-star-half-alt"></i>'; 
															}
														?>
                                                    </div>
                                                    <h5><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title(); ?></a></h5>
                                                    <a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="theme-btn btn-style-two"><?php esc_html_e('Book Now', 'akomo'); ?></a>
                                                </div>
                                            </div>
                                        </div>
    									<?php  endwhile;?>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
							<?php $count++; endforeach;?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Rooms Section Four -->
                
		<?php 
	}

}
