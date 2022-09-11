<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}




add_action( 'wp_enqueue_scripts', 'd2k_scripts' );
function d2k_scripts() {
	wp_enqueue_script( 'd2k-main', get_template_directory_uri() . '/assets/js/index.js', array() , _S_VERSION, true);
	wp_enqueue_script( 'd2k-scroll', get_template_directory_uri() . '/assets/js/scroll.js', array(), true);
	wp_enqueue_script( 'd2k-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}



add_action( 'wp_enqueue_scripts', 'd2k_styles' );
function d2k_styles() {
	wp_enqueue_style( 'd2k-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style('d2k-media-queries', get_template_directory_uri() . '/assets/css/media.css', array() , null, 'all');
}
