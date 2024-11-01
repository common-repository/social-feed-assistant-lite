<?php

namespace WPSF\Admin\Menus\Tabs;

defined('ABSPATH') || exit('no access');

use App\Core\Router\Templates\WpssTemplatesRouter;
use App\Core\Support\Menus\Tabs\Contracts\WpssTabsContract;

class WpsfFeedsTab implements WpssTabsContract
{
    public static function index()
    {
        WpssTemplatesRouter::getInstance()->getTemplate('/feeds', true);
    }

    public static function getID(): string
    {
        return 'wpsf-feeds-tab';
    }

    public static function getLabel(): string
    {
        return __('Feeds', 'wp-ss');
    }

    public static function isDefault(): bool
    {
        return false;
    }
}
