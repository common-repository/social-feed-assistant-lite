<?php

namespace App\Core\Foundation\Init;

defined('ABSPATH') || exit('no access');

use App\Core\Foundation\Init\Activator\WpssMigrateDB;

class WpssInstall
{
    /* load when plugin activate */
    public static function activate()
    {
        self::dbMigrate();
    }

    private static function dbMigrate()
    {
        if (WpssMigrateDB::needMigrateDB()) {
            WpssMigrateDB::migrate();
        }
    }
}
