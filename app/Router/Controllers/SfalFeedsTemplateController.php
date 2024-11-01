<?php

namespace SFAL\Router\Controllers;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Libs\Carbon\SfalCarbon;
use SFAL\Services\SfalFeedsService;
use SFAL\Core\Socials\SfalSocialsManager;
use SFAL\Services\SfalAccountService;

class SfalFeedsTemplateController
{
    public static function feeds()
    {
        $feeds = SfalFeedsService::getFeeds();

        return SfalViews()->get('menus.tabs.feeds-tab.index', compact('feeds'));
    }

    public static function new()
    {
        $socials  = self::getSocials();
        $accounts = self::getAccounts();

        return SfalViews()->get('menus.tabs.feeds-tab.new', compact('socials', 'accounts'));
    }

    public static function edit($id)
    {
        $feed     = self::getFeed($id);
        $socials  = self::getSocials();
        $accounts = self::getAccounts();

        return SfalViews()->get('menus.tabs.feeds-tab.edit', compact('feed', 'socials', 'accounts'));
    }

    private static function getSocials()
    {
        return (array) SfalSocialsManager::getInstance()->getSocials();
    }

    private static function getAccounts(array $normalize = [ 'social' ]) : array
    {
        return SfalAccountService::getAccounts($normalize);
    }

    private static function getFeed($id)
    {
        return SfalFeedsService::getFeed($id, [], ['content']);
    }
}
