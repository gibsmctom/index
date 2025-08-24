<?php
/**
 * @package Internet Provider
 * Setup the WordPress core custom header feature.
 *
 * @uses internet_provider_header_style()
 */
function internet_provider_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'internet_provider_custom_header_args', array(		
		'default-text-color'     => 'fff',
		'width'                  => 1400,
		'height'                 => 280,
		'wp-head-callback'       => 'internet_provider_header_style',		
	) ) );
}
add_action( 'after_setup_theme', 'internet_provider_custom_header_setup' );

if ( ! function_exists( 'internet_provider_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see internet_provider_custom_header_setup().
 */
function internet_provider_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.header, .bg-inner, .page-template-template-home-page .header {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat !important;
			background-position: center top;
			background-size:cover !important;
		}
	<?php endif; ?>	

	h1.site-title a {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_sitetitle_color')); ?>;
	}

	.header-top p {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_sitetagline_color')); ?>;
	}

	.header-top {
		background: <?php echo esc_attr(get_theme_mod('internet_provider_topheaderbg_color')); ?>;
	    opacity: 0.7;
	}

	.header-top .fa-user {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_header_accounticon_col')); ?>;
	}

	.header-top .fa-shopping-basket {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_header_carticon_col')); ?>;
	}

	.bg-inner {
		background: <?php echo esc_attr(get_theme_mod('internet_provider_header_bottombg_col')); ?>;
	}

	.main-nav a {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_header_menus_col')); ?>;
	}

	.main-nav a:hover {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_header_menushov_col')); ?>;
	}

	.main-nav li:hover {
		background-image: linear-gradient( <?php echo esc_attr(get_theme_mod('internet_provider_header_menushover1_col')); ?>,<?php echo esc_attr(get_theme_mod('internet_provider_header_menushover2_col')); ?> );
	}

	.main-nav ul ul {
		background-image: linear-gradient( <?php echo esc_attr(get_theme_mod('internet_provider_header_submenubg1_col')); ?>,<?php echo esc_attr(get_theme_mod('internet_provider_header_submenubg2_col')); ?> );
	}

	.main-nav ul ul a {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_header_submenu_col')); ?>;
	}

	.main-nav ul ul a:hover {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_header_submenuhover_col')); ?>;
	}

	.slider-box span {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_slider_shorttext_col')); ?>;
	}

	.slider-box h1 {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_slider_title_col')); ?>;
	}

	.slider-box p {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_slider_description_col')); ?>;
	}

	.slider-box .pagemore a {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_slider_buttontext_col')); ?>;
	}

	.slider-box .pagemore a {
		background: <?php echo esc_attr(get_theme_mod('internet_provider_slider_buttonbg_col')); ?>;
	}

	.slider-box .pagemore a:hover {
		background: <?php echo esc_attr(get_theme_mod('internet_provider_slider_buttonbghover_col')); ?>;
	}

	.slidesection {
		background-image: linear-gradient(to right, <?php echo esc_attr(get_theme_mod('internet_provider_slider_bg1_col')); ?>, <?php echo esc_attr(get_theme_mod('internet_provider_slider_bg2_col')); ?>);
	}

	.owl-prev, .owl-next {
		border-color: <?php echo esc_attr(get_theme_mod('internet_provider_slider_arrow_col')); ?>;
	}

	button.owl-prev span, button.owl-next span {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_slider_arrow_col')); ?>;
	}

	.catwrapslider .owl-prev:hover, .catwrapslider .owl-next:hover {
		background: <?php echo esc_attr(get_theme_mod('internet_provider_slider_arrowhover_col')); ?>;

	}

	.slidesection {
		background-image: linear-gradient(to right, <?php echo esc_attr(get_theme_mod('internet_provider_slider_bg1_col')); ?>, <?php echo esc_attr(get_theme_mod('internet_provider_slider_bg2_col')); ?>);
	}

	.text-inner-box h2 {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_service_title_col')); ?>;
	}

	.serv-btn a {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_service_buttontext_col')); ?>;
	}

	.serv-btn a {
		background: <?php echo esc_attr(get_theme_mod('internet_provider_service_buttonbg_col')); ?>;
	}

	.pagecontent:hover .serv-btn a {
		background: <?php echo esc_attr(get_theme_mod('internet_provider_service_buttonbghover_col')); ?>;
	}

	.thumbbx {
	    background: linear-gradient( 75deg ,transparent 0%,<?php echo esc_attr(get_theme_mod('internet_provider_service_boxbg_col')); ?> 60% );
	}

	.thumbbx:hover:before {
    	background: linear-gradient( 75deg ,<?php echo esc_attr(get_theme_mod('internet_provider_service_boxhover1_col')); ?> 0%,<?php echo esc_attr(get_theme_mod('internet_provider_service_boxhover2_col')); ?> 60% );
	}

	.copywrap, .copywrap p, .copywrap p a, #footer .copywrap a{
		color: <?php echo esc_attr(get_theme_mod('internet_provider_footer_coypright_col')); ?>;
	}

	#footer .copywrap a:hover, .copywrap p:hover, .copywrap:hover{
		color: <?php echo esc_attr(get_theme_mod('internet_provider_footer_coyprighthover_col')); ?>;
	}

	#footer .copywrap {
		background-color: <?php echo esc_attr(get_theme_mod('internet_provider_footer_coyprightbg_col')); ?>;
	}

	#footer {
		background-color: <?php echo esc_attr(get_theme_mod('internet_provider_footer_topbg_col')); ?>;
	}

	#footer h1,#footer h2,#footer h3,#footer h4,#footer h5,#footer h6 {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_footer_heading_col')); ?>;
	}

	#footer p {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_footer_text_col')); ?>;
	}

	#footer li a {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_footer_list_col')); ?>;
	}

	#footer li a:hover {
		color: <?php echo esc_attr(get_theme_mod('internet_provider_footer_listhover_col')); ?>;
	}
	
	</style>
	<?php 
}
endif;