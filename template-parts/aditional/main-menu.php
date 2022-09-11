<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="main_menu_wrapper hide_menu">
	<div class="close_button hide_menu"><img src="<? echo get_template_directory_uri() ?>/assets/img/icons/close.svg" alt="close"></div>
	<a href="<?php echo carbon_get_theme_option('d2k_social_inst') ?>" target="_BLANK" class="inst_button hide_menu"><img src="<? echo get_template_directory_uri() ?>/assets/img/icons/inst.svg" alt="inst"></a>
	<? d2k_primary_menu() ?>
</div>