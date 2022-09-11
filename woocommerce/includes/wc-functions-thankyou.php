<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


add_filter('woocommerce_endpoint_order-received_title', 'd2k_rename_thankyou_title');
function d2k_rename_thankyou_title() {
    $order_id = $_GET['key'] ? wc_get_order_id_by_order_key($_GET['key']) : false;
    $order = wc_get_order($order_id);
    $name = $order->get_billing_last_name();
    return 'Заказ №'.$order_id;
}



add_filter( 'woocommerce_thankyou_order_received_text', 'd2k_thankyou_rename_subtitle', 10, 2 );
function d2k_thankyou_rename_subtitle($title) {
    return '<div class="ty_thanks_text">
                <img src="'.get_template_directory_uri().'/assets/img/icons/check.svg" alt="check">
                <div class="title">
                    '.carbon_get_theme_option('d2k_thankyou_title').'
                </div>
            </div>';
}

