<?php
/**
 * Banner Template
 *
 * @package    WordPress
 * @subpackage Theme Kalia
 * @author     Theme Kalia
 * @version    1.0
 */

if ( $data->get( 'enable_banner' ) AND $data->get( 'banner_type' ) == 'e' AND ! empty( $data->get( 'banner_elementor' ) ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'banner_elementor' ) );

	return false;
}

?>
<?php if ( $data->get( 'enable_banner' ) ) : ?>

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
            
<?php endif; ?>