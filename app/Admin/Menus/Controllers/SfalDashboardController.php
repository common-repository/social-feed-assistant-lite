<?php

namespace SFAL\Admin\Menus\Controllers;

use SFAL\Core\Foundation\Abstractions\SfalBaseMenu;
use SFAL\Core\Support\Assets\SfalAssetsLoader as Assets;

defined('ABSPATH') || exit('no access');

class SfalDashboardController extends SfalBaseMenu
{
    public static function index()
    {
        SfalViews('menus.dashboard');
    }

    public static function loaded()
    {
        self::removeAdminNotices();
        self::enqueueAssets();
    }

    private static function enqueueAssets()
    {
        $assetsUrl = SfalConfig('app.assetsUrl');
        Assets::getInstance(SFAL()->getPrefix())
        ->enqueueStyle('reset')
        ->enqueueStyle('dashboard', $assetsUrl . 'css/dashboard.css')
        ->enqueueScript('dashboard', $assetsUrl . 'js/dashboard.js', [ 'jquery' ], false, true);
    }
}
