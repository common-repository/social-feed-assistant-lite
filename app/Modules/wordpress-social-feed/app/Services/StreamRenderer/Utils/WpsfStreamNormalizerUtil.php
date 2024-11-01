<?php

namespace WPSF\Services\StreamRenderer\Utils;

defined('ABSPATH') || exit('no access');

use App\Core\Libs\Carbon\WpssCarbon;
class WpsfStreamNormalizerUtil
{
    /**
     * @param integer $timestamp
     * @return string
     */
    public static function convertDateToPopupFormat(int $timestamp) : string
    {
        return (string) WpssCarbon::createFromTimestamp($timestamp)->format('F j');    
    }

    /**
     * @param integer $timestamp
     * @return string
     */
    public static function convertDateToShortFormat(int $timestamp) : string
    {
        return (string) WpssCarbon::createFromTimestamp($timestamp)->diffForHumans();
    }

    /**
     * @param integer $timestamp
     * @return void
     */
    public static function convertDateToClassicFormat(int $timestamp) : string
    {
        return (string) WpssCarbon::createFromTimestamp($timestamp)->toFormattedDateString();
    }

    /**
     * @param integer $timestamp
     * @return string
     */
    public static function convertDateToWordpressFormat(int $timestamp) : string
    {
        return (string) date_i18n(get_option('date_format'), $timestamp);
    }

    /**
     * @param string $caption
     * @return string
     */
    public static function normalizePostText(string $caption, bool $openLinksInNewTab = true) : string
    {
        $caption = normalize_whitespace($caption);
        $caption = self::replaceMentionLinks($caption, $openLinksInNewTab);
        $caption = self::replaceHashtagLinks($caption, $openLinksInNewTab);
        return nl2br($caption);
    }

    /**
     * @param string $text
     * @return string
     */
    public static function normalizeCommentText(string $text, bool $openLinksInNewTab = true) : string
    {
        $text = normalize_whitespace($text);
        $text = self::replaceMentionLinks($text, $openLinksInNewTab);
        $text = self::replaceHashtagLinks($text, $openLinksInNewTab);
        return $text;
    }

    /**
     * @param string $str
     * @return string
     */
    public static function replaceMentionLinks(string $str, bool $openLinksInNewTab = true) : string
    {
        $openLinksInNewTab = $openLinksInNewTab ? 'target="_blank"' : null;
        return (string) preg_replace('~(\@)([^\s!, /()"\'?]+)~', sprintf('<a rel="noreferrer" %s href="https://www.instagram.com/$2">$1$2</a>', $openLinksInNewTab), $str);
    }

    /**
     * @param string $str
     * @return string
     */
    public static function replaceHashtagLinks(string $str, bool $openLinksInNewTab = true) : string
    {
        $openLinksInNewTab = $openLinksInNewTab ? 'target="_blank"' : null;
        return (string) preg_replace('~(\#)([^\s!,. /()"\'?]+)~', sprintf('<a rel="noreferrer" %s href="https://www.instagram.com/explore/tags/$2">$1$2</a>', $openLinksInNewTab), $str);
    }
}
