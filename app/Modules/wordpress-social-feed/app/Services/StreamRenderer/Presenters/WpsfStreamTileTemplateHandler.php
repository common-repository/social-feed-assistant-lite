<?php

namespace WPSF\Services\StreamRenderer\Presenters;

defined('ABSPATH') || exit('no access');

use WPSF\Services\StreamRenderer\Presenters\BaseHandler\WpsfStreamTemplatesPresenterHandler;
class WpsfStreamTileTemplateHandler extends WpsfStreamTemplatesPresenterHandler
{
    protected static function grid(&$post)
    {
        return self::masonry($post);
    }

    protected static function masonry(&$post)
    {
        ob_start();
        include self::$baseView . DIRECTORY_SEPARATOR . 'shortcodes' . DIRECTORY_SEPARATOR . 'wpsf' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'tile' . DIRECTORY_SEPARATOR . 'masonry.php';
        return str_replace("\r\n", '', ob_get_clean()) ;
    }

    protected static function justified(&$post)
    {
        return self::masonry($post);
    }

    protected static function wall(&$post)
    {
        return self::masonry($post);
    }

    protected static function carousel(&$post)
    {
        return self::masonry($post);
    }
}
