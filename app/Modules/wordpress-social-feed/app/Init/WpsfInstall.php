<?php

namespace WPSF\Init;

use WPSF\Init\Activator\WpsfDefaultOptions;
use WPSF\Init\Activator\WpsfMigrateDB;

defined('ABSPATH') || exit('no access');

class WpsfInstall
{
    public static function activate()
    {
        self::setDefaultOptions();
        self::dbMigrate();
    }

    private static function setDefaultOptions()
    {
        if(!WpsfDefaultOptions::isBeforeInit()) {
            WpsfDefaultOptions::initial();
        }
    }

    private static function dbMigrate()
    {
        if (WpsfMigrateDB::needMigrateDB()) {
            WpsfMigrateDB::migrate();
        }
    }
}