<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'd2k_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function d2k_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		d2k_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'd2k_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'd2k_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function d2k_woocommerce_cart_link() {
		?>
		<a class="cart-contents icon icon_fon" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/cart.svg" alt="cart">
                <?php
                $item_count_text = sprintf(
                    _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'd2k' ),
                    WC()->cart->get_cart_contents_count()
                );
                ?>
                <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'd2k_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function d2k_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php d2k_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}



add_filter( 'gettext', 'change_woocommerce_return_to_shop_text', 20, 3 );
function change_woocommerce_return_to_shop_text( $translated_text, $text, $domain ) {
        switch ( $text ) {
            case 'Return to shop' :
                $translated_text = __( 'Перейти к каталогу', 'woocommerce' );
                break;
        }
    return $translated_text;
}


remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_before_cart_table', 'd2k_left_cart_start', 10);
function d2k_left_cart_start() {
	?>
		<div class="cart_left_wrapper">
	<?
}

add_action('woocommerce_before_cart_collaterals', 'd2k_continue_shopping_button', 5);
function d2k_continue_shopping_button() {
	?>
		<a href="<? echo get_site_url(); ?>/shop" class="delivery_and_refund"><img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/shop.svg" alt="shop">Продолжить покупки</a>
	<?php
}

add_action('woocommerce_before_cart_collaterals', 'woocommerce_cross_sell_display', 10);
add_action('woocommerce_before_cart_collaterals', 'd2k_left_cart_end', 20);
function d2k_left_cart_end() {
	?>
		</div>
	<?
}


add_action('woocommerce_proceed_to_checkout', 'd2k_add_delivery_button_to_cart', 20);
function d2k_add_delivery_button_to_cart() {
    ?>
        <a href="<? echo get_site_url(); ?>/delivery" class="delivery_and_refund"><img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/fast.svg" alt="delivery">Доставка и возврат</a>
    <?
}

add_action('woocommerce_after_cart_totals', 'd2k_add_payment_methods_to_cart', 10);
function d2k_add_payment_methods_to_cart() {
    ?>
	<div class="payment_methods">
        <p>Мы принимаем:</p>
		<div class="methods">
			<? if (carbon_get_theme_option('d2k_payment_method_visa')) { ?><img src="<?php echo get_template_directory_uri() ?>/assets/img/payment/visa.svg" alt="visa"><? } ?>
			<? if (carbon_get_theme_option('d2k_payment_method_visa')) { ?><img src="<?php echo get_template_directory_uri() ?>/assets/img/payment/mastercard.svg" alt="mastercard"><? } ?>
			<? if (carbon_get_theme_option('d2k_payment_method_mir')) { ?><img src="<?php echo get_template_directory_uri() ?>/assets/img/payment/mir.svg" alt="mir" class="large"><? } ?>
			<? if (carbon_get_theme_option('d2k_payment_method_visa')) { ?><img src="<?php echo get_template_directory_uri() ?>/assets/img/payment/apple-pay.svg" alt="apple-pay" class="large"><? } ?>
			<? if (carbon_get_theme_option('d2k_payment_method_visa')) { ?><img src="<?php echo get_template_directory_uri() ?>/assets/img/payment/google-pay.svg" alt="google-pay" class="large"><? } ?>
		</div>
	</div>
    <?
}



function d2k_cart_totals_coupon_html( $coupon ) { 
    if ( is_string( $coupon ) ) { 
        $coupon = new WC_Coupon( $coupon ); 
    } 
 
    $discount_amount_html = ''; 
 
    if ( $amount = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax ) ) { 
        $discount_amount_html = '-' . wc_price( $amount ); 
    } elseif ( $coupon->get_free_shipping() ) { 
        $discount_amount_html = __( 'Free shipping coupon', 'woocommerce' ); 
    } 
 
    $discount_amount_html = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon ); 
    $coupon_html = $discount_amount_html . ' <a href="' . esc_url( add_query_arg( 'remove_coupon', urlencode( $coupon->get_code() ), defined( 'WOOCOMMERCE_CHECKOUT' ) ? wc_get_checkout_url() : wc_get_cart_url() ) ) . '" class="woocommerce-remove-coupon" data-coupon="' . esc_attr( $coupon->get_code() ) . '">' . '<img src="'.get_template_directory_uri().'/assets/img/icons/close.svg" alt="delete">' . '</a>'; 
 
    echo wp_kses( apply_filters( 'woocommerce_cart_totals_coupon_html', $coupon_html, $coupon, $discount_amount_html ), array_replace_recursive( wp_kses_allowed_html( 'post' ), array( 'a' => array( 'data-coupon' => true ) ) ) ); 
} 

add_filter( 'woocommerce_product_variation_title_include_attributes', 'custom_product_variation_title', 10, 2 );
function custom_product_variation_title($should_include_attributes, $product){
    $should_include_attributes = false;
    return $should_include_attributes;
}

add_filter('woocommerce_product_cross_sells_products_heading', 'd2k_change_cross_sells_title');
function d2k_change_cross_sells_title() {
	return carbon_get_theme_option('d2k_cross_sells_title');
}

add_filter('woocommerce_shipping_estimate_html', 'd2k_change_shipping_estimate');
function d2k_change_shipping_estimate() {
	return "Стоимость и сроки доставки будут обновлены при оформлении заказа после выбора города!";
}

