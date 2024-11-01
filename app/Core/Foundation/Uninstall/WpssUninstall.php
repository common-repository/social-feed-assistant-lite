<?php

namespace App\Core\Foundation\Uninstall;

defined('ABSPATH') || exit('no access');

class WpssUninstall
{
    private static $db;
    private static $tables = [
        'ss_accounts',
        'sf_feeds',
        'sf_posts',
        'sf_comments',
        'sf_streams',
        'sf_streams_sources'
    ];
    private static $options = [
        'wpss_db_version',
        'wpsf_general_settings',
        'wpsf_options_init',
        'wpsf_db_version'
    ];
    public static function deactivation()
    {
        if ( wp_next_scheduled('wpsf_feeds_cache_event') ) {
            wp_clear_scheduled_hook('wpsf_feeds_cache_event');
        }
    }

    public static function uninstall()
    {
        $options = get_option('wpsf_general_settings', []);
        if(array_key_exists('eraseData', $options) && $options['eraseData'] == 1) {
            global $wpdb;
            self::$db = $wpdb;
            self::removeTables();
            self::removeOptions();
        }
    }

    private static function removeTables()
    {
        foreach (self::$tables as $table) {
            $tableName = self::$db->prefix . $table;
            self::$db->query("DROP TABLE IF EXISTS {$tableName};");
        }
    }

    private static function removeOptions()
    {
        foreach (self::$options as $option) {
            delete_option($option);
        }
    }
}
