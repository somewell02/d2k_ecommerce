<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_filter( 'upload_mimes', 'svg_upload_allow' );
# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	// WP 5.1 +
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	else
		$dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );

	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if( $dosvg ){

		// разрешим
		if( current_user_can('manage_options') ){

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		// запретим
		else {
			$data['ext'] = $type_and_ext['type'] = false;
		}

	}

	return $data;
}


# ограничиваем размер загружаемых файлов по типу
add_filter( 'wp_handle_sideload'.'_prefilter', 'check_file_upload_size' );
add_filter( 'wp_handle_upload'.'_prefilter', 'check_file_upload_size' );

function check_file_upload_size( $file ){

	// для SVG
	if( false !== strpos( $file['type'], 'image/svg+xml') ){
		$size_limit = 50; // макс размер в KB
	}

	if( isset($size_limit) ){
		$size_limit *= 1024;
		if( intval($file['size']) > $size_limit )
			$file['error'] = 'ERROR: Размер этого типа файлов не может превышать '. size_format( $size_limit );
	}

	return $file;
}