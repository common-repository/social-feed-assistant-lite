<?php

namespace App\Core\Support\Shortcode;

use App\Core\Support\Shortcode\Contract\WpssShortcodeHandlerInterface;

defined('ABSPATH') || exit('no access');

class WpssShortcodeHandler implements WpssShortcodeHandlerInterface
{
    public static function add(string $tag, $callback) : WpssShortcodeHandlerInterface
    {
        add_shortcode($tag, $callback);
        return new static;
    }
}
