<?php

namespace SFAL\Router\Controllers;

defined('ABSPATH') || exit('no access');

class SfalSettingsTemplateController
{
    public static function index()
    {
        $options = get_option('sfal_general_settings');
        return SfalViews()->get('menus.tabs.settings-tab.index', compact('options'));
    }
}
