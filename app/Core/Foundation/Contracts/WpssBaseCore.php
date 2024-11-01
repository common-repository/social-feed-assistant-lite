<?php

namespace App\Core\Foundation\Contracts;

defined('ABSPATH') || exit('no access');

/**
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 *
 */
abstract class WpssBaseCore
{
    public static function init(string $version, string $prefix)
    {
        static::setVersion($version);
        static::setPrefix($prefix);

        static::doIncludes();
        static::everyWhere();

        /* run while is admin dashboard */
        if (static::is('admin')) {
            static::admin();
        }

        /* run while is frontend request */
        if (static::is('frontend')) {
            static::frontend();
        }

        /* run while is ajax request */
        if (static::is('ajax')) {
            static::ajax();
        }
    }

    /**
     * Checks the current request of the plugin
     *
     * @param  string  $request
     *
     * @return bool
     */
    protected static function is(string $request)
    {
        switch ($request) {
            case 'admin':
                return is_admin();
            case 'ajax':
                return wp_doing_ajax();
            case 'frontend':
                return ! is_admin();
        }
    }

    /**
     * this method will call everyWhere and suitation
     *
     * @return mixed
     */
    abstract protected static function everyWhere();

    /**
     * this method will call when request was on admin side
     *
     * @return mixed
     */
    abstract protected static function admin();

    /**
     * this method will call when request was on fronted side
     *
     * @return mixed
     */
    abstract protected static function frontend();

    /**
     * this method will call when request was ajax request
     *
     * @return mixed
     */
    abstract protected static function ajax();

    /**
     * this method is for include module ( plugin ) needed files
     *
     * @return mixed
     */
    abstract protected static function doIncludes();

    abstract protected static function setVersion(string $version);

    abstract protected static function setPrefix(string $prefix);
}
