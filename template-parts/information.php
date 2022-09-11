<?php
/*
Template Name: Информация
*/

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Информация</h1>
            </header>
            <div class="entry-content information_content_wrapper">
                <?php d2k_secodary_menu() ?>
                <div class="information_content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
get_footer();
