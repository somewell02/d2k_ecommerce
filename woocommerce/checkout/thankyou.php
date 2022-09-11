<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<div class="thankyou_wrapper">
	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>
		<div class="thankyou_main">
		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

			<div class="order_details">
				<h2>Получение заказа</h2>
				<div class="order_receiving">
					<p><?php echo $order->get_billing_city(); ?></p>
					<p><?php echo $order->get_billing_address_1(); ?></p>
				</div>
			</div>

			<div class="order_details">
				<h2>Метод оплаты</h2>
				<div class="ty_payment_method">
					<?php echo wp_kses_post( $order->get_payment_method_title() ); ?>
				</div>
				<div class="payment_instruction">
					<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
				</div>
			</div>
			
			<div class="order_details">
				<h2>Контактные данные</h2>
				<ul class="woocommerce-order-overview woocommerce-thankyou-order-details contact_info">
					
					<li class="woocommerce-order-overview__full_name full_name">
						<?php //echo get_post_meta( $order->get_id() )["billing_full_name"][0]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								echo $order->get_billing_first_name()." ".$order->get_billing_last_name();	
						?>
					</li>

					<li class="woocommerce-order-overview__phone phone">
						<?php echo $order->get_billing_phone(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</li>

					<li class="woocommerce-order-overview__email email">
						<?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</li>

				</ul>
			</div>

			<?php //print_r($order); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			
			<?php if ( $order->get_customer_note() ) : ?>
				<div class="order_details">
					<h2><?php esc_html_e( 'Детали', 'woocommerce' ); ?></h2>
					<div class="note"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></div>
				</div>
			<?php endif; ?>

		<?php endif; ?>
		</div>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>
	</div>

</div>
