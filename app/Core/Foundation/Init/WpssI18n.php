<?php

namespace App\Core\Foundation\Init;

defined('ABSPATH') || exit('no access');

class WpssI18n
{
    const SLUG = 'wp-ss';
    public static function loadPluginTextDomain()
    {
        load_plugin_textdomain(self::SLUG, false, WpssConfig('app.relPath') . DIRECTORY_SEPARATOR . 'languages');
    }
}
