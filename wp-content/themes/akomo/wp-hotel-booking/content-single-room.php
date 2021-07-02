<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/tp-hotel-booking/content-single-room.php
 *
 * @author        ThimPress
 * @package       wp-hotel-booking/templates
 * @version       1.6
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php
/**
 * hotel_booking_before_single_product hook
 *
 */
do_action( 'hotel_booking_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>

<div id="room-<?php the_ID(); ?>" <?php post_class( 'hb_single_room' ); ?>>
	
    
        
		<?php
		/**
		 * hotel_booking_before_loop_room_summary hook
		 *
		 * @hooked hotel_booking_show_room_sale_flash - 10
		 * @hooked hotel_booking_show_room_images - 20
		 */
		do_action( 'hotel_booking_before_single_room' );
		?>
    
    
	<div class="summary entry-summary">
		<div class="owl-slider owl-theme owl-slider-gallery clearfix">
			<?php
				/**
				 * hotel_booking_single_room_gallery hook
				 */
				do_action( 'hotel_booking_single_room_gallery' );
            ?>
		</div>
        
        <div class="content-side">
            <div class="inner-box">
                <?php
                	/**
					 * hotel_booking_single_room_title hook
					 */
					do_action( 'hotel_booking_single_room_title' );
				?>
                <!--Stars-->
                <div class="stars">
                    <?php do_action( 'hotel_booking_loop_room_rating' );?>
                </div>
                
                <?php the_content();?>
                
				<?php /**
                 * hotel_booking_loop_room_single_price
                 */
                do_action( 'hotel_booking_loop_room_price' );
                ?>
                
            </div>
        </div>
		<?php
		

		/**
		 * hotel_booking_single_room_infomation hook
		 */
		do_action( 'hotel_booking_single_room_infomation' );
		$room_meta = _WSH()->get_meta();
		?>
		<a href="<?php echo esc_attr(akomo_set($room_meta, 'paypal_url'));?>" class="pay-pal-btn btn theme-btn"><?php esc_html_e( 'Book Now', 'akomo' );?></a>
    </div><!-- .summary -->

	<?php
	/**
	 * hotel_booking_after_loop_room hook
	 *
	 * @hooked hotel_booking_output_room_data_tabs - 10
	 * @hooked hotel_booking_upsell_display - 15
	 * @hooked hotel_booking_output_related_products - 20
	 */
	do_action( 'hotel_booking_after_single_room' );
	?>
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'hotel_booking_after_single_product' ); ?>
