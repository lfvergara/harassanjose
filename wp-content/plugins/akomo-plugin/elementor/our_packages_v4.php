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
class Our_Packages_V4 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akomo_our_packages_v4';
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
		return esc_html__( 'Our Packages V4', 'akomo' );
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
			'our_packages_v4',
			[
				'label' => esc_html__( 'Our Packages V4', 'akomo' ),
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
		$this->add_control(
            'video_image',
            [
			    'label' => __('Video Image', 'akomo'),
			    'type' => Controls_Manager::MEDIA,
			    'default' => ['url' => Utils::get_placeholder_image_src(),],
			]
        );
		$this->add_control(
			'video_link',
				[
				  'label' => __( 'Video Url', 'akomo' ),
				  'type' => Controls_Manager::URL,
				  'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				  'show_external' => true,
				  'default' => [
				    'url' => '',
				    'is_external' => true,
				    'nofollow' => true,
				  ],
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
		
        $paged = akomo_set($_POST, 'paged') ? esc_attr($_POST['paged']) : 1;

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
		
        <!-- Packages Section -->
        <section class="packages-section">
            <div class="auto-container">
                <?php if($settings['subtitle'] || $settings['title']) {?>
                <div class="sec-title text-center light">
                    <?php if($settings['subtitle']) { ?><span class="sub-title"><?php echo wp_kses( $settings['subtitle'], true );?></span><?php } ?>
                    <?php if($settings['title']) { ?><h2><?php echo wp_kses( $settings['title'], true );?></h2><?php } ?>
                </div>
    			<?php } ?>
    
                <div class="packages-carousel-two owl-carousel owl-theme">
                    <?php 
						while ( $query->have_posts() ) : $query->the_post(); 
					?>
                    <!-- Package Block -->
                    <div class="package-block">
                        <div class="inner-box">
                            <figure class="image"><?php the_post_thumbnail( 'full' );?></figure>
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
                                <?php echo hotel_booking_loop_room_price(); ?>
                                <div class="room-feature">
                                    <span class="icon flaticon-wifi"></span>
                                    <a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="theme-btn btn-style-two"><?php esc_html_e('Book Now', 'akomo'); ?></a>
                                    <span class="icon flaticon-television"></span>
                                </div>
                            </div>
                        </div>
                    </div>
    				<?php endwhile;?>
                </div>
            </div>
    		<?php if($settings['video_image']['id'] || $settings['video_link']['url']){ ?>
            <div class="video-box-outer">
                <div class="video-box">
                    <?php if($settings['video_image']['id']): ?><figure class="image"><img src="<?php echo esc_url(wp_get_attachment_url( $settings['video_image']['id']));?>" alt="<?php esc_attr_e('Awesome Image', 'akomo'); ?>"></figure><?php endif; ?>
                    <?php if($settings['video_link']['url']): ?><a href="<?php echo esc_url( $settings['video_link']['url'] );?>" class="play-now" data-fancybox="gallery" data-caption=""><i class="icon fa fa-play" aria-hidden="true"></i><span class="ripple"></span></a><?php endif; ?>
                </div>
            </div>
            <?php } ?>
        </section>
        <!-- End Packages Section -->
                        
        <?php }
		wp_reset_postdata();
	}
}