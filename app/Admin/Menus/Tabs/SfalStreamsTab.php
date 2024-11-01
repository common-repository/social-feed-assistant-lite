<?php

namespace SFAL\Admin\Menus\Tabs;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Foundation\Contracts\SfalTabContract;
use SFAL\Core\Router\SfalTemplatesRouter;

class SfalStreamsTab implements SfalTabContract
{
    public static function index()
    {
        SfalTemplatesRouter::getInstance()->getTemplate('/streams', true);
    }

    public static function getID(): string
    {
        return 'sfal-streams-tab';
    }

    public static function getLabel(): string
    {
        return __('Streams', 'sfal');
    }

    public static function isDefault(): bool
    {
        return true;
    }
}
