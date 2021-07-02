<?php
/**
 * Tag Main File.
 *
 * @package AKOMO
 * @author  Theme Kalia
 * @version 1.0
 */

get_header();
global $wp_query;
$data  = \AKOMO\Includes\Classes\Common::instance()->data( 'tag' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
$layout = ( $layout ) ? $layout : 'right';
$sidebar = ( $sidebar ) ? $sidebar : 'default-sidebar';
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-xs-12 col-sm-12 col-md-12' : 'col-xs-12 col-sm-12 col-md-12 col-lg-8';
if ( class_exists( '\Elementor\Plugin' ) AND $data->get( 'tpl-type' ) == 'e' AND $data->get( 'tpl-elementor' ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'tpl-elementor' ) );
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

<!--Start blog area-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
        	<?php
				if ( $data->get( 'layout' ) == 'left' ) {
					do_action( 'akomo_sidebar', $data );
				}
			?>
            <div class="content-side <?php echo esc_attr( $class ); ?>">
                <div class="blog-single">
                    <div class="thm-unit-test">
                        <?php
                            while ( have_posts() ) :
                                the_post();
                                akomo_template_load( 'templates/blog/blog.php', compact( 'data' ) );
                            endwhile;
                            wp_reset_postdata();
                        ?>
                    </div>
                </div>
                
                <!--Pagination-->
                <div class="styled-pagination">
					<?php akomo_the_pagination( $wp_query->max_num_pages );?>
                </div>
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
