<?php

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'includes/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'carbon_fields_register_fields', 'estore_register_custom_fields' );
function estore_register_custom_fields() {
	require get_template_directory() . '/includes/custom-fields-options/metabox.php';
	require get_template_directory() . '/includes/custom-fields-options/theme-options.php';
}

require get_template_directory() . '/includes/theme-settings.php';

require get_template_directory() . '/includes/widget-areas.php';

require get_template_directory() . '/includes/enqueue-scripts-styles.php';

require get_template_directory() . '/includes/helpers.php';

require get_template_directory() . '/includes/navigations.php';

require get_template_directory() . '/includes/custom-layouts.php';

require get_template_directory() . '/includes/svg-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/includes/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/includes/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/includes/woocommerce.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-remove.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-cart.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-archive.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-single.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-checkout.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-thankyou.php';
	require get_template_directory() . '/woocommerce/includes/wc-variations-radio.php';
}



//отключение расстановки тегов параграфов start 
remove_filter('the_content', 'wpautop');     //записи
remove_filter('the_excerpt', 'wpautop');     //цитаты
remove_filter('comment_text', 'wpautop');    //комментарии
//отключение расстановки тегов параграфов end


//отключение типографских замен start 
remove_filter('the_content', 'wptexturize');     //записи
remove_filter('the_excerpt', 'wptexturize');     //цитаты
remove_filter('comment_text', 'wptexturize');    //комментарии
//отключение типографских замен end


//отключение форматирования слова WordPress start 
remove_filter('the_content', 'capital_P_dangit',11);    //записи
remove_filter('the_excerpt', 'capital_P_dangit',11);    //цитаты
remove_filter('comment_text', 'capital_P_dangit',31);   //комментарии
//отключение форматирования слова WordPress end


add_action('admin_menu', 'remove_menus');
function remove_menus(){
	global $menu;
	$restricted = array(
		__('Posts'),
		__('Comments')
	);
	end ($menu);
	while (prev($menu)){
		$value = explode(' ', $menu[key($menu)][0]);
		if( in_array( ($value[0] != NULL ? $value[0] : "") , $restricted ) ){
			unset($menu[key($menu)]);
		}
	}
}
