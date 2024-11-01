<?php

namespace SFAL\Admin\Menus\Controllers;

defined('ABSPATH') || exit('no access');

use SFAL\Admin\Menus\Tabs\SfalAccountsTab;
use SFAL\Core\Foundation\Abstractions\SfalBaseMenu;
use SFAL\Core\Support\Menus\SfalMenusRenderer;

class SfalGeneralSettingsController extends SfalBaseMenu
{
    protected static $tabs = [
        SfalAccountsTab::class,
    ];

    public static function index()
    {
        SfalMenusRenderer::getInstance()->setTabs(self::$tabs)->load(__('General Settings', 'sfal'), __('common settings for whole plugin', 'sfal'));
    }

    public static function loaded()
    {
        self::commonActions();
    }
}
