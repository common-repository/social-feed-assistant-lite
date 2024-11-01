<?php

namespace App\Core\Support\Shortcode\Contract;

defined('ABSPATH') || exit('no access');

interface WpssShortcodeHandlerInterface
{
    /**
     * Handle Wordpress Shortcodes.
     *
     * @param string          $tag   The Sortcode tag
     * @param callable        $callback
     *
     * @return WpssShortcodeHandlerInterface
     */
    public static function add(string $tag, $callback): WpssShortcodeHandlerInterface;
}
