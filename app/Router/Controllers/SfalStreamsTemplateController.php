<?php

namespace SFAL\Router\Controllers;

defined('ABSPATH') || exit('no access');

use SFAL\Services\SfalFeedsService;
use SFAL\Services\SfalStreamsService;

class SfalStreamsTemplateController
{
    private static $feeds = null;
    public static function streams()
    {
        $streams = SfalStreamsService::getStreams();
        $feedsCount = self::getFeedsCount();
        
        return SfalViews()->get('menus.tabs.streams-tab.index', compact('streams', 'feedsCount'));
    }

    public static function new()
    {
        $feeds = self::getFeeds();
        $afterAutoIncreament = SfalStreamsService::getAfterAutoIncreament() ?? 0;

        return SfalViews()->get('menus.tabs.streams-tab.new', compact('feeds', 'afterAutoIncreament'));
    }

    public static function edit($id)
    {
        $feeds  = self::getFeeds();
        $stream = SfalStreamsService::getStream($id);
        
        return SfalViews()->get('menus.tabs.streams-tab.edit', compact('feeds', 'stream'));
    }

    private static function getFeeds($normalizes = [ 'social', 'content' ]): array
    {
        return self::$feeds ?? (self::$feeds = SfalFeedsService::getFeeds($normalizes));
    }

    private static function getFeedsCount()
    {
        return count(self::getFeeds()); 
    }
}
