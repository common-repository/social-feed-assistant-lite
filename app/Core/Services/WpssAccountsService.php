<?php

namespace App\Core\Services;

defined('ABSPATH') || exit('no access');

use App\Core\Libs\Carbon\WpssCarbon;
use App\Core\Socials\WpssSocialsManager;
use Tightenco\Collect\Support\Collection;
use App\Core\Repository\Factory\WpssRepositoryFactory;

/**
 * Class WpssAccountsService
 *
 * @see \App\Core\Repository\Repositories\AccountsRepository\WpssAccountsRepository::all
 * @see \App\Core\Repository\Repositories\AccountsRepository\WpssAccountsRepository::getAccountByID
 * @see \App\Core\Repository\Repositories\AccountsRepository\WpssAccountsRepository::deleteAccount
 * @see \App\Core\Repository\Repositories\AccountsRepository\WpssAccountsRepository::addAccount
 * @see \App\Core\Repository\Repositories\AccountsRepository\WpssAccountsRepository::updateAccount
 * @see \App\Core\Repository\Repositories\AccountsRepository\WpssAccountsRepository::existAccount
 */
class WpssAccountsService
{
    /**
     * we put here normalizer methods
     *
     * @var array
     */
    private static $normalizes = [
        'social' => 'normalizeAccountSocial',
    ];

    /**
     * @param  array  $normalize
     *
     * @return array
     */
    public static function getAccounts(array $normalize = [ 'social' ])
    {
        $accounts = collect(WpssRepositoryFactory::make('accounts')->getAllAccounts());

        if (! $normalize) {
            return $accounts->sortByDesc('created_at')->all();
        }

        self::normalizeAccounts($accounts, $normalize);

        return $accounts->sortByDesc('created_at')->all();
    }

    /**
     * @param  int  $ID
     * @param  array  $columns
     * @param  array  $normalize
     *
     * @return mixed
     */
    public static function getAccount(int $ID, array $columns = [], array $normalize = [])
    {
        $account = WpssRepositoryFactory::make('accounts')->getAccountByID($ID, $columns);

        if (! $normalize) {
            return $account;
        }

        self::normalizeAccount($account, $normalize);

        return $account;
    }

    /**
     * @param  int  $ID
     *
     * @return mixed
     */
    public static function deleteAccount(int $ID)
    {
        return WpssRepositoryFactory::make('accounts')->deleteAccount($ID);
    }

    /**
     * @param  string  $social
     * @param  string  $title
     * @param  string  $auth
     *
     * @return mixed
     */
    public static function addAccount(string $social, string $title, string $auth)
    {
        $item = [
            'social_type' => $social,
            'title'       => $title,
            'auth_key'    => $auth,
            'updated_at'  => WpssCarbon::now(),
            'created_at'  => WpssCarbon::now(),
        ];

        return WpssRepositoryFactory::make('accounts')->addAccount($item, [ '%s', '%s', '%s', '%s', '%s', ]);
    }

    /**
     * @param  int  $beforeID
     * @param  string  $social
     * @param  string  $title
     * @param  string  $auth
     *
     * @return mixed
     */
    public static function updateAccount(int $beforeID, string $social, string $title, string $auth)
    {
        $item = [
            'social_type' => $social,
            'title'       => $title,
            'auth_key'    => $auth,
            'updated_at'  => WpssCarbon::now(),
        ];

        return WpssRepositoryFactory::make('accounts')->updateAccount($beforeID, $item, [ '%s', '%s', '%s', '%s', ]);
    }

    /**
     * @param  int  $ID
     *
     * @return bool
     */
    public static function existAccount(int $ID)
    {
        return WpssRepositoryFactory::make('accounts')->existAccount($ID) ?: false;
    }

    /**
     * @param $account
     *
     * this will add social account to account ( 'social' normalizer method )
     */
    private static function normalizeAccountSocial(&$account)
    {
        $account->social = WpssSocialsManager::getInstance()->getSocialByID($account->social_type);
    }

    /**
     * @param  \Tightenco\Collect\Support\Collection  $accounts
     * @param  array  $normalizes
     */
    private static function normalizeAccounts(Collection &$accounts, array $normalizes = [ 'social' ])
    {
        $accounts->transform(function ($item) use ($normalizes) {
            self::normalizeAccount($item, $normalizes);

            return $item;
        });
    }

    /**
     * @param $account
     * @param  array  $normalizes
     *
     * @see normalizeAccountSocial
     */
    private static function normalizeAccount(&$account, array $normalizes)
    {
        foreach ($normalizes as $normalizer) {
            if (array_key_exists($normalizer, self::$normalizes)) {
                self::{self::$normalizes[ $normalizer ]}($account);
            }
        }
    }
}
