<?php

namespace App\Core\Support\Menus\Controllers;

use App\Core\Support\Menus\Controllers\Contracts\WpssMenusContract;
use App\Core\Support\Assets\WpssAssetsLoader as Assets;

defined('ABSPATH') || exit('no access');

class WpssDashboardController extends WpssMenusContract
{
    public static function index()
    {
        WpssViews('menus.dashboard');
    }

    public static function loaded()
    {
        self::removeAdminNotices();
        self::enqueueAssets();
    }

    private static function enqueueAssets()
    {
        $assetsUrl = WpssConfig('app.assetsUrl');
        Assets::getInstance(WPSS()->getPrefix())->enqueueStyle('reset', $assetsUrl . 'css/reset.css');
        Assets::getInstance()->enqueueStyle('dashboard', $assetsUrl . 'css/dashboard.css');
        Assets::getInstance()->enqueueScript('dashboard', $assetsUrl . 'js/dashboard.js', [ 'jquery' ], false, true);
    }
}
