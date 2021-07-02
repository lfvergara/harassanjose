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
class Our_Service_V1 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akomo_our_service_v1';
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
		return esc_html__( 'Our Service V1', 'akomo' );
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
			'our_service_v1',
			[
				'label' => esc_html__( 'Our Service V1', 'akomo' ),
			]
		);
		$this->add_control(
			'bg_title',
			[
				'label'       => __( 'BG Transparent Title/Sub Title', 'akomo' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your BG Transparent Title', 'akomo' ),
				'default'     => __( 'Services', 'akomo' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'akomo' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'akomo' ),
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
			  'options' => get_service_categories()
			]
		);
		$this->add_control(
            'style_two',
			[
				'label'   => esc_html__( 'Choose Different Style', 'akomo' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT,
				'default' => 'one',
				'options' => array(
					'one' => esc_html__( 'Choose Transparent Title Style', 'akomo' ),
					'two'  => esc_html__( 'Choose visible Title Style', 'akomo' ),
					'three'  => esc_html__( 'Choose Dark Layout Style', 'akomo' ),
				),
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
			'post_type'      => 'service',
			'posts_per_page' => akomo_set( $settings, 'query_number' ),
			'orderby'        => akomo_set( $settings, 'query_orderby' ),
			'order'          => akomo_set( $settings, 'query_order' ),
			'paged'         => $paged
		);
		if( akomo_set( $settings, 'query_category' ) ) $args['service_cat'] = akomo_set( $settings, 'query_category' );
		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) 
		{ ?>
		
        <!-- Services Section -->
        <section class="services-section <?php if($settings['style_two'] == 'three') echo 'style-two'; elseif($settings['style_two'] == 'two') echo 'pt-0'; else echo '';?> ">
            <div class="auto-container">
                <?php if($settings['style_two'] == 'three') : ?>
				
				<?php if($settings['bg_title'] || $settings['title']): ?>
                <div class="sec-title text-center light">
                    <?php if($settings['bg_title']): ?><span class="sub-title-three"><?php echo wp_kses( $settings['bg_title'], true );?></span><?php endif; ?>
                	<?php if($settings['title']): ?><h2><?php echo wp_kses( $settings['title'], true );?></h2><?php endif; ?>
                </div>
    			<?php endif; ?>
				
				<?php elseif($settings['style_two'] == 'two') : ?>
				
				<?php if($settings['bg_title'] || $settings['title']): ?>
                <div class="sec-title text-center">
                    <?php if($settings['bg_title']): ?><span class="sub-title-two"><?php echo wp_kses( $settings['bg_title'], true );?></span><?php endif; ?>
                	<?php if($settings['title']): ?><h2><?php echo wp_kses( $settings['title'], true );?></h2><?php endif; ?>
                </div>
    			<?php endif; ?>
				
				<?php else: ?>
				
				<?php if($settings['bg_title'] || $settings['title']): ?>
                <div class="sec-title text-center">
                    <?php if($settings['bg_title']): ?><span class="float-text"><?php echo wp_kses( $settings['bg_title'], true );?></span><?php endif; ?>
                    <?php if($settings['title']): ?><h2><?php echo wp_kses( $settings['title'], true );?></h2><?php endif; ?>
                </div>
    			<?php endif; endif; ?>
                
                <div class="row">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <!-- Service block -->
                    <div class="service-block col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="<?php echo (get_post_meta(get_the_id(), 'service_icon', true )); ?>"></div>
                            <h4><a href="<?php echo (get_post_meta(get_the_id(), 'ext_url', true)); ?>"><?php the_title(); ?></a></h4>
                            <div class="text"><?php echo wp_kses(akomo_trim(get_the_content(), $settings['text_limit']), true); ?></div>
                        </div>
                    </div>
    				<?php endwhile; ?>
                </div>
            </div>
        </section>
        <!-- End Services Section -->
        
        <?php }
		wp_reset_postdata();
	}

}
