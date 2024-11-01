<?php

namespace SFAL\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Foundation\Abstractions\SfalAjaxBaseController;
use SFAL\Services\MakePosts\SfalMakePosts;

class SfalPostsAjax extends SfalAjaxBaseController
{
    public static function make()
    {
        self::checkAdminReferer('sfal-make-posts', 'make-posts-nonce');
        self::checkAjaxReferer('sfal-make-posts', 'make-posts-nonce');

        $feed        = SfalJsonCleanDecode(SfalRequest('feed'), true);
        $feedID      = (int) SfalRequest('feed-id');
        $feedContent = (string) SfalRequest('feed-content');
        $count       = (int) SfalRequest('count');
        $mediaLinks  = (array) SfalJsonCleanDecode(SfalRequest('media-links'));

        $feed = (object) $feed ?? null;
 
        list($status, $result) = SfalMakePosts::make($feedID, $feedContent, $count, $mediaLinks, $feed);

        (true === $status) || wp_send_json_error(['message' => $result]);

        wp_send_json_success([
            'message' => __('Feed posts successfully created', 'sfal'),
            'count' => $result,
        ]);
    }

    public static function makeLinks()
    {
        self::checkAdminReferer('sfal-make-posts', 'make-posts-nonce');
        self::checkAjaxReferer('sfal-make-posts', 'make-posts-nonce');

        $feed        = SfalJsonCleanDecode(SfalRequest('feed'), true);
        $feedID      = (int) SfalRequest('feed-id');
        $feedContent = (string) SfalRequest('feed-content');
        $count       = (int) SfalRequest('count');

        $feed = (object) $feed ?? null;

        SfalMakePosts::setReturnPureLinks(true);

        list($status, $result) = SfalMakePosts::make($feedID, $feedContent, $count, [], $feed);

        false === $status && wp_send_json_error(['message' => $result]);

        wp_send_json_success([
            'links' => json_encode($result),
        ]);
    }
}
