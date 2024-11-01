<?php

namespace App\Core\Support\Ajax\Contract;

defined('ABSPATH') || exit('no access');

interface WpssAjaxListenerInterface
{
    /**
     * Listen to AJAX calls.
     *
     * @param string          $action   The AJAX action name.
     * @param \Closure|string $callback
     * @param string|bool     $logged   true, false or 'both' type of users.
     *
     * @return WpssAjaxListenerInterface
     */
    public static function listen($action, $callback, $logged = 'both'): WpssAjaxListenerInterface;
}
