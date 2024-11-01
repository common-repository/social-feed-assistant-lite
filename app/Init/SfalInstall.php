<?php

namespace SFAL\Init;

use SFAL\Init\Activator\SfalMigrateDB;
use SFAL\Init\Activator\SfalDefaultOptions;

defined('ABSPATH') || exit('no access');

class SfalInstall
{
    /* load when plugin activate */
    public static function activate()
    {
        self::setDefaultOptions();
        self::dbMigrate();
    }

    private static function setDefaultOptions()
    {
        SfalDefaultOptions::isBeforeInit() || SfalDefaultOptions::initial();
    }

    private static function dbmigrate()
    {
        SfalMigrateDB::needMigrateDb() && SfalMigrateDB::migrate();
    }
}
