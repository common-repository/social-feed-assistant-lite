<?php

namespace WPSF\Services;

defined('ABSPATH') || exit('no access');

use App\Core\Repository\Factory\WpssRepositoryFactory;

class WpsfFeedCommentsService
{
    /**
     * @param string $postID
     * @return array|mixed
     */
    public static function getCommentsByPostID(string $postID){
        return WpssRepositoryFactory::make('comment')->getCommentsByPostID($postID);
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
        return collect(WpssRepositoryFactory::make('comment')->getCommentsByFeeds($feeds, $page, $count, $columns))->all();
    }

    /**
     * add single comment to database
     *
     * @param integer $feedID
     * @param string $postID
     * @param \stdClass $from
     * @param string $text
     * @param integer $created_time
     * @return void
     */
    public static function addComment(int $feedID, int $feedMulti, string $postID, \stdClass $from, string $text, int $created_time)
    {
        $item = [
            'feed_id'       => $feedID,
            'feed_multi'    => $feedMulti,
            'post_id'       => $postID,
            'from'          => serialize($from),
            'text'          => $text,
            'created_time'  => $created_time,
        ];

        return WpssRepositoryFactory::make('comment')->addComment($item, [ '%d', '%d', '%s', '%s', '%s', '%d' ]);
    }

    /**
     * add array of comments data to database
     *
     * @param array $comments
     * @return void
     */
    public static function addComments(array $comments)
    {
        return WpssRepositoryFactory::make('comment')->transaction(function () use ($comments) {
            foreach ($comments as $comment) {
                if (empty($comment)) {
                    continue;
                }
                self::addComment($comment->feed_id, $comment->feed_multi, $comment->post_id, $comment->from, $comment->text, $comment->created_time);
            }
            return true;
        });
    }

    /**
     * @param integer $feedID
     * @return void
     */
    public static function removeAllCommentsByFeedID(int $feedID)
    {
        return WpssRepositoryFactory::make('comment')->removeAllCommentsByFeedID($feedID);
    }

    /**
     * @param array $postIDs
     * @param int $feedID
     * @return mixed
     */
    public static function removeCommentsByPostIDs(int $feedID, int $feedMulti, array $postIDs)
    {
        return WpssRepositoryFactory::make('comment')->removeCommentsByPostIDs($feedID, $feedMulti, $postIDs);
    }
}
