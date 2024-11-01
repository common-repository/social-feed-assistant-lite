<?php

namespace App\Core\Foundation\Ajax;

defined('ABSPATH') || exit('no access');

use App\Core\Support\Ajax\WpssAjaxListener;
use App\Core\Foundation\Contracts\WpssBaseAjax;
use App\Core\Foundation\Ajax\Controllers\WpssGetTemplateAjax;

class WpssAjax extends WpssBaseAjax
{
    public static function init(string $prefix, string $version)
    {
        self::$prefix  = $prefix;
        self::$version = $version;

        // generals ajax
        WpssAjaxListener::listen('wpss_get_template', [ WpssGetTemplateAjax::class, 'get' ]);
    }
}
