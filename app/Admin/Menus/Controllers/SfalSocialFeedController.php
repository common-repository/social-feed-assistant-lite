<?php

namespace SFAL\Admin\Menus\Controllers;

defined('ABSPATH') || exit('no access');

use SFAL\Admin\Menus\Tabs\SfalFeedsTab;
use SFAL\Admin\Menus\Tabs\SfalStreamsTab;
use SFAL\Admin\Menus\Tabs\SfalSettingsTab;
use SFAL\Core\Support\Menus\SfalMenusRenderer;
use SFAL\Core\Foundation\Abstractions\SfalBaseMenu;

class SfalSocialFeedController extends SfalBaseMenu
{
    protected static $tabs = [
        SfalStreamsTab::class,
        SfalFeedsTab::class,
        SfalSettingsTab::class,
    ];

    public static function index()
    {
        SfalMenusRenderer::getInstance()->setTabs(self::$tabs)->load(
            __('Social Feed Assistant', 'sfal'),
            __('Creating amazing galleries of instagram images', 'sfal'),
            [ 'type' => 'image', 'url' => SfalConfig('app.assetsUrl') . 'img/admin/feed-menu-icon.png']
        );
    }

    public static function loaded()
    {
        self::commonActions();
    }
}
