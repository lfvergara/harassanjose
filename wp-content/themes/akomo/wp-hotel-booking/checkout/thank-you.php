<?php 
/**
 * The template for displaying booking thank you page.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/checkout/thank-you.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.9.7.3
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;
?>

<?php
$booking_id = isset( $_GET['booking'] ) ? $_GET['booking'] : '';
$key        = isset( $_GET['key'] ) ? $_GET['key'] : '';
?>

<?php if ( $booking_id && get_post_type( $booking_id ) == 'hb_booking' ) {
	$booking = WPHB_Booking::instance( $booking_id );
	if ( $booking->booking_key === $key ) {
		$rooms = hb_get_order_items( $booking_id );
		?>
		<div class="hb-message message">
			<div class="hb-message-content">
				<?php echo esc_html__( 'Thank you! Your booking has been placed. We will contact you to confirm about the booking soon.', 'akomo' ); ?>
			</div>
		</div>

		<div id="booking-details">
			<div class="booking-data">
				<h3 class="booking-data-number"><?php echo sprintf( esc_attr__( 'Booking %s', 'akomo' ), hb_format_order_number( $booking_id ) ); ?></h3>
				<div class="booking-date">
					<?php echo sprintf( esc_attr__( 'Date %s', 'akomo' ), get_the_date( '', $booking_id ) ); ?>
				</div>
			</div>
		</div>

		<div id="booking-items">

			<h3><?php echo esc_html__( 'Booking Items', 'akomo' ); ?></h3>

			<table class="booking_item_table">
				<thead>
				<tr>
					<th><?php esc_html_e( 'Item', 'akomo' ); ?></th>
					<th><?php esc_html_e( 'Check in - Checkout', 'akomo' ) ?></th>
					<th><?php esc_html_e( 'Night', 'akomo' ); ?></th>
					<th><?php esc_html_e( 'Qty', 'akomo' ); ?></th>
					<th><?php esc_html_e( 'Total', 'akomo' ); ?></th>
				</tr>
				</thead>
				<tbody>

				<?php foreach ( $rooms as $k => $room ) { ?>

					<?php $room_id = apply_filters( 'hotel-booking-order-room-id', hb_get_order_item_meta( $room->order_item_id, 'product_id', true ) ); ?>
					<tr>
						<td>
							<?php printf( '<a href="%s">%s</a>', get_permalink( $room_id ), get_the_title( $room_id ) ) ?>
						</td>
						<td>
							<?php printf( '%s - %s', date_i18n( hb_get_date_format(), hb_get_order_item_meta( $room->order_item_id, 'check_in_date', true ) ), date_i18n( hb_get_date_format(), hb_get_order_item_meta( $room->order_item_id, 'check_out_date', true ) ) ) ?>
						</td>
						<td>
							<?php printf( '%d', hb_count_nights_two_dates( hb_get_order_item_meta( $room->order_item_id, 'check_out_date', true ), hb_get_order_item_meta( $room->order_item_id, 'check_in_date', true ) ) ) ?>
						</td>
						<td>
							<?php printf( '%s', hb_get_order_item_meta( $room->order_item_id, 'qty', true ) ) ?>
						</td>
						<td>
							<?php printf( '%s', hb_format_price( hb_get_order_item_meta( $room->order_item_id, 'subtotal', true ), hb_get_currency_symbol( $booking->currency ) ) ); ?>
						</td>
					</tr>

					<?php $packages = hb_get_order_items( $booking->id, 'sub_item', $room->order_item_id ); ?>
					<?php if ( $packages ) { ?>
						<?php foreach ( $packages as $package ) {
							$extra_id = apply_filters( 'hotel-booking-order-extra-id', hb_get_order_item_meta( $package->order_item_id, 'product_id', true ) );
							$extra    = hotel_booking_get_product_class( $extra_id ); ?>
							<tr data-order-parent="<?php echo esc_attr($extra_id); ?>">
								<td colspan="3">
									<?php echo get_the_title( $extra_id ); ?>
								</td>
								<td>
									<?php echo esc_html( hb_get_order_item_meta( $package->order_item_id, 'qty', true ) ); ?>
								</td>
								<td>
									<?php echo esc_html( hb_format_price( hb_get_order_item_meta( $package->order_item_id, 'subtotal', true ), hb_get_currency_symbol( $booking->currency ) ) ); ?>
								</td>
							</tr>
						<?php } ?>
					<?php } ?>
				<?php } ?>

				<tr>
					<td colspan="4"><?php esc_html_e( 'Sub Total', 'akomo' ) ?></td>
					<td>
						<?php printf( '%s', hb_format_price( hb_booking_subtotal( $booking->id ), hb_get_currency_symbol( $booking->currency ) ) ); ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"><?php esc_html_e( 'Tax', 'akomo' ) ?></td>
					<td>
						<?php printf( '%s', apply_filters( 'hotel_booking_admin_booking_details', hb_format_price( hb_booking_tax_total( $booking->id ), hb_get_currency_symbol( $booking->currency ) ), $booking ) ); ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"><?php esc_html_e( 'Grand Total', 'akomo' ) ?></td>
					<td>
						<?php printf( '%s', hb_format_price( hb_booking_total( $booking->id ), hb_get_currency_symbol( $booking->currency ) ) ) ?>
					</td>
				</tr>

				<?php
				global $hb_settings;
				/**
				 * @var $hb_settings WPHB_Settings
				 */
				$advance_payment  = $booking->advance_payment;
				$advance_settings = $booking->advance_payment_setting;
				if ( ! $advance_settings ) {
					$advance_settings = $hb_settings->get( 'advance_payment', 50 );
				}

				if ( floatval( hb_booking_total( $booking->id ) ) !== floatval( $advance_payment ) ) { ?>
					<tr>
						<td colspan="4"><?php esc_html_e( 'Advance Payment', 'akomo' ) ?></td>
						<td>
							<?php printf( '%s', hb_format_price( $advance_payment, hb_get_currency_symbol( $booking->currency ) ) ) ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>

		<div id="booking-customer">

			<div class="customer-details">
				<ul class="hb-form-table">

					<li>
						<label for="_hb_customer_title"><?php echo esc_html__( 'Title:', 'akomo' ); ?></label>
						<?php echo esc_html( hb_get_title_by_slug( $booking->customer_title ) ); ?>
					</li>

					<li>
						<label for="_hb_customer_first_name"><?php echo esc_html__( 'First Name:', 'akomo' ); ?></label>
						<?php echo esc_html( $booking->customer_first_name ); ?>
					</li>

					<li>
						<label for="_hb_customer_last_name"><?php echo esc_html__( 'Last Name:', 'akomo' ); ?></label>
						<?php echo esc_html( $booking->customer_last_name ); ?>
					</li>

					<li>
						<label for="_hb_customer_address"><?php echo esc_html__( 'Address:', 'akomo' ); ?></label>
						<?php echo esc_html( $booking->customer_address ); ?>
					</li>

					<li>
						<label for="_hb_customer_city"><?php echo esc_html__( 'City:', 'akomo' ); ?></label>
						<?php echo esc_html( $booking->customer_city ); ?>
					</li>

					<li>
						<label for="_hb_customer_state"><?php echo esc_html__( 'State:', 'akomo' ); ?></label>
						<?php echo esc_html( $booking->customer_state ); ?>
					</li>

					<li>
						<label for="_hb_customer_postal_code"><?php echo esc_html__( 'Postal Code:', 'akomo' ); ?></label>
						<?php echo esc_html( $booking->customer_postal_code ); ?>
					</li>

					<li>
						<label for="_hb_customer_country"><?php echo esc_html__( 'Country:', 'akomo' ); ?></label>
						<?php echo esc_html( $booking->customer_country ); ?>
					</li>

					<li>
						<label for="_hb_customer_phone"><?php echo esc_html__( 'Phone:', 'akomo' ); ?></label>
						<?php echo esc_html( $booking->customer_phone ); ?>
					</li>

					<li>
						<label for="_hb_customer_email"><?php echo esc_html__( 'Email:', 'akomo' ); ?></label>
						<?php echo sanitize_email( $booking->customer_email ); ?>
					</li>

					<li>
						<label for="_hb_customer_fax"><?php echo esc_html__( 'Fax:', 'akomo' ); ?></label>
						<?php echo esc_html( $booking->customer_tax ); ?>
					</li>

				</ul>
			</div>

			<div class="booking-notes">
				<label for="_hb_customer_notes"><?php echo esc_html__( 'Booking Notes:', 'akomo' ); ?></label>
				<?php echo esc_html( $booking->post->post_content ); ?>
			</div>

			<?php if ( ( ! $booking->method || $booking->method == 'offline-payment' ) ) {
				$option = get_option( 'tp_hotel_booking_offline-payment' );
				if ( isset( $option['instruction'] ) && $option['instruction'] ) {
					?>
					<div id="instruction">
						<h3><?php echo esc_html__( 'Payment Instruction', 'akomo' ); ?></h3>
						<?php echo stripslashes( $option['instruction'] ); ?>
					</div>
				<?php }
			} ?>

		</div>
	<?php } else { ?>
		<p><?php echo esc_html__( 'Booking invalid', 'akomo' ) ?></p>
	<?php }
} else { ?>
	<p><?php echo esc_html__( 'Booking invalid', 'akomo' ) ?></p>
<?php } ?>