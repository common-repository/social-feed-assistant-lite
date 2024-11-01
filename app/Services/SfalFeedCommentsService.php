<?php

namespace SFAL\Services;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Libs\Carbon\SfalCarbon;
use SFAL\Core\Repository\Factory\SfalRepositoryFactory;

class SfalFeedCommentsService
{
    /**
     * @param string $postID
     * @return array|mixed
     */
    public static function getCommentsByPostID(string $postID){
        return SfalRepositoryFactory::make('comment')->getCommentsByPostID($postID);
    }

    /**
     * get comments by feeds id ( array )
     *
     * @param array $feeds
     * @param integer $page
     * @param integer $count
     * @param array $columns
     * @return void
     */
    public static function getCommentsByFeeds(array $feeds, int $page = 1, int $count = 5, array $columns = [])
    {
        return collect(SfalRepositoryFactory::make('comment')->getCommentsByFeeds($feeds, $page, $count, $columns))->all();
    }

    /**
     * add single comment to database
     *
     * @param integer $feedId
     * @param integer $feedContent
     * @param string $postId
     * @param \stdClass $from
     * @param string $text
     * @param integer $created_time
     * @return mixed
     */
    public static function addComment(int $feedId, int $feedContent, string $postId, \stdClass $from, string $text, int $created_time)
    {
        $item = [
            'feed_id'       => $feedId,
            'feed_content'  => $feedContent,
            'post_id'       => $postId,
            'from'          => serialize($from),
            'text'          => $text,
            'timestamp'     => $created_time,
            'created_at'    => (string) SfalCarbon::now(),
            'updated_at'    => (string) SfalCarbon::now(),
        ];

        return SfalRepositoryFactory::make('comment')->addComment($item, [ '%d', '%d', '%s', '%s', '%s', '%d', '%s', '%s' ]);
    }

    /**
     * add array of comments data to database
     *
     * @param array $comments
     * @return mixed
     */
    public static function addComments(array $comments)
    {
        return SfalTransaction(function () use ($comments) {
            foreach ($comments as $comment) {
                if (empty($comment)) {
                    continue;
                }
                self::addComment(
                    $comment->feed_id,
                    $comment->feed_content,
                    $comment->post_id,
                    $comment->from,
                    $comment->text,
                    $comment->created_time
                );
            }
            return true;
        });
    }

    /**
     * @param integer $feedID
     * @return mixed
     */
    public static function removeAllCommentsByFeedId(int $feedID)
    {
        return SfalRepositoryFactory::make('comment')->removeAllCommentsByFeedId($feedID);
    }

    /**
     * @param int $feedId
     * @param int $feedContent
     * @param array $postIds
     * @return mixed
     */
    public static function removeCommentsByPostIds(int $feedId, int $feedContent, array $postIds)
    {
        return SfalRepositoryFactory::make('comment')->removeCommentsByPostIds($feedId, $feedContent, $postIds);
    }
}
