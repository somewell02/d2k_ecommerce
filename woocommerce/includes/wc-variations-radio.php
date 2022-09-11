<?php

class WC_Radio_Buttons {
	// plugin version
	const VERSION = '2.0.0';

	private $plugin_path;
	private $plugin_url;

	public function __construct() {
		add_filter( 'woocommerce_locate_template', array( $this, 'locate_template' ), 10, 3 );

		//js scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ), 999 );
	}

	public function get_plugin_path() {

		if ( $this->plugin_path ) {
			return $this->plugin_path;
		}

		return $this->plugin_path = plugin_dir_path( __FILE__ );
	}

	public function get_plugin_url() {

		if ( $this->plugin_url ) {
			return $this->plugin_url;
		}

		return $this->plugin_url = plugin_dir_url( __FILE__ );
	}

	public function locate_template( $template, $template_name, $template_path ) {
		global $woocommerce;

		$_template = $template;

		if ( ! $template_path ) {
			$template_path = $woocommerce->template_url;
		}

		$plugin_path = $this->get_plugin_path() . 'templates/';

		// Look within passed path within the theme - this is priority
		$template = locate_template( array(
			$template_path . $template_name,
			$template_name
		) );

		// Modification: Get the template from this plugin, if it exists
		if ( ! $template && file_exists( $plugin_path . $template_name ) ) {
			$template = $plugin_path . $template_name;
		}

		// Use default template
		if ( ! $template ) {
			$template = $_template;
		}

		return $template;
	}

	function load_scripts() {
		// Don't load JS if current product type is bundle to prevent the page from not working
		if (!(wc_get_product() && wc_get_product()->is_type('bundle'))) {
			wp_deregister_script( 'wc-add-to-cart-variation' );
			wp_register_script( 'wc-add-to-cart-variation', get_template_directory_uri() . '/assets/js/add-to-cart-variation.js', array( 'jquery', 'wp-util' ), self::VERSION );
		}
	}
}

new WC_Radio_Buttons();

if ( ! function_exists( 'print_attribute_radio' ) ) {
	function print_attribute_radio( $checked_value, $value, $label, $name ) {
		global $product;
			

		$input_name = 'attribute_' . esc_attr( $name ) ;
		$esc_value = esc_attr( $value );
		$id = esc_attr( $name . '_v_' . $value . $product->get_id() ); //added product ID at the end of the name to target single products
		$checked = checked( $checked_value, $value, false );
		$filtered_label = apply_filters( 'woocommerce_variation_option_name', $label, esc_attr( $name ) );


		foreach ( $product->get_available_variations() as $variation ) {
			$attribute = array();
			foreach ( $variation[ 'attributes' ] as $name => $value ) {
				$attribute[] = $value;
			}
			if (join( ', ', $attribute ) == $esc_value) {
				$is_in_stock = explode('"', $variation['availability_html'])[1];
				if (get_post_meta( $product->get_id(), 'preorder_title_product', true ))
					$pt = get_post_meta( $product->get_id(), 'preorder_title_product', true );
				else
					$pt = carbon_get_theme_option('d2k_preorder_title_product');
				$preorder_text = 'style="--after-content: \''.$pt.'\';"';
			}
		}

		printf( '<div class="%1$s" %2$s><input type="radio" name="%3$s" value="%4$s" id="%5$s" %6$s><label for="%5$s">%7$s</label></div>', $is_in_stock, $preorder_text, $input_name, $esc_value, $id, $checked, $filtered_label);
	}
}