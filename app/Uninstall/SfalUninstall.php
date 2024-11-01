<?php

namespace SFAL\Uninstall;

defined('ABSPATH') || exit('no access');

class SfalUninstall
{
    private static $db;
    private static $tables = [
        'sfal_accounts',
        'sfal_feeds',
        'sfal_feed_contents',
        'sfal_streams',
        'sfal_stream_sources',
        'sfal_stream_filters',
        'sfal_posts',
        'sfal_comments',
    ];
    private static $options = [
        'sfal_db_initialized',
        'sfal_db_version',
        'sfal_general_settings',
        'sfal_options_init',
    ];
    
    public static function deactivation()
    {
        false !== wp_next_scheduled('sfal_feeds_cache_event') && wp_unschedule_hook('sfal_feeds_cache_event');
        false !== wp_next_scheduled('sfal_posts_cache_event') && wp_unschedule_hook('sfal_posts_cache_event');
    }

    public static function uninstall()
    {
        $options = get_option('sfal_general_settings', []);
        if(array_key_exists('eraseData', $options) && $options['eraseData'] == 1) {
            global $wpdb;
            self::$db = $wpdb;
            self::removeTables();
            self::removeOptions();
        }
    }

    private static function removeTables()
    {
        self::$db->query("SET FOREIGN_KEY_CHECKS=0;");
        foreach (self::$tables as $table) {
            $tableName = self::$db->prefix . $table;
            self::$db->query("DROP TABLE IF EXISTS {$tableName};");
        }
        self::$db->query("SET FOREIGN_KEY_CHECKS=1;");
    }

    private static function removeOptions()
    {
        foreach (self::$options as $option) {
            delete_option($option);
        }
    }
}
