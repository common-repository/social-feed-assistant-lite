<?php

namespace SFAL\Services\MakePosts;

use Exception;
use SFAL\Services\MakePosts\Responsers\InstagramPostsResponser\SfalInstagramResponser;
use SFAL\Services\SfalFeedCommentsService;
use SFAL\Services\SfalFeedPostsService;
use SFAL\Services\SfalFeedsService;
use stdClass;

defined('ABSPATH') || exit('no access');

class SfalMakePosts
{
    const INSTAGRAM_RESPONSER = SfalInstagramResponser::class;
    const RESPONSERS = [
        'instagram' => self::INSTAGRAM_RESPONSER,
    ];

    const SUPPORTED_PURE_LINKS = ['instagram'];

    private static $cron = false;
    private static $returnPureLinks = false;
    private static $persistMedias = true;

    public static function make(int $feedId, int $contentId, int $count = 10, array $mediaLinks = [], stdClass $feed = null)
    {
        try {
            $feed = $feed ?? SfalFeedsService::getFeed($feedId, [], ['social', 'content', 'account']);
            $responser = self::getResponser($feed);
            $account   = self::getAccount($feed, $responser);
            $content   = self::getContent($feed, $contentId);

            self::prepareExcludesAndIncludes($feed);

            if (true === self::$returnPureLinks) {
                if (in_array($feed->social_type, self::SUPPORTED_PURE_LINKS)) {
                    $responser::setReturnPureLinks(true);
                    return [ true, $responser::make($feedId, $contentId, $content, $account, $count, $mediaLinks, $feed) ];
                }
                return [ false, __('this feed social does not support make links', 'sfal') ];
            }

            list($posts, $comments) = $responser::make($feedId, $contentId, $content, $account, $count, $mediaLinks, $feed);

            if (true === self::$cron) {
                self::removeCachedPosts($feedId, $contentId, $posts->count());
            }

            if (self::$persistMedias) {
                self::addPostsAndCommentsOnDB(
                    $posts->toArray(),
                    $comments->toArray()
                );
                self::successFeedRbuild($feedId);
                return [ true, $posts->count() ];
            }

            return [ $posts, $comments ];
        } catch (Exception $e) {
            return [ false, wp_trim_words($e->getMessage(), 30, '...') ];
        }
    }

    public static function setReturnPureLinks(bool $bool)
    {
        self::$returnPureLinks = $bool;
    }

    public static function setPersistMedias(bool $bool)
    {
        self::$persistMedias = $bool;
    }

    /**
     * remove feed cached posts‍
     *
     * @param int $feedID
     * @param int $contentId
     * @param int $count
     * @return mixed
     */
    private static function removeCachedPosts(int $feedId, int $contentId, int $count)
    {
        return SfalFeedPostsService::removePostsByFeedIdAndContent($feedId, $contentId, $count);
    }

    /**
     * persist retrieved posts and comments in database
     *
     * @param array $posts
     * @param array $comments
     * @return mixed
     */
    private static function addPostsAndCommentsOnDB(array $posts, array $comments)
    {
        return SfalTransaction(function () use ($posts, $comments) {
            $postsResult = SfalFeedPostsService::addPosts($posts);
            $commentsRes = SfalFeedCommentsService::addComments($comments);
            if (!$postsResult || !$commentsRes) {
                throw new Exception(__('add posts or comments faild', 'sfal'));
            }
            return true;
        });
    }

    /**
     * @param integer $feedId
     * @return void
     */
    private static function successFeedRbuild(int $feedId)
    {
        return SfalFeedsService::updateSuccessFeedRebuild($feedId);
    }

    private static function getResponser(stdClass $feed) : string
    {
        if (array_key_exists($feed->social_type, self::RESPONSERS)) {
            return (string) self::RESPONSERS[$feed->social_type];
        }

        throw new Exception(__('The feed social type is not valid', 'sfal'));
    }

    private static function getAccount(stdClass $feed, string $responser)
    {
        if ($responser::REQUIRED_ACCOUNT && !$feed->account) {
            throw new Exception(__('This feed required account for authentication', 'sfal'));
        }

        return (object) $feed->account;
    }

    private static function getContent(stdClass $feed, int $contentId)
    {
        $contentName = $feed->contentNames[$contentId] ?? 0;

        if (0 === $contentName) {
            throw new Exception(__('Feed content with this id does not exists', 'sfal'));
        }

        return $contentName;
    }

    private static function prepareExcludesAndIncludes(stdClass &$feed)
    {
        is_array($feed->excludes) || $feed->excludes = explode(',', $feed->excludes);
        is_array($feed->includes) || $feed->includes = explode(',', $feed->includes);
    }
}
