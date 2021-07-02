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
class Video_and_Funfacts extends Widget_Base
{

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'akomo_video_and_funfacts';
    }

    /**
     * Get widget title.
     * Retrieve button widget title.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Video and Funfacts', 'akomo');
    }

    /**
     * Get widget icon.
     * Retrieve button widget icon.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
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
    public function get_categories()
    {
        return [ 'akomo' ];
    }

    /**
     * Register button widget controls.
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'video_and_funfacts',
            [
                'label' => esc_html__('Video and Funfacts', 'akomo'),
            ]
        );
		$this->add_control(
			'bg_title',
			[
				'label'       => __( 'Bg Title', 'akomo' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Bg title', 'akomo' ),
				'default'     => __( 'Experiences', 'akomo' ),
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
		);$this->add_control(
			'sub_title',
			[
				'label'       => __( 'Sub Heading', 'akomo' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Sub Heading', 'akomo' ),
			]
		);
		$this->add_control(
			'text',
			[
				'label'       => __( 'Text', 'akomo' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your text', 'akomo' ),
			]
		);
		$this->add_control(
			'btn_title',
			[
				'label'       => __( 'Button Title', 'akomo' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Button Title', 'akomo' ),
				'default'     => __( 'Contact Us', 'akomo' ),
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
								'default' => esc_html__('', 'manzil')
                			],
							[
                    			'name' => 'counter_stop',
                    			'label' => esc_html__('Contact Stop Value', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
								'default' => esc_html__('', 'manzil')
                			],
							[
                    			'name' => 'plus_sign',
                    			'label' => esc_html__('Alphabet Letter', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
								'default' => esc_html__('', 'manzil')
                			],
							[
                    			'name' => 'title1',
                    			'label' => esc_html__('Title', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
								'default' => esc_html__('', 'manzil')
                			],
            			],
            	    'title_field' => '{{title1}}',
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post'); ?>
        
        
        <!-- Experience Section -->
        <section class="experience-section">
            <div class="auto-container">
                <?php if($settings['bg_title'] || $settings['title']): ?>
                <div class="sec-title text-center">
                    <?php if($settings['bg_title']): ?><span class="float-text"><?php echo wp_kses( $settings['bg_title'], true );?></span><?php endif; ?>
                    <?php if($settings['title']): ?><h2><?php echo wp_kses( $settings['title'], true );?></h2><?php endif; ?>
                </div>
    			<?php endif; ?>
                
                <div class="row">
                    <!-- Content Column -->
                    <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
                        <div class="inner-column">
                            <h3><?php echo wp_kses( $settings['sub_title'], true); ?></h3>
                            <div class="text"><?php echo wp_kses( $settings['text'], true); ?></div>
                            <a href="<?php echo esc_url( $settings['btn_link']['url']); ?>" class="theme-btn btn-style-two"><?php echo wp_kses( $settings['btn_title'], true); ?></a>
    
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
    				<?php if($settings['video_image']['id'] || $settings['video_link']['url']): ?>
                    <!-- Video Column -->
                    <div class="video-column col-lg-6 col-md-12 col-sm-12">
                        <div class="video-box">
                            <?php if($settings['video_image']['id']): ?><figure class="image"><img src="<?php echo esc_url(wp_get_attachment_url( $settings['video_image']['id']));?>" alt="<?php esc_attr_e('Awesome Image', 'akomo'); ?>"></figure><?php endif; ?>
                            <?php if($settings['video_link']['url']): ?><a href="<?php echo esc_url( $settings['video_link']['url'] );?>" class="play-now" data-fancybox="gallery" data-caption=""><i class="icon fa fa-play" aria-hidden="true"></i><span class="ripple"></span></a><?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- End Experience Section -->
		<?php
    }
}
