<?php

namespace SFAL\Repositories\FeedContentsRepository;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Repository\SfalBaseRepository;

class SfalFeedContentsRepository extends SfalBaseRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . 'sfal_feed_contents';
    }

    protected $primaryKey = 'id';

    /**
     * @param  int  $feedID
     * @param  array  $columns
     *
     * @return array|mixed|object|void|null
     */
    public function getFeedContentsByFeedID(int $feedID, array $columns = [])
    {
        return $this->findBy([
            'feed_id' => [ 'value' => '%d', 'operator' => '=' ],
        ], [$feedID], $columns, false);
    }

    /**
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function addFeedContent(array $data, array $format)
    {
        return $this->store($data, $format);
    }

    /**
     * @param  int  $feedID
     *
     * @return false|int|mixed
     */
    public function deleteFeedContentsByFeedID(int $feedID)
    {
        return $this->deleteBy([
            'feed_id' => $feedID
        ]);
    }
}
