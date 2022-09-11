<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package d2k
 */

get_header();
?>

	<main id="primary" class="site-main wrapper_404">

		<section class="error-404 not-found">
			<div class="img_404">
				<img class="four" src="<?php echo get_template_directory_uri() ?>/assets/img/4.svg" alt="4">
				<?php 
					$logo_id = carbon_get_theme_option('d2k_pl_logo');
					$logo = $logo_id ? wp_get_attachment_image_src($logo_id, 'full') : '';
				?>
				<img class="zero" src="<?php echo $logo[0]; ?>" alt="0">
				<img class="four" src="<?php echo get_template_directory_uri() ?>/assets/img/4.svg" alt="4">
			</div>
			<div class="text_404">
				<h1>Страница не найдена</h1>
				<hr/>
				<p>Возможно был введен неверный адрес либо страница была перемещена</p>
			</div>
		</section>

	</main>

<?php
get_footer();
