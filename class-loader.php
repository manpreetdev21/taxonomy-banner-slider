<?php 

namespace TaxonomyBannerSlider;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Autoloader for plugin classes
 */
spl_autoload_register(function ($class) {
    $prefix = __NAMESPACE__ . '\\';
    $base_dir = __DIR__ . '/includes/';
    
    // Does the class use the namespace prefix?
    $len = strlen($prefix);
	
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    // Get the relative class name
    $relative_class = substr($class, $len);
    
    // Replace the namespace prefix with the base directory
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

/**
 * Main plugin class
 */
class DwtbsPlugin {
    
    /**
     * Plugin version
     */
    const VERSION = '1.0.0';
    
    /**
     * Singleton instance
     */
    private static $instance = null;
    
    /**
     * Core classes
     */
    private $admin;
    private $shortcode;
    
    /**
     * Get singleton instance
     */
    public static function get_instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        $this->define_constants();
        $this->init_hooks();
        $this->init_components();
    }
    
    /**
     * Define plugin constants
     */
    private function define_constants() {
        define('MS_DWTBS_VERSION', self::VERSION);
        define('MS_DWTBS_PATH', plugin_dir_path(__FILE__));
        define('MS_DWTBS_URL', plugin_dir_url(__FILE__));
        define('MS_DWTBS_BASENAME', plugin_basename(__FILE__));
    }
    
    /**
     * Initialize hooks
     */
    private function init_hooks() {
        register_activation_hook(__FILE__, array('TaxonomyBannerSlider\\Install', 'activate'));
        register_deactivation_hook(__FILE__, array('TaxonomyBannerSlider\\Uninstall', 'deactivate'));
        
        add_action('plugins_loaded', array($this, 'load_textdomain'));
    }
    
    /**
     * Initialize plugin components
     */
    private function init_components() {
        $this->admin = new Admin\Manager();
        $this->shortcode = new Shortcodes\BannerSlider();
    }
    
    /**
     * Load plugin textdomain
     */
    public function load_textdomain() {
        load_plugin_textdomain(
            'taxonomy-banner-slider',
            false,
            dirname(MS_DWTBS_BASENAME) . '/languages/'
        );
    }
}