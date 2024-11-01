<?php

namespace App\Core\Repository\Contracts;

defined('ABSPATH') || exit('no access');

use Exception;

class WpssWpdbBaseRepository implements WpssRepositoryInterface
{
    protected $db;
    protected $table;
    protected $prefix;
    protected $primaryKey = 'id';

    public function __construct()
    {
        global $wpdb;
        $this->db     = $wpdb;
        $this->prefix = $wpdb->prefix;
    }

    /**
     * Begin a Transaction through WordPress wpdb
     */
    public function beginTransaction()
    {
        $this->query("START TRANSACTION");
    }

    public function disableAutoCommit()
    {
        $this->query("SET autocommit = 0");
    }

    public function enableAutoCommit()
    {
        $this->query("SET autocommit = 1");
    }

    /**
     * Rollback a Transaction through WordPress wpdb
     */
    public function rollbackTransaction()
    {
        $this->query("ROLLBACK");
    }

    /**
     * Commit a Transaction through WordPress wpdb
     */
    public function commitTransaction()
    {
        $this->query("COMMIT");
    }

    /**
     * Execute a callable inside a Transaction (through WordPress wpdb); if all
     * goes well, it commit the transaction and returns the value returned by
     * calling the specified callable; otherwise, if an exception is catched, it
     * rollbacks the transaction.
     *
     * @param  callable  $func  the transactional code to execute
     *
     * @return mixed            what the callable returns
     */
    public function transaction(callable $func)
    {
        try {
            $this->beginTransaction();
            $this->disableAutoCommit();
            $result = $func();
            $this->commitTransaction();
        } catch (Exception $e) {
            $result = $e->getMessage();
            $this->rollbackTransaction();
        }
        $this->enableAutoCommit();
        return $result ?? false;
    }

    /**
     * @inheritDoc
     */
    public function query(string $query)
    {
        return $this->db->query($query);
    }

    /**
     * @param string $query
     * @param string $output
     * @return mixed
     */
    public function get_results(string $query = null, string $output = OBJECT)
    {
        return $this->db->get_results($query, $output);
    }

    /**
     * @param string $query
     * @param string $output
     * @param integer $y
     * @return mixed
     */
    public function get_row(string $query = null, string $output = OBJECT, int $y = 0)
    {
        return $this->db->get_row($query, $output, $y);
    }

    /**
     * @param string $query
     * @param integer $x
     * @param integer $y
     * @return mixed
     */
    private function get_var(string $query = null, int $x = 0, int $y = 0)
    {
        return $this->db->get_var($query, $x, $y);
    }

    /**
     * @param string $query
     * @param integer $x
     * @return mixed
     */
    private function get_col(string $query = null, int $x = 0)
    {
        return $this->db->get_col($query, $x);
    }

    /**
     * @inheritDoc
     */
    public function all(array $columns = [])
    {
        $columns = $this->getColumns($columns);

        return $this->get_results("SELECT {$columns} FROM {$this->table}");
    }

    /**
     * @inheritDoc
     */
    public function paginate(int $page, array $columns = [], int $perPage = 50)
    {
        $columns = $this->getColumns($columns);

        $offset = ($page - 1) * $perPage;

        return $this->get_results($this->prepare("SELECT {$columns} FROM {$this->table} LIMIT %d, %d", [
            $offset,
            $perPage,
        ]));
    }

    /**
     * @inheritDoc
     */
    public function paginateBy(array $criteria, array $criteriaValues, int $page, int $perpage = 50, array $columns = [])
    {
        $columns = $this->getColumns($columns);
        $where   = $this->processWhere($criteria);

        $offset  = ($page - 1) * $perpage;

        array_push($criteriaValues, $offset, $perpage);

        return $this->get_results($this->prepare("SELECT {$columns} FROM {$this->table} WHERE {$where} LIMIT %d, %d", $criteriaValues));
    }

    /**
     * @inheritDoc
     */
    public function find(int $ID, array $columns = [])
    {
        $columns = $this->getColumns($columns);

        return $this->get_row($this->prepare("SELECT {$columns} FROM {$this->table} WHERE {$this->primaryKey} = %d LIMIT 1", [
            $ID,
        ]));
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $criteriaValues, array $columns = [], bool $single = true)
    {
        $columns = $this->getColumns($columns);

        $method = $this->getMethod($single);
        $where  = $this->processWhere($criteria);

        $query = "SELECT {$columns} FROM {$this->table} WHERE {$where}";

        if ($single) {
            $query .= " LIMIT 1";
        }

        return $this->{$method}($this->prepare($query, $criteriaValues));
    }

    /**
     * @inheritDoc
     */
    public function findVar(string $query = null, int $columnOffset = 0, int $rowOffset = 0)
    {
        return $this->get_var($query, $columnOffset, $rowOffset);
    }

    /**
     * @inheritDoc
     */
    public function findCol(string $query = null, int $columnOffset = 0)
    {
        return $this->get_col($query, $columnOffset);
    }

    /**
     * @inheritDoc
     */
    public function store(array $item, array $format = [])
    {
        $format = count($format) > 0 ? $format : $this->generateDataFormat($item);

        return $this->db->insert($this->table, $item, $format);
    }

    /**
     * @inheritDoc
     */
    public function replace(array $item, array $format = [])
    {
        $format = count($format) > 0 ? $format : $this->generateDataFormat($item);

        return $this->db->replace($this->table, $item, $format);
    }

    /**
     * @inheritDoc
     */
    public function update(int $ID, array $item, array $format = [])
    {
        $where       = [ $this->primaryKey => $ID ];
        $whereFormat = $this->generateDataFormat($where);
        $format      = count($format) > 0 ? $format : $this->generateDataFormat($item);

        return $this->db->update($this->table, $item, $where, $format, $whereFormat);
    }

    /**
     * @inheritDoc
     */
    public function updateBy(array $criteria, array $data)
    {
        $whereFormat = $this->generateDataFormat($criteria);
        $format      = $this->generateDataFormat($data);

        return $this->db->update($this->table, $data, $criteria, $format, $whereFormat);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $ID)
    {
        $where       = [ $this->primaryKey => $ID ];
        $whereFormat = $this->generateDataFormat($where);

        return $this->db->delete($this->table, $where, $whereFormat);
    }

    /**
     * @inheritDoc
     */
    public function deleteBy(array $criteria)
    {
        $whereFormat = $this->generateDataFormat($criteria);

        return $this->db->delete($this->table, $criteria, $whereFormat);
    }

    /**
     * prepare sql query with $wpdb prepare method
     *
     * @param  string  $query
     * @param  array  $args
     *
     * @return string
     */
    public function prepare(string $query, array $args): string
    {
        return $this->db->prepare($query, ...$args);
    }

    /**
     * @return int
     */
    public function getLastInsertedID()
    {
        return $this->db->insert_id;
    }

    /**
     * validate criteria operators , then return true if is valid operator else return false
     *
     * @param  string  $operator
     *
     * @return bool
     */
    private function isValidCriteriaOperator(string $operator): bool
    {
        return in_array($operator, [ '=', '!=', 'LIKE', 'IN', ]);
    }

    /**
     * validate criteria array , return false if isn't have value or operator key ,
     * else return true
     *
     * @param  array  $criteria
     *
     * @return bool
     */
    private function isValidCriteria(array $criteria): bool
    {
        if (! isset($criteria['value'], $criteria['operator']) || ! $this->isValidCriteriaOperator($criteria['operator'])) {
            return false;
        }

        return true;
    }

    /**
     * this will resolve where value for compatible with operator
     *
     * @param $value
     * @param $operator
     *
     * @return string
     */
    private function resolveWhereValue($value, string $operator): string
    {
        if ($operator == 'IN') {
            return "({$value})";
        }

        return $value;
    }

    /**
     * process where clause with criteria ,
     * get criteria and convert it to where clause for use on query
     *
     * @param  array  $criteria
     *
     * @return string
     */
    private function processWhere(array $criteria): string
    {
        $query = [];
        foreach ($criteria as $key => $value) {
            if (! $this->isValidCriteria($value)) {
                continue;
            }
            $value['value'] = $this->resolveWhereValue($value['value'], $value['operator']);
            array_push($query, $key, $value['operator'], $value['value'], "AND");
        }
        array_pop($query);
        return implode(' ', $query);
    }

    /**
     * get selected method from database ,
     * return get_row if single is true , else return get_results
     *
     * @param  bool  $single
     *
     * @return string
     */
    private function getMethod(bool $single): string
    {
        return $single ? 'get_row' : 'get_results';
    }

    /**
     * this will convert array of columns to string format
     *
     * @param  array  $columns
     *
     * @return string
     */
    private function getColumns(array $columns): string
    {
        if (! $columns) {
            return '*';
        }

        $columns = array_map(function ($column) {
            return "`$column`";
        }, $columns);

        return implode(', ', $columns);
    }

    /**
     * get data and return that formatted
     *
     * @param  array  $data
     *
     * @return array
     */
    private function generateDataFormat(array $data): array
    {
        $result = [];
        foreach ($data as $item) {
            array_push($result, $this->getItemFormat($item));
        }

        return $result;
    }

    /**
     * @param $item
     *
     * get item and return that format
     *
     * @return string
     */
    private function getItemFormat($item): string
    {
        $formats = [
            'int'     => '%d',
            'string'  => '%s',
            'float'   => '%f',
            'default' => '%s',
        ];

        if (is_int($item)) {
            return $formats['int'];
        }

        if (is_float($item) && is_double($item)) {
            return $formats['float'];
        }

        return $formats['default'];
    }
}
