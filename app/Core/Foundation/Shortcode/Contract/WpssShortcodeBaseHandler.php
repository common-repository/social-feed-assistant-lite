<?php

namespace App\Core\Foundation\Shortcode\Contract;

defined('ABSPATH') || exit('no access');
abstract class WpssShortcodeBaseHandler
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
