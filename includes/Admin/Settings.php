<?php 

namespace TaxonomyBannerSlider\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class Settings{
    
    private array $admin_style = [
        'backend-dwtbs-plugin-style' => ['assets/backend/css/backend-style.css', [], null],
    ];

    private array $admin_script = [
        'backend-dwtbs-plugin-script' => ['assets/backend/js/backend-script.js', ['jquery'], null],
    ];

    public function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'wp_dwtbs_script_style_admin']);
    }

    public function wp_dwtbs_script_style_admin(): void {
        if (!defined('MS_DWTBS_URL') || !defined('MS_DWTBS_PATH')) {
            return;
        }
        
        // Check if we're on the product category screen
        $screen = get_current_screen();
        if (!$screen || 'product_cat' !== $screen->taxonomy) {
            return;
        }

        $this->enqueue_assets($this->admin_style, $this->admin_script);

        // Then localize the script (must be after the script is registered)
        if (function_exists('wc_placeholder_img_src')) {
            wp_localize_script(
                'backend-dwtbs-plugin-script',
                'taxonomy_banner_slider_vars',
                array(
                    'placeholder_url' => wc_placeholder_img_src()
                )
            );
        }
    }

    private function enqueue_assets(array $styles, array $scripts): void {
        foreach ($styles as $key => $value) {
            $file_path = MS_DWTBS_PATH . $value[0];
            $version = $value[2] ?? (file_exists($file_path) ? filemtime($file_path) : null);
            wp_register_style($key, MS_DWTBS_URL . $value[0], $value[1], $version);
            wp_enqueue_style($key);
        }

        foreach ($scripts as $key => $value) {
            $file_path = MS_DWTBS_PATH . $value[0];
            $version = $value[2] ?? (file_exists($file_path) ? filemtime($file_path) : null);
            wp_register_script($key, MS_DWTBS_URL . $value[0], $value[1], $version, true);
            wp_enqueue_script($key);
        }
    }

}