<?php

namespace TaxonomyBannerSlider;


if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

/**
 * Uninstall script for the Taxonomy Banner Slider plugin
 *
 * This file is responsible for cleaning up any data created by the plugin
 * when it is uninstalled. It removes scheduled cron jobs and any other
 * necessary cleanup tasks.
 *
 * @package TaxonomyBannerSlider
 */
class Uninstall {
    public static function run() {
        // Check if we should remove all data
        $remove_all_data = get_option('tbs_remove_all_data', false);

        if (!apply_filters('tbs_remove_all_data_on_uninstall', $remove_all_data)) {
            return;
        }

        // Remove all plugin data
        self::remove_cron_jobs();
    }

    /**
     * Remove scheduled cron jobs
     */
    private static function remove_cron_jobs() {
        $crons = [
            'tbs_daily_maintenance',
        ];

        foreach ($crons as $cron) {
            wp_clear_scheduled_hook($cron);
        }
    }
}
Uninstall::run();