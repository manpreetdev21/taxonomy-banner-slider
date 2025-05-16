<?php 

namespace TaxonomyBannerSlider\Frontend;

class Display {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_footer', array($this, 'render_shortcode'));
    }
    
    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts() {
        wp_enqueue_style('dwtbs-banner-slider', plugin_dir_url(__FILE__) . 'assets/css/banner-slider.css', array(), '1.0.0');
        wp_enqueue_script('dwtbs-banner-slider', plugin_dir_url(__FILE__) . 'assets/js/banner-slider.js', array('jquery'), '1.0.0', true);
    }  
}