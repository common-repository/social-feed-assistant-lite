<?php

namespace SFAL\Core\Foundation\Abstractions;

defined('ABSPATH') || exit('no access');

abstract class SfalBaseAdmin
{
    protected static $prefix;
    protected static $version;

    abstract public static function init(string $prefix, string $version);
}
