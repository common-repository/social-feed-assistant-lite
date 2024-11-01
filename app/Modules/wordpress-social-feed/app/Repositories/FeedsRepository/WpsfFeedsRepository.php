<?php

namespace WPSF\Repositories\FeedsRepository;

defined('ABSPATH') || exit('no access');

use App\Core\Repository\Contracts\WpssBaseRepository;

class WpsfFeedsRepository extends WpssBaseRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . 'sf_feeds';
    }

    protected $primaryKey = 'id';

    /**
     * @param  array  $columns
     *
     * @return array|mixed|object|null
     */
    public function getAllFeeds(array $columns = [])
    {
        return $this->all($columns);
    }

    /**
     * @param  int  $ID
     * @param  array  $columns
     *
     * @return array|mixed|object|void|null
     */
    public function getFeedByID(int $ID, array $columns = [])
    {
        return $this->find($ID, $columns);
    }

    /**
     * @return mixed|string|null
     */
    public function getLastFeedID()
    {
        return $this->findVar("SELECT max({$this->primaryKey}) FROM {$this->table} LIMIT 1");
    }

    /**
     * Get feeds that have been updated
     *
     * @return void
     */
    public function getFeedsNeedForRebuild()
    {
        return $this->get_results("SELECT * FROM `{$this->table}` WHERE (`last_cache` + `frequency_update` * 60 * 60) < UNIX_TIMESTAMP() ORDER BY `last_cache`");
    }

    /**
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function addFeed(array $data, array $format)
    {
        return $this->store($data, $format);
    }

    /**
     * @param  int  $ID
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function updateFeed(int $ID, array $data, array $format = [])
    {
        return $this->update($ID, $data, $format);
    } 

    /**
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function replaceFeed(array $data, array $format = [])
    {
        return $this->replace($data, $format);
    }

    /**
     * @param  int  $ID
     *
     * @return false|int|mixed
     */
    public function deleteFeed(int $ID)
    {
        return $this->delete($ID);
    }

    /**
     * @param  int  $ID
     *
     * @return mixed|string|null
     */
    public function existFeed(int $ID)
    {
        return $this->findVar($this->prepare("SELECT `{$this->primaryKey}` FROM {$this->table} WHERE `{$this->primaryKey}`=%d LIMIT 1", [ $ID ]));
    }
}
