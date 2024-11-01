<?php

namespace SFAL\Core\Foundation\Abstractions;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Support\Assets\SfalAssetsLoader as Assets;

abstract class SfalBaseMenu
{
    protected static $tabs = [];

    public static function commonActions()
    {
        self::removeAdminNotices();
        self::commonAssets();
    }

    private static function getData()
    {
        return [
            'ajaxUrl'          => admin_url('admin-ajax.php'),
            'loader'           => SfalViews()->get('menus.loader'),
            'templates'        => apply_filters('sfalStaticTemplates', []),
            'i18n'             => SfalConfig('i18n'),
            'getTemplateNonce' => wp_create_nonce('sfal_get_template_nonce'),
        ];
    }

    protected static function commonAssets()
    {
        Assets::getInstance()->localizeScript('admin-bundle', 'sfalData', self::getData());
        Assets::getInstance()
            ->enqueueStyle('reset')
            ->enqueueStyle('lineIcons')
            ->enqueueStyle('colorpicker')
            ->enqueueStyle('cooltipz')
            ->enqueueStyle('admin')
            ->enqueueMedia()
            ->enqueueScript('admin-bundle');
    }

    protected static function removeAdminNotices()
    {
        add_action('in_admin_header', function () {
            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');
        }, 1000);

        add_action('admin_head', function () {
            echo SfalViews()->get('menus.remove-admin-notices');
        });
    }
}
