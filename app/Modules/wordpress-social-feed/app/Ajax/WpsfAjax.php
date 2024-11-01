<?php

namespace WPSF\Ajax;

defined('ABSPATH') || exit('no access');

use WPSF\Ajax\Controllers\WpsfFeedsAjax;
use WPSF\Ajax\Controllers\WpsfStreamsAjax;
use App\Core\Support\Ajax\WpssAjaxListener;
use App\Core\Foundation\Contracts\WpssBaseAjax;
use WPSF\Ajax\Controllers\WpsfSettingsAjax;

class WpsfAjax extends WpssBaseAjax
{
    public static function init(string $prefix, string $version)
    {
        self::$prefix  = $prefix;
        self::$version = $version;

        // feeds ajax
        WpssAjaxListener::listen('wpsf_new_feed', [ WpsfFeedsAjax::class, 'new' ]);
        WpssAjaxListener::listen('wpsf_remove_feed', [ WpsfFeedsAjax::class, 'delete' ]);
        WpssAjaxListener::listen('wpsf_update_feed', [ WpsfFeedsAjax::class, 'update' ]);
        WpssAjaxListener::listen('wpsf_rebuild_feed', [ WpsfFeedsAjax::class, 'rebuild' ]);
        
        // streams ajax
        WpssAjaxListener::listen('wpsf_new_stream', [ WpsfStreamsAjax::class, 'new' ]);
        WpssAjaxListener::listen('wpsf_remove_stream', [ WpsfStreamsAjax::class, 'delete' ]);
        WpssAjaxListener::listen('wpsf_update_stream', [ WpsfStreamsAjax::class, 'update' ]);
        WpssAjaxListener::listen('wpsf_get_stream_preview', [ WpsfStreamsAjax::class, 'preview' ]);

        // stream posts ajax
        WpssAjaxListener::listen('wpsf_get_stream_posts', [ WpsfStreamsAjax::class, 'getPosts' ]);

        // general (settings) ajax
        WpssAjaxListener::listen('wpsf_update_general_settings', [ WpsfSettingsAjax::class, 'save' ]);
    }
}
