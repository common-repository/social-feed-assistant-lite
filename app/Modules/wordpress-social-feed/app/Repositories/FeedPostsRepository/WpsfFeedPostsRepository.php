<?php

namespace WPSF\Repositories\FeedPostsRepository;

defined('ABSPATH') || exit('no access');

use App\Core\Repository\Contracts\WpssBaseRepository;
use App\Core\Repository\Factory\WpssRepositoryFactory;

class WpsfFeedPostsRepository extends WpssBaseRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . 'sf_posts';
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
     * @param integer $feedID
     * @param integer $count
     * @return mixed
     */
    public function getPostsIDsByFeedIDAndMulti(int $feedID, int $feeMulti, int $count)
    {
        return $this->findCol(
            $this->prepare("SELECT `post_id` FROM {$this->table} 
                WHERE `feed_id` = %d
                AND `feed_multi` = %d
                ORDER BY `timestamp` DESC LIMIT %d", [$feedID, $feeMulti, $count]
            )
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
     * @param integer $feedID
     * @return void
     */
    public function removeAllPostsByFeedID(int $feedID)
    {
        return $this->deleteBy([
            'feed_id' => $feedID
        ]);
    }

    /**
     * remove posts by PostIDs
     *
     * @param array $postIDs
     * @param intn $$feedID
     * @return mixed
     */
    public function removePostsByPostIDs(int $feedID, array $postIDs)
    {
        $format = $this->formatWithPlaceholders($postIDs, '%d');
        $postIDs[] = $feedID;
        return $this->query(
            $this->prepare("DELETE FROM {$this->table}
                WHERE `post_id` IN ({$format}) AND `feed_id` = %d
             ", $postIDs
            )
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
