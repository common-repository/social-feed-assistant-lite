<?php

namespace SFAL\Core\Foundation\Contracts;

defined('ABSPATH') || exit('no access');

interface SfalTabContract
{
    public static function index();

    public static function getID() : string ;

    public static function getLabel() : string ;

    public static function isDefault() : bool;
}
