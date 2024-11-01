<?php

namespace App\Core\Support\Menus\Tabs\Contracts;

defined('ABSPATH') || exit('no access');

interface WpssTabsContract
{
    public static function index();

    public static function getID() : string ;

    public static function getLabel() : string ;

    public static function isDefault() : bool;
}
