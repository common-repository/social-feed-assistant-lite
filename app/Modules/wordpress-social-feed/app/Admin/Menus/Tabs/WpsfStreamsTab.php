<?php

namespace WPSF\Admin\Menus\Tabs;

defined('ABSPATH') || exit('no access');

use App\Core\Router\Templates\WpssTemplatesRouter;
use App\Core\Support\Menus\Tabs\Contracts\WpssTabsContract;

class WpsfStreamsTab implements WpssTabsContract
{
    public static function index()
    {
        WpssTemplatesRouter::getInstance()->getTemplate('/streams', true);
    }

    public static function getID(): string
    {
        return 'wpsf-streams-tab';
    }

    public static function getLabel(): string
    {
        return __('Streams', 'wp-ss');
    }

    public static function isDefault(): bool
    {
        return true;
    }
}
