<?php 

namespace TaxonomyBannerSlider\Admin;

class Manager{

    public function __construct() {
        new Settings();
        new Metabox();
    }
}