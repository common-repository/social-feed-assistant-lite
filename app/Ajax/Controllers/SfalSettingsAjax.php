<?php

namespace SFAL\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Foundation\Abstractions\SfalAjaxBaseController;

class SfalSettingsAjax extends SfalAjaxBaseController
{
    public static function save()
    {
        self::checkAdminReferer('sfal-save-general-settings', 'save-general-settings-nonce');
        self::checkAjaxReferer('sfal-save-general-settings', 'save-general-settings-nonce');

        $shareButtons = (array) SfalRequest('share-buttons');
        $eraseData =  SfalRequest('erase-data') ? 1 : 0;

        self::validateOptions(compact('shareButtons'));

        $option = ['shareButtons' => $shareButtons, 'eraseData' => $eraseData];

        if (false === get_option('sfal_general_settings') && false === update_option('sfal_general_settings', $option)) {
            add_option('sfal_general_settings', $option);
        } else {
            update_option('sfal_general_settings', $option);
        }
        wp_send_json_success(['message' => __('options successfully save', 'sfal')]);
    }

    private static function validateOptions(array $inputs)
    {
        self::validation($inputs, [
            'shareButtons'   => 'array',
            'shareButtons.*' => 'required|in:twitter,facebook,linkedin,google-plus,pinterest,mail'
        ], [
            'shareButtons' => __('share socials', 'sfal')
        ]);
    }
}
