<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );


remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 5 );

add_filter( 'woocommerce_checkout_show_terms', 'set_checked_wc_terms', 10 );
function set_checked_wc_terms( $terms_is_checked ) {   
	return false;   
}

add_filter( 'woocommerce_endpoint_order-pay_title', 'change_checkout_order_pay_title' );
function change_checkout_order_pay_title( $title ) {
    return __( "<div class='order_pay_title'>Оплата заказа</div>", "woocommerce" );
}

//add_action('woocommerce_before_checkout_form', 'd2k_checkout_wrapper_start', 5);
function d2k_checkout_wrapper_start() {
	?>
		<div class="checkout_wrapper">
	<?php
}
//add_action('woocommerce_after_checkout_form', 'd2k_checkout_wrapper_end', 10);
function d2k_checkout_wrapper_end() {
	?>
		</div>
	<?php
}

add_filter('woocommerce_form_field_args', 'd2k_custom_checkout_fields');
function d2k_custom_checkout_fields($fields) {
	$fields['input_class'] = array('checkout_input');
	return $fields;
}





add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
  
function custom_override_checkout_fields( $fields ) {

	// $fields['billing']['billing_full_name'] = array(
    //     'label'       => 'ФИО', // Add custom field label
    //     'placeholder' => __('ФИО*', 'woocommerce'), // Add custom field placeholder
    //     'required'    => true, // if field is required or not
    //     'clear'       => false, // add clear or not
    //     'type'        => 'text', // add field type
    //     'class'       => array('billing_full_name'),   // add class name
    //     'priority'    => 1, // Priority sorting option
    // );
	$fields['order']['order_comments']['label'] = __('', 'woocommerce');
	$fields['order']['order_comments']['placeholder'] = __('Примечание к вашему заказу', 'woocommerce');

	//unset($fields['billing']['billing_first_name']);// имя
	//unset($fields['billing']['billing_last_name']);// фамилия
	unset($fields['billing']['billing_address_2']);//второй адрес

	$fields['billing']['billing_city']['label'] = __('Выберите город', 'woocommerce');
	$fields['billing']['billing_address_1']['label'] = __('', 'woocommerce');
	$fields['billing']['billing_address_1']['placeholder'] = __('Улица, дом, квартира*', 'woocommerce');
	$fields['billing']['billing_first_name']['placeholder'] = __('Имя*', 'woocommerce');
	$fields['billing']['billing_last_name']['placeholder'] = __('Фамилия*', 'woocommerce');

	$fields['billing']['billing_email']['placeholder'] = __('Электронная почта*', 'woocommerce');
	$fields['billing']['billing_phone']['placeholder'] = __('Телефон*', 'woocommerce');
	

 
	unset($fields['billing']['billing_company']);// компания
	unset($fields['billing']['billing_postcode']);// индекс 
    return $fields;
}

// add_action( 'woocommerce_checkout_update_order_meta', 'billing_full_name_update_order_meta' );
// function billing_full_name_update_order_meta( $order_id ) {
//     if ( ! empty( $_POST['billing_full_name'] ) ) {
//         update_post_meta( $order_id, 'billing_full_name', sanitize_text_field( $_POST['billing_full_name'] ) );
//     }
// }

// add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
// function my_custom_checkout_field_process() {
//     // Проверяем, заполнено ли поле, если же нет, добавляем ошибку.
//     if ( ! $_POST['billing_full_name'] )
//         wc_add_notice( __( 'Пожалуйста, введите фио.' ), 'error' );
// }








//Валидация поля фио
// add_action( 'woocommerce_after_checkout_validation', 'truemisha_no_name_numbers', 25, 2 );
 
// function truemisha_no_name_numbers( $fields, $errors ){
	
// 	if (isset($_POST['billing_full_name']) ) {
// 		$val = explode(" ", $_POST['billing_full_name']);
// 		$l = 0;
// 		for ($i = 0; $i < count($val); $i++)
// 			if ($val[$i] != "")
// 				$l++;
// 		if ($l < 3) {
// 			$errors->add( 'validation', 'Введите полностью ФИО (необходимо для получения заказа)' );
// 		}
// 	}
// }




