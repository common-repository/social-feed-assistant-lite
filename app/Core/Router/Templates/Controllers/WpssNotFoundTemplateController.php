<?php

namespace App\Core\Router\Templates\Controllers;

defined('ABSPATH') || exit('no access');

class WpssNotFoundTemplateController
{
    public static function err404()
    {
        return WpssViews()->get('menus.404');
    }
}