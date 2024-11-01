<?php

namespace WPSF\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use WPSF\Services\WpsfFeedsService;
use App\Core\Foundation\Ajax\Controllers\Contract\WpssAjaxBaseController;
use WPSF\Services\FeedsCacheManager\WpsfFeedsCacheManager;

class WpsfFeedsAjax extends WpssAjaxBaseController
{
    public static function new()
    {
        self::checkAdminReferer('wpsf-new-feed', 'save-feed-nonce');
        self::checkAjaxReferer('wpsf-new-feed', 'save-feed-nonce');

        $name            = (string) WpssRequest('name');
        $social          = (string) WpssRequest('social-type');
        $account         = (int)    WpssRequest('account');
        $type            = (string) WpssRequest('feed-type');
        $content         = (string) WpssRequest('content');

        self::validateCreateFeed(compact('name', 'social', 'type', 'content'));

        $resCreateAndBuildCache = WpsfFeedsService::addAndBuildFeedCache($account, $name, $social, $type, $content);
        if ($resCreateAndBuildCache !== true) {
            wp_send_json_error([
                'message' => $resCreateAndBuildCache
            ]);
        }
        wp_send_json_success([
            'message' => __('Feed Successfully Created', 'wp-ss'),
        ]);
    }

    public static function update()
    {
        self::checkAdminReferer('wpsf-update-feed', 'update-feed-nonce');
        self::checkAjaxReferer('wpsf-update-feed', 'update-feed-nonce');

        $id              = (int) WpssRequest('feed-id');
        $name            = (string) WpssRequest('name');
        $social          = (string) WpssRequest('social-type');
        $account         = (int) WpssRequest('account');
        $type            = (string) WpssRequest('feed-type');
        $content         = (string) WpssRequest('content');

        self::validateUpdateFeed(compact('id', 'name', 'social', 'account', 'type', 'content'));
        self::checkIsFeedExist($id);

        $resUpdateAndRebuildCache = WpsfFeedsService::updateFeedAndRebuildCache($id, $account, $name, $social, $type, $content);
        if ($resUpdateAndRebuildCache !== true) {
            wp_send_json_error([
                'message' => $resUpdateAndRebuildCache
            ]);
        }
        wp_send_json_success([
            'message' => __('Feed Successfully Updated', 'wp-ss'),
        ]);
    }

    public static function delete()
    {
        self::checkAdminReferer('wpsf-remove-feed', 'nonce');
        self::checkAjaxReferer('wpsf-remove-feed', 'nonce');

        $id = WpssRequest('feed');

        self::validateDeletedFeed(compact('id'));
        self::checkIsFeedExist($id);

        if (WpsfFeedsService::deleteFeed($id)) {
            WpsfFeedsCacheManager::removeAllCachedPosts($id);
            wp_send_json_success([
                'message' => __('Your feed has been deleted.', 'wp-ss'),
            ]);
        }
    }

    public static function rebuild()
    {
        self::checkAdminReferer('wpsf-rebuild-feed', 'nonce');
        self::checkAjaxReferer('wpsf-rebuild-feed', 'nonce');

        $id = (int) WpssRequest('feed');

        self::validateRebuildedFeed(compact('id'));
        self::checkIsFeedExist($id);

        $result = self::cacheFeedPosts($id);

        if (true === $result) {
            wp_send_json_success([
                'message' => __('Your feed cache has been rebuilded.', 'wp-ss'),
            ]);
        }

        wp_send_json_error(['message' => $result]);
    }

    private static function getValidateAliases()
    {
        return [
            'id'              => __('social id', 'wp-ss'),
            'social'          => __('social type', 'wp-ss'),
            'account'         => __('account name', 'wp-ss'),
            'type'            => __('feed type', 'wp-ss'),
            'updateFrequency' => __('update frequency', 'wp-ss'),
            'content'         => __('content to show', 'wp-ss'),
        ];
    }

    private static function validateCreateFeed(array $inputs)
    {
        self::validation($inputs, [
            'social'          => 'required|in:instagram',
            'name'            => 'required|min:3|max:70',
            'type'            => 'required|in:username',
            'content'         => 'required|min:3|max:70',
        ], self::getValidateAliases());
    }

    private static function validateUpdateFeed(array $inputs)
    {
        self::validation($inputs, [
            'id'              => 'required|numeric',
            'social'          => 'required|in:instagram,twitter',
            'name'            => 'required|min:3|max:70',
            'type'            => 'required|in:username',
            'content'         => 'required|min:3|max:70',
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

    private static function cacheFeedPosts(int $feedID)
    {
        $res = WpsfFeedsCacheManager::rebuilCache($feedID);
        if ($res !== true) {
            wp_send_json_success([
                'message' => __("feed cache faild, please try again later")
            ]);
        }
        return $res;
    }

    private static function checkIsFeedExist(int $id)
    {
        if (false === WpsfFeedsService::existFeed($id)) {
            wp_send_json_error([
                'message' => __('this feed is not exist !', 'wp-ss'),
            ]);
        }
    }
}
