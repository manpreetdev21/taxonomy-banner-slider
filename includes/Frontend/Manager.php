<?php 

namespace TaxonomyBannerSlider\Frontend;

if (!defined('ABSPATH')) {
    exit;
}

class Manager{    
    public function __construct() {
        new Display();
    }
}