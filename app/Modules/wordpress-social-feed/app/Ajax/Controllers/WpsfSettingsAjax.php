<?php

namespace WPSF\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use App\Core\Foundation\Ajax\Controllers\Contract\WpssAjaxBaseController;
use App\Core\Support\Request\WpssRequest;

class WpsfSettingsAjax extends WpssAjaxBaseController
{
    public static function save()
    {
        self::checkAdminReferer('wpsf-save-general-settings', 'save-general-settings-nonce');
        self::checkAjaxReferer('wpsf-save-general-settings', 'save-general-settings-nonce');

        $shareButtons = (array) WpssRequest('share-buttons');
        $eraseData =  WpssRequest('erase-data') ? 1 : 0;

        self::validateOptions(compact('shareButtons'));

        $option = ['shareButtons' => $shareButtons, 'eraseData' => $eraseData];

        if (false === get_option('wpsf_general_settings') && false === update_option('wpsf_general_settings', $option)) {
            add_option('wpsf_general_settings', $option);
        } else {
            update_option('wpsf_general_settings', $option);
        }
        wp_send_json_success(['message' => __('options successfully save', 'wp-ss')]);
    }

    private static function validateOptions(array $inputs)
    {
        self::validation($inputs, [
            'shareButtons'   => 'array',
            'shareButtons.*' => 'required|in:twitter,facebook,linkedin,google-plus,pinterest,mail'
        ], [
            'shareButtons' => __('share socials', 'wp-ss')
        ]);
    }
}
