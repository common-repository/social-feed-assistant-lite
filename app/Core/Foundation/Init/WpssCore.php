<?php

namespace App\Core\Foundation\Init;

use App\Core\Foundation\Init\WpssI18n;
use App\Core\Foundation\Ajax\WpssAjax;
use App\Core\Foundation\Admin\WpssAdmin;
use App\Core\Foundation\Contracts\WpssBaseCore;
use App\Core\Foundation\Facades\WpssModuleActivatorFacade;

defined('ABSPATH') || exit('no access');

class WpssCore extends WpssBaseCore
{
    private static $prefix;
    private static $version;

    protected static function setVersion(string $version)
    {
        self::$version = $version;
    }

    protected static function setPrefix(string $prefix)
    {
        self::$prefix = $prefix;
    }

    /**
     * @inheritDoc
     */
    protected static function everyWhere()
    {
        self::translation();
    }

    /**
     * @inheritDoc
     */
    protected static function admin()
    {
        WpssAdmin::init(self::$prefix, self::$version);
    }

    /**
     * @inheritDoc
     */
    protected static function frontend()
    {
        // TODO: Implement frontend() method.
    }

    /**
     * @inheritDoc
     */
    protected static function ajax()
    {
        WpssAjax::init(self::$prefix, self::$version);
    }

    /**
     * @inheritDoc
     */
    private static function translation()
    {
        add_action('init', [ WpssI18n::class, 'loadPluginTextDomain' ]);
    }

    /**
     * @inheritDoc
     */
    protected static function doIncludes()
    {
        self::includeHelpers();
        self::includeModules();
    }

    /**
     * this will include plugin modules from them path
     */
    private static function includeModules()
    {
        WpssModuleActivatorFacade::includeModules(WpssConfig('modules'));
    }

    /**
     * this will include helper functions for used on whole plugin
     */
    private static function includeHelpers()
    {
        $helpers = WPSS_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'Foundation' . DIRECTORY_SEPARATOR . 'WpssHelpers.php';

        if (! is_readable($helpers)) {
            wp_die('sorry plugin helper functions file is not readable !');
        }
        require_once $helpers;
    }
}
