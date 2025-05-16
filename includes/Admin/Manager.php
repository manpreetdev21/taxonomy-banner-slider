<?php 

namespace TaxonomyBannerSlider\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class Manager{

    public function __construct() {
        new Settings();
        new Metabox();
    }
}