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
class Latest_News_V3 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akomo_latest_news_v3';
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
		return esc_html__( 'Latest News V3', 'akomo' );
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
			'latest_news_v3',
			[
				'label' => esc_html__( 'Latest News V3', 'akomo' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label'       => __( 'Sub Title', 'akomo' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Sub title', 'akomo' ),
				'default'     => __( 'Blogs', 'akomo' ),
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
			  'options' => get_blog_categories()
			]
		);
		$this->add_control(
			'btn_title',
			[
				'label'       => __( 'Button Title', 'akomo' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Button Title', 'akomo' ),
				'default'     => __( 'More BLogs', 'akomo' ),
			]
		);
		$this->add_control(
			'btn_link',
				[
				  'label' => __( 'Button Url', 'akomo' ),
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
		
        $paged = get_query_var('paged');
		$paged = akomo_set($_REQUEST, 'paged') ? esc_attr($_REQUEST['paged']) : $paged;

		$this->add_render_attribute( 'wrapper', 'class', 'templatepath-akomo' );
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => akomo_set( $settings, 'query_number' ),
			'orderby'        => akomo_set( $settings, 'query_orderby' ),
			'order'          => akomo_set( $settings, 'query_order' ),
			'paged'         => $paged
		);
		if( akomo_set( $settings, 'query_category' ) ) $args['category_name'] = akomo_set( $settings, 'query_category' );
		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) 
		{ ?>
		
        <!-- News Section -->
        <section class="news-section">
            <div class="auto-container">
                <?php if($settings['subtitle'] || $settings['title']): ?>
                <!-- Sec Title -->
                <div class="sec-title text-center">
                    <?php if($settings['subtitle']): ?><span class="sub-title-three"><?php echo wp_kses( $settings['subtitle'], true );?></span><?php endif; ?>
                    <?php if($settings['title']): ?><h2><?php echo wp_kses( $settings['title'], true );?></h2><?php endif; ?>
                </div>
    			<?php endif; ?>
                <div class="row">
                    <?php 
						while ( $query->have_posts() ) : $query->the_post(); 
					?>
                    <!-- News Block -->
                    <div class="news-block-five col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                	<a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail('akomo_370x250'); ?></a>
                                    <div class="ako-date"><?php echo get_the_date(); ?></div>
                                </figure>
                            </div>
                            <div class="lower-content">
                                <h4><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title(); ?></a></h4>
                                <div class="post-info">
                                    <div class="post-date"><span class="icon flaticon-consulting-message"></span> <?php comments_number( wp_kses(__('0 Comments' , 'akomo'), true), wp_kses(__('1 Comment' , 'akomo'), true), wp_kses(__('% Comments' , 'akomo'), true)); ?></div>
                                    <div class="post-author"><span class="icon flaticon-user-1"></span> <?php the_author(); ?></div>
                                </div>
                                <div class="text"><?php echo akomo_trim(get_the_content(), $settings['text_limit']); ?></div>
                                <a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>" class="read-more"><?php esc_html_e('Read More', 'akomo'); ?></a>
                            </div>
                        </div>
                    </div>
    				<?php endwhile; ?>
                </div>
    			<?php if(($settings['btn_link']['url']) and ($settings['btn_title'])) { ?>
                <div class="btn-box">
                    <a href="<?php echo esc_url($settings['btn_link']['url']);?>" class="theme-btn btn-style-two"><?php echo wp_kses($settings['btn_title'], true);?></a>
                </div>
                <?php } ?>
            </div>
        </section>
        <!--End News Section -->
        
        <?php }
		wp_reset_postdata();
	}

}
