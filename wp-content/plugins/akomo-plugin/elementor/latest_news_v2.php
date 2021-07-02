<?php namespace AKOMOPLUGIN\Element;

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
class Latest_News_V2 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'akomo_latest_news_v2';
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
        return esc_html__( 'Latest News V2', 'akomo' );
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
            'latest_news_v2',
            [
                'label' => esc_html__( 'General', 'akomo' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
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
                'label'       => __( 'Title', 'akomo' ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your title', 'akomo' ),
            ]
        );
		$this->end_controls_section();
		
		//Blog Grid View
		$this->start_controls_section(
            'grid_view',
            [
                'label' => esc_html__( 'Post Grid View', 'akomo' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $this->add_control(
            'text_limit',
            [
                'label'   => esc_html__( 'Text Limit', 'akomo' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 11,
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
                'default' => 5,
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
                'default' => 'ASC',
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
        $this->end_controls_section();
		
		//Blog List View
		$this->start_controls_section(
            'list_view',
            [
                'label' => esc_html__( 'Post List View', 'akomo' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $this->add_control(
            'query_numbers',
            [
                'label'   => esc_html__( 'Number of post', 'akomo' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 5,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );
        $this->add_control(
            'query_orderbys',
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
            'query_orders',
            [
                'label'   => esc_html__( 'Order', 'akomo' ),
				'label_block' => true,
                'type'    => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => array(
                    'DESC' => esc_html__( 'DESC', 'akomo' ),
                    'ASC'  => esc_html__( 'ASC', 'akomo' ),
                ),
            ]
        );
        $this->add_control(
            'query_categorys',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Category', 'akomo'),
				'label_block' => true,
                'options' => get_blog_categories()
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
            'post_type'      => 'post',
            'posts_per_page' => akomo_set( $settings, 'query_number' ),
            'orderby'        => akomo_set( $settings, 'query_orderby' ),
            'order'          => akomo_set( $settings, 'query_order' ),
            'paged'         => $paged
        );
        if( akomo_set( $settings, 'query_category' ) ) $args['category_name'] = akomo_set( $settings, 'query_category' );
        $query = new \WP_Query( $args );
		
		//Second Query
		$args2 = array(
            'post_type'      => 'post',
            'posts_per_page' => akomo_set( $settings, 'query_numbers' ),
            'orderby'        => akomo_set( $settings, 'query_orderbys' ),
            'order'          => akomo_set( $settings, 'query_orders' ),
            'paged'         => $paged
        );

        if( akomo_set( $settings, 'query_categorys' ) ) $args2['category_name'] = akomo_set( $settings, 'query_categorys' );
        $query2 = new \WP_Query( $args2 );
		
        if ( $query->have_posts() ) { ?>

        <!-- News Section Three -->
        <section class="news-section-three">
            <div class="auto-container">
                <?php if($settings['subtitle'] || $settings['title']) {?>
                <!-- Sec Title -->
                <div class="sec-title text-center">
                    <?php if($settings['subtitle']) { ?><span class="sub-title-two"><?php echo wp_kses( $settings['subtitle'], true );?></span><?php } ?>
                    <?php if($settings['title']) { ?><h2><?php echo wp_kses( $settings['title'], true );?></h2><?php } ?>
                </div>
    			<?php } ?>
                <div class="row">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="left-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <!-- News Block -->
                            <div class="news-block-three">
                                <div class="inner-box">
                                    <figure class="image"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail('akomo_480x300'); ?></a></figure>
                                    <h4><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title(); ?></a></h4>
                                    <div class="post-info">
                                        <div class="post-date"><?php echo get_the_date(); ?></div>
                                        <div class="post-author"><?php esc_html_e('By', 'akomo'); ?> <?php the_author(); ?></div>
                                    </div>
                                    <div class="text"><?php echo akomo_trim(get_the_content(), $settings['text_limit']); ?></div>
                                    <a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>" class="read-more"><?php esc_html_e('Read More', 'akomo'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
    				<?php endwhile; ?>
                    <div class="right-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <?php while ( $query2->have_posts() ) : $query2->the_post(); ?>
                            <!-- News Block -->
                            <div class="news-block-four">
                                <div class="inner-box">
                                    <figure class="image"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail('akomo_160x120'); ?></a></figure>
                                    <h4><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title(); ?></a></h4>
                                    <div class="post-info">
                                        <div class="post-author"><?php esc_html_e('By', 'akomo'); ?> <?php the_author(); ?></div>
                                        <div class="post-date"><?php echo get_the_date(); ?></div>
                                    </div>
                                </div>
                            </div>
    						<?php endwhile; ?> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End News Section Two-->
        
        <?php }

        wp_reset_postdata();
    }
}
