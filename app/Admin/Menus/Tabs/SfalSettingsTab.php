<?php

namespace SFAL\Admin\Menus\Tabs;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Router\SfalTemplatesRouter;
use SFAL\Core\Foundation\Contracts\SfalTabContract;

class SfalSettingsTab implements SfalTabContract
{
    public static function index()
    {
        SfalTemplatesRouter::getInstance()->getTemplate('/settings', true);
    }

    public static function getID(): string
    {
        return 'sfal-settings-tab';
    }

    public static function getLabel(): string
    {
        return __('Settings', 'sfal');
    }

    public static function isDefault(): bool
    {
        return false;
    }
}
