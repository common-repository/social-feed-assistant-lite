<?php

namespace WPSF\Router\Controllers;

defined('ABSPATH') || exit('no access');

use WPSF\Services\WpsfFeedsService;
use WPSF\Services\WpsfStreamsService;

class WpsfStreamsTemplateController
{
    private static $feeds = null;
    public static function streams()
    {
        $streams = WpsfStreamsService::getStreams();
        $feedsCount = self::getFeedsCount();
        return WpssViews()->get('menus.tabs.streams-tab.index', compact('streams', 'feedsCount'));
    }

    public static function new()
    {
        $feeds        = self::getFeeds();
        $afterAutoIncreament = WpsfStreamsService::getAfterAutoIncreament() ?? 0;

        return WpssViews()->get('menus.tabs.streams-tab.new', compact('feeds', 'afterAutoIncreament'));
    }

    public static function edit($id)
    {
        $feeds  = self::getFeeds();
        $stream = WpsfStreamsService::getStream($id);

        return WpssViews()->get('menus.tabs.streams-tab.edit', compact('feeds', 'stream'));
    }

    private static function getFeeds($normalizes = [ 'social', 'content' ]): array
    {
        return !is_null(self::$feeds) ? self::$feeds : (self::$feeds = WpsfFeedsService::getFeeds($normalizes));
    }

    private static function getFeedsCount()
    {
        return count(self::getFeeds()); 
    }
}
