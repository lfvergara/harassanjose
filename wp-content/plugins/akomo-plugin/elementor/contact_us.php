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
class Contact_Us extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akomo_contact_us';
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
		return esc_html__( 'Contact Us', 'akomo' );
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
			'contact_us',
			[
				'label' => esc_html__( 'Locations', 'akomo' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
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
				'default'     => __( 'Locations', 'akomo' ),
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
			  'contact_info', 
				[
					'type' => Controls_Manager::REPEATER,
					'separator' => 'before',
					'default' =>
						[
							['title1' => esc_html__('AUSTIN', 'akomo')],
							['title1' => esc_html__('BOSTON', 'akomo')],
							['title1' => esc_html__('NEW YORK', 'akomo')],
							['title1' => esc_html__('BALTIMORE', 'akomo')]
						],
					'fields' => 
						[
							[
                    			'name' => 'title1',
                    			'label' => esc_html__('Title', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
								'default' => esc_html__('', 'akomo')
                			],
							[
								'name' => 'address',
								'label' => esc_html__('Address', 'akomo'),
								'type' => Controls_Manager::TEXTAREA,
							],
							[
								'name' => 'email',
								'label' => esc_html__('Email Address', 'akomo'),
								'type' => Controls_Manager::TEXT,
								'label_block' => true,
							],
							[
								'name' => 'phone',
								'label' => esc_html__('Phone Number', 'akomo'),
								'type' => Controls_Manager::TEXT,
								'label_block' => true,
							],
						],
					'title_field' => '{{title1}}',
				 ]
		);
		
		$this->end_controls_section();
		
		//Google Map Code
		$this->start_controls_section(
            'google_map',
            [
                'label' => esc_html__( 'Google Map', 'akomo' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
		$this->add_control(
            'google_map_code',
            [
                'label'       => __( 'Google Map Iframe Code', 'akomo' ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your Google Map Iframe Code', 'akomo' ),
            ]
        );
		$this->end_controls_section();
		
		//Contact Information
		$this->start_controls_section(
            'contact',
            [
                'label' => esc_html__( 'Contact Form', 'akomo' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
		$this->add_control(
			'subtitles',
			[
				'label'       => __( 'Sub Title', 'akomo' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your subtitle', 'akomo' ),
			]
		);
		$this->add_control(
			'titles',
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
            'contact_form_url',
            [
                'label'       => __( 'Contact Form 7 Url', 'akomo' ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your Contact Form 7 Url', 'akomo' ),
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
        
        <!-- Contact Section-->
        <section class="contact-section">
            <div class="auto-container">
                
                <?php if($settings['subtitle'] || $settings['title']): ?>
                <!-- Sec Title -->
                <div class="sec-title text-center">
                    <?php if($settings['subtitle']): ?><span class="sub-title-three"><?php echo wp_kses( $settings['subtitle'], true );?></span><?php endif; ?>
                    <?php if($settings['title']): ?><h2><?php echo wp_kses( $settings['title'], true );?></h2><?php endif; ?>
                </div>
    			<?php endif; ?>
                
                <div class="row">
                    
                    <!--Column-->
                    <div class="info-column col-lg-12 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="row">
								<?php foreach( $settings['contact_info'] as $keys => $item ): ?>
                                <div class="contact-block col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="inner-box">
                                        <h5><?php echo wp_kses($item['title1'], true); ?></h5>
                                        <div class="text">
                                            <ul class="info">
                                                <li><span class="icon flaticon-placeholder-2"></span><?php echo wp_kses( $item['address'], true ); ?></li>
                                                <li><span class="icon flaticon-envelope"></span><a href="mailto:<?php echo esc_url( $item['email'], true ); ?>"><?php echo sanitize_email( $item['email'] ); ?></a></li>
                                                <li><span class="icon flaticon-phone-call"></span><a href="tel:<?php echo $item['phone']; ?>"><?php echo wp_kses( $item['phone'], true ); ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    
                    <!--Column-->
                    <div class="form-column map-column col-lg-12 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="map-outer">
                                <?php echo do_shortcode($settings['google_map_code']);?>
                            </div>
                        </div>
                    </div>
                    
                    <!--Column-->
                    <div class="form-column col-lg-12 col-md-12 col-sm-12">
                        <?php if($settings['subtitles'] || $settings['titles']): ?>
                        <!-- Sec Title -->
                        <div class="sec-title text-center">
                            <?php if($settings['subtitles']): ?><span class="sub-title-three"><?php echo wp_kses( $settings['subtitles'], true );?></span><?php endif; ?>
                            <?php if($settings['titles']): ?><h2><?php echo wp_kses( $settings['titles'], true );?></h2><?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <div class="inner-column">
                            <!-- Contact Form -->
                            <div class="contact-form">
                                <?php echo do_shortcode($settings['contact_form_url']);?>
                            </div>
                            <!--End Contact Form -->
    					</div>
                    </div>
    
                </div>
            </div>
        </section>
        <!--End Services Section-->
           
		<?php 
	}

}