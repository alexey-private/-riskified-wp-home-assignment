<?php

namespace CustomTabsPlugin\Shortcodes;

class TabsShortcode {
	private const OPTION_KEY = 'custom_tabs_data';

	public function register(): void {
		add_shortcode( 'custom_tabs', [ $this, 'render' ] );
	}

	public function render( $atts ): string {
		wp_enqueue_style( 'custom-tabs', plugin_dir_url( __DIR__ ) . '../../assets/css/tabs.css' );
		wp_enqueue_script( 'custom-tabs', plugin_dir_url( __DIR__ ) . '../../assets/js/tabs.js', [], '1.0.0', true );

		$data = get_option( self::OPTION_KEY, [ 'tabs' => [], 'trusted_logos' => [] ] );
		$tabs = $data['tabs'] ?? [];
		$trusted_logos = $data['trusted_logos'] ?? [];

		if ( empty( $tabs ) ) {
			return '<p>' . esc_html__( 'No tabs configured. Configure them in the Custom Tabs admin page.', 'custom-tabs-plugin' ) . '</p>';
		}

		ob_start();
		include __DIR__ . '/../../templates/tabs.php';
		return ob_get_clean();
	}
}
