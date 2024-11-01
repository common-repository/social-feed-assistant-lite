<?php

namespace WPSF\Router\Controllers;

defined('ABSPATH') || exit('no access');

use WPSF\Services\WpsfFeedsService;
use App\Core\Socials\WpssSocialsManager;

class WpsfFeedsTemplateController
{
    public static function feeds()
    {
        $feeds = WpsfFeedsService::getFeeds();

        return WpssViews()->get('menus.tabs.feeds-tab.index', compact('feeds'));
    }

    public static function new()
    {
        $socials  = self::getSocials();

        return WpssViews()->get('menus.tabs.feeds-tab.new', compact('socials'));
    }

    public static function edit($id)
    {
        $feed     = self::getFeed($id);
        $socials  = self::getSocials();

        return WpssViews()->get('menus.tabs.feeds-tab.edit', compact('feed', 'socials'));
    }

    private static function getSocials()
    {
        return (array) WpssSocialsManager::getInstance()->getSocials();
    }

    private static function getFeed($id)
    {
        return WpsfFeedsService::getFeed($id, [], []);
    }
}
