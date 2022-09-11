<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
remove_all_actions('woocommerce_sidebar');


//notices
remove_action( 'woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5 );
remove_action( 'woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
//remove_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_checkout_form_cart_notices', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_account_content', 'woocommerce_output_all_notices', 5 );
remove_action( 'woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_lost_password_form', 'woocommerce_output_all_notices', 10 );
remove_action( 'before_woocommerce_pay', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_reset_password_form', 'woocommerce_output_all_notices', 10 );