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
    }
}
Uninstall::run();