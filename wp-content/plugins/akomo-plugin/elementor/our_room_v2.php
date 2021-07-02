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
class Our_Room_V2 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akomo_our_room_v2';
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
		return esc_html__( 'Our Room V2', 'akomo' );
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
			'our_room_v2',
			[
				'label' => esc_html__( 'Our Room V2', 'akomo' ),
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
				'label'       => __( 'title', 'akomo' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Title', 'akomo' ),
			]
		);
		$this->add_control(
			'number',
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
			'cat_exclude',
			[
				'label'       => esc_html__( 'Exclude', 'akomo' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Exclude categories, etc. by ID with comma separated.', 'akomo' ),
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
			'post_type'      => 'hb_room',
			'posts_per_page' => akomo_set( $settings, 'query_number' ),
			'orderby'        => akomo_set( $settings, 'query_orderby' ),
			'order'          => akomo_set( $settings, 'query_order' ),
			'paged'         => $paged
		);
		$terms_array = explode(",",akomo_set( $settings, 'cat_exclude' ));
		if(akomo_set( $settings, 'cat_exclude' )) $args['tax_query'] = array(array('taxonomy' => 'hb_room_type','field' => 'id','terms' => $terms_array,'operator' => 'NOT IN',));
		$allowed_tags = wp_kses_allowed_html('post');
		$query = new \WP_Query( $args );
		$t = '';
		$data_filtration = '';
		$data_posts = '';
		if ( $query->have_posts() ) 
		{
		ob_start();
		?>
  
		<?php 
            $count = 0; 
            $fliteration = array();
            while( $query->have_posts() ): $query->the_post();
            global  $post;
            $meta = ''; //printr($meta);
            $meta1 = ''; //_WSH()->get_meta();
            $post_terms = get_the_terms( get_the_id(), 'hb_room_type');// printr($post_terms); exit();
            foreach( (array)$post_terms as $pos_term ) $fliteration[$pos_term->term_id] = $pos_term;
            $temp_category = get_the_term_list(get_the_id(), 'hb_room_type', '', ', ');
            
            $post_terms = wp_get_post_terms( get_the_id(), 'hb_room_type'); 
            $term_slug = '';
            if( $post_terms ) foreach( $post_terms as $p_term ) $term_slug .= $p_term->slug.' ';
        	
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
            $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
            ?>
            
            <!-- Room Block -->
            <div class="room-block-three all masonry-item <?php echo esc_attr($term_slug); ?> <?php if(get_post_meta( get_the_id(), 'dimension', true) == 'extra_height') echo 'col-lg-4 col-md-6 col-sm-12'; else echo 'col-lg-4 col-md-6 col-sm-12'?>">
                <div class="inner-box">
                    <figure class="image">
					<?php 
                        $dimention = get_post_meta( get_the_id(), 'dimension', true );
                        if($dimention == 'extra_height'){
                            $image_size = 'akomo_400x600';
                        }
                        else{
                            $image_size = 'akomo_400x285'; 
                        }
                        the_post_thumbnail($image_size);
                    ?>
                    </figure>
                    <?php echo hotel_booking_loop_room_price(); ?>
                    <div class="overlay-cotnent">
                        <div class="rating">
                            <?php
								$ratting = get_post_meta( get_the_id(), 'room_rating', true );
								for ($x = 1; $x <= 5; $x++) {
									if($x <= $ratting) echo '<i class="fa fa-star"></i>'; else echo '<i class="fa fa-star-half-alt"></i>'; 
								}
							?>
                        </div>
                        <h5><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title(); ?></a></h5>
                        <a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="theme-btn btn-style-two"><?php esc_html_e('Book Now', 'akomo'); ?></a>
                    </div>
                </div>
            </div>
            
            <?php endwhile;?>

            <?php wp_reset_postdata();
            $data_posts = ob_get_contents();
            ob_end_clean();
            
            ob_start();?>
            
            <?php $terms = get_terms(array('hb_room_type')); ?>
            
            <!-- Rooms Section -->
            <section class="rooms-section-three">
                <div class="auto-container">
                    <?php if($settings['subtitle'] || $settings['title']) {?>
                    <div class="sec-title text-center">
                        <?php if($settings['subtitle']) { ?><span class="sub-title-two"><?php echo wp_kses( $settings['subtitle'], true );?></span><?php } ?>
                     	<?php if($settings['title']) { ?><h2><?php echo wp_kses( $settings['title'], true );?></h2><?php } ?>
                    </div>
        			<?php } ?>
                    <!--Sortable Masonry-->
                    <div class="sortable-masonry">
                        <!--Filter-->
                        <div class="filters">
                            <ul class="filter-tabs filter-btns clearfix">
                                <li class="active filter" data-role="button" data-filter=".all"><?php esc_attr_e('All', 'akomo');?></li>
                                <?php foreach( $fliteration as $t ): ?>
                                <li class="filter" data-role="button" data-filter=".<?php echo esc_attr(akomo_set( $t, 'slug' )); ?>"><?php echo akomo_set( $t, 'name'); ?></li>
                                <?php endforeach;?>
                            </ul>                     
                        </div>
        
                        <div class="items-container row">
        					<?php echo wp_kses($data_posts, $allowed_tags); ?>
                        </div>
                    </div>
                </div>
            </section>
            <!--End Rooms Section -->
                  
    	<?php }
	}

}