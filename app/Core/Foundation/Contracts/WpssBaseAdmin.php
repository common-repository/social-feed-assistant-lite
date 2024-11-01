<?php

namespace App\Core\Foundation\Contracts;

defined('ABSPATH') || exit('no access');

abstract class WpssBaseAdmin
{
    protected static $prefix;
    protected static $version;

    abstract public static function init(string $prefix, string $version);
}
