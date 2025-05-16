<?php 
/**
* Plugin Name: Dynamic Woo Taxonomy Banner Slider
* Description: WordPress Dynamic Woo Taxonomy Banner Slider for WooCommerce, easy to use with help of shortcodes.
* Plugin URI: #
* Version: 1.0.0
* Author: Manpreet Singh
**/

if ( ! defined( 'ABSPATH' ) ) {
     die;
}
define( 'MS_DWTBS_VERSION', '1.0.0' );
define( 'MS_DWTBS_TEXT_DOMAIN', 'ms-banner-slider' );
define( 'MS_DWTBS_DIR__NAME', dirname( __FILE__ ) );
define( 'MS_DWTBS_EDITING_URL', plugin_dir_url( __FILE__ ) );
define( 'MS_DWTBS_EDITING_DIR', plugin_dir_path( __FILE__ ) );
define( 'MS_DWTBS_PLUGIN', __FILE__ );
define( 'MS_DWTBS_PLUGIN_BASENAME', plugin_basename( MS_DWTBS_PLUGIN ) );

function wp_dfbs_plugin_init(): void {
	$loader = MS_DWTBS_EDITING_DIR . 'class-loader.php';
	if (file_exists($loader) ) {
		require_once $loader;
	} else {
		wp_die(__('Plugin loader file is missing.', MS_DWTBS_TEXT_DOMAIN));
	}
}
add_action( 'plugins_loaded', 'wp_dfbs_plugin_init' );