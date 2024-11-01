<?php

namespace SFAL\Core\Repository;

defined('ABSPATH') || exit('no access');

class SfalBaseRepository extends SfalWpdbBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getTable()
    {
        return $this->table;    
    }
}
