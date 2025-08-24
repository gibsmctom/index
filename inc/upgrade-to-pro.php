<?php
/**
 * Upgrade to pro options
 */
function internet_provider_upgrade_pro_options( $wp_customize ) {

	$wp_customize->add_section(
		'upgrade_premium',
		array(
			'title'    => esc_html__( 'About Internet Provider', 'internet-provider' ),
			'priority' => 1,
		)
	);

	class Internet_Provider_Pro_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'upgrade_premium';

		function render_content() {
			?>
			<div class="pro_info">
				<ul>
				    <li><a class="upgrade-to-pro pro-btn" href="<?php echo esc_url( INTERNET_PROVIDER_PREMIUM_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-cart"></i><?php esc_html_e( 'Upgrade Pro', 'internet-provider' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( INTERNET_PROVIDER_PRO_DEMO ); ?>" target="_blank"><i class="dashicons dashicons-awards"></i><?php esc_html_e( 'Premium Demo', 'internet-provider' ); ?> </a></li>
					
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( INTERNET_PROVIDER_REVIEW ); ?>" target="_blank"><i class="dashicons dashicons-star-filled"></i><?php esc_html_e( 'Rate Us', 'internet-provider' ); ?> </a></li>
					
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( INTERNET_PROVIDER_SUPPORT ); ?>" target="_blank"><i class="dashicons dashicons-lightbulb"></i><?php esc_html_e( 'Support Forum', 'internet-provider' ); ?> </a></li>
					
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( INTERNET_PROVIDER_THEME_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-admin-appearance"></i><?php esc_html_e( 'Theme Page', 'internet-provider' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( INTERNET_PROVIDER_THEME_DOCUMENTATION ); ?>" target="_blank"><i class="dashicons dashicons-visibility"></i><?php esc_html_e( 'Theme Documentation', 'internet-provider' ); ?> </a></li>

				</ul>
			</div>
			<?php
		}
	}

	$wp_customize->add_setting(
		'pro_info_buttons',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'internet_provider_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Internet_Provider_Pro_Button_Customize_Control(
			$wp_customize,
			'pro_info_buttons',
			array(
				'section' => 'upgrade_premium',
			)
		)
	);
}
add_action( 'customize_register', 'internet_provider_upgrade_pro_options' );
