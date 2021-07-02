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
class About_Us_V2 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akomo_about_us_v2';
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
		return esc_html__( 'About Us V2', 'akomo' );
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
			'about_us_v2',
			[
				'label' => esc_html__( 'About Us V2', 'akomo' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label'       => __( 'Sub Title', 'akomo' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Sub Title', 'akomo' ),
				'default'     => __( 'About Us', 'akomo' ),
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
				'placeholder' => __( 'Enter your Title', 'akomo' ),
			]
		);
		$this->add_control(
			'text',
			[
				'label'       => __( 'Description', 'akomo' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Description', 'akomo' ),
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
				'default'     => __( 'About More', 'akomo' ),
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
		$this->add_control(
           'funfact', 
			  	[
            		'type' => Controls_Manager::REPEATER,
            		'separator' => 'before',
            		'default' => 
						[
                			['title1' => esc_html__('Yearly Customers', 'akomo')],
                			['title1' => esc_html__('Marriage Arrange', 'akomo')],
							['title1' => esc_html__('Hotel Rooms', 'akomo')]
            			],
            		'fields' => 
						[
							[
                    			'name' => 'counter_start',
                    			'label' => esc_html__('Contact Start Value', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
                			],
							[
                    			'name' => 'counter_stop',
                    			'label' => esc_html__('Contact Stop Value', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
                			],
							[
                    			'name' => 'plus_sign',
                    			'label' => esc_html__('Alphabet Letter', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
                			],
							[
                    			'name' => 'title1',
                    			'label' => esc_html__('Title', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
                			],
            			],
            	    'title_field' => '{{title1}}',
                 ]
        );
		$this->add_control(
			'about_img1',
			[
			  'label' => __( 'About Image V1', 'akomo' ),
			  'type' => Controls_Manager::MEDIA,
			  'default' => ['url' => Utils::get_placeholder_image_src(),],
			]
	    );
		$this->add_control(
			'about_img2',
			[
			  'label' => __( 'About Image V2', 'akomo' ),
			  'type' => Controls_Manager::MEDIA,
			  'default' => ['url' => Utils::get_placeholder_image_src(),],
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
		?>
        
        <!-- About Section Four -->
        <section class="about-section-four">
            <div class="auto-container">
                <div class="outer-box">
                    <div class="row">
                        <!-- Content Column -->
                        <div class="content-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="sec-title">
                                    <?php if($settings['subtitle']) { ?>
                                    <span class="sub-title-three"><?php echo wp_kses($settings['subtitle'], true);?></span>
                                    <?php } ?>
                                    <?php if($settings['title']) { ?>
                                    <h3><?php echo wp_kses($settings['title'], true);?></h3>
                                    <?php } ?>
									<?php if($settings['text']) { ?>
                                    <div class="text"><?php echo wp_kses($settings['text'], true);?></div>
                                    <?php } ?>
                                    <?php if(($settings['btn_link']['url']) and ($settings['btn_title'])) { ?>
                                    <a href="<?php echo esc_url($settings['btn_link']['url']);?>" class="theme-btn btn-style-two"><?php echo wp_kses($settings['btn_title'], true);?></a>
                                    <?php } ?>
                                    <!-- Fact Section -->
                                    <div class="fact-counter">
                                        <div class="row">
                                            <?php foreach( $settings['funfact'] as $key => $item ): ?>
                                            <!--Column-->
                                            <div class="counter-column col-lg-4 col-md-4 col-sm-12">
                                                <div class="count-box"><span class="count-text" data-speed="3000" data-stop="<?php echo wp_kses($item['counter_stop'], true); ?>"><?php echo wp_kses($item['counter_start'], true); ?></span><?php echo wp_kses($item['plus_sign'], true); ?></div>
                                                <h5 class="counter-title"><?php echo wp_kses($item['title1'], true); ?></h5>
                                            </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    					<?php if($settings['about_img1']['id'] || $settings['about_img2']['id']){ ?>
                        <!-- Image Column -->
                        <div class="image-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <?php if($settings['about_img1']['id']){ ?><figure class="image-1"><img src="<?php echo esc_url(wp_get_attachment_url($settings['about_img1']['id']));?>" alt="<?php esc_attr_e('Awesome Image', 'akomo'); ?>"></figure><?php } ?>
                        		<?php if($settings['about_img2']['id']){ ?><figure class="image-2"><img src="<?php echo esc_url(wp_get_attachment_url($settings['about_img2']['id']));?>" alt="<?php esc_attr_e('Awesome Image', 'akomo'); ?>"></figure><?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section Four -->
                        
		<?php 
	}

}