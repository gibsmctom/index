<?php
/**
 * Internet Provider Theme Customizer
 *
 * @package Internet Provider
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function internet_provider_customize_register( $wp_customize ) {

	function internet_provider_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function internet_provider_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	wp_enqueue_style('internet-provider-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	function internet_provider_sanitize_email( $email, $setting ) {
		// Strips out all characters that are not allowable in an email address.
		$email = sanitize_email( $email );
		
		// If $email is a valid email, return it; otherwise, return the default.
		return ( ! is_null( $email ) ? $email : $setting->default );
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	//Logo
    $wp_customize->add_setting('internet_provider_logo_width',array(
		'default'=> '',
		'transport' => 'refresh',
		'sanitize_callback' => 'internet_provider_sanitize_integer'
	));
	$wp_customize->add_control(new Internet_Provider_Slider_Custom_Control( $wp_customize, 'internet_provider_logo_width',array(
		'label'	=> esc_html__('Logo Width','internet-provider'),
		'section'=> 'title_tagline',
		'settings'=>'internet_provider_logo_width',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting('internet_provider_title_enable',array(
		'default' => false,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control( 'internet_provider_title_enable', array(
	   'settings' => 'internet_provider_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','internet-provider'),
	   'type'      => 'checkbox'
	));


	// site title color
	$wp_customize->add_setting('internet_provider_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_sitetitle_color', array(
	   'settings' => 'internet_provider_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'internet-provider'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('internet_provider_tagline_enable',array(
		'default' => true,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control( 'internet_provider_tagline_enable', array(
	   'settings' => 'internet_provider_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','internet-provider'),
	   'type'      => 'checkbox'
	));

	// site tagline color
	$wp_customize->add_setting('internet_provider_sitetagline_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_sitetagline_color', array(
	   'settings' => 'internet_provider_sitetagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// woocommerce section
	$wp_customize->add_section('internet_provider_woocommerce_page_settings', array(
		'title'    => __('WooCommerce Page Settings', 'internet-provider'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	$wp_customize->add_setting('internet_provider_shop_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'internet_provider_sanitize_checkbox'
	));
	$wp_customize->add_control('internet_provider_shop_page_sidebar',array(
		'type' => 'checkbox',
		'label' => __(' Check To Enable Shop page sidebar','internet-provider'),
		'section' => 'internet_provider_woocommerce_page_settings',
	));

    // shop page sidebar alignment
    $wp_customize->add_setting('internet_provider_shop_page_sidebar_position', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'internet_provider_sanitize_choices',
	));
	$wp_customize->add_control('internet_provider_shop_page_sidebar_position',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Sidebar', 'internet-provider'),
		'section'        => 'internet_provider_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'internet-provider'),
			'Right Sidebar' => __('Right Sidebar', 'internet-provider'),
		),
	));	 

	$wp_customize->add_setting('internet_provider_wooproducts_nav',array(
		'default' => 'Yes',
		'sanitize_callback'	=> 'internet_provider_sanitize_choices'
	));
	$wp_customize->add_control('internet_provider_wooproducts_nav',array(
		'type' => 'select',
		'label' => __('Shop Page Products Navigation','internet-provider'),
		'choices' => array(
			 'Yes' => __('Yes','internet-provider'),
			 'No' => __('No','internet-provider'),
		 ),
		'section' => 'internet_provider_woocommerce_page_settings',
	));

	$wp_customize->add_setting( 'internet_provider_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'internet_provider_sanitize_checkbox'
    ) );
    $wp_customize->add_control('internet_provider_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Check To Enable Single Product Page Sidebar','internet-provider'),
		'section' => 'internet_provider_woocommerce_page_settings'
    ));

	// single product page sidebar alignment
    $wp_customize->add_setting('internet_provider_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'internet_provider_sanitize_choices',
	));
	$wp_customize->add_control('internet_provider_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page Sidebar', 'internet-provider'),
		'section'        => 'internet_provider_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'internet-provider'),
			'Right Sidebar' => __('Right Sidebar', 'internet-provider'),
		),
	));

	$wp_customize->add_setting('internet_provider_related_product_enable',array(
		'default' => true,
		'sanitize_callback'	=> 'internet_provider_sanitize_checkbox'
	));
	$wp_customize->add_control('internet_provider_related_product_enable',array(
		'type' => 'checkbox',
		'label' => __('Check To Enable Related product','internet-provider'),
		'section' => 'internet_provider_woocommerce_page_settings',
	));	

	$wp_customize->add_setting( 'internet_provider_woo_product_img_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'internet_provider_sanitize_integer'
    ) );
    $wp_customize->add_control(new Internet_Provider_Slider_Custom_Control( $wp_customize, 'internet_provider_woo_product_img_border_radius',array(
		'label'	=> esc_html__('Woo Product Img Border Radius','internet-provider'),
		'section'=> 'internet_provider_woocommerce_page_settings',
		'settings'=>'internet_provider_woo_product_img_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

    // Add a setting for number of products per row
    $wp_customize->add_setting('internet_provider_products_per_row', array(
	  'default'   => '4',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'internet_provider_sanitize_integer'
    ));
    $wp_customize->add_control('internet_provider_products_per_row', array(
	  'label'    => __('Woo Products Per Row', 'internet-provider'),
	  'section'  => 'internet_provider_woocommerce_page_settings',
	  'settings' => 'internet_provider_products_per_row',
	  'type'     => 'select',
	  'choices'  => array(
		  '2' => '2',
		  '3' => '3',
		  '4' => '4',
	  ),
    ));

    // Add a setting for the number of products per page
    $wp_customize->add_setting('internet_provider_products_per_page', array(
	  'default'   => '9',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'internet_provider_sanitize_integer'
    ));
    $wp_customize->add_control('internet_provider_products_per_page', array(
	  'label'    => __('Woo Products Per Page', 'internet-provider'),
	  'section'  => 'internet_provider_woocommerce_page_settings',
	  'settings' => 'internet_provider_products_per_page',
	  'type'     => 'number',
	  'input_attrs' => array(
		 'min'  => 1,
		 'step' => 1,
	  ),
    ));

    $wp_customize->add_setting('internet_provider_product_sale_position',array(
        'default' => 'Left',
        'sanitize_callback' => 'internet_provider_sanitize_choices'
	));
	$wp_customize->add_control('internet_provider_product_sale_position',array(
        'type' => 'radio',
        'label' => __('Product Sale Position','internet-provider'),
        'section' => 'internet_provider_woocommerce_page_settings',
        'choices' => array(
            'Left' => __('Left','internet-provider'),
            'Right' => __('Right','internet-provider'),
        ),
	) );  	

	//Theme Options
	$wp_customize->add_panel( 'internet_provider_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'internet-provider' ),
	) );
	
	//Site Layout Section
	$wp_customize->add_section('internet_provider_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section ','internet-provider'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','internet-provider'),
		'priority'	=> 1,
		'panel' => 'internet_provider_panel_area',
	));		

	$wp_customize->add_setting('internet_provider_preloader',array(
		'default' => false,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control( 'internet_provider_preloader', array(
	   'section'   => 'internet_provider_site_layoutsec',
	   'label'	=> __('Check to show preloader','internet-provider'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('internet_provider_preloader_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'internet_provider_preloader_bg_image',array(
        'section' => 'internet_provider_site_layoutsec',
		'label' => __('Preloader Background Image','internet-provider'),
	)));
	
	$wp_customize->add_setting('internet_provider_box_layout',array(
		'default' => false,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control( 'internet_provider_box_layout', array(
	   'section'   => 'internet_provider_site_layoutsec',
	   'label'	=> __('Check to Show Box Layout','internet-provider'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting( 'internet_provider_theme_page_breadcrumb',array(
		'default' => false,
        'sanitize_callback'	=> 'internet_provider_sanitize_checkbox',
	) );
	 $wp_customize->add_control('internet_provider_theme_page_breadcrumb',array(
       'section' => 'internet_provider_site_layoutsec',
	   'label' => __( 'Check To Enable Theme Page Breadcrumb','internet-provider' ),
	   'type' => 'checkbox'
   ));	

    // Add Settings and Controls for Page Layout
    $wp_customize->add_setting('internet_provider_sidebar_page_layout',array(
	  'default' => 'full',
	  'sanitize_callback' => 'internet_provider_sanitize_choices'
	));
	$wp_customize->add_control('internet_provider_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'internet-provider'),
		'section' => 'internet_provider_site_layoutsec',
		'choices' => array(
			'left' => __('Left','internet-provider'),
			'right' => __('Right','internet-provider'),
			'full' => __('No Sidebar','internet-provider')
	),
	) );	

	$wp_customize->add_setting('internet_provider_topbar',array(
		'default' => true,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control( 'internet_provider_topbar', array(
	   'section'   => 'internet_provider_site_layoutsec',
	   'label'	=> __('Check to show topbar','internet-provider'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting( 'internet_provider_layout_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_layout_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(INTERNET_PROVIDER_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'internet_provider_site_layoutsec'
	));

   //Global Color
	$wp_customize->add_section('internet_provider_global_color', array(
		'title'    => __('Manage Global Color Section', 'internet-provider'),
		'panel'    => 'internet_provider_panel_area',
	));

	$wp_customize->add_setting('internet_provider_color_scheme_gradiant1', array(
		'default'           => '#d52657',
		'sanitize_callback' => 'sanitize_hex_color',
	));	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'internet_provider_color_scheme_gradiant1', array(
		'label'    => __('Theme Color', 'internet-provider'),
		'section'  => 'internet_provider_global_color',
		'settings' => 'internet_provider_color_scheme_gradiant1',
	)));		

	$wp_customize->add_setting('internet_provider_color_scheme_gradiant2', array(
		'default'           => '#30279a',
		'sanitize_callback' => 'sanitize_hex_color',
	));	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'internet_provider_color_scheme_gradiant2', array(
		'label'    => __('Theme Color', 'internet-provider'),
		'section'  => 'internet_provider_global_color',
		'settings' => 'internet_provider_color_scheme_gradiant2',
	)));

	$wp_customize->add_setting( 'internet_provider_global_color_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_global_color_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(INTERNET_PROVIDER_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'internet_provider_global_color'
	));	

	// Header Section 
	$wp_customize->add_section('internet_provider_header', array(
		'title'	=> __('Manage Header Section','internet-provider'),
		'description' => __('<p class="sec-title">Manage Header Section</p>','internet-provider'),
		'priority'	=> null,
		'panel' => 'internet_provider_panel_area',
	));

	$wp_customize->add_setting('internet_provider_stickyheader',array(
		'default' => false,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control( 'internet_provider_stickyheader', array(
	   'section'   => 'internet_provider_header',
	   'label'	=> __('Check To Show Sticky Header','internet-provider'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('internet_provider_search_option',array(
		'default' => true,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));	 
	$wp_customize->add_control( 'internet_provider_search_option', array(
	   'section'   => 'internet_provider_header',
	   'label'	=> __('Check to show Search','internet-provider'),
	   'type'      => 'checkbox'
 	)); 

	// topheader color
	$wp_customize->add_setting('internet_provider_topheaderbg_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_topheaderbg_color', array(
	   'settings' => 'internet_provider_topheaderbg_color',
	   'section'   => 'internet_provider_header',
	   'label' => __('Top BG Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// header_accounticon_col
	$wp_customize->add_setting('internet_provider_header_accounticon_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_accounticon_col', array(
	   'settings' => 'internet_provider_header_accounticon_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('Account Icon Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// header_carticon_col
	$wp_customize->add_setting('internet_provider_header_carticon_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_carticon_col', array(
	   'settings' => 'internet_provider_header_carticon_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('Cart Icon Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// header bottombg col
	$wp_customize->add_setting('internet_provider_header_bottombg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_bottombg_col', array(
	   'settings' => 'internet_provider_header_bottombg_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('Bottom BG Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// header menus col
	$wp_customize->add_setting('internet_provider_header_menus_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_menus_col', array(
	   'settings' => 'internet_provider_header_menus_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('Menus Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// header menushov col
	$wp_customize->add_setting('internet_provider_header_menushov_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_menushov_col', array(
	   'settings' => 'internet_provider_header_menushov_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('Menus Hover Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// header menushover1 col
	$wp_customize->add_setting('internet_provider_header_menushover1_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_menushover1_col', array(
	   'settings' => 'internet_provider_header_menushover1_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('Menus BG Hover Color 1', 'internet-provider'),
	   'type'      => 'color'
	));

	// header menushover2 col
	$wp_customize->add_setting('internet_provider_header_menushover2_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_menushover2_col', array(
	   'settings' => 'internet_provider_header_menushover2_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('Menus BG Hover Color 2', 'internet-provider'),
	   'type'      => 'color'
	));

	// header submenubg1 col
	$wp_customize->add_setting('internet_provider_header_submenubg1_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_submenubg1_col', array(
	   'settings' => 'internet_provider_header_submenubg1_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('SubMenus BG Color 1', 'internet-provider'),
	   'type'      => 'color'
	));

	// header submenubg2 col
	$wp_customize->add_setting('internet_provider_header_submenubg2_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_submenubg2_col', array(
	   'settings' => 'internet_provider_header_submenubg2_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('SubMenus BG Color 2', 'internet-provider'),
	   'type'      => 'color'
	));

	// header submenu col
	$wp_customize->add_setting('internet_provider_header_submenu_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_submenu_col', array(
	   'settings' => 'internet_provider_header_submenu_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('SubMenus Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// header submenuhover col
	$wp_customize->add_setting('internet_provider_header_submenuhover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_header_submenuhover_col', array(
	   'settings' => 'internet_provider_header_submenuhover_col',
	   'section'   => 'internet_provider_header',
	   'label' => __('SubMenu Hover Color', 'internet-provider'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'internet_provider_header_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_header_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(INTERNET_PROVIDER_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'internet_provider_header'
	));

	// Home Category Dropdown Section
	$wp_customize->add_section('internet_provider_one_cols_section',array(
		'title'	=> __('Manage Slider Section','internet-provider'),
		'description'	=> __('<p class="sec-title">Manage Slider Section</p> Select Category from the Dropdowns for slider, Also use the given image dimension (1600 x 600).','internet-provider'),
		'priority'	=> null,
		'panel' => 'internet_provider_panel_area'
	));

	//Hide Section
	$wp_customize->add_setting('internet_provider_hide_categorysec',array(
		'default' => true,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_hide_categorysec', array(
	   'settings' => 'internet_provider_hide_categorysec',
	   'section'   => 'internet_provider_one_cols_section',
	   'label'     => __('Check To Enable This Section','internet-provider'),
	   'type'      => 'checkbox'
	));

	// Add a category dropdown Slider Coloumn
	$wp_customize->add_setting( 'internet_provider_pageboxes', array(
		'default'	=> '0',	
		'sanitize_callback'	=> 'absint'
	) );
	$wp_customize->add_control( new Internet_Provider_Category_Dropdown_Custom_Control( $wp_customize, 'internet_provider_pageboxes', array(
		'section' => 'internet_provider_one_cols_section',
	   'label'     => __('Select Category to display Slider','internet-provider'),
		'settings'   => 'internet_provider_pageboxes',
	) ) );
	
	$wp_customize->add_setting('internet_provider_pgboxes_title',array(
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'internet_provider_pgboxes_title', array(
	   'section' 	=> 'internet_provider_one_cols_section',
	   'label'	 	=> __('Short Text','internet-provider'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

    $wp_customize->add_setting('internet_provider_button_text',array(
		'default' => 'Read More',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_button_text', array(
	   'settings' => 'internet_provider_button_text',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('Add Button Text', 'internet-provider'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('internet_provider_button_link_slider',array(
        'default'=> '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('internet_provider_button_link_slider',array(
        'label' => esc_html__('Add Button Link','internet-provider'),
        'section'=> 'internet_provider_one_cols_section',
        'type'=> 'url'
    ));

    //Slider height
    $wp_customize->add_setting('internet_provider_slider_img_height',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('internet_provider_slider_img_height',array(
        'label' => __('Slider Image Height','internet-provider'),
        'description'   => __('Add the slider image height here (eg. 600px)','internet-provider'),
        'input_attrs' => array(
            'placeholder' => __( '500px', 'internet-provider' ),
        ),
        'section'=> 'internet_provider_one_cols_section',
        'type'=> 'text'
    ));

    // slider shorttext col
	$wp_customize->add_setting('internet_provider_slider_shorttext_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_slider_shorttext_col', array(
	   'settings' => 'internet_provider_slider_shorttext_col',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('Short Text Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// slider title col
	$wp_customize->add_setting('internet_provider_slider_title_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_slider_title_col', array(
	   'settings' => 'internet_provider_slider_title_col',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('Title Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// slider description col
	$wp_customize->add_setting('internet_provider_slider_description_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_slider_description_col', array(
	   'settings' => 'internet_provider_slider_description_col',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('Description Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// slider buttontext col
	$wp_customize->add_setting('internet_provider_slider_buttontext_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_slider_buttontext_col', array(
	   'settings' => 'internet_provider_slider_buttontext_col',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('Button Text Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// slider buttonbg col
	$wp_customize->add_setting('internet_provider_slider_buttonbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_slider_buttonbg_col', array(
	   'settings' => 'internet_provider_slider_buttonbg_col',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('Button BG Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// slider buttonbghover col
	$wp_customize->add_setting('internet_provider_slider_buttonbghover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_slider_buttonbghover_col', array(
	   'settings' => 'internet_provider_slider_buttonbghover_col',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('Button BG Hover Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// slider bg1 col
	$wp_customize->add_setting('internet_provider_slider_bg1_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_slider_bg1_col', array(
	   'settings' => 'internet_provider_slider_bg1_col',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('BG Color 1', 'internet-provider'),
	   'type'      => 'color'
	));

	// slider bg2 col
	$wp_customize->add_setting('internet_provider_slider_bg2_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_slider_bg2_col', array(
	   'settings' => 'internet_provider_slider_bg2_col',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('BG Color 2', 'internet-provider'),
	   'type'      => 'color'
	));

	// slider arrow col
	$wp_customize->add_setting('internet_provider_slider_arrow_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_slider_arrow_col', array(
	   'settings' => 'internet_provider_slider_arrow_col',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('Arrows Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// slider arrowhover col
	$wp_customize->add_setting('internet_provider_slider_arrowhover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_slider_arrowhover_col', array(
	   'settings' => 'internet_provider_slider_arrowhover_col',
	   'section'   => 'internet_provider_one_cols_section',
	   'label' => __('Arrows hover Color', 'internet-provider'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'internet_provider_slider_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_slider_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(INTERNET_PROVIDER_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'internet_provider_one_cols_section'
	));

	// Home Three Boxes Section 
	$wp_customize->add_section('internet_provider_below_banner_section', array(
		'title'	=> __('Manage Services Section','internet-provider'),
		'description'	=> __('<p class="sec-title">Manage Services Section</p> Select Pages from the dropdown for Services, Also use the given image dimension (500 x 500).','internet-provider'),
		'priority'	=> null,
		'panel' => 'internet_provider_panel_area',
	));

	$wp_customize->add_setting('internet_provider_disabled_pgboxes',array(
		'default' => true,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_disabled_pgboxes', array(
	   'settings' => 'internet_provider_disabled_pgboxes',
	   'section'   => 'internet_provider_below_banner_section',
	   'label'     => __('Check To Enable This Section','internet-provider'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('internet_provider_pageboxes1',array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'internet_provider_sanitize_dropdown_pages'
	));
	$wp_customize->add_control(	'internet_provider_pageboxes1',array(
		'type' => 'dropdown-pages',
	   'label'     => __('Select Pages to display Services','internet-provider'),
		'section' => 'internet_provider_below_banner_section',
	));	

	$wp_customize->add_setting('internet_provider_pageboxes2',array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'internet_provider_sanitize_dropdown_pages'
	)); 
	$wp_customize->add_control(	'internet_provider_pageboxes2',array(
		'type' => 'dropdown-pages',
		'section' => 'internet_provider_below_banner_section',
	));
	
	$wp_customize->add_setting('internet_provider_pageboxes3',array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'internet_provider_sanitize_dropdown_pages'
	));
	$wp_customize->add_control(	'internet_provider_pageboxes3',array(
		'type' => 'dropdown-pages',
		'section' => 'internet_provider_below_banner_section',
	));

	$wp_customize->add_setting('internet_provider_projects_price', array(
            'sanitize_callback' => 'sanitize_text_field',
    ));
	$wp_customize->add_control('internet_provider_projects_price', array(
		'label' => __('Price', 'internet-provider'),
		'section' => 'internet_provider_below_banner_section',
		'type' => 'text',
	));
	
	// service title col
	$wp_customize->add_setting('internet_provider_service_title_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_service_title_col', array(
	   'settings' => 'internet_provider_service_title_col',
	   'section'   => 'internet_provider_below_banner_section',
	   'label' => __('Title Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// service buttontext col
	$wp_customize->add_setting('internet_provider_service_buttontext_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_service_buttontext_col', array(
	   'settings' => 'internet_provider_service_buttontext_col',
	   'section'   => 'internet_provider_below_banner_section',
	   'label' => __('Button Text Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// service buttonbg col
	$wp_customize->add_setting('internet_provider_service_buttonbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_service_buttonbg_col', array(
	   'settings' => 'internet_provider_service_buttonbg_col',
	   'section'   => 'internet_provider_below_banner_section',
	   'label' => __('Button BG Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// service buttonbghover col
	$wp_customize->add_setting('internet_provider_service_buttonbghover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_service_buttonbghover_col', array(
	   'settings' => 'internet_provider_service_buttonbghover_col',
	   'section'   => 'internet_provider_below_banner_section',
	   'label' => __('Button BG Hover Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// service boxbg col
	$wp_customize->add_setting('internet_provider_service_boxbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_service_boxbg_col', array(
	   'settings' => 'internet_provider_service_boxbg_col',
	   'section'   => 'internet_provider_below_banner_section',
	   'label' => __('Box BG Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// service boxhover1 col
	$wp_customize->add_setting('internet_provider_service_boxhover1_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_service_boxhover1_col', array(
	   'settings' => 'internet_provider_service_boxhover1_col',
	   'section'   => 'internet_provider_below_banner_section',
	   'label' => __('Box BG Hover 1 Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// service boxhover2 col
	$wp_customize->add_setting('internet_provider_service_boxhover2_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_service_boxhover2_col', array(
	   'settings' => 'internet_provider_service_boxhover2_col',
	   'section'   => 'internet_provider_below_banner_section',
	   'label' => __('Box BG Hover 2 Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// service boxhoverborder col
	$wp_customize->add_setting('internet_provider_service_boxhoverborder_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_service_boxhoverborder_col', array(
	   'settings' => 'internet_provider_service_boxhoverborder_col',
	   'section'   => 'internet_provider_below_banner_section',
	   'label' => __('Box Hover Border Color', 'internet-provider'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'internet_provider_services_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_services_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(INTERNET_PROVIDER_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'internet_provider_below_banner_section'
	));	

	//Blog post
	$wp_customize->add_section('internet_provider_blog_post_settings',array(
        'title' => __('Manage Post Section', 'internet-provider'),
        'priority' => null,
        'panel' => 'internet_provider_panel_area'
    ) );

	$wp_customize->add_setting('internet_provider_metafields_date', array(
	    'default' => true,
	    'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control('internet_provider_metafields_date', array(
	    'settings' => 'internet_provider_metafields_date', 
	    'section'   => 'internet_provider_blog_post_settings',
	    'label'     => __('Check to Enable Date', 'internet-provider'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('internet_provider_metafields_comments', array(
		'default' => true,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));	
	$wp_customize->add_control('internet_provider_metafields_comments', array(
		'settings' => 'internet_provider_metafields_comments',
		'section'  => 'internet_provider_blog_post_settings',
		'label'    => __('Check to Enable Comments', 'internet-provider'),
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('internet_provider_metafields_author', array(
		'default' => true,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control('internet_provider_metafields_author', array(
		'settings' => 'internet_provider_metafields_author',
		'section'  => 'internet_provider_blog_post_settings',
		'label'    => __('Check to Enable Author', 'internet-provider'),
		'type'     => 'checkbox',
	));		

	$wp_customize->add_setting('internet_provider_metafields_time', array(
		'default' => true,
		'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control('internet_provider_metafields_time', array(
		'settings' => 'internet_provider_metafields_time',
		'section'  => 'internet_provider_blog_post_settings',
		'label'    => __('Check to Enable Time', 'internet-provider'),
		'type'     => 'checkbox',
	));	

	$wp_customize->add_setting('internet_provider_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','internet-provider'),
		'description' => __('Ex: "/", "|", "-", ...','internet-provider'),
		'section' => 'internet_provider_blog_post_settings'
	)); 

   // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('internet_provider_sidebar_post_layout',array(
		'default' => 'right',
		'sanitize_callback' => 'internet_provider_sanitize_choices'
	));
	$wp_customize->add_control('internet_provider_sidebar_post_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Post Sidebar Position', 'internet-provider'),
		'description'   => __('This option work for blog page, archive page and search page.', 'internet-provider'),
		'section' => 'internet_provider_blog_post_settings',
		'choices' => array(
			'left' => __('Left','internet-provider'),
			'right' => __('Right','internet-provider'),
			'three-column' => __('Three Columns','internet-provider'),
			'four-column' => __('Four Columns','internet-provider'),
			'grid' => __('Grid Layout','internet-provider'),
			'full' => __('No Sidebar','internet-provider')
     ),
	) );

	$wp_customize->add_setting('internet_provider_blog_post_description_option',array(
    	'default'   => 'Full Content', 
        'sanitize_callback' => 'internet_provider_sanitize_choices'
	));
	$wp_customize->add_control('internet_provider_blog_post_description_option',array(
        'type' => 'radio',
        'label' => __('Post Description Length','internet-provider'),
        'section' => 'internet_provider_blog_post_settings',
        'choices' => array(
            'No Content' => __('No Content','internet-provider'),
            'Excerpt Content' => __('Excerpt Content','internet-provider'),
            'Full Content' => __('Full Content','internet-provider'),
        ),
	) );

	$wp_customize->add_setting('internet_provider_blog_post_thumb',array(
        'sanitize_callback' => 'internet_provider_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('internet_provider_blog_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Show / Hide Blog Post Thumbnail', 'internet-provider'),
        'section'     => 'internet_provider_blog_post_settings',
    ));

    $wp_customize->add_setting( 'internet_provider_blog_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'internet_provider_sanitize_integer'
    ) );
    $wp_customize->add_control(new Internet_Provider_Slider_Custom_Control( $wp_customize, 'internet_provider_blog_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Blog Page Image Box Shadow','internet-provider'),
		'section'=> 'internet_provider_blog_post_settings',
		'settings'=>'internet_provider_blog_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'internet_provider_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(INTERNET_PROVIDER_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'internet_provider_blog_post_settings'
	));		

	//Single Post Settings
	$wp_customize->add_section('internet_provider_single_post_settings',array(
		'title' => __('Manage Single Post Section', 'internet-provider'),
		'priority' => null,
		'panel' => 'internet_provider_panel_area'
	));

	$wp_customize->add_setting( 'internet_provider_single_page_breadcrumb',array(
		'default' => true,
        'sanitize_callback'	=> 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control('internet_provider_single_page_breadcrumb',array(
       'section' => 'internet_provider_single_post_settings',
	   'label' => __( 'Check To Enable Breadcrumb','internet-provider' ),
	   'type' => 'checkbox'
    ));	

	$wp_customize->add_setting('internet_provider_single_post_date',array(
		'default' => true,
		'sanitize_callback'	=> 'internet_provider_sanitize_checkbox'
	));
	$wp_customize->add_control('internet_provider_single_post_date',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Date ','internet-provider'),
		'section' => 'internet_provider_single_post_settings'
	));	

	$wp_customize->add_setting('internet_provider_single_post_author',array(
		'default' => true,
		'sanitize_callback'	=> 'internet_provider_sanitize_checkbox'
	));
	$wp_customize->add_control('internet_provider_single_post_author',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Author','internet-provider'),
		'section' => 'internet_provider_single_post_settings'
	));

	$wp_customize->add_setting('internet_provider_single_post_comment',array(
		'default' => true,
		'sanitize_callback'	=> 'internet_provider_sanitize_checkbox'
	));
	$wp_customize->add_control('internet_provider_single_post_comment',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Comments','internet-provider'),
		'section' => 'internet_provider_single_post_settings'
	));	

	$wp_customize->add_setting('internet_provider_single_post_time',array(
		'default' => true,
		'sanitize_callback'	=> 'internet_provider_sanitize_checkbox'
	));
	$wp_customize->add_control('internet_provider_single_post_time',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Time','internet-provider'),
		'section' => 'internet_provider_single_post_settings'
	));	

	$wp_customize->add_setting('internet_provider_single_post_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_single_post_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','internet-provider'),
		'description' => __('Ex: "/", "|", "-", ...','internet-provider'),
		'section' => 'internet_provider_single_post_settings'
	)); 

	$wp_customize->add_setting('internet_provider_sidebar_single_post_layout',array(
    	'default' => 'right',
    	 'sanitize_callback' => 'internet_provider_sanitize_choices'
	));
	$wp_customize->add_control('internet_provider_sidebar_single_post_layout',array(
   		'type' => 'radio',
    	'label'     => __('Single post sidebar layout', 'internet-provider'),
     	'section' => 'internet_provider_single_post_settings',
     	'choices' => array(
			'left' => __('Left','internet-provider'),
			'right' => __('Right','internet-provider'),
			'full' => __('No Sidebar','internet-provider'),
     ),
	));

	$wp_customize->add_setting( 'internet_provider_single_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_single_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(INTERNET_PROVIDER_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'internet_provider_single_post_settings'
	)); 

	// 404 Page Settings
	$wp_customize->add_section('internet_provider_page_not_found', array(
		'title'	=> __('Manage 404 Page Section','internet-provider'),
		'priority'	=> null,
		'panel' => 'internet_provider_panel_area',
	));

	$wp_customize->add_setting('internet_provider_page_not_found_heading',array(
		'default'=> __('404 Not Found','internet-provider'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_page_not_found_heading',array(
		'label'	=> __('404 Heading','internet-provider'),
		'section'=> 'internet_provider_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('internet_provider_page_not_found_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('internet_provider_page_not_found_content',array(
		'label'	=> __('404 Text','internet-provider'),
		'input_attrs' => array(
			'placeholder' => __( 'Looks like you have taken a wrong turn.....Don\'t worry... it happens to the best of us.', 'internet-provider' ),
		),
		'section'=> 'internet_provider_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'internet_provider_page_not_found_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_page_not_found_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(INTERNET_PROVIDER_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'internet_provider_page_not_found'
	));

	// Footer Section 
	$wp_customize->add_section('internet_provider_footer', array(
		'title'	=> __('Manage Footer Section','internet-provider'),
		'description'	=> __('<p class="sec-title">Manage Footer Section</p>','internet-provider'),
		'priority'	=> null,
		'panel' => 'internet_provider_panel_area',
	));

	$wp_customize->add_setting('internet_provider_footer_widget', array(
	    'default' => true,
	    'sanitize_callback' => 'internet_provider_sanitize_checkbox',
	));
	$wp_customize->add_control('internet_provider_footer_widget', array(
	    'settings' => 'internet_provider_footer_widget', // Corrected setting name
	    'section'   => 'internet_provider_footer',
	    'label'     => __('Check to Enable Footer Widget', 'internet-provider'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('internet_provider_footer_bg_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'internet_provider_footer_bg_color', array(
        'label'    => __('Footer Background Color', 'internet-provider'),
        'section'  => 'internet_provider_footer',
    )));

	$wp_customize->add_setting('internet_provider_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'internet_provider_footer_bg_image',array(
        'label' => __('Footer Background Image','internet-provider'),
        'section' => 'internet_provider_footer',
    )));

	$wp_customize->add_setting('internet_provider_copyright_line',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'internet_provider_copyright_line', array(
	   'section' 	=> 'internet_provider_footer',
	   'label'	 	=> __('Copyright Line','internet-provider'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

    $wp_customize->add_setting('internet_provider_copyright_link',array( 
    	'default' => 'https://www.theclassictemplates.com/products/free-internet-provider-wordpress-theme',
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'internet_provider_copyright_link', array(
	   'section' 	=> 'internet_provider_footer',
	   'label'	 	=> __('Copyright Link','internet-provider'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

    // footer coypright col
	$wp_customize->add_setting('internet_provider_footer_coypright_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_footer_coypright_col', array(
	   'settings' => 'internet_provider_footer_coypright_col',
	   'section'   => 'internet_provider_footer',
	   'label' => __('Copyright Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// footer coyprighthover col
	$wp_customize->add_setting('internet_provider_footer_coyprighthover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_footer_coyprighthover_col', array(
	   'settings' => 'internet_provider_footer_coyprighthover_col',
	   'section'   => 'internet_provider_footer',
	   'label' => __('Copyright Hover Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// footer coyprightbg col
	$wp_customize->add_setting('internet_provider_footer_coyprightbg_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_footer_coyprightbg_col', array(
	   'settings' => 'internet_provider_footer_coyprightbg_col',
	   'section'   => 'internet_provider_footer',
	   'label' => __('Copyright BG Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// footer heading col
	$wp_customize->add_setting('internet_provider_footer_heading_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_footer_heading_col', array(
	   'settings' => 'internet_provider_footer_heading_col',
	   'section'   => 'internet_provider_footer',
	   'label' => __('Heading Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// footer text col
	$wp_customize->add_setting('internet_provider_footer_text_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_footer_text_col', array(
	   'settings' => 'internet_provider_footer_text_col',
	   'section'   => 'internet_provider_footer',
	   'label' => __('Text Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// footer list col
	$wp_customize->add_setting('internet_provider_footer_list_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_footer_list_col', array(
	   'settings' => 'internet_provider_footer_list_col',
	   'section'   => 'internet_provider_footer',
	   'label' => __('List Color', 'internet-provider'),
	   'type'      => 'color'
	));

	// footer listhover col
	$wp_customize->add_setting('internet_provider_footer_listhover_col',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'internet_provider_footer_listhover_col', array(
	   'settings' => 'internet_provider_footer_listhover_col',
	   'section'   => 'internet_provider_footer',
	   'label' => __('List Hover Color', 'internet-provider'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('internet_provider_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'internet_provider_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'internet_provider_scroll_hide',array(
        'label'          => __( 'Check To Show Scroll To Top', 'internet-provider' ),
        'section'        => 'internet_provider_footer',
        'settings'       => 'internet_provider_scroll_hide',
        'type'           => 'checkbox',
    )));
    
    $wp_customize->add_setting('internet_provider_scroll_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'internet_provider_sanitize_choices'
    ));
    $wp_customize->add_control('internet_provider_scroll_position',array(
        'type' => 'radio',
        'section' => 'internet_provider_footer',
        'label'	 	=> __('Scroll To Top Positions','internet-provider'),
        'choices' => array(
            'Right' => __('Right','internet-provider'),
            'Left' => __('Left','internet-provider'),
            'Center' => __('Center','internet-provider')
        ),
    ) );

	$wp_customize->add_setting('internet_provider_scroll_text',array(
		'default'	=> __('TOP','internet-provider'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('internet_provider_scroll_text',array(
		'label'	=> __('Scroll To Top Button Text','internet-provider'),
		'section'	=> 'internet_provider_footer',
		'type'		=> 'text'
	));

	$wp_customize->add_setting( 'internet_provider_scroll_top_shape', array(
		'default'           => 'circle',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'internet_provider_scroll_top_shape', array(
		'label'    => __( 'Scroll to Top Button Shape', 'internet-provider' ),
		'section'  => 'internet_provider_footer',
		'settings' => 'internet_provider_scroll_top_shape',
		'type'     => 'radio',
		'choices'  => array(
			'box'        => __( 'Box', 'internet-provider' ),
			'curved' => __( 'Curved', 'internet-provider'),
			'circle'     => __( 'Circle', 'internet-provider' ),
		),
	));

	$wp_customize->add_setting('internet_provider_footer_widget_areas',array(
		'default'           => 4,
		'sanitize_callback' => 'internet_provider_sanitize_choices',
	));
	$wp_customize->add_control('internet_provider_footer_widget_areas',array(
		'type'        => 'radio',
		'section' => 'internet_provider_footer',
		'label'       => __('Footer widget area', 'internet-provider'),
		'choices' => array(
		   '1'     => __('One', 'internet-provider'),
		   '2'     => __('Two', 'internet-provider'),
		   '3'     => __('Three', 'internet-provider'),
		   '4'     => __('Four', 'internet-provider')
		),
	));

	$wp_customize->add_setting( 'internet_provider_footer_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('internet_provider_footer_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(INTERNET_PROVIDER_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'internet_provider_footer'
	));		

    // Google Fonts
    $wp_customize->add_section( 'internet_provider_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'internet-provider' ),
		'priority'    => 24,
	) );

	$font_choices = array(
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'internet_provider_headings_fonts', array(
		'sanitize_callback' => 'internet_provider_sanitize_fonts',
	));
	$wp_customize->add_control( 'internet_provider_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'internet-provider'),
		'section' => 'internet_provider_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'internet_provider_body_fonts', array(
		'sanitize_callback' => 'internet_provider_sanitize_fonts'
	));
	$wp_customize->add_control( 'internet_provider_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'internet-provider' ),
		'section' => 'internet_provider_google_fonts_section',
		'choices' => $font_choices
	));
}
add_action( 'customize_register', 'internet_provider_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function internet_provider_customize_preview_js() {
	wp_enqueue_script( 'internet_provider_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'internet_provider_customize_preview_js' );