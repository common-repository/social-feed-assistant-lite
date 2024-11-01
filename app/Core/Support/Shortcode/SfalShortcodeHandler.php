<?php

namespace SFAL\Core\Support\Shortcode;

use SFAL\Core\Foundation\Contracts\SfalShortcodeHandlerInterface;

defined('ABSPATH') || exit('no access');

class SfalShortcodeHandler implements SfalShortcodeHandlerInterface
{
    public static function add(string $tag, $callback) : SfalShortcodeHandlerInterface
    {
        add_shortcode($tag, $callback);
        return new static;
    }
}
