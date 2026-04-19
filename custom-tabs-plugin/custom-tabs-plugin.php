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

require_once __DIR__ . '/vendor/autoload.php';

( new \CustomTabsPlugin\Plugin() )->boot();
