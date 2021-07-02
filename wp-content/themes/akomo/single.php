<?php
/**
 * Blog Post Main File.
 *
 * @package AKOMO
 * @author  Theme Kalia
 * @version 1.0
 */

get_header();
$data    = \AKOMO\Includes\Classes\Common::instance()->data( 'single' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-xs-12 col-sm-12 col-md-12' : 'col-xs-12 col-sm-12 col-md-12 col-lg-8';
$options = akomo_WSH()->option();

if ( class_exists( '\Elementor\Plugin' ) && $data->get( 'tpl-type' ) == 'e') {
	
	while(have_posts()) {
	   the_post();
	   the_content();
    }

} else {
?>

<?php if ( class_exists( '\Elementor\Plugin' )):?>
	<?php do_action( 'akomo_banner', $data );?>
<?php else:?>  
<!--Page Title-->
<section class="page-title" style="background-image:url('<?php echo esc_url( $data->get( 'banner' ) ); ?>')">
    <div class="auto-container">
        <h2><?php if( $data->get( 'title' ) ) echo wp_kses( $data->get( 'title' ), true ); else( wp_title( '' ) ); ?></h2>
        <ul class="page-breadcrumb">
            <?php echo akomo_the_breadcrumb(); ?>
        </ul>
    </div>
</section>
<!--End Page Title-->
<?php endif;?>

<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
        	<?php
				if ( $data->get( 'layout' ) == 'left' ) {
					do_action( 'akomo_sidebar', $data );
				}
			?>
            <div class="content-side <?php echo esc_attr( $class ); ?>">
            	
				<?php while ( have_posts() ) : the_post(); ?>
				
                <div class="blog-single p-r30">
                	
                    <div class="thm-unit-test">    
                        
                        <div class="news-block-six">
                            <?php if( has_post_thumbnail() ):?>
                            <div class="image m-b20"><?php the_post_thumbnail('akomo_1170x420'); ?></div>
                            <?php endif;?>
                            <ul class="post-info">
                                <?php if( $options->get( 'single_post_author' ) ):?><li class="colored"><?php esc_html_e('By', 'akomo'); ?> <?php the_author(); ?></li><?php endif;?>
                                <?php if( $options->get( 'single_post_date' ) ): ?><li><?php esc_html_e('Date:', 'akomo'); ?> <?php echo get_the_date(); ?></li><?php endif;?>
                                <?php if( $options->get( 'single_post_comments' ) ):?><li><span class="icon flaticon-consulting-message"></span> <?php comments_number( wp_kses(__('0 Comments' , 'akomo'), true), wp_kses(__('1 Comment' , 'akomo'), true), wp_kses(__('% Comments' , 'akomo'), true)); ?></li><?php endif;?>
                            </ul>
                            
                            <div class="text">
								<?php the_content(); ?>
                                <div class="clearfix"></div>
                                <?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'akomo'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
                            </div>
                            <!--post-share-options-->
                            <div class="post-share-options clearfix">
                                <?php if($options->get( 'single_post_tag' )): ?>
                                <?php if(has_tag()): ?>
                                <div class="pull-left tags"><span class="tag">Tags</span><?php the_tags('',''); ?></div>
                                <?php endif; ?>
                                <?php endif;?>
                                <?php if(function_exists('bunch_share_us_two')):?>
                                <div class="pull-right">
                                    <?php echo wp_kses(bunch_share_us_two(get_the_id(),$post->post_name ), true);?>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                        
                        <?php if( $options->get( 'single_post_author_box' ) ):?>
                        <!--Author Box-->
                        <div class="author-box">
                            <div class="author-comment">
                                <div class="inner-box">
                                    <div class="image">
										<?php if($avatar = get_avatar(get_the_author_meta('ID')) !== FALSE): ?>
											<?php echo get_avatar(get_the_author_meta('ID'), 180); ?>
                                        <?php endif; ?>
                                    </div>
                                    <h3><?php the_author(); ?></h3>
                                    <div class="designation"><?php the_author_meta( 'designation', get_the_author_meta('ID') );?></div>
                                    <div class="text"><?php the_author_meta( 'description', get_the_author_meta('ID') ); ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
						
                        <?php comments_template(); ?>
                    
                	</div>
					<!--End thm-unit-test-->
                </div>
                <!--End blog-content-->
				<?php endwhile; ?>
                
            </div>
        	<?php
				if ( $data->get( 'layout' ) == 'right' ) {
					do_action( 'akomo_sidebar', $data );
				}
			?>
        </div>
    </div>
</div>
<!--End blog area--> 

<?php
}
get_footer();
