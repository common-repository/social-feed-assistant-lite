<?php

namespace SFAL\Admin\Menus\Tabs;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Router\SfalTemplatesRouter;
use SFAL\Core\Foundation\Contracts\SfalTabContract;

class SfalFeedsTab implements SfalTabContract
{
    public static function index()
    {
        SfalTemplatesRouter::getInstance()->getTemplate('/feeds', true);
    }

    public static function getID(): string
    {
        return 'sfal-feeds-tab';
    }

    public static function getLabel(): string
    {
        return __('Feeds', 'sfal');
    }

    public static function isDefault(): bool
    {
        return false;
    }
}
