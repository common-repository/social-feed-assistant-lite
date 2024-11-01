<?php

namespace SFAL\Repositories\FeedPostsRepository;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Libs\Carbon\SfalCarbon;
use SFAL\Core\Repository\SfalBaseRepository;

class SfalFeedPostsRepository extends SfalBaseRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . 'sfal_posts';
    }

    protected $primaryKey = 'id';

    /**
     *
     * @param array $criteria
     * @param array $criteriaValues
     * @param array $columns
     * @return void
     */
    public function getPostsByCriteria(array $criteria, array $criteriaValues, array $columns = [])
    {
        return $this->findBy($criteria, $criteriaValues, $columns, false);
    }

    /**
     * get posts by feeds id ( array )
     *
     * @param array $feeds
     * @param array $columns
     * @return mixed
     */
    public function getPostByFeeds(array $feeds, array $columns = [])
    {
        $format = $this->formatWithPlaceholders($feeds, '%d');

        return $this->findBy([
            'feed_id' => [ 'value' => $format, 'operator' => 'IN' ],
        ], $feeds, $columns, false);
    }

    /**
     * get posts id by feed id and count for limit
     *
     * @param integer $feedId
     * @param integer $feedContent
     * @param integer $count
     * @return mixed
     */
    public function getPostsIdsByFeedIdAndContent(int $feedId, int $feedContent, int $count)
    {
        return $this->findCol(
            $this->prepare(
                "SELECT `post_id` FROM {$this->table} 
                    WHERE `feed_id` = %d
                    AND `feed_content` = %d
                    ORDER BY `timestamp` DESC LIMIT %d",
                [$feedId, $feedContent, $count]
            )
        );
    }

    public function getPostsNeedForRebuild()
    {
        $twoDaysAgo = SfalCarbon::now()->subDays(2)->toDateTimeString();
        
        return $this->get_results(
            "SELECT * FROM {$this->table}
                WHERE `updated_at` <= '{$twoDaysAgo}'
                ORDER BY `updated_at`"
        );
    }

    /**
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function addPost(array $data, array $format = [])
    {
        return $this->store($data, $format);
    }

    /**
     * insert multi posts on database
     *
     * @param array $datas
     * @param array $format
     * @return void
     */
    public function addPosts(array $datas, array $format)
    {
        return $this->transaction(function () use ($datas, $format) {
            foreach ($datas as $data) {
                $this->addPost($data, $format);
            }
        });
    }

    /**
     * @param  int  $id
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function updatePost(int $id, array $data, array $format = [])
    {
        return $this->update($id, $data, $format);
    }

    /**
     * @param integer $feedId
     * @return mixed
     */
    public function removeAllPostsByFeedId(int $feedId)
    {
        return $this->deleteBy([
            'feed_id' => $feedId
        ]);
    }

    /**
     * remove posts by PostIDs
     *
     * @param int $feedId
     * @param int $feedContent
     * @param array $postIds
     * @return mixed
     */
    public function removePostsByPostIds(int $feedId, int $feedContent, array $postIds)
    {
        $format = $this->formatWithPlaceholders($postIds, '%d');
        $postIds[] = $feedId;
        $postIds[] = $feedContent;
        return $this->query(
            $this->prepare("DELETE FROM {$this->table}
                WHERE `post_id` IN ({$format}) AND `feed_id` = %d AND `feed_content` = %d
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
