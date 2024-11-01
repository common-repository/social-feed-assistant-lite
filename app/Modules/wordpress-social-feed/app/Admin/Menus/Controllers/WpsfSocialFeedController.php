<?php

namespace WPSF\Admin\Menus\Controllers;

defined('ABSPATH') || exit('no access');

use App\Core\Support\Config\WpssConfig;
use WPSF\Admin\Menus\Tabs\WpsfFeedsTab;
use WPSF\Admin\Menus\Tabs\WpsfStreamsTab;
use WPSF\Admin\Menus\Tabs\WpsfSettingsTab;
use App\Core\Support\Menus\WpssMenusRenderer;
use App\Core\Support\Menus\Controllers\Contracts\WpssMenusContract;

class WpsfSocialFeedController extends WpssMenusContract
{
    protected static $tabs = [
        WpsfStreamsTab::class,
        WpsfFeedsTab::class,
        WpsfSettingsTab::class,
    ];

    public static function index()
    {
        WpssMenusRenderer::getInstance()->setTabs(self::$tabs)->load(
            __('Social Feed Assistant', 'wp-ss'),
            __('Creating amazing galleries of instagram images', 'wp-ss'),
            [ 'type' => 'image', 'url' => WpssConfig('app.assetsUrl') . 'img/admin/feed-menu-icon.png']
        );
    }

    public static function loaded()
    {
        self::commonActions();
    }
}
