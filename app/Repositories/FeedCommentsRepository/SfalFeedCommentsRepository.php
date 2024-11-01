<?php

namespace SFAL\Repositories\FeedCommentsRepository;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Repository\SfalBaseRepository;

class SfalFeedCommentsRepository extends SfalBaseRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . 'sfal_comments';
    }

    protected $primaryKey = 'id';

    /**
     *
     * @param array $criteria
     * @param array $criteriaValues
     * @param array $columns
     * @return void
     */
    public function getCommentsByCriteria(array $criteria, array $criteriaValues, array $columns = [])
    {
        return $this->findBy($criteria, $criteriaValues, $columns, false);
    }

    /**
     * get comments with feeds id ( array )
     *
     * @param array $feeds
     * @param integer $page
     * @param integer $count
     * @param array $columns
     * @return void
     */
    public function getCommentsByFeeds(array $feeds, int $page = 1, int $count = 5, array $columns = [])
    {
        $format = $this->formatWithPlaceholders($feeds, '%d');

        return $this->paginateBy([
            'feed_id' => [ 'value' => $format, 'operator' => 'IN' ],
        ], $feeds, $page, $count, $columns);
    }

    /**
     * get comments by postID from database
     *
     * @param string $postID
     * @return void
     */
    public function getCommentsByPostID(string $postID)
    {
        return $this->getCommentsByCriteria([
            'post_id' => [ 'value' => '%s', 'operator' => '=' ]
        ], [$postID]);
    }

    /**
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function addComment(array $data, array $format)
    {
        return $this->store($data, $format);
    }

    /**
     * @param integer $feedId
     * @return mixed
     */
    public function removeAllCommentsByFeedId(int $feedId)
    {
        return $this->deleteBy([
            'feed_id' => $feedId
        ]);    
    }

    /**
     * remove comments by postIds
     *
     * @param intn $feedID
     * @param int $feedContent
     * @param array $postIDs
     * @return mixed
     */
    public function removeCommentsByPostIds(int $feedID, int $feedContent, array $postIds)
    {
        $format = $this->formatWithPlaceholders($postIds, '%d');
        $postIds[] = $feedID; 
        $postIds[] = $feedContent;
        return $this->query(
            $this->prepare("DELETE FROM {$this->table}
                WHERE `post_id` IN ({$format}) AND `feed_id` = %d AND `feed_content` = %d;
            ", $postIds)
        );
    }

    /**
     * fill array with count $value by given string
     *
     * @param array $value
     * @param string $str
     * @return void
     */
    private function formatWithPlaceholders(array $value, string $str)
    {
        return implode(', ', array_fill(0, count($value), $str));
    }
}
