<?php

namespace WPSF\Init\Activator;

defined('ABSPATH') || exit('no access');
class WpsfCheckCronActivator
{
    public static function removeRebuildCacheEvent()
    {
        if (wp_next_scheduled('wpsf_feeds_cache_event')) {
            wp_clear_scheduled_hook('wpsf_feeds_cache_event');
        }
    }
}