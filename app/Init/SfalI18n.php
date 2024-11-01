<?php

namespace SFAL\Init;

defined('ABSPATH') || exit('no access');

class SfalI18n
{
    const SLUG = 'sfal';
    public static function loadPluginTextDomain()
    {
        load_plugin_textdomain(self::SLUG, false, SfalConfig('app.relPath') . DIRECTORY_SEPARATOR . 'languages');
    }
}
