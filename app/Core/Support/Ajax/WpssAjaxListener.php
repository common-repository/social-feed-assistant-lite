<?php

namespace App\Core\Support\Ajax;

defined('ABSPATH') || exit('no access');

use App\Core\Support\Ajax\Contract\WpssAjaxListenerInterface;

class WpssAjaxListener implements WpssAjaxListenerInterface
{
    /**
     * Listen to AJAX API calls.
     *
     * @param  string  $action  The AJAX action name.
     * @param  \Closure|string  $callback  A callback function name, a closure or a string defining a class and its method.
     * @param  string|bool  $logged  true, false or 'both' type of users.
     *
     * @return WpssAjaxListenerInterface
     */
    public static function listen($action, $callback, $logged = 'both'): WpssAjaxListenerInterface
    {
        // Front-end ajax for non-logged users
        // Set $logged to false
        if ($logged === false || $logged === 'no') {
            add_action("wp_ajax_nopriv_$action", $callback);
        }

        // Front-end and back-end ajax for logged users
        if ($logged === true || $logged === 'yes') {
            add_action("wp_ajax_$action", $callback);
        }

        // Front-end and back-end for both logged in or out users
        if ($logged === 'both') {
            add_action("wp_ajax_nopriv_$action", $callback);
            add_action("wp_ajax_$action", $callback);
        }

        return new static;
    }
}
