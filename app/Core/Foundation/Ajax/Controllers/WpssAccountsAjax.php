<?php

namespace App\Core\Foundation\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use App\Core\Services\WpssAccountsService;
use App\Core\Foundation\Ajax\Controllers\Contract\WpssAjaxBaseController;

class WpssAccountsAjax extends WpssAjaxBaseController
{
    public static function new()
    {
        self::checkAdminReferer('wpss-new-account', 'save-account-nonce');
        self::checkAjaxReferer('wpss-new-account', 'save-account-nonce');

        $title = WpssRequest('account-name');
        $type  = WpssRequest('account-type');
        $auth  = WpssRequest('auth-key');

        self::validateCreateAccount(compact('title', 'type', 'auth'));

        if (WpssAccountsService::addAccount($type, $title, $auth)) {
            wp_send_json_success([
                'message' => __('Account Successfully Created !', 'wp-ss'),
            ]);
        }
    }

    public static function update()
    {
        self::checkAdminReferer('wpss-update-account', 'update-account-nonce');
        self::checkAjaxReferer('wpss-update-account', 'update-account-nonce');

        $id    = WpssRequest('account-id');
        $title = WpssRequest('account-name');
        $type  = WpssRequest('account-type');
        $auth  = WpssRequest('auth-key');

        self::validateUpdateAccount(compact('id', 'title', 'type', 'auth'));
        self::checkIsAccountExist($id);

        if (WpssAccountsService::updateAccount($id, $type, $title, $auth)) {
            wp_send_json_success([
                'message' => __('Account Successfully Updated !', 'wp-ss'),
            ]);
        }
    }

    public static function delete()
    {
        self::checkAdminReferer('wpss_remove_account', 'nonce');
        self::checkAjaxReferer('wpss_remove_account', 'nonce');

        $id = WpssRequest('account');

        self::validateDeletedAccount(compact('id'));

        self::checkIsAccountExist($id);

        if (WpssAccountsService::deleteAccount($id)) {
            wp_send_json_success([
                'message' => __('Your account has been deleted.', 'wp-ss'),
            ]);
        }
    }

    private static function validateCreateAccount(array $inputs)
    {
        self::validation($inputs, [
            'title' => 'required|min:3|max:70',
            'type'  => 'required',
            'auth'  => 'required|min:7',
        ], [
            'title' => __('account title', 'wp-ss'),
            'type'  => __('account type', 'wp-ss'),
            'auth'  => __('auth key', 'wp-ss'),
        ]);
    }

    private static function validateUpdateAccount(array $inputs)
    {
        self::validation($inputs, [
            'id'    => 'required|numeric',
            'title' => 'required|min:3|max:70',
            'type'  => 'required',
            'auth'  => 'required|min:7',
        ], [
            'id' => __('account id', 'wp-ss'),
            'title' => __('account title', 'wp-ss'),
            'type'  => __('account type', 'wp-ss'),
            'auth'  => __('auth key', 'wp-ss'),
        ]);
    }

    private static function validateDeletedAccount(array $inputs)
    {
        self::validation($inputs, [
            'id' => 'required|numeric',
        ], [
            'id' => __('account id', 'wp-ss'),
        ]);
    }

    private static function checkIsAccountExist(int $id)
    {
        if (false === WpssAccountsService::existAccount($id)) {
            wp_send_json_error([
                'message' => __('this account is not exist !', 'wp-ss'),
            ]);
        }
    }
}
