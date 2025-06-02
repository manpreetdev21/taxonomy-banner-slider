<?php

namespace TaxonomyBannerSlider\Shortcodes;

if (!defined('ABSPATH')) {
    exit;
}

class BannerSlider {

    var $term_page_id = '';
    var $meta_data = array();

    public function __construct() {
        add_shortcode('taxonomy_banner_slider', array($this, 'wp_dwtbs_render_shortcode'));
    }
    
    public function wp_dwtbs_render_shortcode( $atts ) {
        $term = get_queried_object();
        $this->term_page_id = isset($term->term_id) ? $term->term_id : '';
        $this->meta_data = get_term_meta($term->term_id, 'dwtbs_banner_slider', false);

        $layout = isset($atts['layout']) ? sanitize_file_name($atts['layout']) : '1';
        
        // Determine the layout file name
        $layout_file_name = 'dwtbs-layout-' . $layout . '.php';
        $default_file_name = 'dwtbs-shortcode.php';
        
        // First check theme directory
        $theme_dir = get_template_directory() . '/woocommerce/banner_slider/';
        $theme_file = $theme_dir . $layout_file_name;
        
        // Then check plugin directory
        $plugin_dir = MS_DWTBS_PATH . '/templates/';
        $plugin_default = $plugin_dir . $default_file_name;
        
        ob_start();
        
        // Check theme files first
        if ( ( is_dir($theme_dir) == true ) && ( file_exists($theme_file) == true ) ) {
            include_once($theme_file);
        } else {
            include_once($plugin_default);
        }
        return ob_get_clean();
    }
}