<?php

namespace SFAL\Ajax\Controllers;

defined('ABSPATH') || exit('no access');

use Exception;
use SFAL\Core\Foundation\Abstractions\SfalAjaxBaseController;
use SFAL\Services\SfalAccountService;

class SfalAccountsAjax extends SfalAjaxBaseController
{
    public static function new()
    {
        self::checkAdminReferer('sfal-new-account', 'save-account-nonce');
        self::checkAjaxReferer('sfal-new-account', 'save-account-nonce');

        $title = SfalRequest('account-name');
        $type  = SfalRequest('account-type');
        $auth  = SfalRequest('auth-settings');

        self::validateCreateAccount(compact('title', 'type', 'auth'));

        $result = SfalAccountService::addAccount($type, $title, $auth);
        if ($result) {
            wp_send_json_success([
                'message' => __('Account successfully created', 'sfal'),
            ]);
        }
    }

    public static function update()
    {
        self::checkAdminReferer('sfal-update-account', 'update-account-nonce');
        self::checkAjaxReferer('sfal-update-account', 'update-account-nonce');

        $id    = SfalRequest('account-id');
        $title = SfalRequest('account-name');
        $type  = SfalRequest('account-type');
        $auth  = SfalRequest('auth-settings');

        self::validateUpdateAccount(compact('id', 'title', 'type', 'auth'));

        self::checkIsAccountExist($id);

        $result = SfalAccountService::updateAccount($id, $type, $title, $auth);

        if($result) {
            wp_send_json_success([
                'message' => __('Account successfully updated !', 'sfal'),
            ]);
        }
    }

    public static function delete()
    {
        self::checkAdminReferer('sfal_remove_account', 'nonce');
        self::checkAjaxReferer('sfal_remove_account', 'nonce');

        $id = SfalRequest('account');

        self::validateDeletedAccount(compact('id'));

        self::checkIsAccountExist($id);

        $result = SfalAccountService::deleteAccount($id);
        
        if($result) {
            wp_send_json_success([
                'message' => __('Your account has been deleted.', 'sfal'),
            ]);
        }
    }

    private static function validateCreateAccount(array $inputs)
    {
        self::validation($inputs, [
            'title' => 'required|min:3|max:70',
            'type'  => 'required|in:instagram,twitter',
            'auth'  => 'array',
            'auth.instagram' => 'array',
            'auth.instagram.username' => 'min:3|max:30',
            'auth.instagram.password' => 'min:3|max:30',
            'auth.twitter' => 'array',
        ], self::getValidateAliases());
    }

    private static function validateUpdateAccount(array $inputs)
    {
        self::validation($inputs, [
            'id'    => 'required|numeric',
            'title' => 'required|min:3|max:70',
            'type'  => 'required|in:instagram,twitter',
            'auth'  => 'array',
            'auth.instagram' => 'array',
            'auth.instagram.username' => 'min:3|max:30',
            'auth.instagram.password' => 'min:3|max:30',
            'auth.twitter' => 'array',
        ], self::getValidateAliases());
    }

    private static function validateDeletedAccount(array $inputs)
    {
        self::validation($inputs, [
            'id' => 'required|numeric',
        ], self::getValidateAliases());
    }

    private static function getValidateAliases()
    {
        return [
            'id' => __('account id', 'sfal'),
            'title' => __('account title', 'sfal'),
            'type'  => __('account type', 'sfal'),
            'auth'  => __('auth settings', 'sfal'),
            'auth.instagram' => __('instagram authentication settings', 'sfal'),
            'auth.instagram.username' => __('instagram username', 'sfal'),
            'auth.instagram.password' => __('instagram password', 'sfal'),
            'auth.twitter' => __('twitter authentication settings', 'sfal'),
        ];
    }

    private static function checkIsAccountExist(int $id)
    {
        if (false === SfalAccountService::existAccount($id)) {
            wp_send_json_error([
                'message' => __('this account is not exist !', 'sfal'),
            ]);
        }
    }
}
