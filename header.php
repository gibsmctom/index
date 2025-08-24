<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Internet Provider
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
} else {
  do_action( 'wp_body_open' );
} ?>

<?php if ( get_theme_mod('internet_provider_preloader', false) != "") { ?>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
<?php }?>

<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'internet-provider' ); ?></a>

<div id="pageholder" <?php if( get_theme_mod( 'internet_provider_box_layout', false) != "") { echo 'class="boxlayout"'; } ?>>

<div class="header">
  <?php if ( get_theme_mod('internet_provider_topbar', true) != "") { ?>
    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 col-md-9 align-self-center">
            <?php $blog_info = get_bloginfo( 'name' ); ?>
              <?php if ( ! empty( $blog_info ) ) : ?>
                <?php $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                  <?php if ( get_theme_mod('internet_provider_tagline_enable',true) != "") { ?>
                  <p class="site-description"><?php echo esc_html( $description ); ?></p>
                  <?php } ?>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          <div class="col-lg-2 col-md-3 align-self-center text-lg-end">
            <?php if(class_exists('woocommerce')){ ?>
              <span class="product-account text-center ">
                <?php if ( is_user_logged_in() ) { ?>
                  <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','internet-provider'); ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
                <?php } 
                else { ?>
                  <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login / Register','internet-provider'); ?>"><i class="fas fa-user"></i></a>
                <?php } ?>
              </span>
            <?php }?>
              <?php if(class_exists('woocommerce')){ ?> 
                <span class="product-cart text-center position-relative">
                  <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','internet-provider' ); ?>"><i class="fas fa-shopping-basket"></i></a>
                </span>
              <?php }?>
              <span class="search-box text-center">
                <?php if(get_theme_mod('internet_provider_search_option',true) != ''){ ?>
                  <button type="button" class="search-open"><i class="fas fa-search"></i></button>
                <?php }?>
              </span>
          </div>
          <div class="search-outer">
            <div class="serach_inner w-100 h-100">
              <?php get_search_form(); ?>
            </div>
            <button type="button" class="search-close"><span>X</span></button>
          </div>
        </div>
      </div>
    </div>
  <?php }?>
  <div class="container">
    <div class="bg-inner <?php echo esc_attr(internet_provider_sticky_menu()); ?>">
      <div class="row">
        <div class="col-lg-3 col-md-6 align-self-center">
          <div class="logo">
            <?php internet_provider_the_custom_logo(); ?>
            <?php $blog_info = get_bloginfo( 'name' ); ?>
            <?php if ( ! empty( $blog_info ) ) : ?>
              <?php if ( get_theme_mod('internet_provider_title_enable',false) != "") { ?>
                <?php if ( is_front_page() && is_home() ) : ?>
                  <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1> 
                <?php else : ?>
                  <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
              <?php endif; ?>
            <?php } ?>
          <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-8 col-md-6 align-self-center menubox">
          <div class="toggle-nav text-lg-end">
              <button role="tab"><?php esc_html_e('MENU','internet-provider'); ?></button>
          </div>
          <div id="mySidenav" class="nav sidenav text-start text-lg-center">
            <nav id="site-navigation" class="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu','internet-provider' ); ?>">
              <?php 
                wp_nav_menu( array( 
                  'theme_location' => 'primary',
                  'container_class' => 'main-menu clearfix' ,
                  'menu_class' => 'clearfix',
                  'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                  'fallback_cb' => 'wp_page_menu',
                ) );
               ?>
              <a href="javascript:void(0)" class="close-button"><?php esc_html_e('CLOSE','internet-provider'); ?></a>
            </nav>
          </div>
        </div>
        <div class="col-lg-1 align-self-center">
          <div class="head-btn">
            <i class="fa fa-lg fa-chevron-right"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>