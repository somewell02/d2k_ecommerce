<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package d2k
 */

 
get_header();
?>

	<main id="primary" class="site-main product_wrapper">
		<div class="shop_catalog">
            <?php echo do_shortcode("[products]"); ?>
            <div class="nav_buttons container big_container">
                <div class="button left_button hide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/long-arrow.svg" alt="arrow"></div>
                <div class="button right_button hide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/long-arrow.svg" alt="arrow"></div>
            </div>
		</div>
	</main><!-- #main -->

<?php
get_footer();

//header('Location: ' . home_url('/') . 'shop');
