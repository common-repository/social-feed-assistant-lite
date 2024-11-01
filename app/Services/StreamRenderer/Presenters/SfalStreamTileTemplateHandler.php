<?php

namespace SFAL\Services\StreamRenderer\Presenters;

defined('ABSPATH') || exit('no access');

use SFAL\Services\StreamRenderer\Presenters\BaseHandler\SfalStreamTemplatesPresenterHandler;

class SfalStreamTileTemplateHandler extends SfalStreamTemplatesPresenterHandler
{
    protected static function grid(&$post)
    {
        ob_start();
        include self::$baseView . DIRECTORY_SEPARATOR . 'shortcodes' . DIRECTORY_SEPARATOR . 'sfal' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'tile' . DIRECTORY_SEPARATOR . 'grid.php';
        return str_replace("\r\n", '', ob_get_clean()) ;
    }

    protected static function masonry(&$post)
    {
        ob_start();
        include self::$baseView . DIRECTORY_SEPARATOR . 'shortcodes' . DIRECTORY_SEPARATOR . 'sfal' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'tile' . DIRECTORY_SEPARATOR . 'masonry.php';
        return str_replace("\r\n", '', ob_get_clean()) ;
    }

    protected static function justified(&$post)
    {
        ob_start();
        include self::$baseView . DIRECTORY_SEPARATOR . 'shortcodes' . DIRECTORY_SEPARATOR . 'sfal' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'tile' . DIRECTORY_SEPARATOR . 'justified.php';
        return str_replace("\r\n", '', ob_get_clean()) ;
    }

    protected static function wall(&$post)
    {
        return self::masonry($post);
    }

    protected static function carousel(&$post)
    {
        ob_start();
        include self::$baseView . DIRECTORY_SEPARATOR . 'shortcodes' . DIRECTORY_SEPARATOR . 'sfal' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'tile' . DIRECTORY_SEPARATOR . 'carousel.php';
        return str_replace("\r\n", '', ob_get_clean());
    }
}
