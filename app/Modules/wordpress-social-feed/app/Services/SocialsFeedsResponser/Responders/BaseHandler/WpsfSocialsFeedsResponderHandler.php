<?php

namespace WPSF\Services\SocialsFeedsResponser\Responders\BaseHandler;

defined('ABSPATH') || exit('no access');

use WPSF\Services\SocialsFeedsResponser\Utils\WpsfFiltersTags;

abstract class WpsfSocialsFeedsResponderHandler
{
    const USE_IPV4 = true;

    const MEDIAS_COUNT = 30;
    const MEDIA_MAXID = '';

    protected static $api;

    protected static $countPost = 0;
    protected static $contentCount = 1;

    protected static $includes = [];
    protected static $excludes = [];
    protected static $filterMethod = 'excludes';

    /**
     * initial
     *
     * @return void
     */
    abstract public static function init();

    /**
     * this is main class for get social posts
     *
     * @param integer $feed
     * @param string $type
     * @param array $contents
     * @param integer $account
     * @param array $excludes
     * @param array $includes
     * @return void
     */
    abstract public static function response(int $feed, string $type, array $contents, int $account = 0, array $excludes = [], array $includes = [], int $count = 0);

    /**
     * return counts of media for each content
     *
     * @return integer
     */
    protected static function getMediasCount() : int
    {
        return self::$countPost > 0
        ? self::$countPost
        : ceil(static::MEDIAS_COUNT / (int) static::$contentCount);
    }

    /**
     *
     * @param array $includes
     * @param array $excludes
     * @return void
     */
    protected static function setFilters(array $includes, array $excludes)
    {
        static::$includes = WpsfFiltersTags::dispatchFilterTags($includes);
        static::$excludes = WpsfFiltersTags::dispatchFilterTags($excludes);
    }

    /**
     * determinationd filter method ( includes or excludes )
     *
     * @return void
     */
    protected static function setFilterMethod()
    {
        self::$filterMethod = (!empty(self::$includes['word']) || !empty(self::$includes['account']) || !empty(self::$includes['url'])) ? 'includes' : 'excludes';
    }

    /**
     * @param array $filters
     * @return boolean
     */
    protected static function isEmptyFilter(array $filters) : bool
    {
        return (empty($filters['account']) && empty($filters['url']) && empty($filters['word'])) ? true : false;
    }

    /**
     * check is post suitable for show
     *
     * @param string $url
     * @param string $username
     * @param string $text
     * @return boolean
     */
    protected static function isSuitablePost(string $url, string $username, string $text) : bool
    {
        $filters = self::${self::$filterMethod};

        if (self::isEmptyFilter($filters)) {
            return self::$filterMethod == 'includes' ? false : true;
        }

        foreach ($filters['account'] as $account) {
            if ($account == $username) {
                return self::$filterMethod == 'excludes' ? false : true;
            }
        }

        foreach ($filters['url'] as $urlSubstr) {
            if (mb_strpos($url, trim($urlSubstr))) {
                return self::$filterMethod == 'excludes' ? false : true;
            }
        }

        foreach ($filters['word'] as $word) {
            if (mb_strpos($text, trim($word))) {
                return self::$filterMethod == 'excludes' ? false : true;
            }
        }
        
        return self::$filterMethod == 'includes' ? false : true;
    }
}
