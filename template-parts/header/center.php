<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="main_logo header_logo">
    <?php 
        $logo_id = carbon_get_theme_option('d2k_logo');
        $logo = $logo_id ? wp_get_attachment_image_src($logo_id, 'full') : '';
    ?>
    <a href="<?php echo home_url('/');?>">
        <img src="<?php echo $logo[0]; ?>" alt="logo">
    </a>
</div>