<?php

namespace SFAL\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use SFAL\Services\SfalFeedsService;
use SFAL\Core\Foundation\Abstractions\SfalAjaxBaseController;
use SFAL\Services\FeedsCacheManager\SfalFeedsCacheManager;
use SFAL\Services\SfalFeedPostsService;

class SfalFeedsAjax extends SfalAjaxBaseController
{
    public static function new()
    {
        self::checkAdminReferer('sfal-new-feed', 'save-feed-nonce');
        self::checkAjaxReferer('sfal-new-feed', 'save-feed-nonce');

        $name            = (string) SfalRequest('name');
        $social          = (string) SfalRequest('social-type');
        $account         = (int)    SfalRequest('account');
        $type            = (string) SfalRequest('feed-type');
        $contents        = (string) SfalRequest('contents');

        self::validateCreateFeed(compact('name', 'social', 'type', 'contents'));

        $result = SfalFeedsService::addAndBuildPosts($account, $name, $social, $type, $contents);

        is_int($result) || wp_send_json_error([ 'message' => $result ]);

        $response = [
            'message' => __('Feed successfully created', 'sfal'),
        ];

        if ($social == 'instagram') {
            $feed = SfalFeedsService::getFeed($result, [], [ 'social', 'content', 'account' ]);
            $response['lazyMakePosts'] = true;
            $response['feed'] = json_encode($feed);
            $response['makPostsNonce'] = wp_create_nonce('sfal-make-posts');
        }
        
        wp_send_json_success($response);
    }

    public static function update()
    {
        self::checkAdminReferer('sfal-update-feed', 'update-feed-nonce');
        self::checkAjaxReferer('sfal-update-feed', 'update-feed-nonce');

        $id              = (int) SfalRequest('feed-id');
        $name            = (string) SfalRequest('name');
        $social          = (string) SfalRequest('social-type');
        $account         = (int) SfalRequest('account');
        $type            = (string) SfalRequest('feed-type');
        $contents        = (string) SfalRequest('contents');

        self::validateUpdateFeed(compact('id', 'name', 'social', 'account', 'type', 'contents'));

        self::checkIsFeedExist($id);

        $result = SfalFeedsService::updateFeedAndRebuildCache($id, $account, $name, $social, $type, $contents);

        is_int($result) || wp_send_json_error([ 'message' => $result ]);

        $response = [
            'message' => __('Feed successfully updated', 'sfal'),
        ];

        if ($social == 'instagram') {
            $feed = SfalFeedsService::getFeed($result, [], [ 'social', 'content', 'account' ]);
            $response['lazyMakePosts'] = true;
            $response['feed'] = json_encode($feed);
            $response['makPostsNonce'] = wp_create_nonce('sfal-make-posts');
        }
        
        wp_send_json_success($response);
    }

    public static function delete()
    {
        self::checkAdminReferer('sfal-remove-feed', 'nonce');
        self::checkAjaxReferer('sfal-remove-feed', 'nonce');

        $id = SfalRequest('feed');

        self::validateDeletedFeed(compact('id'));
        self::checkIsFeedExist($id);

        $result = SfalFeedsService::deleteFeed($id);

        if ($result) {
            wp_send_json_success([
                'message' => __('Your feed has been deleted.', 'sfal'),
            ]);
        }

        wp_send_json_error([
            'message' => $result
        ]);
    }

    public static function rebuild()
    {
        self::checkAdminReferer('sfal-rebuild-feed', 'nonce');
        self::checkAjaxReferer('sfal-rebuild-feed', 'nonce');

        $id = (int) SfalRequest('feed');

        self::validateRebuildedFeed(compact('id'));
        self::checkIsFeedExist($id);

        $feed = SfalFeedsService::getFeed($id, [], [ 'social', 'content', 'account' ]);

        $feed->social_type != 'instagram' && wp_send_json_error(['message' => __('this feed does not support rebuild feature!', 'sfal')]);

        $removeMediasResult = SfalFeedPostsService::removeAllPostsWithCommentsByFeedId($id);

        (true === $removeMediasResult) || wp_send_json_error(['message' => $removeMediasResult]);

        $response = [
            'message' => __('Your feed cache has been rebuilded.', 'sfal'),
            'feed' => json_encode($feed),
            'lazyMakePosts' => true,
            'makePostsNonce' => wp_create_nonce('sfal-make-posts'),
        ];

        wp_send_json_success($response);
    }

    private static function getValidateAliases()
    {
        return [
            'id'              => __('social id', 'sfal'),
            'social'          => __('social type', 'sfal'),
            'account'         => __('account name', 'sfal'),
            'type'            => __('feed type', 'sfal'),
            'updateFrequency' => __('update frequency', 'sfal'),
            'contents'         => __('content to show', 'sfal'),
        ];
    }

    private static function validateCreateFeed(array $inputs)
    {
        self::validation($inputs, [
            'social'          => 'required|in:instagram',
            'name'            => 'required|min:3|max:70',
            'type'            => 'required|in:username',
            'contents'         => 'required|min:3|max:70',
        ], self::getValidateAliases());
    }

    private static function validateUpdateFeed(array $inputs)
    {
        self::validation($inputs, [
            'id'              => 'required|numeric',
            'social'          => 'required|in:instagram,twitter',
            'name'            => 'required|min:3|max:70',
            'type'            => 'required|in:username',
            'contents'         => 'required|min:3|max:70',
        ], self::getValidateAliases());
    }

    private static function validateDeletedFeed(array $inputs)
    {
        self::validation($inputs, [
            'id' => 'required|numeric',
        ], self::getValidateAliases());
    }

    private static function validateRebuildedFeed(array $inputs)
    {
        self::Validation($inputs, [
            'id' => 'required|numeric'
        ], self::getValidateAliases());
    }

    private static function checkIsFeedExist(int $id)
    {
        if (false === SfalFeedsService::existFeed($id)) {
            wp_send_json_error([
                'message' => __('this feed is not exist !', 'wp-ss'),
            ]);
        }
    }
}
