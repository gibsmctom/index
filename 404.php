<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Internet Provider
 */

get_header(); ?>

<div class="container">
    <div id="content" class="contentsecwrap">
        <section class="site-main page-not-found">
            <header class="page-header">
                <h1 class="entry-title">
                    <?php echo esc_html(get_theme_mod('internet_provider_page_not_found_heading',__('404 Not Found','internet-provider')));?>
                </h1>
            </header>
            <div class="page-content">
                <p>
                    <?php echo esc_html(get_theme_mod('internet_provider_page_not_found_content',__( 'Looks like you have taken a wrong turn.....Don\'t worry... it happens to the best of us.', 'internet-provider' ))); ?>
                </p>
            </div>
        </section>
        <div class="clear"></div>
    </div>
</div>

<?php get_footer(); ?>