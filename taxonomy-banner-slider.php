<?php 
/**
* Plugin Name: Dynamic Woo Taxonomy Banner Slider
* Description: WordPress Dynamic WooCommerce Taxonomy Banner Slider for WooCommerce, easy to use with the help of shortcodes.
* Plugin URI: https://github.com/manpreetdev21/taxonomy-banner-slider.git
* Version: 1.0.0
* Author: Manpreet Singh
* Text Domain: taxonomy-banner-slider
**/

if (!defined('ABSPATH')) {
    exit;
}

$loader = plugin_dir_path(__FILE__) . 'class-loader.php';
if (file_exists($loader) ) {
    require_once $loader;
} else {
    wp_die(__('Plugin loader file is missing.', 'taxonomy-banner-slider'));
}

// Initialize the plugin
TaxonomyBannerSlider\DwtbsPlugin::get_instance();
