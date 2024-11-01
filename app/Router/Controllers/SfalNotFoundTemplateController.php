<?php

namespace SFAL\Router\Controllers;

defined('ABSPATH') || exit('no access');

class SfalNotFoundTemplateController
{
    public static function err404()
    {
        return SfalViews()->get('menus.404');
    }
}