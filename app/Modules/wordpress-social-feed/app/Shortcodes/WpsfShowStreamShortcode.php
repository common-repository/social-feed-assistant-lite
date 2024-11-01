<?php

namespace WPSF\Shortcodes;

use App\Core\Foundation\Shortcode\Contract\WpssShortcodeBaseHandler;
use App\Core\Support\Assets\WpssAssetsLoader as Assets;
use WPSF\Services\StreamRenderer\Utils\WpsfStreamSettingsUtil;
use WPSF\Services\StreamRenderer\Utils\WpsfStreamStylesRender;
use WPSF\Services\WpsfStreamsService;

defined('ABSPATH') || exit('no access');

class WpsfShowStreamShortcode extends WpssShortcodeBaseHandler
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
            return WpssViews()->get('shortcodes.wpsf.fallback', compact('streamID'));
        }

        $template  = self::$options->general->postSettings->template;
        $layout    = self::$options->general->postSettings->layout;
        $postCount = self::$options->general->postCount;
        $filters   = self::$filters;
        $options   = self::$options;

        $preview || self::addAssets();
        
        return WpssViews()->get('shortcodes.wpsf.index', compact('streamID', 'options', 'postCount', 'filters', 'template', 'layout'));
    }

    /**
     * @param integer $streamID
     * @return boolean
     */
    private static function init(int $streamID) : bool
    {
        if (! $streamID || !(self::$stream = WpsfStreamsService::getStream($streamID, [], ['options', 'relatedOptions']))) {
            return false;
        }
        
        self::$streamID = $streamID;
        self::$options = self::$stream->options;
        self::$filters = self::$stream->filters;

        if (! (WpsfStreamSettingsUtil::isPossibleToShow(self::$options))) {
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
        $prefix    = WPSF()->getPrefix();
        $assetsUrl = WpssConfig('app.assetsUrl');
        $streamID = self::$streamID;
        $streamStylesURL = WpsfStreamStylesRender::render($streamID, self::$options, self::$options->general->postSettings->template, self::$options->general->postSettings->layout);

        Assets::getInstance()->setPrefix($prefix)->enqueueStyle('lineIcons', $assetsUrl . 'library/lineicons/LineIcons.min.css');
        Assets::getInstance()->enqueueStyle("stream-{$streamID}-styles", $streamStylesURL);

        // only show image on popup
        if (self::$options->general->actionOnImageClick == 3) {
            Assets::getInstance()->enqueueStyle('lightbox', $assetsUrl . 'library/lightbox/css/lightbox.min.css');
            Assets::getInstance()->enqueueScript('lightbox',  $assetsUrl . 'library/lightbox/js/lightbox.min.js', ['jquery']);
        }
        
        // carousel or wall layout
        if (in_array(self::$options->general->actionOnImageClick, [1, 2]) ||
            in_array(self::$options->general->postSettings->layout, ['carousel', 'wall'])) {
            Assets::getInstance()->enqueueStyle('swiper', $assetsUrl . 'library/swiper/swiper.min.css');
            Assets::getInstance()->enqueueScript('swiper', $assetsUrl . 'library/swiper/swiper.min.js', ['jquery']);
        }

        if(self::$options->general->postSettings->layout == 'justified') {
            Assets::getInstance()->enqueueStyle('justified', $assetsUrl . 'library/justified/justifiedGallery.min.css');
            Assets::getInstance()->enqueueScript('justified', $assetsUrl . 'library/justified/jquery.justifiedGallery.min.js', ['jquery']);
        }

        Assets::getInstance()->enqueueStyle('animated', $assetsUrl . 'library/animate/animate.css');

        Assets::getInstance()->registerScript('highlight', $assetsUrl . 'library/highlight/jquery.highlight-5.closure.js', ['jquery']);
        Assets::getInstance()->registerScript('lazyLoad', $assetsUrl . 'library/lazyLoad/jquery.lazy.min.js', ['jquery']);
        Assets::getInstance()->registerScript('lazyAv', $assetsUrl . 'library/lazyLoad/plugins/jquery.lazy.av.min.js', ['jquery']);
        Assets::getInstance()->registerScript('isotope', $assetsUrl . 'library/isotope/isotope.pkgd.min.js', ['jquery']);
        Assets::getInstance()->registerScript('streams', $assetsUrl . 'js/streams.js', ['jquery', $prefix . '_isotope', $prefix . '_highlight', $prefix . '_lazyLoad', $prefix . '_lazyAv'], false, true);
        Assets::getInstance()->registerScript('public', $assetsUrl . 'js/user.js', ['jquery', $prefix . '_streams'], false, true);
        Assets::getInstance()->enqueueScript('public');
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
