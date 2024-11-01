<?php

namespace SFAL\Services;

defined('ABSPATH') || exit('no access');

use Exception;
use SFAL\Core\Libs\Carbon\SfalCarbon;
use SFAL\Core\Repository\Factory\SfalRepositoryFactory;
use stdClass;

/**
 * Class SfalStreamPostsService
 *
 * @see \SFAL\Repositories\FeedPostsRepository\SfalFeedPostsRepository::getPostByFeeds()
 * @see \SFAL\Repositories\FeedPostsRepository\SfalFeedPostsRepository::removePostsByFeedID()
 */
class SfalFeedPostsService
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
        int $feedId,
        int $feedContent,
        string $postId,
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
            'feed_id'      => $feedId,
            'feed_content' => $feedContent,
            'post_id'      => $postId,
            'type'         => $type,
            'media_type'   => $mediaType,
            'user'         => serialize($user),
            'text'         => $text,
            'permalink'    => $permalink,
            'rand_order'   => $randOrder,
            'timestamp'    => $timestamp,
            'carousel'     => serialize($carousel),
            'media'        => serialize($media),
            'images'       => serialize($images),
            'videos'       => serialize($videos),
            'location'     => serialize($location),
            'additional'   => serialize($additonal),
            'created_at'   => (string) SfalCarbon::now(),
            'updated_at'   => (string) SfalCarbon::now(),
        ];

        return SfalRepositoryFactory::make('post')->addPost($item, [ '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%f', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s']);
    }

    public static function updatePost(int $id, int $feedId, int $feedContent, array $data, array $format, array $comments)
    {
        return SfalTransaction(function() use($id, $feedId, $feedContent, $data, $format, $comments) {
            $postId = (array) $data['post_id'];
            $resPostUpdated = SfalRepositoryFactory::make('post')->updatePost($id, $data, $format);
            $resCommentsRemoved = SfalFeedCommentsService::removeCommentsByPostIds($feedId, $feedContent, $postId);
            $commentsRes = SfalFeedCommentsService::addComments($comments);
            if(false === $resPostUpdated || false === $resCommentsRemoved || false === $commentsRes) {
                throw new Exception(__('There was a problem on updating the medias, please rebuild the feed.', 'sfal'));
            }
            return true;
        });
    }

    public static function updateBrokenPost(stdClass $post, stdClass $beforePost, array $comments)
    {
        $data = [
            'post_id'      => $post->post_id,
            'text'         => $post->text,
            'user'         => serialize($post->user),
            'carousel'     => serialize($post->carousel),
            'media'        => serialize($post->media),
            'images'       => serialize($post->images),
            'videos'       => serialize($post->videos),
            'location'     => serialize($post->location),
            'additional'   => serialize($post->additional),
            'updated_at'   => (string) SfalCarbon::now(),
        ];

        $format = ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'];

        return self::updatePost($beforePost->id, $beforePost->feed_id, $beforePost->feed_content, $data, $format, $comments);
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
        return collect(SfalRepositoryFactory::make('post')->getPostByFeeds($feeds, $columns))->all();
    }

    /**
     * get postsIDs by feed id
     *
     * @param integer $feedId
     * @param integer $count
     * @return mixed
     */
    public static function getPostsIdsByfeedIdAndContent(int $feedId, int $feedContent, int $count)
    {
        return SfalRepositoryFactory::make('post')->getPostsIdsByfeedIdAndContent($feedId, $feedContent, $count);    
    }


    public static function getPostsNeedForRebuild() : array
    {
        return (array) SfalRepositoryFactory::make('post')->getPostsNeedForRebuild();
    }
    
    /**
     * @param integer $feedID
     * @return void
     */
    public static function removeAllPostsByFeedId(int $feedID)
    {
        return SfalRepositoryFactory::make('post')->removeAllPostsByFeedId($feedID);
    }

    /**
     * @param integer $feedId
     * @param integer $feedContent
     * @param integer $count
     * @return mixed
     */
    public static function removePostsByFeedIdAndContent(int $feedId, int $feedContent, int $count)
    {
        return SfalTransaction(function() use($feedId, $feedContent, $count) {
            $postIds = self::getPostsIdsByfeedIdAndContent($feedId, $feedContent, $count);
            $resCommentsRemoved = SfalFeedCommentsService::removeCommentsByPostIDs($feedId, $feedContent, $postIds);
            $resPostsRemoved = self::removePostsByPostIds($feedId, $feedContent, $postIds);
            if(false === $resCommentsRemoved || false === $resPostsRemoved) {
                throw new Exception(__('There is an error in deleting posts or comments., Please try again.', 'sfal'));
            } 
            return true;
        });
    }

    /**
     * @param array $postIDs
     * @param int $feedID
     * @return mixed
     */
    public static function removePostsByPostIds(int $feedID, int $feedContent, array $postIds)
    {
        return SfalRepositoryFactory::make('post')->removePostsByPostIds($feedID, $feedContent, $postIds);    
    }

    /**
     * remove all posts and comments for specief feed with id
     *
     * @param integer $feedID
     * @return mixed
     */
    public static function removeAllPostsWithCommentsByFeedId(int $feedId)
    {
        return SfalTransaction(function() use ($feedId) {
            $resCommentsRemoved = SfalFeedCommentsService::removeAllCommentsByFeedId($feedId);
            $resPostsRemoved = self::removeAllPostsByFeedId($feedId);
            if(false === $resCommentsRemoved || false === $resPostsRemoved) {
                throw new Exception(__('There is an error in deleting posts or comments, Please try again.', 'sfal'));
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
        return SfalRepositoryFactory::make('post')->transaction(function () use ($posts) {
            foreach ($posts as $post) {
                if (empty($post)) {
                    continue;
                }
                self::addPost(
                    $post->feed_id,
                    $post->feed_content,
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
