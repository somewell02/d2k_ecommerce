<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package d2k
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-site-verification" content="gIlycXoCI1ZWZ7n6JS5Ifcw60aKOHiyIUar0A_xUlP0" />
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<?php wp_head(); ?>

	<!-- Facebook Pixel Code --> 
<script> 
!function(f,b,e,v,n,t,s) 
{if(f.fbq)return;n=f.fbq=function(){n.callMethod? 
n.callMethod.apply(n,arguments):n.queue.push(arguments)}; 
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; 
n.queue=[];t=b.createElement(e);t.async=!0; 
t.src=v;s=b.getElementsByTagName(e)[0]; 
s.parentNode.insertBefore(t,s)}(window, document,'script', 
'https://connect.facebook.net/en_US/fbevents.js'); 
fbq('init', '860064891287810'); 
fbq('track', 'PageView'); 
</script> 
<noscript><img height="1" width="1" style="display:none" 
src="https://www.facebook.com/tr?id=860064891287810&ev=PageView&noscript=1" 
/></noscript> 
<!-- End Facebook Pixel Code -->
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if (is_shop() || is_product() || is_home()) :?>
<div id="preloader" class="preloader_wrapper">
	<div class="preloader">
		<div class="preloader_content">
			<?php 
				$logo_id = carbon_get_theme_option('d2k_pl_logo');
				$logo = $logo_id ? wp_get_attachment_image_src($logo_id, 'full') : '';
			?>
			<img class="logo" src="<?php echo $logo[0]; ?>" alt="logo">
			<!-- <p class="title"><?php echo carbon_get_theme_option('d2k_pl_title') ?></p>
			<hr>
			<p class="slogan"><?php echo carbon_get_theme_option('d2k_pl_slogan') ?></p> -->
		</div>
	</div>
</div>
<? endif; ?>

<div id="page" class="main_wrapper">

	<header id="masthead" class="main_header <?php if (is_shop() || is_home()) echo "pfixed"; ?> <?php if (!is_shop() && !is_product() && !is_home()) echo "header_fon"; ?>">
		<div class="container <?php if (is_shop() || is_home()) echo "big_container"; ?>">
			<?php do_action('header_parts'); ?>
		</div>
	</header>
