<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" id="checkout" method="post" class="checkout woocommerce-checkout checkout_wrapper" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

<div class="checkout_forms">

		<?php if ( $checkout->get_checkout_fields() ) : ?>


			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<h2>Метод оплаты</h2>
			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			<h2>Контактные данные</h2>
			<div class="col2-set" id="customer_details">
				<div class="col-1">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
				<h2>Детали</h2>
				<div class="col-2">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>

		<?php endif; ?>

		<div class="checkout_submit_wrap">

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

			<?php 
			$order_button_text = "Подтвердить заказ";
			echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

			<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
			<div class="private_policy_wrap">Отправляя форму вы соглашаетесь с   <a href="<?php echo get_site_url( null, '', 'https' ); ?>/privacy">политикой конфиденциальности</a></div>
		</div>
		

</div> 



<div class="checkout_order">

	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

	<h2 id="order_review_heading"><?php esc_html_e( 'Обзор', 'woocommerce' ); ?> <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/short-arrow.svg" alt="arrow"></h2>

	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>
		

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

	
	<div class="form-row place-order">
		<noscript>
			<?php
			/* translators: $1 and $2 opening and closing emphasis tags respectively */
			printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
			?>
			<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
		</noscript>
		
		<?php wc_get_template( 'checkout/terms.php' ); ?>

		<div class="checkout_submit_wrap">

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

			<?php 
			$order_button_text = "Подтвердить заказ";
			echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

			<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
			<div class="private_policy_wrap">Отправляя форму вы соглашаетесь с   <a href="<?php echo get_site_url( null, '', 'https' ); ?>/privacy">политикой конфиденциальности</a></div>
		</div>
	</div>

</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
