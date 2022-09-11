<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package d2k
 */

?>

	<? if (!is_shop() && !is_404() && !is_home()) : ?>
	<footer id="colophon" class="main_footer">
		<div class="container">
			<?php do_action('footer_parts'); ?>			
		</div>
	</footer>
	<? endif; ?>
</div>

<?php do_action('additional_elements'); ?>


<?php wp_footer(); ?>


<?php if( is_checkout() ) :	?>
	<script>
	jQuery(function($){
		$('body').on('blur change', '#billing_full_name', function(){
			var wrapper = $(this).closest('.form-row');
			var val = $(this).val().split(" ");
			var l = 0;
			for (var i = 0; i < val.length; i++)
				if (val[i] != "")
					l++;
			if( l < 3 ) {
				wrapper.addClass('woocommerce-invalid');
			} else {
				wrapper.addClass('woocommerce-validated');
			}
		});

		// $('body').on('submit', '#checkout', function(){
		// 	var wrapper = $("#billing_address_1_field");
		// 	if( $("#billing_address_1").val() ) {
		// 		wrapper.addClass('woocommerce-validated');
		// 	} else {
		// 		wrapper.addClass('woocommerce-invalid');
		// 	}
		// });
		
	

	});
	</script>
<?php endif; ?>
</body>
</html>
