<?php

namespace WPSF\User;

use App\Core\Foundation\Contracts\WpssBaseUser;

defined('ABSPATH') || exit('no access');

final class WpsfUser extends WpssBaseUser
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
