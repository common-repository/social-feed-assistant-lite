<?php

namespace SFAL\Core\Foundation\Abstractions;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Libs\Factory\SfalLibFactory;

abstract class SfalAjaxBaseController
{
    /**
     * this will validate ajax request inputs , then if it was invalid this will send json error to frontend
     *
     * @param  array  $inputs
     * @param  array  $rules
     * @param  array  $aliases
     * @param  array  $messages
     */
    protected static function validation(array $inputs, array $rules, array $aliases = [], array $messages = [])
    {
        $validator = SfalLibFactory::make('validator')->make($inputs, $rules, $messages);

        $aliases && $validator->setAliases($aliases);

        $validator->validate();

        if ($validator->fails()) {
            wp_send_json_error([
                'message' => implode("</br>", $validator->errors()->all()),
            ]);
        }
    }

    /**
     * validate ajax request , with wp_nonce
     *
     * @param  int  $action
     * @param  bool  $queryArg
     * @param  bool  $die
     *
     */
    protected static function checkAjaxReferer($action = - 1, $queryArg = false, $die = false)
    {
        if (check_ajax_referer($action, $queryArg, $die) === false) {
            wp_send_json_error([
                'message' => __('nonce expired', 'sfal'),
            ]);
        }
    }

    /**
     * validate request , is from admin dashboard
     *
     * @param  int  $action
     * @param  string  $queryArg
     */
    protected static function checkAdminReferer($action = - 1, $queryArg = '_wpnonce')
    {
        if (check_admin_referer($action, $queryArg) === false) {
            wp_send_json_error([
                'message' => __('admin referer is not valid !', 'sfal'),
            ]);
        }
    }

    /**
     * validate required args
     *
     * @param  string  $key
     */
    protected static function requiredArg(string $key)
    {
        if (! SfalRequest()->keyExists($key)) {
            wp_send_json_error([
                'message' => __('incomplete request', 'sfal'),
            ]);
        }
    }

    /**
     * @param  string  $key
     *
     * @return string
     */
    protected static function getArg(string $key): string
    {
        return sanitize_text_field(SfalRequest($key));
    }
}
