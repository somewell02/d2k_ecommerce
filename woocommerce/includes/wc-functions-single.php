<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_all_actions('woocommerce_after_single_product_summary');

//remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);




add_action('woocommerce_before_main_content', 'd2k_product_wrapper_start', 10);
function d2k_product_wrapper_start() {
    ?>
	    <main id="primary" class="site-main product_wrapper">
    <?
}

add_action('woocommerce_after_main_content', 'd2k_product_wrapper_end', 10);
function d2k_product_wrapper_end() {
    ?>
	    </main>
    <?
}


add_action('woocommerce_single_product_summary', 'd2k_product_content_start', 1);
function d2k_product_content_start() {
    global $product;
    $post = $product->id;
    echo get_the_post_thumbnail( $post, 'full', array('class' => 'product_img_fon') );
    ?>
        <div class="fon"></div>
        <div class="product_main_content">

    <?
}

add_action('woocommerce_single_product_summary', 'd2k_product_content_end', 60);
function d2k_product_content_end() {
    ?>
        </div>
    <?
}



add_action('woocommerce_single_product_summary', 'd2k_product_price_wrapper_start', 24);
function d2k_product_price_wrapper_start() {
    ?>
    <div class="product_block_header">
	    <div class="price_wrapper">
    <?
}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 25);

add_action('woocommerce_single_product_summary', 'd2k_product_price_wrapper_end', 26);
function d2k_product_price_wrapper_end() {
    ?>
        <div class="varition_price"></div>
    <?
}

add_action('woocommerce_single_product_summary', 'd2k_product_discount_percent', 27);
function d2k_product_discount_percent() {
    
    ?>
            <!-- <div class="discount"> -20% </div> -->
	    </div>
    <?
}




add_action('woocommerce_single_product_summary', 'd2k_product_content_left_start', 3);
function d2k_product_content_left_start() {
    ?>
	    <div class="product_content_block product_content_left">
    <div class="product_block_header">
    <?
}

add_action('woocommerce_single_product_summary', 'd2k_product_content_left_end', 22);
function d2k_product_content_left_end() {
    ?>
	    </div>
    <?
}


add_action('woocommerce_single_product_summary', 'd2k_product_content_right_start', 23);
function d2k_product_content_right_start() {
    ?>
	    <div class="product_content_block product_content_right">
    <?
}

add_action('woocommerce_single_product_summary', 'd2k_product_content_right_end', 40);
function d2k_product_content_right_end() {
    ?>
	    </div>
    <?
}

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 6);

add_action('woocommerce_single_product_summary', 'd2k_product_content_hr', 28);
add_action('woocommerce_single_product_summary', 'd2k_product_content_hr', 7);
function d2k_product_content_hr() {
    ?>
	    <hr>
        </div>
    <?
}



add_action('woocommerce_single_product_summary', 'd2k_show_more_button', 21);
function d2k_show_more_button() {
    ?>
        <button class="product_show_more">Подробнее <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/short-arrow.svg" alt="arrow"></button>
    <?
}



add_action('woocommerce_single_variation', 'd2k_sizes_form', 15);
function d2k_sizes_form() {
    global $product;
    $terms = get_the_terms( $product->ID, 'size_table' );
    ?>
        <div class="sizes_table_button"> <p>Таблица размеров</p> </div>
        <div class="sizes_table_wrapper">
            <div class="fon"></div>
            <div class="sizes_table">
                <h3 class="title"><?php echo $terms[0]->name; ?></h3>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/close.svg" alt="close" class="close">
                <div class="size_table">
                    <?php
                       echo $terms[0]->description;
                    ?>
                </div>
            </div>
        </div>
    <?
}





add_action('woocommerce_after_single_product_summary', 'woocommerce_show_product_images', 10);
add_action('woocommerce_after_single_product_summary', 'd2k_product_bottom_start', 5);
function d2k_product_bottom_start() { 
    ?>
    <div class="product_desc_wrapper container">
        <div class="product_desc_left">
            <div class="product_gallery_wrapper">
    <?
}
add_action('woocommerce_after_single_product_summary', 'd2k_product_right_start', 30);
function d2k_product_right_start() {
    ?>
    <div class="product_desc_right">
    <?
}

add_action('woocommerce_after_single_product_summary', 'd2k_product_bottom_end', 12);
add_action('woocommerce_after_single_product_summary', 'd2k_product_bottom_end', 49);
add_action('woocommerce_after_single_product_summary', 'd2k_product_bottom_end', 50);
function d2k_product_bottom_end() {
    ?>
    </div>
    <?
}



add_action('woocommerce_after_single_product_summary', function () { ?>
    <div class="upsell_wrapper container">
<?}, 58);
add_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 60);
add_action('woocommerce_after_single_product_summary', function () { ?>
    </div>
<?}, 62);


add_filter('woocommerce_product_upsells_products_heading', 'change_up_sells_title');
function change_up_sells_title() {
	return carbon_get_theme_option('d2k_up_sells_title');
}


add_action('woocommerce_after_single_product_summary', 'd2k_product_gallery_end', 15);
function d2k_product_gallery_end() {
    ?>
        <a href="<? echo get_site_url(); ?>/delivery" class="delivery_and_refund"><img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/fast.svg" alt="delivery">Доставка и возврат</a>
    </div>
    <?
}




add_action('woocommerce_after_single_product_summary', 'd2k_product_gallery_arrows', 11);
function d2k_product_gallery_arrows() {
    global $product;
    if (count($product->get_gallery_image_ids()) > 1) :
    ?>
    <div class="gallery_nav_arrow right_arrow">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/short-arrow.svg" alt="arrow">
    </div>
    <div class="gallery_nav_arrow left_arrow">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/short-arrow.svg" alt="arrow">
    </div>
    <?
    endif;
}


add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 40);

add_filter('woocommerce_product_description_heading', 'd2k_heading_tabs_remove');
add_filter('woocommerce_reviews_title', 'd2k_heading_tabs_remove');
add_filter('woocommerce_product_pwb_tab_title', 'd2k_heading_tabs_remove');
function d2k_heading_tabs_remove($header) {
    $header = false;
    return $header;
}

add_filter( 'woocommerce_product_tabs', 'd2k_tabs', 10);
function d2k_tabs($product_tabs) {
     foreach ( $product_tabs as $key => $product_tab ) :
        if ($key == 'description') : ?>
        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
            <?php
                call_user_func( $product_tab['callback'], $key, $product_tab );
            ?>
        </div>
    <?php 
        endif;
    endforeach; 
    
    global $post;
	$additional_1 = get_post_meta( $post->ID, 'additional_1', true );
	$additional_1_title = get_post_meta( $post->ID, 'additional_1_title', true );
	$additional_2 = get_post_meta( $post->ID, 'additional_2', true );
	$additional_2_title = get_post_meta( $post->ID, 'additional_2_title', true );
	$additional_3 = get_post_meta( $post->ID, 'additional_3', true );
	$additional_3_title = get_post_meta( $post->ID, 'additional_3_title', true );
	?>
	<div class="product_additional_tabs">
        <? if($additional_1_title && $additional_1) : ?>
            <div class="product_tab" data-open="true">
                <div class="title">
                    <?php echo $additional_1_title; ?>
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/short-arrow.svg" alt="arrow">
                </div>
                <div class="description">
                    <?php echo $additional_1; ?>
                </div>
            </div>
        <? endif; ?>
        <? if($additional_2_title && $additional_2) : ?>
            <div class="product_tab" data-open="false">
                <div class="title">
                    <?php echo $additional_2_title; ?>
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/short-arrow.svg" alt="arrow">
                </div>
                <div class="description">
                    <?php echo $additional_2; ?>
                </div>
            </div>
        <? endif; ?>
        <? if($additional_3_title && $additional_3) : ?>
            <div class="product_tab" data-open="false">
                <div class="title">
                    <?php echo $additional_3_title; ?>
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/short-arrow.svg" alt="arrow">
                </div>
                <div class="description">
                    <?php echo $additional_3; ?>
                </div>
            </div>
        <? endif; ?>
	</div>
	<?php
}





//Удаляем зум в галерее
add_action('after_setup_theme', 'remove_zoom_theme_support', 100);
function remove_zoom_theme_support() {
    remove_theme_support('wc-product-gallery-zoom');
}




add_filter( 'woocommerce_reset_variations_link', function() {return false;});




add_action('woocommerce_after_single_product', 'd2k_product_back_to_shop', 20);
function d2k_product_back_to_shop () {
    ?>
        <div class="back_to_shop_wrapper"><a href="/shop" class="back_to_shop"><img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/to_catalog.svg" alt="catalog"></a></div>
    <?
}





add_action( 'woocommerce_product_options_advanced', 'd2k_add_custom_pt_fields' );
function d2k_add_custom_pt_fields() {
	global $product, $post;
	echo '<div class="options_group">';
	woocommerce_wp_text_input( array(
		'id'                => 'product_additional_name',
		'label'             => __( 'Название товара' ),
		'placeholder'       => '',
		'description'       => __( '', 'woocommerce' ),
		'type'              => 'text',
		'custom_attributes' => array(
		   'step' => 'any',
		   'min'  => '0',
		),
	 ) );
	woocommerce_wp_text_input( array(
		'id'                => 'preorder_title_product',
		'label'             => __( 'Предупреждение предзаказа в товаре', 'woocommerce' ),
		'placeholder'       => '',
		'description'       => __( '', 'woocommerce' ),
		'type'              => 'text',
		'custom_attributes' => array(
		   'step' => 'any',
		   'min'  => '0',
		),
	 ) );
	woocommerce_wp_text_input( array(
		'id'                => 'preorder_title_cart',
		'label'             => __( 'Предупреждение предзаказа в корзине' ),
		'placeholder'       => '',
		'description'       => __( '', 'woocommerce' ),
		'type'              => 'text',
		'custom_attributes' => array(
		   'step' => 'any',
		   'min'  => '0',
		),
	 ) );
	echo '</div>';
}



add_action('add_meta_boxes', 'd2k_extra_fields', 1);

function d2k_extra_fields() {
	add_meta_box( 'extra_fields', 'Дополнительные вкладки', 'd2k_add_custom_fields', 'product', 'advanced', 'low' );
}

function d2k_add_custom_fields() {
	global $product, $post;
	?>
    <h2 style="font-weight:500;font-size:18px;">Вкладка 1</h2>
	<div class="options_group">
		<?php
        woocommerce_wp_text_input( array(
            'id'                => 'additional_1_title',
            'placeholder'       => 'Заголовок вкладки',
            'type'              => 'text',
            'custom_attributes' => array(
               'step' => 'any',
               'min'  => '0',
            ),
         ) );
		wp_editor(get_post_meta( $post->ID, 'additional_1', true ), 'additional1', array(
			'wpautop'       => 1,
			'media_buttons' => 1,
			'textarea_name' => 'additional_1',
			'textarea_rows' => 5,
			'tabindex'      => null,
			'editor_css'    => '<style>.quicktags-toolbar, .wp-editor-tools, .wp-switch-editor {padding: 5px 10px;}</style>',
			'editor_class'  => 'form-field',
			'teeny'         => 0,
			'dfw'           => 0,
			'tinymce'       => 1,
			'quicktags'     => 1,
			'drag_drop_upload' => false
		) );
		
		?>
	</div>
    <h2 style="font-weight:500;font-size:18px;">Вкладка 2</h2>
    <div class="options_group">
		<?php
        woocommerce_wp_text_input( array(
            'id'                => 'additional_2_title',
            'placeholder'       => 'Заголовок вкладки',
            'type'              => 'text',
            'custom_attributes' => array(
               'step' => 'any',
               'min'  => '0',
            ),
         ) );
		wp_editor(get_post_meta( $post->ID, 'additional_2', true ), 'additional2', array(
			'wpautop'       => 1,
			'media_buttons' => 1,
			'textarea_name' => 'additional_2',
			'textarea_rows' => 5,
			'tabindex'      => null,
			'editor_css'    => '<style>.quicktags-toolbar, .wp-editor-tools, .wp-switch-editor {padding: 5px 10px;}</style>',
			'editor_class'  => 'form-field',
			'teeny'         => 0,
			'dfw'           => 0,
			'tinymce'       => 1,
			'quicktags'     => 1,
			'drag_drop_upload' => false
		) );
		
		?>
	</div>
    <h2 style="font-weight:500;font-size:18px;">Вкладка 3</h2>
    <div class="options_group">
		<?php
        woocommerce_wp_text_input( array(
            'id'                => 'additional_3_title',
            'placeholder'       => 'Заголовок вкладки',
            'type'              => 'text',
            'custom_attributes' => array(
               'step' => 'any',
               'min'  => '0',
            ),
         ) );
		wp_editor(get_post_meta( $post->ID, 'additional_3', true ), 'additional3', array(
			'wpautop'       => 1,
			'media_buttons' => 1,
			'textarea_name' => 'additional_3',
			'textarea_rows' => 5,
			'tabindex'      => null,
			'editor_css'    => '<style>.quicktags-toolbar, .wp-editor-tools, .wp-switch-editor {padding: 5px 10px;}</style>',
			'editor_class'  => 'form-field',
			'teeny'         => 0,
			'dfw'           => 0,
			'tinymce'       => 1,
			'quicktags'     => 1,
			'drag_drop_upload' => false
		) );
		
		?>
	</div>
    <?php
}


add_action( 'woocommerce_process_product_meta', 'd2k_custom_fields_save', 10 );
function d2k_custom_fields_save( $post_id ) {
   // Сохранение цифрового поля   
   update_post_meta( $post_id, 'product_additional_name', esc_attr( $_POST['product_additional_name'] ) );
   update_post_meta( $post_id, 'preorder_title_product', esc_attr( $_POST['preorder_title_product'] ) );
   update_post_meta( $post_id, 'preorder_title_cart', esc_attr( $_POST['preorder_title_cart'] ) );

	// Сохранение области тектса
	$woocommerce_textarea = $_POST['additional_1'];
	if ( ! empty( $woocommerce_textarea ) ) {
		update_post_meta( $post_id, 'additional_1', $woocommerce_textarea );
	}
	$woocommerce_textarea = $_POST['additional_1_title'];
	if ( ! empty( $woocommerce_textarea ) ) {
		update_post_meta( $post_id, 'additional_1_title', $woocommerce_textarea );
	}

    $woocommerce_textarea = $_POST['additional_2'];
	if ( ! empty( $woocommerce_textarea ) ) {
		update_post_meta( $post_id, 'additional_2', $woocommerce_textarea );
	}
	$woocommerce_textarea = $_POST['additional_2_title'];
	if ( ! empty( $woocommerce_textarea ) ) {
		update_post_meta( $post_id, 'additional_2_title', $woocommerce_textarea );
	}

    $woocommerce_textarea = $_POST['additional_3'];
	if ( ! empty( $woocommerce_textarea ) ) {
		update_post_meta( $post_id, 'additional_3', $woocommerce_textarea );
	}
	$woocommerce_textarea = $_POST['additional_3_title'];
	if ( ! empty( $woocommerce_textarea ) ) {
		update_post_meta( $post_id, 'additional_3_title', $woocommerce_textarea );
	}
}



add_filter('woocommerce_single_product_image_thumbnail_html', 'remove_featured_image', 10, 2);
function remove_featured_image($html, $attachment_id ) {
    global $post, $product;
    if (count($product->get_gallery_image_ids()) > 0) {
        $featured_image = get_post_thumbnail_id( $post->ID );

        if ( $attachment_id == $featured_image )
            $html = '';
    }

    return $html;
}




add_filter( 'woocommerce_get_image_size_single', function( $size ) {
	return array(
	'width' => '800px',
	'height' => '800px',
	'crop' => 0,
	);
});
