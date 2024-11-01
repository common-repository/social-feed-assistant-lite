<?php

namespace App\Core\Support\Menus\Controllers;

defined('ABSPATH') || exit('no access');

use App\Core\Support\Menus\WpssMenusRenderer;
use App\Core\Support\Menus\Tabs\WpssAccountsTab;
use App\Core\Support\Menus\Controllers\Contracts\WpssMenusContract;

class WpssGeneralSettingsController extends WpssMenusContract
{
    protected static $tabs = [
        WpssAccountsTab::class,
    ];

    public static function index()
    {
        WpssMenusRenderer::getInstance()->setTabs(self::$tabs)->load(__('General Settings', 'wp-ss'), __('common settings for whole plugin', 'wp-ss'));
    }

    public static function loaded()
    {
        self::commonActions();
    }
}
