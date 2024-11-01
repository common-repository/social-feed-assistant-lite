<?php

namespace SFAL\Repositories\StreamSourcesRepository;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Repository\SfalBaseRepository;

class SfalStreamSourcesRepository extends SfalBaseRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . 'sfal_stream_sources';
    }

    protected $primaryKey = 'id';

    /**
     * @param  array  $columns
     *
     * @return array|mixed|object|null
     */
    public function getAllSources(array $columns = [])
    {
        return $this->all($columns);
    }

    /**
     * @param  int  $ID
     * @param  array  $columns
     *
     * @return array|mixed|object|void|null
     */
    public function getSourceByID(int $ID, array $columns = [])
    {
        return $this->find($ID, $columns);
    }

    /**
     * @param  int  $streamID
     * @param  array  $columns
     *
     * @return mixed
     */
    public function getSourcesByStreamID(int $streamID, array $columns)
    {
        return $this->findBy([
            'stream_id' => [ 'value' => '%d', 'operator' => '=' ],
        ], [ $streamID ], $columns, false);
    }

    /**
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function addSource(array $data, array $format)
    {
        return $this->store($data, $format);
    }

    /**
     * @param  int  $streamID
     * @param $data
     *
     * @return false|int|mixed
     */
    public function updateSourceByStreamID(int $streamID, $data)
    {
        return $this->updateBy([
            'stream_id' => $streamID,
        ], $data);
    }

    /**
     * @param  int  $streamID
     deleteSourceByStreamID*
     * @return false|int|mixed
     */
    public function deleteSourceByStreamID(int $streamID)
    {
        return $this->deleteBy([
            'stream_id' => $streamID,
        ]);
    }

    /**
     * @param  int  $ID
     *
     * @return mixed|string|null
     */
    public function existSource(int $ID)
    {
        return $this->findVar($this->prepare("SELECT `{$this->primaryKey}` FROM {$this->table} WHERE `{$this->primaryKey}`=%d LIMIT 1", [ $ID ]));
    }

    /**
     * @param  int  $streamID
     *
     * @return mixed|string|null
     */
    public function existSourceByStreamID(int $streamID)
    {
        return $this->findVar($this->prepare("SELECT `{$this->primaryKey}` FROM {$this->table} WHERE `stream_id`=%d LIMIT 1", [ $streamID ]));
    }
}
