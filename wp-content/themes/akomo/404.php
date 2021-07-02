<?php
/**
 * 404 page file
 *
 * @package    WordPress
 * @subpackage Akomo
 * @author     Tona Theme <admin@tonatheme.com>
 * @version    1.0
 */

$allowed_html = wp_kses_allowed_html( 'post' );
?>
<?php get_header();
$data = \AKOMO\Includes\Classes\Common::instance()->data( '404' )->get();
$options = akomo_WSH()->option();
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
    
    <!-- error-section -->
    <section class="error-page-area centred">
        <div class="auto-container">
            <div class="error-content">
                <div class="title">
				<?php 
					if( $options->get( '404-page_heading' ) ){
						echo wp_kses( $options->get( '404-page_heading' ), true );
					}else{
						esc_html_e( '404', 'akomo' );
					}
				?>
				</div>
                <h2>
				<?php 
					if( $options->get( '404-page_title' ) ){
						echo wp_kses( $options->get( '404-page_title' ), true );
					}else{
						esc_html_e( 'PAGE NOT FOUND', 'akomo' );
					}
				?>
				</h2>
                <p>
				<?php 
					if( $options->get( '404-page-text' ) ){
						echo wp_kses( $options->get( '404-page-text' ), true );
					}else{
						esc_html_e( 'Sorry, but the page you are looking for does not existing', 'akomo' );
					}
				?>
				</p>
                <?php if ( $options->get( 'back_home_btn', true ) ) : ?>
                <a href="<?php echo( home_url( '/' ) ); ?>" class="theme-btn btn-style-two">
				<span class="txt"><?php 
					if( $options->get( 'back_home_btn_label' ) ){
						echo wp_kses( $options->get( 'back_home_btn_label' ), true );
					}else{
						esc_html_e( 'Go to home', 'akomo' );
					}
				?></span>
				</a>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- error-section end -->
     
<?php
}
get_footer(); ?>
