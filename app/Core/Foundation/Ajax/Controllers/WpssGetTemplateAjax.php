<?php

namespace App\Core\Foundation\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use App\Core\Router\Templates\WpssTemplatesRouter;
use App\Core\Foundation\Ajax\Controllers\Contract\WpssAjaxBaseController;

class WpssGetTemplateAjax extends WpssAjaxBaseController
{
    public static function get()
    {
        self::checkAdminReferer('wpss_get_template_nonce', 'nonce');
        self::checkAjaxReferer('wpss_get_template_nonce', 'nonce');

        $endpoint = self::getEndpoint();
        WpssTemplatesRouter::getInstance()->getTemplate($endpoint, false, true);
    }

    /**
     * @return \App\Core\Support\Request\WpssRequest|string
     */
    private static function getEndpoint()
    {
        $endpoint = WpssRequest('endpoint');
        self::validateEndpoint($endpoint);
        return $endpoint;
    }

    /**
     * @param $endpoint
     */
    private static function validateEndpoint($endpoint)
    {
        if (! $endpoint) {
            wp_send_json_error([
                'message' => __('please enter endpoint'),
            ]);
        }
    }
}
