<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package d2k
 */

?>

<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header<? if(is_checkout() && !explode('/', explode('?', $_SERVER['REQUEST_URI'])[0])[2]) echo " checkout_header" ?>">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if(is_checkout() && !explode('/', explode('?', $_SERVER['REQUEST_URI'])[0])[2]) { ?>
			<a href="<? echo get_site_url(); ?>/cart" class="delivery_and_refund"><img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/cart.svg" alt="cart">Вернуться в корзину</a>
		<? }; ?>
	</header>

	<?php d2k_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'd2k' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'd2k' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>
</article>
