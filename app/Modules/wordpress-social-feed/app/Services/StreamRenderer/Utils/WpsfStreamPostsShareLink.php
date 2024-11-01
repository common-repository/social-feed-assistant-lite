<?php

namespace WPSF\Services\StreamRenderer\Utils;

defined('ABSPATH') || exit('no access');
class WpsfStreamPostsShareLink
{

    const TWITER = "https://twitter.com/share?url={link}";
    const FACEBOOK = "https://www.facebook.com/sharer/sharer.php?u={link}";
    const GOOGLEPLUS = "https://plus.google.com/share?url={link}";
    const PINTEREST = "https://pinterest.com/pin/create/bookmarklet/?url={link}";
    const LINKEDIN = "http://www.linkedin.com/shareArticle?url={link}";
    const EMAIL = "mailto:?subject={subject}&body={link}";

    /**
     * @param string $url
     * @return void
     */
    public static function twitter(string $url) : string
    {
        return str_replace('{link}', esc_url($url), self::TWITER);
    }

    /**
     * @param string $url
     * @return void
     */
    public static function facebook(string $url) : string
    {
        return str_replace('{link}', esc_url($url), self::FACEBOOK);
    }

    /**
     * @param string $url
     * @return void
     */
    public static function googleplus(string $url) : string
    {
        return str_replace('{link}', esc_url($url), self::GOOGLEPLUS);
    }

    /**
     * @param string $url
     * @return void
     */
    public static function pinterest(string $url) : string
    {
        return str_replace('{link}', esc_url($url), self::PINTEREST);
    }

    /**
     * @param string $url
     * @return void
     */
    public static function linkedin(string $url) : string
    {
        return str_replace('{link}', esc_url($url), self::LINKEDIN);

    }

    /**
     * @param string $link
     * @param string $subject
     * @return void
     */
    public static function email(string $link, string $subject = '') : string
    {
        return str_replace(['{subject}', '{link}'], [$subject, $link], self::EMAIL);
    }

}
