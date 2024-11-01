<?php

namespace SFAL\Repositories\StreamsRepository;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Repository\SfalBaseRepository;

class SfalStreamsRepository extends SfalBaseRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . 'sfal_streams';
    }

    protected $primaryKey = 'id';

    /**
     * @param  array  $columns
     *
     * @return array|mixed|object|null
     */
    public function getAllStreams(array $columns = [])
    {
        return $this->all($columns);
    }

    /**
     * @param  int  $ID
     * @param  array  $columns
     *
     * @return array|mixed|object|void|null
     */
    public function getStreamByID(int $ID, array $columns = [])
    {
        return $this->find($ID, $columns);
    }

    /**
     * @return mixed|string|null
     */
    public function getLastStreamID()
    {
        return $this->findVar("SELECT max({$this->primaryKey}) FROM {$this->table} LIMIT 1");
    }

    /**
     * @return mixed|string|null
     */
    public function getAfterAutoIncreament()
    {
        return $this->findVar("SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = '{$this->db->dbname}'
            AND   TABLE_NAME   = '{$this->table}';"
        );
    }

    /**
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function addStream(array $data, array $format)
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
    public function updateStream(int $ID, array $data, array $format = [])
    {
        return $this->update($ID, $data, $format);
    }

    /**
     * @param  array  $data
     * @param  array  $format
     *
     * @return false|int|mixed
     */
    public function replaceStream(array $data, array $format = [])
    {
        return $this->replace($data, $format);
    }

    /**
     * @param  int  $ID
     *
     * @return false|int|mixed
     */
    public function deleteStream(int $ID)
    {
        return $this->delete($ID);
    }

    /**
     * @param  int  $ID
     *
     * @return mixed|string|null
     */
    public function existStream(int $ID)
    {
        return $this->findVar($this->prepare("SELECT `{$this->primaryKey}` FROM {$this->table} WHERE `{$this->primaryKey}`=%d LIMIT 1", [ $ID ]));
    }
}
