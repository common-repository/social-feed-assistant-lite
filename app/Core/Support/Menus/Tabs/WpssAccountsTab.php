<?php

namespace App\Core\Support\Menus\Tabs;

defined('ABSPATH') || exit('no access');

use App\Core\Socials\WpssSocialsManager;
use App\Core\Router\Templates\WpssTemplatesRouter;
use App\Core\Repository\Factory\WpssRepositoryFactory;
use App\Core\Foundation\Ajax\Controllers\WpssGetTemplateAjax;
use App\Core\Support\Menus\Tabs\Contracts\WpssTabsContract;

class WpssAccountsTab implements WpssTabsContract
{
    public static function index()
    {
        WpssTemplatesRouter::getInstance()->getTemplate('/accounts', true);
    }

    public static function getID(): string
    {
        return 'wpss-accounts-tab';
    }

    public static function getLabel(): string
    {
        return __('Account Manager', 'wp-ss');
    }

    public static function isDefault(): bool
    {
        return true;
    }
}
