<?php

namespace SFAL\Admin\Menus\Tabs;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Router\SfalTemplatesRouter;
use SFAL\Core\Foundation\Contracts\SfalTabContract;

class SfalAccountsTab implements SfalTabContract
{
    public static function index()
    {
        SfalTemplatesRouter::getInstance()->getTemplate('/accounts', true);
    }

    public static function getID(): string
    {
        return 'sfal-accounts-tab';
    }

    public static function getLabel(): string
    {
        return __('Account Manager', 'sfal');
    }

    public static function isDefault(): bool
    {
        return true;
    }
}
