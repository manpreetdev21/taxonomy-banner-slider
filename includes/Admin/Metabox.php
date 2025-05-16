<?php 

namespace TaxonomyBannerSlider\Admin;

class Metabox{
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_boxes'));
    }

    /**
     * Add meta boxes
     */
    public function add_meta_boxes() {
        add_meta_box(
            'dwtbs_banner_slider',
            __('Banner Slider', 'dwtbs'),
            array($this, 'render_meta_box'),
            'post',
            'normal',
            'high'
        );
    }

    /**
     * Render meta box
     */
    public function render_meta_box($post) {
        // Render the meta box content here
        echo '<p>' . __('Meta box content goes here.', 'dwtbs') . '</p>';
    }

    /**
     * Save meta box data
     */
    public function save_meta_boxes($post_id) {
        // Save the meta box data here
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        // Save your data here
    }
    
}