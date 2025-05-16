<?php 

namespace TaxonomyBannerSlider\Admin;

class Settings{
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'settings_init'));
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_options_page(
            'Banner Slider Settings',
            'Banner Slider',
            'manage_options',
            'banner_slider',
            array($this, 'options_page')
        );
    }
}