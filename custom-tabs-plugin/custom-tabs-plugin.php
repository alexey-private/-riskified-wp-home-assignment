<?php
/**
 * Plugin Name: Custom Tabs Plugin
 * Description: Case study industry tabs component
 * Version: 1.0.0
 * Author: Alexey
 * Text Domain: custom-tabs-plugin
 * Domain Path: /languages
 */

if ( ! function_exists( 'add_action' ) ) {
	exit;
}

define( 'CUSTOM_TABS_VERSION', '1.0.0' );
define( 'CUSTOM_TABS_URL', plugin_dir_url( __FILE__ ) );
define( 'CUSTOM_TABS_PATH', plugin_dir_path( __FILE__ ) );

require_once __DIR__ . '/vendor/autoload.php';

( new \CustomTabsPlugin\Plugin() )->boot();
