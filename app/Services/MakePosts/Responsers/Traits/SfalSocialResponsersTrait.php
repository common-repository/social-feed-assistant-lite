<?php

namespace SFAL\Services\MakePosts\Responsers\Traits;

defined('ABSPATH') || exit('no access');

use SFAL\Services\SocialsFeedsResponser\Utils\SfalFiltersTags;

trait SfalSocialResponsersTrait
{
    public static $includes;
    public static $excludes;
    public static $filterMethod;
    /**
     *
     * @param array $includes
     * @param array $excludes
     * @return void
     */
    protected static function setFilters(array $includes, array $excludes)
    {
        static::$includes = SfalFiltersTags::dispatchFilterTags($includes);
        static::$excludes = SfalFiltersTags::dispatchFilterTags($excludes);
    }

    /**
     * determinationd filter method ( includes or excludes )
     *
     * @return void
     */
    protected static function setFilterMethod()
    {
        static::$filterMethod = (!empty(static::$includes['word']) || !empty(static::$includes['account']) || !empty(self::$includes['url'])) ? 'includes' : 'excludes';
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
        $filters = static::${static::$filterMethod};

        if (static::isEmptyFilter($filters)) {
            return static::$filterMethod == 'includes' ? false : true;
        }

        foreach ($filters['account'] as $account) {
            if ($account == $username) {
                return static::$filterMethod == 'excludes' ? false : true;
            }
        }

        foreach ($filters['url'] as $urlSubstr) {
            if (mb_strpos($url, trim($urlSubstr))) {
                return static::$filterMethod == 'excludes' ? false : true;
            }
        }

        foreach ($filters['word'] as $word) {
            if (mb_strpos($text, trim($word))) {
                return static::$filterMethod == 'excludes' ? false : true;
            }
        }
        
        return static::$filterMethod == 'includes' ? false : true;
    }
}
