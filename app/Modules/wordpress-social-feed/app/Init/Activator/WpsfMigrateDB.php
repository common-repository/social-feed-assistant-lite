<?php

namespace WPSF\Init\Activator;

defined('ABSPATH') || exit('no access');
class WpsfMigrateDB
{
    /**
     * task for migration database
     *  
     * @var array
     */
    private static $migration = [
        'createFeedsTable',
        'createStreamsTable',
        'createStreamSourcesTable',
        'createPostsTable',
        'createCommentsTable'
    ];

    private static $prefix;
    private static $charsetCollate;

    private static $sqls = [];

    /**
     * initial dependencies for work with database and migration
     */
    private static function initial()
    {
        global $wpdb;
        self::$prefix = $wpdb->prefix;
        self::$charsetCollate = $wpdb->get_charset_collate();
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    }

    /**
     * migrate all tasks, one by one
     *
     * @return void
     */
    public static function migrate()
    {
        self::initial();
        foreach (self::$migration as $migrator) {
            if (method_exists(self::class, $migrator)) {
                self::$sqls[] = self::{$migrator}();
            }
        }
        dbDelta(self::$sqls);
        update_option('wpsf_db_version', WPSF()::DB_VERSION);
    }

    /**
     * check is need for upgrade db
     *
     * @return bool
     */
    public static function needMigrateDB() : bool
    {
        return (bool) WPSF()::DB_VERSION > (int) get_option('wpsf_db_version', 0);
    }

    /**
     * feeds table creator
     *
     * @return string
     */
    private static function createFeedsTable() : string
    {
        $tableName = self::$prefix . 'sf_feeds';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
            id int(11) NOT NULL AUTO_INCREMENT,
            account_id int(11) NOT NULL,
            name varchar(100) NOT NULL,
            social_type varchar(100) NOT NULL,
            type varchar(100) NOT NULL,
            content varchar(100) NOT NULL,
            frequency_update varchar(11) NOT NULL,
            exclude varchar(500) NOT NULL,
            include varchar(500) NOT NULL,
            last_cache int(11) NOT NULL,
            cache_error varchar(500),
            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            KEY account_id (account_id)
            ) $charsetCollate;";
    }

    /**
     * streams table creator
     *
     * @return string
     */
    private static function createStreamsTable() : string
    {
        $tableName = self::$prefix . 'sf_streams';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        options text NOT NULL,
        filters varchar(500) NOT NULL,
        updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
        ) $charsetCollate;";
    }

    /**
     * stream sources table creator
     *
     * @return string
     */
    private static function createStreamSourcesTable() : string
    {
        $tableName = self::$prefix . 'sf_streams_sources';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
        id int(11) NOT NULL AUTO_INCREMENT,
        stream_id int(11) NOT NULL,
        feeds varchar(255) NOT NULL,
        updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        KEY stream_id (stream_id)
        ) $charsetCollate;";
    }

    /**
     * posts table creator
     *
     * @return string
     */
    private static function createPostsTable() : string
    {
        $tableName = self::$prefix . 'sf_posts';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
        id int(11) NOT NULL AUTO_INCREMENT,
        feed_id int(11) NOT NULL,
        feed_multi int(11) NOT NULL,
        post_id varchar(50) NOT NULL,
        type varchar(10) NOT NULL,
        media_type varchar(100) NOT NULL,
        user text NOT NULL,
        text text NOT NULL,
        permalink varchar(300) NOT NULL,
        rand_order float(11) NOT NULL,
        timestamp int(11) NOT NULL,
        carousel text NOT NULL,
        media text NOT NULL,
        images text NOT NULL,
        videos text NOT NULL,
        location varchar(1000) NOT NULL,
        additional varchar(1000) NOT NULL,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        KEY feed_id (feed_id),
        KEY type (type)
        ) $charsetCollate;";
    }

    /**
     * comments table creator
     *
     * @return string
     */
    private static function createCommentsTable() : string
    {
        $tableName = self::$prefix . 'sf_comments';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
        id int(11) NOT NULL AUTO_INCREMENT,
        feed_id int(11) NOT NULL,
        feed_multi int(11) NOT NULL,
        post_id varchar(50) NOT NULL,
        `from` varchar(1000) NOT NULL,
        text text NOT NULL,
        created_time int(11) NOT NULL,
        PRIMARY KEY  (id),
        KEY post_id (post_id),
        KEY feed_id (feed_id)
        ) $charsetCollate;";
    }
}
