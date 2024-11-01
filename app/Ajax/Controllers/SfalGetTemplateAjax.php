<?php

namespace SFAL\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Foundation\Abstractions\SfalAjaxBaseController;
use SFAL\Core\Router\SfalTemplatesRouter;

class SfalGetTemplateAjax extends SfalAjaxBaseController
{
    public static function get()
    {
        self::checkAdminReferer('sfal_get_template_nonce', 'nonce');
        self::checkAjaxReferer('sfal_get_template_nonce', 'nonce');

        $endpoint = self::getEndpoint();
        SfalTemplatesRouter::getInstance()->getTemplate($endpoint, false, true);
    }

    /**
     * @return \SFAL\Core\Support\Request\SfalRequest|string
     */
    private static function getEndpoint()
    {
        $endpoint = SfalRequest('endpoint');
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
