<?php

namespace WPSF\Router\Controllers;

defined('ABSPATH') || exit('no access');

class WpsfSettingsTemplateController
{
    public static function index()
    {
        $options = get_option('wpsf_general_settings');
        return WpssViews()->get('menus.tabs.settings-tab.index', compact('options'));
    }
}
