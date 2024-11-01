<?php

namespace SFAL\Init;

use SFAL\Admin\SfalAdmin;
use SFAL\Ajax\SfalAjax;
use SFAL\Init\SfalI18n;
use SFAL\Core\Foundation\Abstractions\SfalBaseCore;
use SFAL\Core\Support\Shortcode\SfalShortcodeHandler;
use SFAL\Shortcodes\SfalShowStreamShortcode;
use SFAL\User\SfalUser;

defined('ABSPATH') || exit('no access');

class SfalCore extends SfalBaseCore
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
        self::registerScripts();
        self::translation();
        self::registerShortcodes();
    }

    /**
     * @inheritDoc
     */
    protected static function admin()
    {
        SfalAdmin::init(self::$prefix, self::$version);
    }

    /**
     * @inheritDoc
     */
    protected static function frontend()
    {
        SfalUser::init(self::$prefix, self::$version);
    }

    /**
     * @inheritDoc
     */
    protected static function ajax()
    {
        SfalAjax::init(self::$prefix, self::$version);
    }

    private static function registerScripts()
    {
        add_action('wp_loaded', function(){
            SfalInitialize::registerScripts();
        });
    }

    /**
     * @inheritDoc
     */
    private static function translation()
    {
        add_action('init', [ SfalI18n::class, 'loadPluginTextDomain' ]);
    }

    private static function registerShortcodes()
    {
        add_action('init', function () {
            SfalShortcodeHandler::add('wp-sfstream', [ SfalShowStreamShortcode::class, 'handle' ]);
        });  
    }

    /**
     * @inheritDoc
     */
    protected static function doIncludes()
    {
        self::includeHelpers();
    }

    /**
     * this will include helper functions for used on whole plugin
     */
    private static function includeHelpers()
    {
        $helpers = SFAL_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'Foundation' . DIRECTORY_SEPARATOR . 'SfalHelpers.php';

        is_readable($helpers) || wp_die('sorry plugin helper functions file is not readable !');

        require_once $helpers;
    }
}
