<?php

namespace SFAL\Shortcodes;

use SFAL\Core\Foundation\Abstractions\SfalShortcodeBaseHandler;
use SFAL\Core\Support\Assets\SfalAssetsLoader as Assets;
use SFAL\Services\StreamRenderer\Utils\SfalStreamSettingsUtil;
use SFAL\Services\StreamRenderer\Utils\SfalStreamStylesRender;
use SFAL\Services\SfalStreamsService;

defined('ABSPATH') || exit('no access');

class SfalShowStreamShortcode extends SfalShortcodeBaseHandler
{
    private static $stream;
    private static $options;
    private static $filters;

    private static $streamID;

    /**
     * @param array $atts
     * @param string $content
     * @return void
     */
    public static function handle($atts = [], string $content = "")
    {
        $streamID = self::getStreamID($atts);
        $preview = self::isPreview($atts);

        if (true !== self::init($streamID)) {
            return SfalViews()->get('shortcodes.sfal.fallback', compact('streamID'));
        }

        $template  = self::$options->general->postSettings->template;
        $layout    = self::$options->general->postSettings->layout;
        $postCount = self::$options->general->postCount;
        $options   = self::$options;

        $preview || self::addAssets();
        
        return SfalViews()->get('shortcodes.sfal.index', compact('streamID', 'options', 'postCount', 'template', 'layout'));
    }

    /**
     * @param integer $streamID
     * @return boolean
     */
    private static function init(int $streamID) : bool
    {
        if (! $streamID || !(self::$stream = SfalStreamsService::getStream($streamID, [], ['options', 'relatedOptions']))) {
            return false;
        }
        
        self::$streamID = $streamID;
        self::$options = self::$stream->options;

        self::$options->general->postSettings->layout = 'masonry';
        
        in_array(self::$options->general->actionOnImageClick, ['1', '2']) && self::$options->general->actionOnImageClick = '3';

        if (! (SfalStreamSettingsUtil::isPossibleToShow(self::$options))) {
            return false;
        }

        return true;
    }

    /**
     * enqueue needed script for stream shortcode
     *
     * @return void
     */
    private static function addAssets()
    {
        $streamID = self::$streamID;
        $streamStylesURL = SfalStreamStylesRender::render($streamID, self::$options, self::$options->general->postSettings->template, self::$options->general->postSettings->layout);

        Assets::getInstance()
            ->enqueueStyle('lineIcons')
            ->enqueueStyle("stream-{$streamID}-styles", $streamStylesURL);

        // only show image on popup
        self::$options->general->actionOnImageClick == 3 && Assets::getInstance()
            ->enqueueStyle('lightbox')
            ->enqueueScript('lightbox');
        
        Assets::getInstance()
            ->enqueueStyle('animated')
            ->enqueueScript('isotope')
            ->enqueueScript('highlight')
            ->enqueueScript('lazyLoad')
            ->enqueueScript('lazyAv')
            ->enqueueScript('front-bundle');
    }

    private static function getStreamID(array $atts) : int
    {
        return array_key_exists('id', $atts) ? (int) $atts['id'] : 0;
    }

    private static function isPreview(array $atts) : bool
    {
        return array_key_exists('preview', $atts) ? (bool) $atts['preview'] : false;
    }
}
