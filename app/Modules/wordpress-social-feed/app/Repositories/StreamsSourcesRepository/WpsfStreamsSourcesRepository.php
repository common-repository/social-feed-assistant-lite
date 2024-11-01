<?php

namespace WPSF\Repositories\StreamsSourcesRepository;

defined('ABSPATH') || exit('no access');

use App\Core\Repository\Contracts\WpssBaseRepository;

class WpsfStreamsSourcesRepository extends WpssBaseRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . 'sf_streams_sources';
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
    public function getSourceByStreamID(int $streamID, array $columns)
    {
        return $this->findBy([
            'stream_id' => [ 'value' => '%d', 'operator' => '=' ],
        ], [ $streamID ], $columns);
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
     * @param  int  $ID
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function updateSource(int $ID, array $data, array $format = [])
    {
        return $this->update($ID, $data, $format);
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
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function replaceSource(array $data, array $format = [])
    {
        return $this->replace($data, $format);
    }

    /**
     * @param  int  $ID
     *
     * @return false|int|mixed
     */
    public function deleteSource(int $ID)
    {
        return $this->delete($ID);
    }

    /**
     * @param  int  $streamID
     *
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
