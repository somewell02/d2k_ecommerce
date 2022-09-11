<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



// хук для регистрации
add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){
	register_taxonomy( 'size_table', [ 'product' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Таблица размеров',
			'singular_name'     => 'Таблица размеров',
			'search_items'      => 'Поиск таблицы размеров',
			'all_items'         => 'Все таблицы размеров',
			'view_item '        => 'Просмотр таблицы размеров',
			'parent_item'       => '',
			'parent_item_colon' => '',
			'edit_item'         => 'Редактирование таблицы размеров',
			'update_item'       => 'Обновить таблицу размеров',
			'add_new_item'      => 'Добавить таблицу размеров',
			'new_item_name'     => 'Новая таблица размеров',
			'menu_name'         => 'Таблицы размеров',
		],
		'description'           => 'Таблица рамзеров', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		//'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical'          => false,

		'rewrite'               => true,
		'query_var'             => true, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'			=> true,
		//'update_count_callback' => '_update_post_term_count',
	] );
}


remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );




function format_phone($phone = '')
{ 
    // Perform phone number formatting here
    if (strlen($phone) == 7) {
        $phone = preg_replace("/([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1-$2", $phone);
    } elseif (strlen($phone) == 10) {
        $phone = preg_replace("/([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "($1) $2-$3", $phone);
    } elseif (strlen($phone) == 11) {
        $phone = preg_replace("/([0-9a-zA-Z]{1})([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{2})([0-9a-zA-Z]{2})/", "$1 ($2) $3-$4-$5", $phone);
    }

	if ($phone[0] = 7) {
		for ($i = strlen($phone); $i > 0; $i--) {
			$phone[$i] = $phone[$i-1];
		}
		$phone[0] = "+";
	}
 
    return $phone;
}