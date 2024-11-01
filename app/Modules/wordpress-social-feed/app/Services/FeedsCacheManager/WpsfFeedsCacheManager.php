<?php

namespace WPSF\Services\FeedsCacheManager;

defined('ABSPATH') || exit('no access');

use App\Core\Repository\Factory\WpssRepositoryFactory;
use Exception;
use Tightenco\Collect\Support\Collection;
use WPSF\Services\SocialsFeedsResponser\WpsfSocialsResponser;
use WPSF\Services\WpsfFeedCommentsService;
use WPSF\Services\WpsfFeedPostsService;
use WPSF\Services\WpsfFeedsService;

class WpsfFeedsCacheManager
{
    private static $cron = false;
    /**
     * retrive feed posts and save these on database
     *
     * @param integer $feedID
     * @param string $social
     * @param string $type
     * @param string $contents
     * @param integer $account
     * @param string $excludes
     * @param string $includes
     * @return void
     */
    public static function CacheFeedPosts(int $feedID, string $social, string $type, string $contents, int $account = 0, string $excludes = '', string $includes = '')
    {
        $contents = array_slice(explode(',', $contents), 0, 3);
        $excludes = explode(',', $excludes);
        $includes = explode(',', $includes);

        try {
            $cronCount = ceil(10 / count($contents));
            $postsAndComments = self::$cron
            ? WpsfSocialsResponser::get($feedID, $social, $type, $contents, $account, $excludes, $includes, $cronCount)
            : WpsfSocialsResponser::get($feedID, $social, $type, $contents, $account, $excludes, $includes);

            list($posts, $comments) = $postsAndComments;

            $resCacheRemoved = true === self::$cron
            ? self::removeCachedPosts($feedID, $cronCount, self::getPostsMulti($posts))
            : self::removeAllCachedPosts($feedID);
            if($resCacheRemoved !== true || self::addPostsAndCommentsOnDB($posts->all(), $comments->all()) !== true) {
                throw new Exception($resCacheRemoved);
            }
            return true;
        } catch (Exception $e) {
            return wp_trim_words($e->getMessage(), 30, '...');
        }

    }

    /**
     * add retrieved posts and comments on database
     *
     * @param array $posts
     * @param array $comments
     * @return void
     */
    private static function addPostsAndCommentsOnDB(array $posts, array $comments)
    {
        return WpssRepositoryFactory::make('feeds')->transaction(function () use ($posts, $comments) {
            $postsRes    = WpsfFeedPostsService::addPosts($posts);
            $commentsRes = WpsfFeedCommentsService::addComments($comments);
            if (!$postsRes || !$commentsRes) {
                throw new Exception(__('add posts or comments faild', 'wp-ss'));
            }
            return true;
        });
    }

    /**
     * rebuild feed cache posts
     *
     * @param integer $feedID
     * @return void
     */
    public static function rebuilCache(int $feedID, bool $cron = false)
    {
        self::$cron = $cron;
        if (!($feed = WpsfFeedsService::getFeed($feedID))) {
            return false;
        }
        $res = self::CacheFeedPosts((int) $feed->id, $feed->social_type, $feed->type, $feed->content, (int) $feed->account_id, (string) $feed->exclude, (string) $feed->include);
        $res !== true
        ? self::updateFeedCacheError($feed->id, (string) $res)
        : self::successFeedRbuild($feed->id);
        
        return $res;
    }

    public static function removeAllCachedPosts(int $feedID)
    {
        return WpsfFeedPostsService::removeAllPostsWithCommentsByFeedID($feedID);
    }

    /**
     * remove feed cached posts‍
     *
     * @param int $feedID
     * @return void
     */
    public static function removeCachedPosts(int $feedID, int $count, array $multis)
    {
        return WpsfFeedPostsService::removePostsWithCommentsByFeedIDAndMulti($feedID, $multis, $count);
    }

    /**
     * get multi feed from array of posts
     *
     * @param Collection $posts
     * @return array
     */
    public static function getPostsMulti(Collection $posts) : array
    {
        return (array) array_unique($posts->pluck('feed_multi')->all());
    }
    

    /**
     * @param integer $feedID
     * @return void
     */
    private static function successFeedRbuild(int $feedID)
    {
        WpsfFeedsService::updateSuccessFeedRebuild($feedID);
    }

    /**
     * add error for unsuccessfull feed cached posts
     *
     * @param integer $feedID
     * @param string $error
     * @return void
     */
    private static function updateFeedCacheError(int $feedID, string $error = '')
    {
        WpsfFeedsService::updateFeedError($feedID, $error);
    }
}
