<?php
/*
Template Name: О нас
*/

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main about_us_wrapper">
        <div class="about_us_main">
            <header class="entry-header">
                <div class="container">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </div>
            </header>

            <div class="entry-content">
                <?php
                //the_content();
                ?>
                <div class="about_us_desc container">
                    <?php echo carbon_get_theme_option('d2k_about_us_desc') ?>
                </div>
                <div class="about_us_media">
                    <div class="fon">
                    </div>
                    <div class="container">
                        <video controls>
                            <source src="<?php echo get_template_directory_uri() ?>/assets/img/temp/video.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                            Элемент video не поддерживается вашим браузером. 
                        </video>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="about_us_feedback">
                <header class="entry-header">
                    <h1 class="entry-title">Обратная связь</h1>
                </header>
                <div class="feedback_wrapper">
                    <div class="feedback_form">
                        <?php echo do_shortcode(carbon_get_theme_option('d2k_feedback_form')) ?>
                        <div class="private_policy_wrap">Отправляя форму вы соглашаетесь с   <a href="<?php echo get_site_url( null, '', 'https' ); ?>/privacy">политикой конфиденциальности</a></div>
                    </div>
                    <hr>
                    <div class="feedback_info">
                        <div class="feedback_info_item">
                            <div class="icon">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/phone.svg" alt="phone">
                            </div>
                            <p><?php echo carbon_get_theme_option('d2k_phone') ?></p>
                        </div>
                        <div class="feedback_info_item">
                            <div class="icon">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/mail.svg" alt="mail">
                            </div>
                            <p><?php echo carbon_get_theme_option('d2k_email') ?></p>
                        </div>
                        <a href="<?php echo carbon_get_theme_option('d2k_social_vk') ?>" target="_BLANK" class="feedback_info_item">
                            <div class="icon">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/vk.svg" alt="vk">
                            </div>
                            <p><?php echo carbon_get_theme_option('d2k_social_inst_nick') ?></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
get_footer();
