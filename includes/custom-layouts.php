<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//---------------------------------------------------------------------Header

add_action('header_parts', 'd2k_header_left_menu', 10);
function d2k_header_left_menu() {
    get_template_part( 'template-parts/header/left_menu' );
}
add_action('header_parts', 'd2k_header_center', 20);
function d2k_header_center() {
    get_template_part( 'template-parts/header/center' );
}
add_action('header_parts', 'd2k_header_right_menu', 30);
function d2k_header_right_menu() {
    get_template_part( 'template-parts/header/right_menu' );
}

//---------------------------------------------------------------------Footer
add_action('footer_parts', 'd2k_footer_left', 10);
function d2k_footer_left() {
    get_template_part( 'template-parts/footer/left' );
}
add_action('footer_parts', 'd2k_footer_center', 20);
function d2k_footer_center() {
    get_template_part( 'template-parts/footer/center' );
}
add_action('footer_parts', 'd2k_footer_right', 30);
function d2k_footer_right() {
    get_template_part( 'template-parts/footer/right' );
}

//---------------------------------------------------------------------Additional elements
add_action('additional_elements', 'd2k_main_menu', 10);
function d2k_main_menu() {
    get_template_part( 'template-parts/aditional/main-menu' );
}