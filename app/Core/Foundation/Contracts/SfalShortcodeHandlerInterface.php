<?php

namespace SFAL\Core\Foundation\Contracts;

defined('ABSPATH') || exit('no access');

interface SfalShortcodeHandlerInterface
{
    /**
     * Handle Wordpress Shortcodes.
     *
     * @param string          $tag   The Sortcode tag
     * @param callable        $callback
     *
     * @return SfalShortcodeHandlerInterface
     */
    public static function add(string $tag, $callback): SfalShortcodeHandlerInterface;
}
