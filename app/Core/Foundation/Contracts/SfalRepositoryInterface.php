<?php

namespace SFAL\Core\Foundation\Contracts;

defined('ABSPATH') || exit('no access');

interface SfalRepositoryInterface
{
    /**
     * this will just run query and return that result
     *
     * @param $query
     *
     * @return mixed
     */
    public function query(string $query);

    /**
     * return all rows from data storage
     *
     * @param  array  $columns  *
     *
     * @return mixed
     */
    public function all(array $columns = []);

    /**
     * return paginated data from data storage
     *
     * @param  int  $page
     * @param  array  $columns
     * @param  int  $perPage
     *
     * @return mixed
     */
    public function paginate(int $page, array $columns = [], int $perPage = 50);

    /**
     *
     * return paginated data from data storage with criteria
     *
     * @param  array  $criteria
     * @param  array  $criteriaValues
     * @param  int  $page
     * @param  int  $perpage
     * @param  array  $columns
     *
     * @return mixed
     */
    public function paginateBy(array $criteria, array $criteriaValues, int $page, int $perpage = 50, array $columns = []);

    /**
     * find row from data storage with primaryKey
     *
     * @param  int  $ID
     * @param  array  $columns
     *
     * @return mixed
     */
    public function find(int $ID, array $columns = []);

    /**
     * find data from data storage with criteria
     *
     * @param  array  $criteria
     * @param  array  $criteriaValues
     * @param  array  $columns
     * @param  bool  $single
     *
     * @return mixed
     */
    public function findBy(array $criteria, array $criteriaValues, array $columns = [], bool $single = true);

    /**
     *
     * return single var from data storage
     *
     * @param  string  $query
     * @param  int  $columnOffset
     * @param  int  $rowOffset
     *
     * @return mixed
     */
    public function findVar(string $query, int $columnOffset = 0, int $rowOffset = 0);

    /**
     *
     * return single column from data storage
     *
     * @param  string  $query
     * @param  int  $columnOffset
     *
     * @return mixed
     */
    public function findCol(string $query, int $columnOffset = 0);

    /**
     * store data on data storage
     *
     * @param  array  $item
     * @param  array  $format
     *
     * @return mixed
     */
    public function store(array $item, array $format = []);

    /**
     *
     * replace data on data storage
     *
     * @param  array  $item
     * @param  array  $format
     *
     * @return mixed
     */
    public function replace(array $item, array $format = []);

    /**
     * update row on data storage with primaryKey
     *
     * @param  int  $ID
     * @param  array  $item
     * @param  array  $format
     *
     * @return mixed
     */
    public function update(int $ID, array $item, array $format = []);

    /**
     * update data storage with criteria and new data
     *
     * @param  array  $criteria
     * @param  array  $data
     *
     * @return mixed
     */
    public function updateBy(array $criteria, array $data);

    /**
     * delete row from data storage with primaryKey
     *
     * @param  int  $ID
     *
     * @return mixed
     */
    public function delete(int $ID);

    /**
     * delete row from data storage with criteria
     *
     * @param  array  $criteria
     *
     * @return mixed
     */
    public function deleteBy(array $criteria);
}
