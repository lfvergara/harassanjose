<?php
/**
 * Footer Template  File
 *
 * @package AKOMO
 * @author  Theme Kalia
 * @version 1.0
 */

$options = akomo_WSH()->option();
$footer_bg2 = $options->get( 'footer_bg_image2' );
$footer_bg2 = akomo_set( $footer_bg2, 'url', AKOMO_URI . 'images/background/4.jpg' );
$allowed_html = wp_kses_allowed_html( 'post' );
?>

	<!-- Main Footer -->
    <footer class="main-footer style-two" <?php if($footer_bg2){ ?>style="background-image: url(<?php echo esc_url($footer_bg2); ?>);"<?php } ?>>
        <?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="auto-container">
                <div class="row">
                    <?php dynamic_sidebar( 'footer-sidebar' ); ?>
                </div>
            </div>
        </div>
		<?php } ?>
        <!--Footer Bottom-->
        <div class="footer-bottom">            
            <div class="auto-container">
                <div class="inner-container">
                     <div class="copyright-text">
                        <p><?php echo wp_kses( $options->get( 'copyright_text2', '&copy; 2021. All Right Reserved' ), true ); ?></p>
                    </div>
					<?php if($options->get( 'footer_menu2' )):?>
                    <div class="footer-nav">
                        <ul class="clearfix">
                           <?php echo wp_kses( $options->get( 'footer_menu2'), true ); ?>
                        </ul>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </footer>
    <!--End Main Footer -->

</div><!-- End Page Wrapper -->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>