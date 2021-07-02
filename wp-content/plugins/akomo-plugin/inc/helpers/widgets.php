<?php
///----Blog widgets---
//Popular Post
class Akomo_Popular_Post extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Akomo_Popular_Post', /* Name */esc_html__('Akomo Popular Post','akomo'), array( 'description' => esc_html__('Show the Popular Post', 'akomo' )) );
	}
 

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
        <!--Popular Posts-->
        <div class="recent-post">
            <?php echo wp_kses_post($before_title.$title.$after_title); ?>

            <div class="widget-content">
				<?php $query_string = 'posts_per_page='.$instance['number'];
                    if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
                    $this->posts($query_string);
                ?>
            </div>
        </div>
        
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Popular Post', 'akomo');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'akomo'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'akomo'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Category', 'akomo'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'akomo'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('categories')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($query_string)
	{
		
		$query = new WP_Query($query_string);
		if( $query->have_posts() ):?>
        
           	<!-- Title -->
			<?php 
				global $post;
				while( $query->have_posts() ): $query->the_post(); 
				$post_thumbnail_id = get_post_thumbnail_id($post->ID);
				$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
			?>
            <article class="post">
                <div class="post-thumb" style="background-image:url(<?php echo esc_url($post_thumbnail_url);?>);"><a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"></a></div>
                <h5><a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"><?php echo wp_kses( akomo_trim(get_the_title(), 7), true ); ?></a></h5>
                <div class="post-info"><?php echo get_the_date();?></div>
            </article>
            <?php endwhile; ?>
            
        <?php endif;
		wp_reset_postdata();
    }
}


///----footer widgets---
//About Company
class Akomo_About_Company extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Akomo_About_Company', /* Name */esc_html__('Akomo About Company','akomo'), array( 'description' => esc_html__('Show the About Company', 'akomo' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		
		echo wp_kses_post($before_widget);?>
      		
			<!--Footer Column-->
            <div class="about-widget">
                <div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($instance['widget_logo_img']); ?>" alt="<?php esc_attr_e('Awesome Image', 'akomo'); ?>" /></a></div>
                <div class="text"><?php echo wp_kses_post($instance['text']); ?></div>
                
                <?php if( $instance['show'] ): ?>
				<?php echo wp_kses_post(akomo_get_social_icons2()); ?>
                <?php endif; ?>
                
            </div>
            
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['widget_logo_img'] = $new_instance['widget_logo_img'];
		$instance['text'] = $new_instance['text'];
		$instance['show'] = $new_instance['show'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$widget_logo_img = ($instance) ? esc_attr($instance['widget_logo_img']) : 'http://wp.efforttech.net/wp/akomo/wp-content/uploads/2021/03/logo-1.png';
		$text = ($instance) ? esc_attr($instance['text']) : '';
		$show = ($instance) ? esc_attr($instance['show']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_logo_img')); ?>"><?php esc_html_e('Logo Image Url:', 'akomo'); ?></label>
            <input placeholder="<?php esc_attr_e('Image Url', 'akomo');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_logo_img')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_logo_img')); ?>" type="text" value="<?php echo esc_attr($widget_logo_img); ?>" />
        </p>              
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Description:', 'akomo'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" ><?php echo wp_kses_post($text); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show')); ?>"><?php esc_html_e('Show Social Icons:', 'akomo'); ?></label>
			<?php $selected = ( $show ) ? ' checked="checked"' : ''; ?>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show')); ?>"<?php echo esc_attr($selected); ?> name="<?php echo esc_attr($this->get_field_name('show')); ?>" type="checkbox" value="true" />
        </p>
           
		<?php 
	}
	
}

//Contact Info
class Akomo_Contact_Info extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Akomo_Contact_Info', /* Name */esc_html__('Akomo Contact Info','akomo'), array( 'description' => esc_html__('Show the Contact Info', 'akomo' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget);?>
      		
			<!--Footer Column-->
            <div class="contact-widget">
                <?php echo wp_kses_post($before_title.$title.$after_title); ?>
                <!--Footer Column-->
                <div class="widget-content">
                    <div class="text">Get in Touch for Special Offers and Discounts.</div>
                    <ul class="contact-list">
                        <?php if($instance['address']){ ?><li><i class="icon flaticon-placeholder-2"></i><?php echo wp_kses_post($instance['address']); ?></li><?php } ?>
                        <?php if($instance['phone_no']){ ?><li><i class="icon flaticon-phone-call"></i><?php echo wp_kses_post($instance['phone_no']); ?></li><?php } ?>
                        <?php if($instance['email_address']){ ?><li><i class="icon flaticon-envelope"></i><a href="mailto:<?php echo esc_attr($instance['email_address']); ?>"><?php echo wp_kses_post($instance['email_address']); ?></a></li><?php } ?>
                    </ul>
                </div>
            </div>
            
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address'] = $new_instance['address'];
		$instance['phone_no'] = $new_instance['phone_no'];
		$instance['email_address'] = $new_instance['email_address'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		
		$title = ($instance) ? esc_attr($instance['title']) : 'Contact';
		$address = ($instance) ? esc_attr($instance['address']) : '';
		$phone_no = ($instance) ? esc_attr($instance['phone_no']) : '';
		$email_address = ($instance) ? esc_attr($instance['email_address']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter Title:', 'akomo'); ?></label>
            <input placeholder="<?php esc_attr_e('Contact', 'akomo');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address:', 'akomo'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" ><?php echo wp_kses_post($address); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone_no')); ?>"><?php esc_html_e('Phone and Fax No:', 'akomo'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_no')); ?>" name="<?php echo esc_attr($this->get_field_name('phone_no')); ?>" ><?php echo wp_kses_post($phone_no); ?></textarea>
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email_address')); ?>"><?php esc_html_e('Email Addess:', 'akomo'); ?></label>
            <input placeholder="<?php esc_attr_e('info@example.com', 'akomo');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('email_address')); ?>" name="<?php echo esc_attr($this->get_field_name('email_address')); ?>" type="text" value="<?php echo esc_attr($email_address); ?>" />
        </p>
               
                
		<?php 
	}
	
}

