<?php

namespace App\Core\Foundation\Init\Activator;

defined('ABSPATH') || exit('no access');
class WpssMigrateDB
{
    /**
     * task for migration database
     *  
     * @var array
     */
    private static $migration = [
        'createAccountTable',
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
        update_option('wpss_db_version', WPSS()::DB_VERSION);
    }

    /**
     * check is need for upgrade db
     *
     * @return bool
     */
    public static function needMigrateDB() : bool
    {
        return (bool) WPSS()::DB_VERSION > (int) get_option('wpss_db_version', 0);
    }

    /**
     * accounts table creator
     *
     * @return string
     */
    private static function createAccountTable() : string
    {
        $tableName = self::$prefix . 'ss_accounts';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
            id int(11) NOT NULL AUTO_INCREMENT,
            social_type varchar(100) NOT NULL,
            title varchar(255) NOT NULL,
            auth_key varchar(255) NOT NULL,
            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            KEY social_type (social_type)
        ) $charsetCollate;";
    }
}
