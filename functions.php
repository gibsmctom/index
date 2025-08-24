<?php
/**
 * Internet Provider functions and definitions
 *
 * @package Internet Provider
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'internet_provider_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function internet_provider_setup() {
	global $content_width;   
	if ( ! isset( $content_width ) )
		$content_width = 680; 

	load_theme_textdomain( 'internet-provider', get_template_directory() . '/languages' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );	
	add_theme_support( 'custom-header', array( 
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
	) );	
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'internet-provider' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_editor_style( 'editor-style.css' );

	global $pagenow;

    if ( is_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
        add_action('admin_notices', 'internet_provider_deprecated_hook_admin_notice');
    }
} 
endif; // internet_provider_setup
add_action( 'after_setup_theme', 'internet_provider_setup' );

function internet_provider_the_breadcrumb() {
    echo '<div class="breadcrumb my-3">';

    if (!is_home()) {
        echo '<a class="home-main align-self-center" href="' . esc_url(home_url()) . '">';
        bloginfo('name');
        echo "</a>";

        if (is_category() || is_single()) {
            the_category(' , ');
            if (is_single()) {
                echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (is_page()) {
            echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</div>';
}

function internet_provider_widgets_init() {
	register_sidebar( array( 
		'name'          => __( 'Blog Sidebar', 'internet-provider' ),
		'description'   => __( 'Appears on blog page sidebar', 'internet-provider' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'internet-provider' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'internet-provider' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'internet-provider' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'internet-provider' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'internet-provider' ),
		'description'   => __( 'Appears on shop page', 'internet-provider' ),
		'id'            => 'woocommerce_sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar(array(
        'name'          => __('Single Product Sidebar', 'internet-provider'),
        'description'   => __('Sidebar for single product pages', 'internet-provider'),
		'id'            => 'woocommerce-single-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));	

	$internet_provider_widget_areas = get_theme_mod('internet_provider_footer_widget_areas', '4');
	for ($internet_provider_i=1; $internet_provider_i <= 4; $internet_provider_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'internet-provider' ) . $internet_provider_i,
			'id'            => 'footer-' . $internet_provider_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'internet_provider_widgets_init' );


// Change number of products per row to 4
add_filter('loop_shop_columns', 'internet_provider_loop_columns');
if (!function_exists('internet_provider_loop_columns')) {
    function internet_provider_loop_columns() {
        $colm = get_theme_mod('internet_provider_products_per_row', 4); // Default to 4 if not set
        return $colm;
    }
}

// Use the customizer setting to set the number of products per page
function internet_provider_products_per_page($cols) {
    $cols = get_theme_mod('internet_provider_products_per_page', 9); // Default to 9 if not set
    return $cols;
}
add_filter('loop_shop_per_page', 'internet_provider_products_per_page', 9);

function internet_provider_scripts() {
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri())."/css/bootstrap.css" );
	wp_enqueue_style( 'internet-provider-basic-style', get_stylesheet_uri() );
	wp_style_add_data('internet-provider-basic-style', 'rtl', 'replace');
	wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri())."/css/owl.carousel.css" );
	wp_enqueue_style( 'internet-provider-responsive', esc_url(get_template_directory_uri())."/css/responsive.css" );
	
	require get_parent_theme_file_path( '/inc/color-scheme/custom-color-control.php' );
	wp_add_inline_style( 'internet-provider-basic-style',$internet_provider_color_scheme_css );

	wp_enqueue_style( 'internet-provider-default', esc_url(get_template_directory_uri())."/css/default.css" );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'owl.carousel-js', esc_url(get_template_directory_uri()). '/js/owl.carousel.js', array('jquery') );
	wp_enqueue_script( 'internet-provider-theme', esc_url(get_template_directory_uri()) . '/js/theme.js' );

	wp_enqueue_style( 'font-awesome', esc_url(get_template_directory_uri())."/css/fontawesome-all.css" );	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// font-family
	$internet_provider_headings_font = esc_html(get_theme_mod('internet_provider_headings_fonts'));
	$internet_provider_body_font = esc_html(get_theme_mod('internet_provider_body_fonts'));

	if ($internet_provider_headings_font) {
	    wp_enqueue_style('internet-provider-headings-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($internet_provider_headings_font));
	} else {
	    wp_enqueue_style('poppins-headings', 'https://fonts.googleapis.com/css?family=Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
	}

	if ($internet_provider_body_font) {
	    wp_enqueue_style('internet-provider-body-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($internet_provider_body_font));
	} else {
	    wp_enqueue_style('poppins-body', 'https://fonts.googleapis.com/css?family=Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
	}
}
add_action( 'wp_enqueue_scripts', 'internet_provider_scripts' );


require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * Theme Info Page.
 */
require get_template_directory() . '/inc/addon.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/upgrade-to-pro.php';

// select
require get_template_directory() . '/inc/select/category-dropdown-custom-control.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/inc/tgm/tgm.php';

/* Starter Content */
	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'footer-1' => array(
				'categories',
			),
			'footer-2' => array(
				'archives',
			),
			'footer-3' => array(
				'meta',
			),
			'footer-4' => array(
				'search',
			),
		),
    ));


if ( ! function_exists( 'internet_provider_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */

function internet_provider_setup_theme() {
	if ( ! defined( 'INTERNET_PROVIDER_THEME_PAGE' ) ) {
	define('INTERNET_PROVIDER_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','internet-provider'));
	}
	if ( ! defined( 'INTERNET_PROVIDER_SUPPORT' ) ) {
	define('INTERNET_PROVIDER_SUPPORT',__('https://wordpress.org/support/theme/internet-provider','internet-provider'));
	}
	if ( ! defined( 'INTERNET_PROVIDER_REVIEW' ) ) {
	define('INTERNET_PROVIDER_REVIEW',__('https://wordpress.org/support/theme/internet-provider/reviews/','internet-provider'));
	}
	if ( ! defined( 'INTERNET_PROVIDER_PRO_DEMO' ) ) {
	define('INTERNET_PROVIDER_PRO_DEMO',__('https://live.theclassictemplates.com/demo/internet-provider/','internet-provider'));
	}
	if ( ! defined( 'INTERNET_PROVIDER_PREMIUM_PAGE' ) ) {
	define('INTERNET_PROVIDER_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/internet-service-provider-wordpres-theme','internet-provider'));
	}
	if ( ! defined( 'INTERNET_PROVIDER_THEME_DOCUMENTATION' ) ) {
	define('INTERNET_PROVIDER_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/internet-provider-free/','internet-provider'));
	}
}
add_action( 'after_setup_theme', 'internet_provider_setup_theme' );

function internet_provider_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		if( has_custom_logo() ){
			the_custom_logo();
		}else{
			echo "<a href='".esc_url( home_url() )."' rel='home'><img src='".esc_url(get_template_directory_uri())."/images/Logo.png' alt='" . esc_attr__("Classic Bakery logo", 'internet-provider') . "'/></a>";
		}
	}
}
endif;

/* Activation Notice */
function internet_provider_deprecated_hook_admin_notice() {
    $internet_provider_theme = wp_get_theme();
    $internet_provider_dismissed = get_user_meta( get_current_user_id(), 'internet_provider_dismissable_notice', true );
    if ( !$internet_provider_dismissed) { ?>
        <div class="getstrat updated notice notice-success is-dismissible notice-get-started-class">
            <div class="admin-image">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
            </div>
            <div class="admin-content" >
                <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'internet-provider' ), esc_html($internet_provider_theme->get( 'Name' )), esc_html($internet_provider_theme->get( 'Version' ))); ?>
                </h1>
                <p><?php _e('Get Started With Theme By Clicking On Getting Started.', 'internet-provider'); ?></p>
                <div style="display: grid;">
                    <a class="admin-notice-btn button button-hero upgrade-pro" target="_blank" href="<?php echo esc_url( INTERNET_PROVIDER_PREMIUM_PAGE ); ?>"><?php esc_html_e('Upgrade Pro', 'internet-provider') ?><i class="dashicons dashicons-cart"></i></a>
                    <a class="admin-notice-btn button button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=internet-provider' )); ?>"><?php esc_html_e( 'Get started', 'internet-provider' ) ?><i class="dashicons dashicons-backup"></i></a>
                    <a class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( INTERNET_PROVIDER_THEME_DOCUMENTATION ); ?>"><?php esc_html_e('Free Doc', 'internet-provider') ?><i class="dashicons dashicons-visibility"></i></a>
                    <a  class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( INTERNET_PROVIDER_PRO_DEMO ); ?>"><?php esc_html_e('View Demo', 'internet-provider') ?><i class="dashicons dashicons-awards"></i></a>
                </div>
            </div>
        </div>
    <?php }
}