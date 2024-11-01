<?php

namespace SFAL\Admin;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Foundation\Abstractions\SfalBaseAdmin;
use SFAL\Core\Support\Menus\SfalMenusGenerator;

final class SfalAdmin extends SfalBaseAdmin
{
    public static function init(string $prefix, string $version)
    {
        self::$prefix  = $prefix;
        self::$version = $version;

        self::setTemplates();
        self::bindMenus();
        self::registerMenus();
    }

    /**
     * it will add templates routes for this plugin
     */
    private static function setTemplates()
    {
        add_filter('SfalTemplateRoutes', function ($routes) {
            return array_merge($routes, SfalConfig('routes.social-feed'));
        });
    }

    /**
     * it will add menus and submenus for this plugin
     */
    private static function bindMenus()
    {
        add_filter('SfalAdminSubmenus', function ($submenus) {
            return array_merge($submenus, SfalConfig('subpages.social-feed'));
        });
    }

    private static function registerMenus()
    {
        add_action('admin_menu', function () {
            SfalMenusGenerator::init(self::$prefix)::register();
        });
    }
}

