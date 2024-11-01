<?php

namespace SFAL\Services\StreamRenderer\Presenters;

defined('ABSPATH') || exit('no access');

use SFAL\Services\StreamRenderer\Presenters\BaseHandler\SfalStreamTemplatesPresenterHandler;

class SfalStreamClassicTemplateHandler extends SfalStreamTemplatesPresenterHandler
{
    public static $count;
    protected static function grid(&$post)
    {
        ob_start();
        include self::$baseView . DIRECTORY_SEPARATOR . 'shortcodes' . DIRECTORY_SEPARATOR . 'sfal' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'classic' . DIRECTORY_SEPARATOR . 'grid.php';
        return str_replace("\r\n", '', ob_get_clean());
    }

    protected static function masonry(&$post)
    {
        ob_start();
        include self::$baseView . DIRECTORY_SEPARATOR . 'shortcodes' . DIRECTORY_SEPARATOR . 'sfal' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'classic' . DIRECTORY_SEPARATOR . 'masonry.php';
        return str_replace("\r\n", '', ob_get_clean());
    }

    protected static function justified(&$post)
    {
        return self::grid($post);
    }

    protected static function wall(&$post)
    {
        ob_start();
        include self::$baseView . DIRECTORY_SEPARATOR . 'shortcodes' . DIRECTORY_SEPARATOR . 'sfal' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'classic' . DIRECTORY_SEPARATOR . 'wall.php';
        return str_replace("\r\n", '', ob_get_clean());
    }

    protected static function carousel(&$post)
    {
        ob_start();
        include self::$baseView . DIRECTORY_SEPARATOR . 'shortcodes' . DIRECTORY_SEPARATOR . 'sfal' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'classic' . DIRECTORY_SEPARATOR . 'carousel.php';
        return str_replace("\r\n", '', ob_get_clean());
    }
}
