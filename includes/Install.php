<?php 

namespace TaxonomyBannerSlider;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Install script for the Taxonomy Banner Slider plugin
 *
 * This file is responsible for setting up the plugin during activation.
 * It checks system requirements, schedules cron jobs, and sets the installed version.
 *
 * @package TaxonomyBannerSlider
 */
class Install {
    /**
     * Minimum PHP version required
     */
    const MIN_PHP_VERSION = '7.4';

    /**
     * Minimum WordPress version required
     */
    const MIN_WP_VERSION = '5.6';
    
    /**
     * Run installation process
     */
    public static function activate() {
        // Check requirements before installation
        self::check_requirements();

        // Schedule any needed cron jobs
        self::schedule_crons();

        // Set the installed version
        update_option('tbs_version', DwtbsPlugin::VERSION);
    }

    /**
     * Check system requirements
     * 
     * @throws \Exception If requirements aren't met
     */
    private static function check_requirements() {
        global $wp_version;

        // Check PHP version
        if (version_compare(PHP_VERSION, self::MIN_PHP_VERSION, '<')) {
            throw new \Exception(sprintf(
                __('Taxonomy Banner Slider requires PHP %s or higher. You are running PHP %s.', 'taxonomy-banner-slider'),
                self::MIN_PHP_VERSION,
                PHP_VERSION
            ));
        }

        // Check WordPress version
        if (version_compare($wp_version, self::MIN_WP_VERSION, '<')) {
            throw new \Exception(sprintf(
                __('Taxonomy Banner Slider requires WordPress %s or higher. You are running WordPress %s.', 'taxonomy-banner-slider'),
                self::MIN_WP_VERSION,
                $wp_version
            ));
        }
    }

    /**
     * Schedule cron jobs
     */
    private static function schedule_crons() {
        if (!wp_next_scheduled('tbs_daily_maintenance')) {
            wp_schedule_event(time(), 'daily', 'tbs_daily_maintenance');
        }
    }
}