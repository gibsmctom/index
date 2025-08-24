<?php

// Get color scheme values
$internet_provider_color_scheme_gradiant1 = get_theme_mod('internet_provider_color_scheme_gradiant1');
$internet_provider_color_scheme_gradiant2 = get_theme_mod('internet_provider_color_scheme_gradiant2');  
$internet_provider_color_scheme_css = '';

/*------------------ Global First Color -----------*/

if ($internet_provider_color_scheme_gradiant1) {
  $internet_provider_color_scheme_css .= ':root {';
  $internet_provider_color_scheme_css .= '--first-theme-color: ' . esc_attr($internet_provider_color_scheme_gradiant1) . ' !important;';
  $internet_provider_color_scheme_css .= '} ';
}

/*------------------ Global Second Color -----------*/

if ($internet_provider_color_scheme_gradiant2) {
  $internet_provider_color_scheme_css .= ':root {';
  $internet_provider_color_scheme_css .= '--second-theme-color: ' . esc_attr($internet_provider_color_scheme_gradiant2) . ' !important;';
  $internet_provider_color_scheme_css .= '} ';
}

// Global Color 
$internet_provider_color_scheme_css .= '.thumbbx:hover:before {';
$internet_provider_color_scheme_css .= 'background: linear-gradient(-75deg, ' . esc_attr($internet_provider_color_scheme_gradiant1) . ', ' . esc_attr($internet_provider_color_scheme_gradiant2) . ' 60%);';
$internet_provider_color_scheme_css .= '}';

$internet_provider_color_scheme_css .= '#button {';
$internet_provider_color_scheme_css .= 'background-image: linear-gradient(' . esc_attr($internet_provider_color_scheme_gradiant1) . ', ' . esc_attr($internet_provider_color_scheme_gradiant2) . ');';
$internet_provider_color_scheme_css .= '}';

$internet_provider_color_scheme_css .= '.slidesection {';
$internet_provider_color_scheme_css .= 'background: linear-gradient(to left, ' . esc_attr($internet_provider_color_scheme_gradiant2) . ', ' . esc_attr($internet_provider_color_scheme_gradiant1) . ');';
$internet_provider_color_scheme_css .= '}';

$internet_provider_color_scheme_css .= 'span.onsale, nav.woocommerce-MyAccount-navigation ul li  {';
$internet_provider_color_scheme_css .= 'background-image: linear-gradient(to right, ' . esc_attr($internet_provider_color_scheme_gradiant1) . ', ' . esc_attr($internet_provider_color_scheme_gradiant2) . ') !important;';
$internet_provider_color_scheme_css .= '}';

$internet_provider_color_scheme_css .= '.thumbbx {';
$internet_provider_color_scheme_css .= 'background: linear-gradient(-75deg, transparent 0%, ' . esc_attr($internet_provider_color_scheme_gradiant1) . ');';
$internet_provider_color_scheme_css .= '}';

$internet_provider_color_scheme_css .= '.thumbbx:hover:before {';
$internet_provider_color_scheme_css .= 'background: linear-gradient(-75deg, transparent, ' . esc_attr($internet_provider_color_scheme_gradiant1) . ' 60%);';
$internet_provider_color_scheme_css .= '}';

// slider hide css
$internet_provider_hide_categorysec = get_theme_mod( 'internet_provider_hide_categorysec', true);
  $internet_provider_pageboxes = get_theme_mod('internet_provider_pageboxes');
if($internet_provider_hide_categorysec != true || $internet_provider_pageboxes != true){
  $internet_provider_color_scheme_css .='.page-template-template-home-page .header{';
    $internet_provider_color_scheme_css .='position:static;';
  $internet_provider_color_scheme_css .='}';
}

//---------------------------------Logo-Max-height--------- 
$internet_provider_logo_width = get_theme_mod('internet_provider_logo_width');

if($internet_provider_logo_width != false ){

  $internet_provider_color_scheme_css .='.logo img{';

    $internet_provider_color_scheme_css .='width: '.esc_html($internet_provider_logo_width).'px;';

  $internet_provider_color_scheme_css .='}';
}

/*---------------------------Slider Height ------------*/

  $internet_provider_slider_img_height = get_theme_mod('internet_provider_slider_img_height');
  if($internet_provider_slider_img_height != false){
      $internet_provider_color_scheme_css .='.slidesection img{';
          $internet_provider_color_scheme_css .='height: '.esc_attr($internet_provider_slider_img_height).' !important;';
      $internet_provider_color_scheme_css .='}';
  }

/*--------------------------- Footer background image -------------------*/

  $internet_provider_footer_bg_image = get_theme_mod('internet_provider_footer_bg_image');
  if($internet_provider_footer_bg_image != false){
      $internet_provider_color_scheme_css .='.footer-widget{';
          $internet_provider_color_scheme_css .='background: url('.esc_attr($internet_provider_footer_bg_image).')!important;';
      $internet_provider_color_scheme_css .='}';
  }

  /*--------------------------- Footer Background Color -------------------*/

  $internet_provider_footer_bg_color = get_theme_mod('internet_provider_footer_bg_color');
  if($internet_provider_footer_bg_color != false){
      $internet_provider_color_scheme_css .='.footer-widget{';
          $internet_provider_color_scheme_css .='background-color: '.esc_attr($internet_provider_footer_bg_color).' !important;';
      $internet_provider_color_scheme_css .='}';
  }

  /*--------------------------- Scroll to top positions -------------------*/

  $internet_provider_scroll_position = get_theme_mod( 'internet_provider_scroll_position','Right');
  if($internet_provider_scroll_position == 'Right'){
      $internet_provider_color_scheme_css .='#button{';
          $internet_provider_color_scheme_css .='right: 20px;';
      $internet_provider_color_scheme_css .='}';
  }else if($internet_provider_scroll_position == 'Left'){
      $internet_provider_color_scheme_css .='#button{';
          $internet_provider_color_scheme_css .='left: 20px;';
      $internet_provider_color_scheme_css .='}';
  }else if($internet_provider_scroll_position == 'Center'){
      $internet_provider_color_scheme_css .='#button{';
          $internet_provider_color_scheme_css .='right: 50%;left: 50%;';
      $internet_provider_color_scheme_css .='}';
  }  

  /*--------------------------- Blog Post Page Image Box Shadow -------------------*/

  $internet_provider_blog_post_page_image_box_shadow = get_theme_mod('internet_provider_blog_post_page_image_box_shadow',0);
  if($internet_provider_blog_post_page_image_box_shadow != false){
      $internet_provider_color_scheme_css .='.post-thumb img{';
          $internet_provider_color_scheme_css .='box-shadow: '.esc_attr($internet_provider_blog_post_page_image_box_shadow).'px '.esc_attr($internet_provider_blog_post_page_image_box_shadow).'px '.esc_attr($internet_provider_blog_post_page_image_box_shadow).'px #cccccc;';
      $internet_provider_color_scheme_css .='}';
  }

  /*--------------------------- Woocommerce Product Image Border Radius -------------------*/

  $internet_provider_woo_product_img_border_radius = get_theme_mod('internet_provider_woo_product_img_border_radius');
  if($internet_provider_woo_product_img_border_radius != false){
      $internet_provider_color_scheme_css .='.woocommerce ul.products li.product a img{';
          $internet_provider_color_scheme_css .='border-radius: '.esc_attr($internet_provider_woo_product_img_border_radius).'px;';
      $internet_provider_color_scheme_css .='}';
  }

  /*--------------------------- Woocommerce Product Sale Position -------------------*/    

  $internet_provider_product_sale_position = get_theme_mod( 'internet_provider_product_sale_position','Left');
  if($internet_provider_product_sale_position == 'Right'){
      $internet_provider_color_scheme_css .='.woocommerce ul.products li.product .onsale{';
          $internet_provider_color_scheme_css .='left:auto !important; right:.5em !important;';
      $internet_provider_color_scheme_css .='}';
  }else if($internet_provider_product_sale_position == 'Left'){
      $internet_provider_color_scheme_css .='.woocommerce ul.products li.product .onsale {';
          $internet_provider_color_scheme_css .='right:auto !important; left:.5em !important;';
      $internet_provider_color_scheme_css .='}';
  }        
  
  /*--------------------------- Shop page pagination -------------------*/
  
  $internet_provider_wooproducts_nav = get_theme_mod('internet_provider_wooproducts_nav', 'Yes');
  if($internet_provider_wooproducts_nav == 'No'){
    $internet_provider_color_scheme_css .='.woocommerce nav.woocommerce-pagination{';
      $internet_provider_color_scheme_css .='display: none;';
    $internet_provider_color_scheme_css .='}';
  }
  
  /*--------------------------- Related Product -------------------*/
  
  $internet_provider_related_product_enable = get_theme_mod('internet_provider_related_product_enable',true);
  if($internet_provider_related_product_enable == false){
    $internet_provider_color_scheme_css .='.related.products{';
      $internet_provider_color_scheme_css .='display: none;';
    $internet_provider_color_scheme_css .='}';
  }  

  /*--------------------------- Preloader Background Image ------------*/

  $internet_provider_preloader_bg_image = get_theme_mod('internet_provider_preloader_bg_image');
    if($internet_provider_preloader_bg_image != false){
      $internet_provider_color_scheme_css .='#preloader{';
        $internet_provider_color_scheme_css .='background: url('.esc_attr($internet_provider_preloader_bg_image).'); background-size: cover;';
      $internet_provider_color_scheme_css .='}';
    }

  /*--------------------------- Scroll to Top Button Shape -------------------*/

  $internet_provider_scroll_top_shape = get_theme_mod('internet_provider_scroll_top_shape', 'circle');
  if($internet_provider_scroll_top_shape == 'box' ){
      $internet_provider_color_scheme_css .='#button{';
          $internet_provider_color_scheme_css .=' border-radius: 0%';
      $internet_provider_color_scheme_css .='}';
  }elseif($internet_provider_scroll_top_shape == 'curved' ){
      $internet_provider_color_scheme_css .='#button{';
          $internet_provider_color_scheme_css .=' border-radius: 20%';
      $internet_provider_color_scheme_css .='}';
  }elseif($internet_provider_scroll_top_shape == 'circle' ){
      $internet_provider_color_scheme_css .='#button{';
          $internet_provider_color_scheme_css .=' border-radius: 50%;';
      $internet_provider_color_scheme_css .='}';
  }