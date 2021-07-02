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
class Room_List_View extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akomo_room_list_view';
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
		return esc_html__( 'Room List View', 'akomo' );
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
			'room_list_view',
			[
				'label' => esc_html__( 'Room List View', 'akomo' ),
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
			'text_limit',
			[
				'label'   => esc_html__( 'Text Limit', 'akomo' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);
		$this->add_control(
			'query_number',
			[
				'label'   => esc_html__( 'Number of post', 'akomo' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);
		$this->add_control(
			'query_orderby',
			[
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
			]
		);
		$this->add_control(
			'query_order',
			[
				'label'   => esc_html__( 'Order', 'akomo' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'DESC' => esc_html__( 'DESC', 'akomo' ),
					'ASC'  => esc_html__( 'ASC', 'akomo' ),
				),
			]
		);
		$this->add_control(
            'query_category', 
			[
			  'type' => Controls_Manager::SELECT,
			  'label' => esc_html__('Category', 'akomo'),
			  'label_block' => true,
			  'options' => get_hb_room_categories()
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
        $allowed_tags = wp_kses_allowed_html('post');
		
        $paged = get_query_var('paged');
		$paged = akomo_set($_REQUEST, 'paged') ? esc_attr($_REQUEST['paged']) : $paged;

		$this->add_render_attribute( 'wrapper', 'class', 'templatepath-akomo' );
		$args = array(
			'post_type'      => 'hb_room',
			'posts_per_page' => akomo_set( $settings, 'query_number' ),
			'orderby'        => akomo_set( $settings, 'query_orderby' ),
			'order'          => akomo_set( $settings, 'query_order' ),
			'paged'         => $paged
		);
		if( akomo_set( $settings, 'query_category' ) ) $args['hb_room_type'] = akomo_set( $settings, 'query_category' );
		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) 
		{ ?>
		
        <!-- Rooms Section -->
        <section class="rooms-section list-view">
            <div class="auto-container">
                <?php if($settings['title']) {?>
                <div class="sec-title text-center">
                    <h2><?php echo wp_kses( $settings['title'], true );?></h2>
                </div>
    			<?php } ?>
                
				<?php 
					while ( $query->have_posts() ) : $query->the_post();
				?>
                <!-- Room Block -->
                <div class="room-block-four">
                    <div class="inner-box">
                        <figure class="image-box"><?php the_post_thumbnail( 'full' );?></figure>
                        <div class="cotnent-box">
                            <div class="upper-box">
                                <div class="rating">
								<?php
                                    $ratting = get_post_meta( get_the_id(), 'room_rating', true );
                                    for ($x = 1; $x <= 5; $x++) {
                                        if($x <= $ratting) echo '<i class="fa fa-star"></i>'; else echo '<i class="fa fa-star-half-alt"></i>'; 
                                    }
                                ?>
                                </div>
                                <?php echo hotel_booking_loop_room_price(); ?>
                            </div>
                            <h5><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title(); ?></a></h5>
                            <div class="text"><?php echo wp_kses( wp_trim_words( get_the_content(), $settings['text_limit'] ), true);?></div>
                            <a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="theme-btn btn-style-two"><?php esc_html_e('Book Now', 'akomo'); ?></a>
                        </div>
                    </div>
                </div>
    			<?php endwhile;?>
    
                <!--Styled Pagination-->
                <div class="styled-pagination text-center">
                    <?php akomo_the_pagination2(array('total'=>$query->max_num_pages, 'next_text' => 'Next <i class="fa fa-angle-double-right"></i> ', 'prev_text' => '<i class="fa fa-angle-double-left"></i> Prev')); ?>
                </div>                
                <!--End Styled Pagination-->
            </div>
        </section>
        <!--End Rooms Section -->
        
        <?php }
		wp_reset_postdata();
	}
}