<?php

namespace CustomTabsPlugin\Shortcodes;

use CustomTabsPlugin\Config;

class TabsShortcode {

	public function register(): void {
		add_shortcode( 'custom_tabs', [ $this, 'render' ] );
	}

	public function render( array $atts = [] ): string {
		wp_enqueue_style( 'custom-tabs', CUSTOM_TABS_URL . 'assets/css/tabs.css', [], CUSTOM_TABS_VERSION );
		wp_enqueue_script( 'custom-tabs', CUSTOM_TABS_URL . 'assets/js/tabs.js', [], CUSTOM_TABS_VERSION, true );

		$data          = get_option( Config::OPTION_KEY, Config::DEFAULT_DATA );
		$tabs          = $data['tabs'] ?? [];
		$trusted_logos = $data['trusted_logos'] ?? [];

		if ( empty( $tabs ) ) {
			return '<p>' . esc_html__( 'No tabs configured. Configure them in the Custom Tabs admin page.', 'custom-tabs-plugin' ) . '</p>';
		}

		ob_start();
		include CUSTOM_TABS_PATH . 'templates/tabs.php';
		return ob_get_clean();
	}
}
