<?php

namespace App\Core\Support\Menus\Controllers\Contracts;

defined('ABSPATH') || exit('no access');

use App\Core\Support\Assets\WpssAssetsLoader as Assets;

abstract class WpssMenusContract
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
            'loader'           => WpssViews()->get('menus.loader'),
            'templates'        => apply_filters('wpssStaticTemplates', []),
            'i18n'             => WpssConfig('i18n'),
            'getTemplateNonce' => wp_create_nonce('wpss_get_template_nonce'),
        ];
    }

    protected static function commonAssets()
    {
        $assetsUrl = WpssConfig('app.assetsUrl');
        Assets::getInstance(WPSS()->getPrefix())->enqueueStyle('reset', $assetsUrl . 'css/reset.css');
        Assets::getInstance()->enqueueStyle('lineIcons', $assetsUrl . 'library/lineicons/LineIcons.min.css');
        Assets::getInstance()->enqueueStyle('colorpicker', $assetsUrl . 'library/color-picker/jquery.minicolors.css');
        Assets::getInstance()->enqueueStyle('cooltipz', $assetsUrl . 'library/cooltipz/cooltipz.min.css');
        Assets::getInstance()->enqueueStyle('admin', $assetsUrl . 'css/admin.css');

        Assets::getInstance()->registerScript('sweetalert', $assetsUrl . 'library/sweetalert2/sweetalert2.all.min.js', [], false, true);
        Assets::getInstance()->registerScript('tagify', $assetsUrl . 'library/tagify/tagify.min.js', [], false, true);
        Assets::getInstance()->registerScript('colorpicker', $assetsUrl . 'library/color-picker/jquery.minicolors.min.js', [], false, true);

        // code editor
        Assets::getInstance()->registerScript('ace', $assetsUrl . 'library/ice-editor/ace.js', [], false, true);
        Assets::getInstance()->registerScript('ace-theme', $assetsUrl . 'library/ice-editor/theme-monokai.js', [], false, true);
        Assets::getInstance()->registerScript('ace-mode', $assetsUrl . 'library/ice-editor/mode-css.js', [], false, true);
        Assets::getInstance()->registerScript('jquery-ace', $assetsUrl . 'library/ice-editor/jquery-ace.min.js' , [], false, true);

        $deps = [ 
            'jquery',
            'jquery-ui-sortable', 
            WPSS()->getPrefix() . "_sweetalert",
            WPSS()->getPrefix() . "_tagify",
            WPSS()->getPrefix() . "_colorpicker",
            WPSS()->getPrefix() . "_ace" ,
            WPSS()->getPrefix() . "_ace-theme" ,
            WPSS()->getPrefix() . "_ace-mode" ,
            WPSS()->getPrefix() . "_jquery-ace" 
        ];
        Assets::getInstance()->registerScript('admin', $assetsUrl . 'js/admin.js', $deps, false, true);
        Assets::getInstance()->localizeScript('admin', 'wpssData', self::getData());

        Assets::getInstance()->enqueueMedia()
        ->enqueueScript('admin')
        ->enqueueScript('sweetalert')
        ->enqueueScript('tagify')
        ->enqueueScript('colorpicker')
        ->enqueueScript('ace')
        ->enqueueScript('ace-theme')
        ->enqueueScript('ace-mode')
        ->enqueueScript('jquery-ace');
    }

    protected static function removeAdminNotices()
    {
        add_action('in_admin_header', function () {
            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');
        }, 1000);

        add_action('admin_head', function () {
            echo WpssViews()->get('menus.remove-admin-notices');
        });
    }
}
