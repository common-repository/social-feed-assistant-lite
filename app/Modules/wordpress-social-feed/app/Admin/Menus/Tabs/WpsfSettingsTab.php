<?php

namespace WPSF\Admin\Menus\Tabs;

defined('ABSPATH') || exit('no access');

use App\Core\Router\Templates\WpssTemplatesRouter;
use App\Core\Support\Menus\Tabs\Contracts\WpssTabsContract;

class WpsfSettingsTab implements WpssTabsContract
{
    public static function index()
    {
        WpssTemplatesRouter::getInstance()->getTemplate('/settings', true);
    }

    public static function getID(): string
    {
        return 'wpsf-settings-tab';
    }

    public static function getLabel(): string
    {
        return __('Settings', 'wp-ss');
    }

    public static function isDefault(): bool
    {
        return false;
    }
}
