<?php

namespace SFAL\Core\Foundation\Abstractions;

defined('ABSPATH') || exit('no access');
abstract class SfalShortcodeBaseHandler
{
    /**
     * this will handle shortcode output
     *
     * @param array $atts
     * @param string $content
     * @return void
     */
    abstract public static function handle($atts = [], string $content = "");
}
