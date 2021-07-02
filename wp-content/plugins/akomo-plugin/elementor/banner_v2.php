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
class Banner_V2 extends Widget_Base
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
        return 'akomo_banner_v2';
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
        return esc_html__('Banner V2', 'akomo');
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
            'banner_v2',
            [
                'label' => esc_html__('Banner V2', 'akomo'),
            ]
        );
		$this->add_control(
              'slide', 
			  	[
            		'type' => Controls_Manager::REPEATER,
            		'separator' => 'before',
            		'default' => 
						[
                			['title' => esc_html__('Make Your Plan <br>Enjoy Your Vacation', 'akomo')],
                			['title' => esc_html__('Make Your Plan <br>Enjoy Your Vacation', 'akomo')],
                			['title' => esc_html__('Make Your Plan <br>Enjoy Your Vacation', 'akomo')]
            			],
            		'fields' => 
						[
							[
                    			'name' => 'slide_img',
                    			'label' => __('Slide BG Image', 'akomo'),
								'type' => Controls_Manager::MEDIA,
								'default' => ['url' => Utils::get_placeholder_image_src(),],
                			],
							[
                    			'name' => 'title',
                    			'label' => esc_html__('Title', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXTAREA,
                			],
							[
                    			'name' => 'text',
                    			'label' => esc_html__('Text', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXTAREA,
                			],
							[
                    			'name' => 'btn_title',
                    			'label' => esc_html__('Button Title', 'akomo'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
                    			'default' => esc_html__('', 'akomo')
                			],
							[
                    			'name' => 'btn_link',
								'label' => __( 'External Url', 'akomo' ),
							    'type' => Controls_Manager::URL,
							    'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
							    'show_external' => true,
							    'default' => ['url' => '','is_external' => true,'nofollow' => true,],
                			],
            			],
            	    'title_field' => '{{title}}',
                 ]
        );
        $this->add_control(
			'booking_form_url2',
			[
				'label'       => __( 'Booking Form Url', 'akomo' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Booking Form Url', 'akomo' ),
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
        
        <!-- Banner Section Two -->
        <section class="banner-section-three">
            <div class="banner-carousel owl-carousel owl-theme">
    			<?php foreach( $settings['slide'] as $key => $item ): ?>
                <div class="slide-item" <?php if($item['slide_img']['id']) { ?> style="background-image: url(<?php echo esc_url(wp_get_attachment_url( $item['slide_img']['id']));?>);" <?php } ?>>
                    <div class="auto-container">
                        <div class="content-box">
                            <h2><?php echo wp_kses($item['title'], true); ?></h2>
                            <div class="text"><?php echo wp_kses($item['text'], true); ?></div>
                            <?php if(($item['btn_link']['url']) and ($item['btn_title'])) { ?>
                            <a href="<?php echo esc_url($item['btn_link']['url']);?>" class="theme-btn btn-style-two"><?php echo wp_kses($item['btn_title'], true);?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
    			<?php endforeach;?>
            </div>
    		<?php if($settings['booking_form_url2']) { ?>
            <!-- Room Search Form -->
            <div class="room-search-outer">
                <div class="room-search-form-two">
                    <div class="room-search-form style-two">
                    	<?php echo do_shortcode($settings['booking_form_url2']);?>
                    </div>
                </div>
            </div>
    		<?php } ?>
        </section>
        <!--END Banner Section Two -->
        
		<?php
    }
}
