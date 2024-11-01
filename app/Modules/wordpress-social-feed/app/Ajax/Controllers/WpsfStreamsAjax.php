<?php

namespace WPSF\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use WPSF\Services\WpsfStreamsService;
use WPSF\Services\WpsfStreamsSourcesService;
use App\Core\Foundation\Ajax\Controllers\Contract\WpssAjaxBaseController;
use App\Core\Utils\WpssObjectUtil;
use WPSF\Services\StreamRenderer\Utils\WpsfStreamStylesRender;
use WPSF\Services\StreamRenderer\WpsfStreamRender;

class WpsfStreamsAjax extends WpssAjaxBaseController
{
    public static function new()
    {
        self::checkAdminReferer('wpsf-new-stream', 'save-stream-nonce');
        self::checkAjaxReferer('wpsf-new-stream', 'save-stream-nonce');

        $options = WpssJsonCleanDecode(WpssRequest('options'));
        $sources = WpssJsonCleanDecode(WpssRequest('sources'));

        if (WpsfStreamsSourcesService::addStreamWithSource((string) $options->name, $options, $sources)) {
            $lastID = WpsfStreamsService::getLastStreamID();
            self::removeStreamCaches($lastID);
            wp_send_json_success([
                'message'  => __('Stream Successfully Created', 'wp-ss'),
                'redirect' => "/streams/edit/{$lastID}"
            ]);
        }
    }

    public static function update()
    {
        self::checkAdminReferer('wpsf-update-stream', 'update-stream-nonce');
        self::checkAjaxReferer('wpsf-update-stream', 'update-stream-nonce');

        $id = WpssRequest('stream-id');

        $options = WpssJsonCleanDecode(WpssRequest('options'));
        $sources = WpssJsonCleanDecode(WpssRequest('sources'));

        self::validateUpdateStream(compact('id'));

        self::checkIsStreamExist($id);
        self::checkIsSourceExist($id);

        if (WpsfStreamsSourcesService::updateStreamWithSource((int) $id, (string) $options->name ?? 'Untitled', $options, $sources)) {
            self::removeStreamCaches($id);
            wp_send_json_success([
                'message' => __('Stream Successfully Updated', 'wp-ss'),
            ]);
        }
    }

    public static function delete()
    {
        self::checkAdminReferer('wpsf_remove_stream', 'nonce');
        self::checkAjaxReferer('wpsf_remove_stream', 'nonce');

        $id = WpssRequest('stream');

        self::validateDeletedStream(compact('id'));
        self::checkIsStreamExist($id);

        if (WpsfStreamsService::deleteStreamWithSource($id)) {
            self::removeStreamCaches($id);
            wp_send_json_success([
                'message' => __('Your stream has been deleted.', 'wp-ss'),
            ]);
        }
    }

    public static function getPosts()
    {
        self::checkAjaxReferer('wpsf_get_stream_posts', 'nonce');
        
        $id    = (int) WpssRequest('stream');
        $count = (int) WpssRequest('count');
        $page  = (int) WpssRequest('page');

        $posts = WpssObjectUtil::toObject(WpsfStreamRender::render($id, $page, $count));
        if ($posts) {
            wp_send_json($posts, 200);
        }

        wp_send_json(['content' => null, 'count' => 0, 'page' => $page], 200);
    }

    private static function removeStreamCaches(int $streamID)
    {
        WpsfStreamStylesRender::removeCache($streamID);
        delete_transient("wpsf_stream_{$streamID}_posts");
    }

    private static function validateUpdateStream(array $inputs)
    {
        self::validation($inputs, [
            'id' => 'required|numeric',
        ], [
            'id' => __('stream id', 'wp-ss'),
        ]);
    }

    private static function validateDeletedStream(array $inputs)
    {
        self::validation($inputs, [
            'id' => 'required|numeric',
        ], [
            'id' => __('stream id', 'wp-ss'),
        ]);
    }

    private static function checkIsStreamExist(int $id)
    {
        if (false === WpsfStreamsService::existStream($id)) {
            wp_send_json_error([
                'message' => __('this stream is not exist !', 'wp-ss'),
            ]);
        }
    }

    private static function checkIsSourceExist(int $id)
    {
        if (false === WpsfStreamsSourcesService::existSourceByStreamID($id)) {
            wp_send_json_error([
                'message' => __('this stream sources is not valid ! , please delete stream and create new again !', 'wp-ss'),
            ]);
        }
    }
}
