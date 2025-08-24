<?php
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function internet_provider_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Woocommerce', 'internet-provider' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Classic Blog Grid', 'internet-provider' ),
			'slug'             => 'classic-blog-grid',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'internet_provider_register_recommended_plugins' );