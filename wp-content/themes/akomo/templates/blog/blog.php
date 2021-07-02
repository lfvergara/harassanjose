<?php

/**
 * Blog Content Template
 *
 * @package    WordPress
 * @subpackage AKOMO
 * @author     Theme Kalia
 * @version    1.0
 */

if ( class_exists( 'Akomo_Resizer' ) ) {
	$img_obj = new Akomo_Resizer();
} else {
	$img_obj = array();
}

$options = akomo_WSH()->option();

$allowed_tags = wp_kses_allowed_html('post');
global $post;
?>
<div <?php post_class(); ?>>

	<!-- Sec Title -->
    <div class="blog-single style-two">
        <div class="news-block-six update">
            <?php if( has_post_thumbnail() ):?><div class="image"><?php the_post_thumbnail('akomo_1170x420'); ?></div><?php endif;?>
            <div class="lower-box">
                <ul class="post-info">
                    <?php if( $options->get( 'blog_post_author' ) ):?><li><span class="icon flaticon-user-1"></span> <?php the_author(); ?></li><?php endif;?>
                    <?php if( $options->get( 'blog_post_date' ) ):?><li><span class="icon flaticon-clock"></span><?php echo get_the_date(); ?></li><?php endif;?>
                    <?php if( $options->get( 'blog_post_comments' ) ):?><li><span class="icon flaticon-consulting-message"></span> <?php comments_number( wp_kses(__('0 Comments' , 'akomo'), true), wp_kses(__('1 Comment' , 'akomo'), true), wp_kses(__('% Comments' , 'akomo'), true)); ?></li><?php endif;?>
                </ul>
                <h2><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title(); ?></a></h2>
                <div class="text">
                <?php the_excerpt(); ?>
                </div>
                
                <div class="link-box">
                    <a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>" class="theme-btn btn-style-two"><?php esc_html_e('Read More', 'akomo'); ?></a>
                </div>
            </div>
         </div>
    </div>
    
</div>