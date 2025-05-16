<?php

namespace TaxonomyBannerSlider\Shortcodes;

if (!defined('ABSPATH')) {
    exit;
}

class BannerSlider {
    public function __construct() {
        add_shortcode('taxonomy_banner_slider', array($this, 'render_shortcode'));
    }
    
    public function render_shortcode($atts) {
        // Shortcode implementation
    }
}