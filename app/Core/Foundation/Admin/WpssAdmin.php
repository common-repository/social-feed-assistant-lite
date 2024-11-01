<?php

namespace App\Core\Foundation\Admin;

defined('ABSPATH') || exit('no access');

use App\Core\Support\Menus\WpssMenusGenerator;
use App\Core\Foundation\Contracts\WpssBaseAdmin;

final class WpssAdmin extends WpssBaseAdmin
{
    public static function init(string $prefix, string $version)
    {
        self::$prefix  = $prefix;
        self::$version = $version;

        self::registerScripts();
        self::registerMenus();
    }

    /**
     * it will add menus and submenus for this plugin
     */
    private static function registerMenus()
    {
        add_action('admin_menu', function () {
            WpssMenusGenerator::init(self::$prefix)::register();
        });
    }

    /**
     * it will register and enqueue scripts and styles
     */
    private static function registerScripts()
    {
    }
}
