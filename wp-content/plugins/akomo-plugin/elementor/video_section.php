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
class Video_Section extends Widget_Base
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
        return 'akomo_video_section';
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
        return esc_html__('Video Section', 'akomo');
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
            'video_section',
            [
                'label' => esc_html__('Video Section', 'akomo'),
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
        
        <?php if($settings['video_image']['id'] || $settings['video_link']['url']): ?>
        <!-- Video Section -->
        <div class="video-section" <?php if($settings['video_image']['id']): ?>style="background-image: url(<?php echo esc_url(wp_get_attachment_url( $settings['video_image']['id']));?>);"<?php endif; ?>>
            <?php if($settings['video_link']['url']): ?>
            <div class="video-box">
                <a href="<?php echo esc_url( $settings['video_link']['url'] );?>" class="play-now" data-fancybox="gallery" data-caption=""><i class="icon fa fa-play" aria-hidden="true"></i><span class="ripple"></span></a>
            </div>
            <?php endif; ?>
        </div>
        <!-- End Video Section -->
        <?php endif; ?>
        
		<?php
    }
}
