<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Internet Provider
 */
?>
<div id="footer">
  <?php 
    $internet_provider_footer_widget_enabled = get_theme_mod('internet_provider_footer_widget', true);      
    if ($internet_provider_footer_widget_enabled !== false && $internet_provider_footer_widget_enabled !== '') { ?>

    <?php 
        $internet_provider_widget_areas = get_theme_mod('internet_provider_footer_widget_areas', '4');
        if ($internet_provider_widget_areas == '3') {
            $internet_provider_cols = 'col-lg-4 col-md-6';
        } elseif ($internet_provider_widget_areas == '4') {
            $internet_provider_cols = 'col-lg-3 col-md-6';
        } elseif ($internet_provider_widget_areas == '2') {
            $internet_provider_cols = 'col-lg-6 col-md-6';
        } else {
            $internet_provider_cols = 'col-lg-12 col-md-12';
        }
    ?>

    <div class="footer-widget">
        <div class="container">
        <div class="row">
            <!-- Footer 1 -->
            <div class="<?php echo esc_attr($internet_provider_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <aside id="categories" class="widget pb-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'internet-provider'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Categories', 'internet-provider'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 2 -->
            <div class="<?php echo esc_attr($internet_provider_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <aside id="archives" class="widget pb-3" role="complementary" aria-label="<?php esc_attr_e('footer2', 'internet-provider'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Archives', 'internet-provider'); ?></h3>
                        <ul>
                            <?php wp_get_archives(array('type' => 'monthly')); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 3 -->
            <div class="<?php echo esc_attr($internet_provider_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <aside id="meta" class="widget pb-3" role="complementary" aria-label="<?php esc_attr_e('footer3', 'internet-provider'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Meta', 'internet-provider'); ?></h3>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <?php wp_meta(); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 4 -->
            <div class="<?php echo esc_attr($internet_provider_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php else : ?>
                    <aside id="search-widget" class="widget pb-3" role="complementary" aria-label="<?php esc_attr_e('footer4', 'internet-provider'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Search', 'internet-provider'); ?></h3>
                        <?php the_widget('WP_Widget_Search'); ?>
                    </aside>
                <?php endif; ?>
            </div>
        </div>
        </div>
    </div>

    <?php } ?>
    <div class="clear"></div>

  <div class="copywrap text-center">
    <div class="container">
      <a href="<?php echo esc_html(get_theme_mod('internet_provider_copyright_link',__('https://www.theclassictemplates.com/products/free-internet-provider-wordpress-theme','internet-provider'))); ?>" target="_blank"><?php echo esc_html(get_theme_mod('internet_provider_copyright_line',__('Internet Provider WordPress Theme','internet-provider'))); ?></a> <?php echo esc_html('By Classic Templates','internet-provider'); ?>
    </div>
  </div>
</div>

<?php if(get_theme_mod('internet_provider_scroll_hide',true)){ ?>
    <a id="button"><?php echo esc_html( get_theme_mod('internet_provider_scroll_text',__('TOP', 'internet-provider' )) ); ?></a>
<?php } ?>
  
<?php wp_footer(); ?>
</body>
</html>