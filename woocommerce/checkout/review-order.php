<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table">
	<table class="checkout_review_order_table">
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<td class="product-thumbnail">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
					</td>
					<td class="product-name">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $_product->get_name() ) : $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
						<?php
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								if (get_post_meta( $cart_item['product_id'], 'preorder_title_cart', true ))
									$pt = get_post_meta( $cart_item['product_id'], 'preorder_title_cart', true );
								else
									$pt = carbon_get_theme_option('d2k_preorder_title_cart');
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( $pt, 'woocommerce' ) . '</p>', $product_id ) );
							}
						?>
						<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <p class="product-quantity">' . sprintf( 'Количество: %s', $cart_item['quantity'] ) . '</p>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						
						<div class="product-total">
							<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</table>
	<div class="tfoot">

		<div class="cart-subtotal">
			<h3><?php esc_html_e( 'Товары', 'woocommerce' ); ?></h3>
			<p><?php wc_cart_totals_subtotal_html(); ?></p>
		</div>

		
		<?php if(WC()->cart->get_coupons()) : ?>
			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
					<h3><?php wc_cart_totals_coupon_label( $coupon ); ?></h3>
					<p data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php d2k_cart_totals_coupon_html( $coupon ); ?></p>
				</div>
			<?php endforeach; ?>
		<?php elseif ( wc_coupons_enabled() ) : ?>
			<form class="woocommerce-form-coupon coupon" method="post">
				<label for="coupon_code"><?php esc_html_e( 'Есть промокод?', 'woocommerce' ); ?></label> 
				<div class="coupon_div">
				<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Введите промокод', 'woocommerce' ); ?>"/> 
				<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply', 'woocommerce' ); ?></button>
				</div>
				<?php do_action( 'woocommerce_cart_coupon' ); ?>
		</form>
		<?php endif; ?>



		
		<h2>Получение заказа</h2>
			
		<div class="city_field_wrapper">
				<?php
				$fields = $checkout->get_checkout_fields( 'billing' );

				foreach ( $fields as $key => $field ) {
					if ($field["label"] =="Выберите город")
						woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
				}
				?>
			</div>
		<div class="shipping_methods">
			<h3>Выберете способ получения</h3>
		
			
			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
			
				<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<div class="woocommerce-shipping-wrapper">

					<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

					<?php
					$fields = $checkout->get_checkout_fields( 'billing' );

					foreach ( $fields as $key => $field ) {
						if ($field["label"] !="ФИО" && $field["type"] != "tel" && $field["type"] !="email" && $field["label"] !="Выберите город" && $field["label"] != "Имя" && $field["label"] != "Фамилия")
							woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
					}
					?>
				</div>

			<?php endif; ?>

			
				

		</div>

		<div class="subtotal-form__shipping">
			<h3 class="subtotal-form__shipping-label">
				Доставка
			</h3>
			<p class="subtotal-form__shipping-price">
				<?php if (WC()->cart->get_shipping_total() && WC()->cart->get_shipping_total() > 0) :
					echo WC()->cart->get_shipping_total().' '.get_woocommerce_currency_symbol();
				else :
					echo '-';
				endif; ?>
			</p>
		</div>

		
		

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="fee">
				<h3><?php echo esc_html( $fee->name ); ?></h3>
				<p><?php wc_cart_totals_fee_html( $fee ); ?></p>
			</div>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
					<div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<h3><?php echo esc_html( $tax->label ); ?></h3>
						<p><?php echo wp_kses_post( $tax->formatted_amount ); ?></p>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="tax-total">
					<h3><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></h3>
					<p><?php wc_cart_totals_taxes_total_html(); ?></p>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<div class="order-total">
			<h3><?php esc_html_e( 'Итоговая стоимость', 'woocommerce' ); ?></h3>
			<p><?php wc_cart_totals_order_total_html(); ?></p>
		</div>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</div>
</div>
