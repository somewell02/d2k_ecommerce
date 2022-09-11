<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

remove_all_actions('woocommerce_archive_description');
remove_all_actions('woocommerce_before_main_content');
remove_all_actions('woocommerce_before_shop_loop');
remove_all_actions('woocommerce_after_shop_loop');
remove_all_actions('woocommerce_no_products_found');
remove_all_actions('woocommerce_after_main_content');

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

add_action('woocommerce_after_shop_loop_item', 'remove_add_to_cart', 1);
function remove_add_to_cart() {
    if (!is_shop() && !is_home()) {
        add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    }
}
add_action('woocommerce_after_shop_loop_item_title', 'remove_price', 1);
function remove_price() {
    if (!is_shop() && !is_home()) {
        add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    }
}



add_action('woocommerce_before_shop_loop', 'd2k_loop_start', 10);
function d2k_loop_start() {
    ?>
        <div class="shop_catalog">
            
    <?
}

add_action('woocommerce_after_shop_loop', 'd2k_loop_end', 10);
function d2k_loop_end() {
    ?>
            <div class="nav_buttons container big_container">
                <div class="button left_button hide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/long-arrow.svg" alt="arrow"></div>
                <div class="button right_button hide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/long-arrow.svg" alt="arrow"></div>
            </div>
        </div>
    <?
}


add_action('woocommerce_shop_loop_item_title', 'd2k_title_star', 5);
function d2k_title_star() {
    ?>
        <div class="fon"></div>
        <div class="product_description">
    <?
}

add_action('woocommerce_shop_loop_item_title', 'd2k_add_excerpt', 1);
function d2k_add_excerpt() {
    if (is_shop() || is_home()) {
        add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_single_excerpt', 15);
        add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 21);
    }
}
add_action('woocommerce_shop_loop_item_title', 'd2k_loop_add_additional_name', 12);
function d2k_loop_add_additional_name() {
    if (is_shop() || is_home()) {
        global $post;
        // $terms = get_terms( [
        //     'taxonomy' => 'product_tag',
        //     'include'  => $product->get_tag_ids()
        // ] );
        ?>
                <p class="additional_name"><?php echo get_post_meta( $post->ID, 'product_additional_name', true );?></p>
        <?
    }
}
add_action('woocommerce_shop_loop_item_title', 'd2k_loop_add_hr', 20);
function d2k_loop_add_hr() {
    if (is_shop() || is_home()) {
        ?>
            <hr>
        <?
    }
}
add_action('woocommerce_shop_loop_item_title', 'd2k_loop_add_price', 22);
function d2k_loop_add_price() {
    if (is_shop() || is_home()) {
        ?>
            </div>
            <div class="product_more">
                Подробнее
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/short-arrow.svg" alt="arrow">
            </div>
        <?
    }
}


add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
	return array(
	'width' => '3000px',
	'height' => '1000px',
	'crop' => 0,
	);
});
 



add_filter('gettext', 'translate_tag_taxonomy');
add_filter('ngettext', 'translate_tag_taxonomy');
 
function translate_tag_taxonomy($translated) {
 
    $translated = str_ireplace('Метка:', 'Коллекция:', $translated);
  
    return $translated;
}