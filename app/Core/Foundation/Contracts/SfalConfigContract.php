<?php

namespace SFAL\Core\Foundation\Contracts;

defined('ABSPATH') || exit('no access');

interface SfalConfigContract
{
    public function get(string $config);

    public function has(string $config);

    public function all(string $config);
}
