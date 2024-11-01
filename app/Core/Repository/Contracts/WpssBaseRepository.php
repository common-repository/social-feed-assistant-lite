<?php

namespace App\Core\Repository\Contracts;

defined('ABSPATH') || exit('no access');

class WpssBaseRepository extends WpssWpdbBaseRepository
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
