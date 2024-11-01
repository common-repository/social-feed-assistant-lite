<?php

namespace SFAL\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use SFAL\Services\SfalStreamsService;
use SFAL\Services\SfalStreamsSourcesService;
use SFAL\Core\Foundation\Abstractions\SfalAjaxBaseController;
use SFAL\Core\Utils\SfalObjectUtil;
use SFAL\Services\StreamRenderer\Utils\SfalStreamStylesRender;
use SFAL\Services\StreamRenderer\SfalStreamRender;

class SfalStreamsAjax extends SfalAjaxBaseController
{
    public static function new()
    {
        self::checkAdminReferer('sfal-new-stream', 'save-stream-nonce');
        self::checkAjaxReferer('sfal-new-stream', 'save-stream-nonce');

        $options  = SfalRequest('options');
        $filters  = SfalJsonCleanDecode(SfalRequest('filters'));
        $sources  = SfalJsonCleanDecode(SfalRequest('sources'));
        $template = SfalRequest('template');
        $layout   = SfalRequest('layout');

        $options['general']['postSettings']['template'] = (string) $template;
        $options['general']['postSettings']['layout'] = (string) $layout;

        $options = SfalStreamsService::prepareStreamOptions($options);
        $options = SfalObjectUtil::toObject($options);

        $result = SfalStreamsService::addStream((string) $options->name, $options, $sources, $filters);

        if(true !== $result) {
            wp_send_json_error([
                'message' => $result
            ]);
        }

        $lastID = SfalStreamsService::getLastStreamID();

        self::removeStreamCaches($lastID);

        wp_send_json_success([
            'message'  => __('Stream successfully created', 'sfal'),
            'redirect' => "/streams/edit/{$lastID}"
        ]);
    }

    public static function update()
    {
        self::checkAdminReferer('sfal-update-stream', 'update-stream-nonce');
        self::checkAjaxReferer('sfal-update-stream', 'update-stream-nonce');

        $id = SfalRequest('stream-id');

        $options  = SfalRequest('options');
        $filters  = SfalJsonCleanDecode(SfalRequest('filters'));
        $sources  = SfalJsonCleanDecode(SfalRequest('sources'));
        $template = SfalRequest('template');
        $layout   = SfalRequest('layout');

        $options['general']['postSettings']['template'] = (string) $template;
        $options['general']['postSettings']['layout'] = (string) $layout;

        $options = SfalStreamsService::prepareStreamOptions($options);
        $options = SfalObjectUtil::toObject($options);

        self::validateUpdateStream(compact('id'));

        self::checkIsStreamExist($id);
        self::checkIsSourceExist($id);

        $result = SfalStreamsService::updateStream((int) $id, (string) $options->name, $options, $sources, $filters);

        if(true !== $result) {
            wp_send_json_error([
                'message' => $result
            ]);
        }

        self::removeStreamCaches($id);

        wp_send_json_success([
            'message' => __('Stream Successfully Updated', 'sfal'),
        ]);
    }

    public static function delete()
    {
        self::checkAdminReferer('sfal_remove_stream', 'nonce');
        self::checkAjaxReferer('sfal_remove_stream', 'nonce');

        $id = SfalRequest('stream');

        self::validateDeletedStream(compact('id'));
        self::checkIsStreamExist($id);

        $result = SfalStreamsService::deleteStream($id);

        if($result) {
            self::removeStreamCaches($id);
            wp_send_json_success([
                'message' => __('Your stream has been deleted.', 'wp-ss'),
            ]);
        }
    }

    public static function getPosts()
    {
        self::checkAjaxReferer('sfal_get_stream_posts', 'nonce');
        
        $id    = (int) SfalRequest('stream');
        $count = (int) SfalRequest('count');
        $page  = (int) SfalRequest('page');

        $renders = SfalStreamRender::render($id, $page, $count);
        $posts = SfalObjectUtil::toObject($renders);

        $posts && wp_send_json($posts, 200);

        wp_send_json(['content' => null, 'count' => 0, 'page' => $page], 200);
    }

    public static function preview()
    {
        self::checkAjaxReferer('sfal_get_stream_preview', 'nonce');

        self::checkIsStreamExist(($id = (int) SfalRequest('stream')));

        $stream = SfalStreamsService::getStream($id, [], ['options', 'relatedOptions']);
        
        $options = $stream->options;

        $assets = SfalConfig('app.assetsUrl');

        $stylesURL = SfalStreamStylesRender::render($id, $options, $options->general->postSettings->template, $options->general->postSettings->layout);
        
        SfalViews('shortcodes.sfal.preview', compact('id', 'assets', 'options', 'stylesURL'));
        exit;
    }

    private static function removeStreamCaches(int $streamID)
    {
        SfalStreamStylesRender::removeCache($streamID);
        delete_transient("sfal_stream_{$streamID}_posts");
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
        if (false === SfalStreamsService::existStream($id)) {
            wp_send_json_error([
                'message' => __('this stream is not exist !', 'wp-ss'),
            ]);
        }
    }

    private static function checkIsSourceExist(int $id)
    {
        if (false === SfalStreamsSourcesService::existSourceByStreamID($id)) {
            wp_send_json_error([
                'message' => __('this stream sources is not valid ! , please delete stream and create new again !', 'wp-ss'),
            ]);
        }
    }
}
