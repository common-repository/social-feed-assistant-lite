<?php

namespace WPSF\Admin;

defined('ABSPATH') || exit('no access');

use App\Core\Foundation\Contracts\WpssBaseAdmin;
use App\Core\Support\Shortcode\WpssShortcodeHandler;
use WPSF\Shortcodes\WpsfShowStreamShortcode;

final class WpsfAdmin extends WpssBaseAdmin
{
    public static function init(string $prefix, string $version)
    {
        self::$prefix  = $prefix;
        self::$version = $version;

        self::setTemplates();
        self::adminAssets();
        self::registerMenus();
    }

    /**
     * it will add menus and submenus for this plugin
     */
    private static function registerMenus()
    {
        add_filter('WpssAdminSubmenus', function ($submenus) {
            return array_merge($submenus, WpssConfig('subpages.social-feed'));
        });
    }

    /**
     * it will register and enqueue scripts and styles
     */
    private static function adminAssets()
    {
        add_action('admin_enqueue_scripts', function () {
        });
    }

    /**
     * it will add templates routes for this plugin
     */
    private static function setTemplates()
    {
        add_filter('WpssTemplateRoutes', function ($routes) {
            return array_merge($routes, WpssConfig('routes.social-feed'));
        });
    }
}
