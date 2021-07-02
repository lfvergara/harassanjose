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
class Subscribe_Form_v2 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akomo_subscribe_form_v2';
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
		return esc_html__( 'Subscribe Form V2', 'akomo' );
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
			'subscribe_form_v2',
			[
				'label' => esc_html__( 'Subscribe Form V2', 'akomo' ),
			]
		);
		$this->add_control(
            'bg_image',
            [
			    'label' => __('BG Image', 'akomo'),
			    'type' => Controls_Manager::MEDIA,
			    'default' => ['url' => Utils::get_placeholder_image_src(),],
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
			'mailchimp_form_url2',
			[
				'label'       => __( 'MailChimp Form Url', 'akomo' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your MailChimp Form Url', 'akomo' ),
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
        
        <!-- Subscribe Section -->
        <section class="subscribe-section">
            <div class="outer-box" <?php if($settings['bg_image']['id']){ ?>style="background-image: url(<?php echo esc_url(wp_get_attachment_url( $settings['bg_image']['id']));?>);"<?php } ?>>
                <div class="inner-container">
                    <?php if($settings['title'] || $settings['text']): ?>
                    <div class="title-column">
                        <?php if($settings['title']): ?><h4><?php echo wp_kses($settings['title'], true);?></h4><?php endif; ?>
                        <?php if($settings['text']): ?><div class="text"><?php echo wp_kses($settings['text'], true);?></div><?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if($settings['mailchimp_form_url2']): ?>
                    <div class="form-column">
                        <div class="subscribe-form">
                            <?php echo do_shortcode($settings['mailchimp_form_url2']);?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- End Subscribe Section -->
                    
		<?php 
	}

}