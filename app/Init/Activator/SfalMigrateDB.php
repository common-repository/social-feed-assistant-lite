<?php

namespace SFAL\Init\Activator;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Foundation\Contracts\Database\SfalMigrationsInterface;
use SFAL\Init\Activator\Migrations\SfalInitialMigration;

class SfalMigrateDB
{
    private static $migrations = [
        // ?
    ];

    private static $connection;

    /**
     * initial dependencies for work with database and migration
     */
    private static function initial()
    {
        global $wpdb;
        self::$connection = $wpdb;
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    }

    /**
     * migrate all tasks, one by one
     *
     * @return void
     */
    public static function migrate()
    {
        self::initial();
        if (self::isBeforeInitializedTables()) {
            foreach (self::getCurrentVersionMigrators() as $migrator) {
                is_subclass_of($migrator, SfalMigrationsInterface::class) && $migrator::execute(self::$connection);
            }
        } else {
            SfalInitialMigration::execute(self::$connection);
        }
        update_option('sfal_db_version', SFAL()::DB_VERSION);
    }

    /**
     * check is need for upgrade db
     *
     * @return bool
     */
    public static function needMigrateDB() : bool
    {
        return (bool) self::getDbVersion() > (int) get_option('sfal_db_version', 0);
    }


    private static function getDbVersion()
    {
        return SFAL()::DB_VERSION;
    }
    
    private static function getCurrentVersionMigrators()
    {
        $version = self::getDbVersion();
        return self::$migrations[$version] ?? [];
    }
    
    private static function isBeforeInitializedTables()
    {
        return (bool) get_option('sfal_db_initialized', false);
    }
}
