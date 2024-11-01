<?php

namespace SFAL\Ajax;

defined('ABSPATH') || exit('no access');

use SFAL\Ajax\Controllers\SfalAccountsAjax;
use SFAL\Ajax\Controllers\SfalFeedsAjax;
use SFAL\Ajax\Controllers\SfalGetTemplateAjax;
use SFAL\Ajax\Controllers\SfalPostsAjax;
use SFAL\Ajax\Controllers\SfalStreamsAjax;
use SFAL\Ajax\Controllers\SfalSettingsAjax;
use SFAL\Core\Support\Ajax\SfalAjaxListener;
use SFAL\Core\Foundation\Abstractions\SfalBaseAjax;

class SfalAjax extends SfalBaseAjax
{
    public static function init(string $prefix, string $version)
    {
        self::$prefix  = $prefix;
        self::$version = $version;

        // generals ajax
        SfalAjaxListener::listen('sfal_get_template', [ SfalGetTemplateAjax::class, 'get' ]);

        // accounts ajax
        SfalAjaxListener::listen('sfal_new_account', [ SfalAccountsAjax::class, 'new' ]);
        SfalAjaxListener::listen('sfal_remove_account', [ SfalAccountsAjax::class, 'delete' ]);
        SfalAjaxListener::listen('sfal_update_account', [ SfalAccountsAjax::class, 'update' ]);

        // feeds ajax
        SfalAjaxListener::listen('sfal_new_feed', [ SfalFeedsAjax::class, 'new' ]);
        SfalAjaxListener::listen('sfal_remove_feed', [ SfalFeedsAjax::class, 'delete' ]);
        SfalAjaxListener::listen('sfal_update_feed', [ SfalFeedsAjax::class, 'update' ]);
        SfalAjaxListener::listen('sfal_rebuild_feed', [ SfalFeedsAjax::class, 'rebuild' ]);
        
        // posts ajax
        SfalAjaxListener::listen('sfal_make_posts', [ SfalPostsAjax::class, 'make' ]);
        SfalAjaxListener::listen('sfal_make_media_links', [ SfalPostsAjax::class, 'makeLinks' ]);

        // streams ajax
        SfalAjaxListener::listen('sfal_new_stream', [ SfalStreamsAjax::class, 'new' ]);
        SfalAjaxListener::listen('sfal_remove_stream', [ SfalStreamsAjax::class, 'delete' ]);
        SfalAjaxListener::listen('sfal_update_stream', [ SfalStreamsAjax::class, 'update' ]);
        SfalAjaxListener::listen('sfal_get_stream_preview', [ SfalStreamsAjax::class, 'preview' ]);

        // stream posts ajax
        SfalAjaxListener::listen('sfal_get_stream_posts', [ SfalStreamsAjax::class, 'getPosts' ]);

        // general (settings) ajax
        SfalAjaxListener::listen('sfal_update_general_settings', [ SfalSettingsAjax::class, 'save' ]);
    }
}
