<?php

namespace SFAL\User;

use SFAL\Core\Foundation\Abstractions\SfalBaseUser;

defined('ABSPATH') || exit('no access');

final class SfalUser extends SfalBaseUser
{
    public static function init(string $prefix, string $version)
    {
        self::$prefix  = $prefix;
        self::$version = $version;

        self::userAssets();
    }

    /**
     * it will add fronted assets
     */
    private static function userAssets()
    {
        // TODO
    }
}
