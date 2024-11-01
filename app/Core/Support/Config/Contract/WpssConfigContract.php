<?php

namespace App\Core\Support\Config\Contract;

defined('ABSPATH') || exit('no access');

interface WpssConfigContract
{
    public function get(string $config);

    public function has(string $config);

    public function all(string $config);
}
