<?php 
/**
* Plugin Name: Dynamic Woo Taxonomy Banner Slider
* Description: WordPress Dynamic Woo Taxonomy Banner Slider for WooCommerce, easy to use with help of shortcodes.
* Plugin URI: https://github.com/lucifermani21/taxonomy-banner-slider.git
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
    wp_die(__('Plugin loader file is missing.', MS_SBS_TEXT_DOMAIN));
}

// Initialize the plugin
TaxonomyBannerSlider\DwtbsPlugin::get_instance();