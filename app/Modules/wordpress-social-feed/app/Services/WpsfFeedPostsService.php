<?php

namespace WPSF\Services;

defined('ABSPATH') || exit('no access');

use App\Core\Libs\Carbon\WpssCarbon;
use App\Core\Repository\Factory\WpssRepositoryFactory;

/**
 * Class WpsfStreamPostsService
 *
 * @see \WPSF\Repositories\FeedPostsRepository\WpsfFeedPostsRepository::getPostByFeeds()
 * @see \WPSF\Repositories\FeedPostsRepository\WpsfFeedPostsRepository::removePostsByFeedID()
 */
class WpsfFeedPostsService
{
    /**
     * add single feed post on database
     * hey man , care this is not for wordpress post , is for social feed posts !
     *
     * @param integer $feedID
     * @param integer $feedMulti
     * @param string $postID
     * @param string $type
     * @param string $mediaType
     * @param \stdClass $user
     * @param string $text
     * @param string $permalink
     * @param integer $timestamp
     * @param array $carousel
     * @param \stdClass $media
     * @param \stdClass $images
     * @param \stdClass $videos
     * @param \stdClass $location
     * @param \stdClass $additonal
     * @return mixed
     */
    public static function addPost(
        int $feedID,
        int $feedMulti,
        string $postID,
        string $type,
        string $mediaType,
        \stdClass $user,
        string $text,
        string $permalink,
        float $randOrder,
        int $timestamp,
        array $carousel,
        \stdClass $media,
        \stdClass $images,
        \stdClass $videos,
        \stdClass $location,
        \stdClass $additonal
    ) {
        $item = [
            'feed_id'       => $feedID,
            'feed_multi'    => $feedMulti,
            'post_id'       => $postID,
            'type'          => $type,
            'media_type'    => $mediaType,
            'user'          => serialize($user),
            'text'          => $text,
            'permalink'     => $permalink,
            'rand_order'    => $randOrder,
            'timestamp'     => $timestamp,
            'carousel'      => serialize($carousel),
            'media'         => serialize($media),
            'images'        => serialize($images),
            'videos'        => serialize($videos),
            'location'      => serialize($location),
            'additional'    => serialize($additonal),
            'created_at'    => (string) WpssCarbon::now(),
        ];

        return WpssRepositoryFactory::make('post')->addPost($item, [ '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%f', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s']);
    }

    /**
     * get posts by array of feeds id
     *
     * @param array $feeds
     * @param array $columns
     * @return mixed
     */
    public static function getPostByFeeds(array $feeds, array $columns = [])
    {
        return collect(WpssRepositoryFactory::make('post')->getPostByFeeds($feeds, $columns))->all();
    }

    /**
     * get postsIDs by feed id
     *
     * @param integer $feedID
     * @param integer $count
     * @return mixed
     */
    public static function getPostsIDsByFeedIDAndMulti(int $feedID, int $feedMutli, int $count)
    {
        return WpssRepositoryFactory::make('post')->getPostsIDsByFeedIDAndMulti($feedID, $feedMutli, $count);    
    }
    
    /**
     * @param integer $feedID
     * @return void
     */
    public static function removeAllPostsByFeedID(int $feedID)
    {
        return WpssRepositoryFactory::make('post')->removeAllPostsByFeedID($feedID);
    }

    /**
     * @param array $postIDs
     * @param int $feedID
     * @return mixed
     */
    public static function removePostsByPostIDs(int $feedID, array $postIDs)
    {
        return WpssRepositoryFactory::make('post')->removePostsByPostIDs($feedID, $postIDs);    
    }

    /**
     * remove all posts and comments for specief feed with id
     *
     * @param integer $feedID
     * @return mixed
     */
    public static function removeAllPostsWithCommentsByFeedID(int $feedID)
    {
        return WpssRepositoryFactory::make('post')->transaction(function () use ($feedID) {
            $resPosts = self::removeAllPostsByFeedID($feedID);
            $resComments = WpsfFeedCommentsService::removeAllCommentsByFeedID($feedID);
            if (false === $resPosts || false === $resComments) {
                throw new \Exception(__('posts or comments saved faild', 'wp-ss'));
            }
            return true;
        });
    }

    /**
     * remove posts and comments for specief feed with id and limit count
     *
     * @param integer $feedID
     * @param integer $count
     * @return mixed
     */
    public static function removePostsWithCommentsByFeedIDAndMulti(int $feedID, array $feedMultis, int $count = 30)
    {
        return WpssRepositoryFactory::make('post')->transaction(function () use ($feedID, $feedMultis, $count) {
            foreach ($feedMultis as $multi) {
                $postsID = self::getPostsIDsByFeedIDAndMulti($feedID, $multi, $count);
                $resCommentsRemove = WpsfFeedCommentsService::removeCommentsByPostIDs($feedID, $multi, $postsID);
                if (false === $resCommentsRemove) {
                    throw new \Exception(__('comments removed faild! ', 'wp-ss'));
                }
                $resPostsRemove = self::removePostsByPostIDs($feedID, $postsID);
                if(false === $resPostsRemove) {
                    throw new \Exception(__('posts removed faild!', 'wp-ss'));
                }
            }
            return true;
        });
    }

    /**
     * add array of posts data on the database
     *
     * @param array $posts
     * @return void
     */
    public static function addPosts(array $posts)
    {
        return WpssRepositoryFactory::make('post')->transaction(function () use ($posts) {
            foreach ($posts as $post) {
                if (empty($post)) {
                    continue;
                }
                self::addPost(
                    $post->feed_id,
                    $post->feed_multi,
                    $post->post_id,
                    $post->type,
                    $post->media_type,
                    $post->user,
                    $post->text,
                    $post->permalink,
                    $post->rand_order,
                    $post->timestamp,
                    $post->carousel,
                    $post->media,
                    $post->images,
                    $post->videos,
                    $post->location,
                    $post->additional
                );
            }
            return true;
        });
    }
}
