<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="footer_right">
    <div class="footer_contact">
        <p><?php echo carbon_get_theme_option('d2k_phone') ?></p>
        <p><?php echo carbon_get_theme_option('d2k_email') ?></p>
    </div>
    <a href="<?php echo carbon_get_theme_option('d2k_social_vk') ?>" target="_BLANK" class="footer_social">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/vk.svg" alt="vk">
    </a>
</div>