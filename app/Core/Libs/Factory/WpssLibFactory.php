<?php

namespace App\Core\Libs\Factory;

defined('ABSPATH') || exit('no access');

use App\Core\Libs\Validator\WpssValidator;

class WpssLibFactory
{
    private static $alias = [
        'validator' => WpssValidator::class
    ];
    private static $libs = [];

    /**
     * @param $lib
     *
     * @return bool|mixed|null
     */
    public static function make($lib)
    {
        $lib = self::hasOnAlias($lib) ? self::$alias[ $lib ] : $lib;

        return self::resolveLib($lib);
    }

    /**
     * @param $lib
     *
     * @return bool|mixed|null
     */
    private static function resolveLib($lib)
    {
        if (! class_exists($lib)) {
            return false;
        }

        if (! self::hasLib($lib)) {
            self::storeLib($lib);
        }

        return self::getLib($lib);
    }

    /**
     * @param $lib
     */
    private static function storeLib($lib)
    {
        self::$libs[ $lib ] = new $lib;
    }

    /**
     * @param $lib
     *
     * @return bool
     */
    private static function hasLib($lib)
    {
        return array_key_exists($lib, self::$libs);
    }

    /**
     * @param $lib
     *
     * @return mixed|null
     */
    private static function getLib($lib)
    {
        return self::$libs[ $lib ] ?? null;
    }

    /**
     * @param $lib
     *
     * @return bool
     */
    private static function hasOnAlias($lib)
    {
        return array_key_exists($lib, self::$alias);
    }
}
