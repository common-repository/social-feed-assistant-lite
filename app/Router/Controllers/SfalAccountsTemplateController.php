<?php

namespace SFAL\Router\Controllers;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Socials\SfalSocialsManager;
use SFAL\Services\SfalAccountService;

class SfalAccountsTemplateController
{
    public static function accounts()
    {
        $accounts = self::getAccounts();

        return SfalViews()->get('menus.tabs.accounts-tab.index', compact('accounts'));
    }

    public static function new()
    {
        $socials = self::getSocials();

        return SfalViews()->get('menus.tabs.accounts-tab.new', compact('socials'));
    }

    public static function table()
    {
        $accounts = self::getAccounts();

        return SfalViews()->get('menus.tabs.accounts-tab.table', compact('accounts'));
    }

    public static function edit($id)
    {
        $account = self::getAccount($id);
        $socials = self::getSocials();

        return SfalViews()->get('menus.tabs.accounts-tab.edit', compact('account', 'socials'));
    }

    private static function getSocials()
    {
        return SfalSocialsManager::getInstance()->getSocials();
    }

    private static function getAccounts(array $normalize = [ 'social' ]): array
    {
        return SfalAccountService::getAccounts($normalize);
    }

    private static function getAccount($id)
    {
        return SfalAccountService::getAccount($id, [], [ 'options', 'social' ]);
    }
}
