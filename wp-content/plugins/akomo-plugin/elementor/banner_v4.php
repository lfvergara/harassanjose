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
class Banner_V4 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akomo_banner_v4';
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
		return esc_html__( 'Banner V4', 'akomo' );
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
			'banner_v4',
			[
				'label' => esc_html__( 'Banner V4', 'akomo' ),
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
			'experience_desc',
			[
				'label'       => __( 'Experience Description', 'akomo' ),
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
			'banner_img',
			[
			  'label' => __( 'Feature Image', 'akomo' ),
			  'type' => Controls_Manager::MEDIA,
			  'default' => ['url' => Utils::get_placeholder_image_src(),],
			]
	    );
		$this->add_control(
			'booking_form_url3',
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
	protected function render() {
		$settings = $this->get_settings_for_display();
		$allowed_tags = wp_kses_allowed_html('post');
		?>
        
        <!-- Banner Section -->
        <section class="banner-section">
            <div class="auto-container">
                <?php if($settings['title']) { ?>
                <h1><?php echo wp_kses($settings['title'], true);?></h1>
                <?php } ?>
                
                <?php if($settings['experience_desc'] || $settings['text']) { ?>
                <div class="about-hotel">
                    <?php if($settings['experience_desc']) { ?><div class="experience"><span><?php echo wp_kses($settings['experience_desc'], true);?></span></div><?php } ?>
                    <?php if($settings['text']) { ?><div class="text"><?php echo wp_kses($settings['text'], true);?></div><?php } ?>
                </div>
    			<?php } ?>
                
				<?php if($settings['banner_img']['id']): ?>
                <!-- Main image -->
                <div class="main-image"><img src="<?php echo esc_url(wp_get_attachment_url($settings['banner_img']['id']));?>" alt="<?php esc_html_e('Awesome Image', 'akomo'); ?>"></div>
    			<?php endif; ?>
                
				<?php if($settings['booking_form_url3']) { ?>
                <!-- Room Search Form -->
                <div class="room-search-form">
                    <?php echo do_shortcode($settings['booking_form_url3']);?>
                </div>
                <!-- End Room Search Form -->
                <?php } ?>
            </div>
        </section>
        <!--END Banner Section -->
                
		<?php 
	}

}