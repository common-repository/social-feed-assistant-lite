<?php

namespace SFAL\Repositories\StreamFiltersRepository;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Repository\SfalBaseRepository;

class SfalStreamFiltersRepository extends SfalBaseRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . 'sfal_stream_filters';
    }

    protected $primaryKey = 'id';

    /**
     * @param  int  $streamID
     * @param  array  $columns
     *
     * @return mixed
     */
    public function getFiltersByStreamID(int $streamID, array $columns = [])
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
    public function addFilter(array $data, array $format)
    {
        return $this->store($data, $format);
    }

    /**
     * @param  int  $streamID
     * @return false|int|mixed
     */
    public function deleteFiltersByStreamID(int $streamID)
    {
        return $this->deleteBy([
            'stream_id' => $streamID,
        ]);
    }
}
