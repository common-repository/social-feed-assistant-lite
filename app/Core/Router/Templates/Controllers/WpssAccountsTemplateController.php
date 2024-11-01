<?php

namespace App\Core\Router\Templates\Controllers;

defined('ABSPATH') || exit('no access');

use App\Core\Socials\WpssSocialsManager;
use App\Core\Services\WpssAccountsService;

class WpssAccountsTemplateController
{
    public static function accounts()
    {
        $accounts = self::getAccounts();

        return WpssViews()->get('menus.tabs.accounts-tab.index', compact('accounts'));
    }

    public static function new()
    {
        $socials = self::getSocials();

        return WpssViews()->get('menus.tabs.accounts-tab.new', compact('socials'));
    }

    public static function table()
    {
        $accounts = self::getAccounts();

        return WpssViews()->get('menus.tabs.accounts-tab.table', compact('accounts'));
    }

    public static function edit($id)
    {
        $account = self::getAccount($id);
        $socials = self::getSocials();

        return WpssViews()->get('menus.tabs.accounts-tab.edit', compact('account', 'socials'));
    }

    private static function getSocials()
    {
        return WpssSocialsManager::getInstance()->getSocials();
    }

    private static function getAccounts(array $normalize = [ 'social' ]): array
    {
        return WpssAccountsService::getAccounts($normalize);
    }

    private static function getAccount($id)
    {
        return WpssAccountsService::getAccount($id);
    }
}
