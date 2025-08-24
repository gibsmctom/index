<?php
/*
 * @package Internet Provider
 */

function internet_provider_admin_enqueue_scripts() {
    wp_enqueue_style( 'internet-provider-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'internet_provider_admin_enqueue_scripts' );

function internet_provider_theme_info_menu_link() {

    $internet_provider_theme = wp_get_theme();
    add_theme_page(
        sprintf( esc_html__( 'Welcome to %1$s %2$s', 'internet-provider' ), $internet_provider_theme->get( 'Name' ), $internet_provider_theme->get( 'Version' ) ),
        esc_html__( 'Theme Info', 'internet-provider' ),'edit_theme_options','internet-provider','internet_provider_theme_info_page'
    );

    // Add "Theme Demo Import" page
    add_theme_page(
        esc_html__( 'Theme Demo Import', 'internet-provider' ),
        esc_html__( 'Theme Demo Import', 'internet-provider' ),
        'edit_theme_options',
        'internet-provider-demo',
        'internet_provider_demo_content_page'
    );
}
add_action( 'admin_menu', 'internet_provider_theme_info_menu_link' );

function internet_provider_theme_info_page() {

    $internet_provider_theme = wp_get_theme();
    ?>
<div class="wrap theme-info-wrap">
    <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'internet-provider' ), esc_html($internet_provider_theme->get( 'Name' )), esc_html($internet_provider_theme->get( 'Version' ))); ?>
    </h1>
    <p class="theme-description">
    <?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'internet-provider' ); ?>
    </p>
    <div class="important-link">
        <p class="main-box columns-wrapper clearfix">
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Pro version of our theme', 'internet-provider' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you exited for our theme? Then we will proceed for pro version of theme.', 'internet-provider' ); ?></p>
                <a class="get-premium" href="<?php echo esc_url( INTERNET_PROVIDER_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'internet-provider' ); ?></a>
                <p><strong><?php esc_html_e( 'Check all classic features', 'internet-provider' ); ?></strong></p>
                <p><?php esc_html_e( 'Explore all the premium features.', 'internet-provider' ); ?></p>
                <a href="<?php echo esc_url( INTERNET_PROVIDER_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'internet-provider' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Need Help?', 'internet-provider' ); ?></strong></p>
                <p><?php esc_html_e( 'Go to our support forum to help you out in case of queries and doubts regarding our theme.', 'internet-provider' ); ?></p>
                <a href="<?php echo esc_url( INTERNET_PROVIDER_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'internet-provider' ); ?></a>
                <p><strong><?php esc_html_e( 'Leave us a review', 'internet-provider' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you enjoying our theme? We would love to hear your feedback.', 'internet-provider' ); ?></p>
                <a href="<?php echo esc_url( INTERNET_PROVIDER_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'internet-provider' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Check Our Demo', 'internet-provider' ); ?></strong></p>
                <p><?php esc_html_e( 'Here, you can view a live demonstration of our premium them.', 'internet-provider' ); ?></p>
                <a href="<?php echo esc_url( INTERNET_PROVIDER_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'internet-provider' ); ?></a>
                <p><strong><?php esc_html_e( 'Theme Documentation', 'internet-provider' ); ?></strong></p>
                <p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed theme setup.', 'internet-provider' ); ?></p>
                <a href="<?php echo esc_url( INTERNET_PROVIDER_THEME_DOCUMENTATION ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'internet-provider' ); ?></a>
            </div>
        </p>
    </div>
    <div id="getting-started">
        <h3><?php printf( esc_html__( 'Getting started with %s', 'internet-provider' ),
        esc_html($internet_provider_theme->get( 'Name' ))); ?></h3>
        <div class="columns-wrapper clearfix">
            <div class="column column-half clearfix">
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Description', 'internet-provider' ); ?></h4>
                    <div class="theme-description-1"><?php echo esc_html($internet_provider_theme->get( 'Description' )); ?></div>
                </div>
            </div>
            <div class="column column-half clearfix">
                <img src="<?php echo esc_url( $internet_provider_theme->get_screenshot() ); ?>" alt="<?php echo esc_attr( 'screenshot', 'internet-provider'); ?>"/>
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Options', 'internet-provider' ); ?></h4>
                    <p class="about">
                    <?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'internet-provider' ),esc_html($internet_provider_theme->get( 'Name' ))); ?></p>
                    <p>
                    <div class="themelink-1">
                        <a target="_blank" href="<?php echo esc_url( wp_customize_url() ); ?>"><?php esc_html_e( 'Customize Theme', 'internet-provider' ); ?></a>
                        <a class="get-premium" href="<?php echo esc_url( INTERNET_PROVIDER_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Checkout Premium', 'internet-provider' ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="theme-author">
      <p><?php
        printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'internet-provider' ),
            esc_html($internet_provider_theme->get( 'Name' )),
            '<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'internet-provider' ) . '">classictemplate</a>',
            '<a target="_blank" href="' . esc_url( INTERNET_PROVIDER_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'internet-provider' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'internet-provider' ) . '</a>'
        );
        ?></p>
    </div>
</div>
<?php
}

function internet_provider_demo_content_page() {

    $internet_provider_theme = wp_get_theme();
    ?>
    <div class="container">
       <div class="start-box">
          <div class="columns-wrapper m-0"> 
             <div class="column column-half clearfix">
               <div class="wrapper-info"> 
                  <img src="<?php echo esc_url( get_template_directory_uri().'/images/Logo.png' ); ?>" />
                  <h2><?php esc_html_e( 'Welcome to Internet Provider', 'internet-provider' ); ?></h2>
                  <span class="version"><?php esc_html_e( 'Version', 'internet-provider' ); ?>: <?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></span>	
                  <p><?php esc_html_e( 'To begin, locate the demo importer button and click on it to initiate the importation of all the demo content.', 'internet-provider' ); ?></p>
                  <?php require get_parent_theme_file_path( '/inc/demo-content.php' ); ?>
               </div>
             </div>
             <div class="column column-half clearfix">
             <div class="get-screenshot">
               <img src="<?php echo esc_url( get_template_directory_uri().'/screenshot.png' ); ?>" />
             </div>   
             </div>
          </div>
       </div>
    </div>
<?php
}

?>
