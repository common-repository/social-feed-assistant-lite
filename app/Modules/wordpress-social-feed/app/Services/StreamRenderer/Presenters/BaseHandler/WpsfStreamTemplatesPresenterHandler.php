<?php

namespace WPSF\Services\StreamRenderer\Presenters\BaseHandler;

defined('ABSPATH') || exit('no access');

use App\Core\Libs\Carbon\WpssCarbon;
use WPSF\Services\StreamRenderer\Utils\WpsfStreamNormalizerUtil;
use WPSF\Services\WpsfFeedCommentsService;

abstract class WpsfStreamTemplatesPresenterHandler
{
    protected static $posts;
    protected static $options;
    protected static $filters;
    protected static $template;
    protected static $layout;

    protected static $baseView;

    protected static $comments = [];

    protected static $response = [];

    protected static $inProcessPostCount = 1;
    
    /**
     * @param \stdClass $options
     * @param array $posts
     * @return void
     */
    public static function render(\stdClass $options, array $posts)
    {
        static::$posts    = $posts;
        static::$options  = $options;
        static::$template = (string) $options->general->postSettings->template;
        static::$layout   = 'masonry';

        static::$baseView = WpssConfig('app.viewPath');

        foreach ($posts as $post) {
            self::normalizePost($post);
            self::$response[] = [
                'item' => $post,
                'content' => static::{static::$layout}($post),
            ];
        }

        return self::$response;
    }

    /**
     * @param \stdClass $post
     * @return void
     */
    protected static function normalizePost(\stdClass &$post)
    {
        $post->user            = unserialize($post->user);
        $post->carousel        = unserialize($post->carousel);
        $post->media           = unserialize($post->media);
        $post->images          = unserialize($post->images);
        $post->videos          = unserialize($post->videos);
        $post->location        = unserialize($post->location);
        $post->post_date       = self::postFriendlyDate((int) $post->timestamp ?? 0);
        $post->additional      = self::postAdditionalNormalize($post->additional);

        $post->original_text = $post->text;
        $post->text = wp_trim_words($post->text, 35);
        $post->original_text = WpsfStreamNormalizerUtil::normalizePostText($post->original_text, self::openLinksInNewPage());
        $post->text = WpsfStreamNormalizerUtil::normalizePostText($post->text, self::openLinksInNewPage());

        if (self::supportedPopup()) {
            $post->popup_date = self::postFriendlyDate((int) $post->timestamp ?? 0, 'popup');
        }
    }

    /**
     * @param string $additional
     * @return void
     */
    private static function postAdditionalNormalize(string $additional)
    {
        $additional           = unserialize($additional);
        $additional->likes    = WpssNumberFormatShort((int) $additional->likes);
        $additional->comments = WpssNumberFormatShort((int) $additional->comments);
        return $additional;
    }

    /**
     * @param int $timestamp
     * @param string $format
     * @return void
     */
    private static function postFriendlyDate(int $timestamp, $format = '')
    {
        $formats = [
            'popup'     => "convertDateToPopupFormat",
            'short'     => "convertDateToShortFormat",
            'classic'   => "convertDateToClassicFormat",
            'wordpress' => "convertDateToWordpressFormat",
        ];
        
        $dateFormat = $format ? $format : self::$options->general->dateFormat;

        if (array_key_exists($dateFormat, $formats)) {
            return WpsfStreamNormalizerUtil::{$formats[ $dateFormat ]}($timestamp);
        }

        return $timestamp;
    }

    /**
     * @param integer $postID
     * @return void
     */
    protected static function getPostComments(string $postID)
    {
        if (array_key_exists($postID, self::$comments)) {
            return self::$comments[$postID];
        }

        return self::$comments[$postID] = WpsfFeedCommentsService::getCommentsByPostID($postID);
    }

    /**
     * @param \stdClass $comment
     * @return void
     */
    protected static function normalizeComment(\stdClass &$comment)
    {
        $comment->from = is_object($comment->from) ? $comment->from : unserialize($comment->from);
        $comment->text = WpsfStreamNormalizerUtil::normalizeCommentText($comment->text, self::openLinksInNewPage());
    }

    /**
     * @return void
     */
    protected static function getResponsiveClasses()
    {
        $desktop = self::$options->{self::$layout}->responsive->desktop->column ?? 3;
        $tablet  = self::$options->{self::$layout}->responsive->tablet->column  ?? 2;
        $mobile  = self::$options->{self::$layout}->responsive->mobile->column  ?? 1;
        $xl = ($desktop % 2 == 0 && $desktop != 8 && $desktop != 10) ? sprintf("wpsf-col-xl-%d", 12 / $desktop) : sprintf("wpsf-col-xl-%d-ths", $desktop);
        $lg = ($desktop % 2 == 0 && $desktop != 8 && $desktop != 10) ? sprintf("wpsf-col-lg-%d", 12 / $desktop) : sprintf("wpsf-col-lg-%d-ths", $desktop);
        $md = ($tablet  % 2 == 0 && $tablet  != 8 && $tablet  != 10) ? sprintf("wpsf-col-md-%d", 12 / $tablet)  : sprintf("wpsf-col-md-%d-ths", $tablet);
        $sm = ($mobile  % 2 == 0 && $mobile  != 8 && $mobile  != 10) ? sprintf("wpsf-col-sm-%d", 12 / $mobile)  : sprintf("wpsf-col-sm-%d-ths", $mobile);
        $xs = ($mobile  % 2 == 0 && $mobile  != 8 && $mobile  != 10) ? sprintf("wpsf-col-%d", 12 / $mobile)     : sprintf("wpsf-col-%d-ths", $mobile);
        return (string) "{$xl} {$lg} {$md} {$sm} {$xs}";
    }

    protected static function supportedPopup()
    {
        return (self::$options->general->actionOnImageClick == 1 || self::$options->general->actionOnImageClick == 2);
    }

    protected static function openLinksInNewPage()
    {
        return (bool) self::$options->general->openLinksInNewTab;
    }
    
    protected static function getPosts() : array
    {
        return self::$posts;
    }

    protected static function getLayout() : string
    {
        return self::$layout;
    }

    abstract protected static function grid(&$post);

    abstract protected static function masonry(&$post);

    abstract protected static function justified(&$post);

    abstract protected static function wall(&$post);

    abstract protected static function carousel(&$post);
}
