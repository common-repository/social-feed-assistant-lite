<?php

namespace SFAL\Core\Foundation\Contracts;

defined('ABSPATH') || exit('no access');

interface SfalAjaxListenerInterface
{
    /**
     * Listen to AJAX calls.
     *
     * @param string          $action   The AJAX action name.
     * @param \Closure|string $callback
     * @param string|bool     $logged   true, false or 'both' type of users.
     *
     * @return SfalAjaxListenerInterface
     */
    public static function listen($action, $callback, $logged = 'both'): SfalAjaxListenerInterface;
}
