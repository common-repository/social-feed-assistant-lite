<?php

namespace SFAL\Services;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Libs\Carbon\SfalCarbon;
use SFAL\Core\Socials\SfalSocialsManager;
use Tightenco\Collect\Support\Collection;
use SFAL\Core\Repository\Factory\SfalRepositoryFactory;

/**
 * Class SfalAccountService
 *
 * @see \SFAL\Core\Repository\Repositories\AccountsRepository\SfalAccountsRepository::all
 * @see \SFAL\Core\Repository\Repositories\AccountsRepository\SfalAccountsRepository::getAccountByID
 * @see \SFAL\Core\Repository\Repositories\AccountsRepository\SfalAccountsRepository::deleteAccount
 * @see \SFAL\Core\Repository\Repositories\AccountsRepository\SfalAccountsRepository::addAccount
 * @see \SFAL\Core\Repository\Repositories\AccountsRepository\SfalAccountsRepository::updateAccount
 * @see \SFAL\Core\Repository\Repositories\AccountsRepository\SfalAccountsRepository::existAccount
 */
class SfalAccountService
{
    /**
     * we put here normalizer methods
     *
     * @var array
     */
    private static $normalizes = [
        'options' => 'normalizeAccountOptions',
        'social' => 'normalizeAccountSocial',
    ];

    /**
     * @param  array  $normalize
     *
     * @return array
     */
    public static function getAccounts(array $normalize = [ 'options', 'social' ])
    {
        $accounts = collect(SfalRepositoryFactory::make('accounts')->getAllAccounts());

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
        $account = SfalRepositoryFactory::make('accounts')->getAccountByID($ID, $columns);

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
        return SfalRepositoryFactory::make('accounts')->deleteAccount($ID);
    }

    /**
     * @param  string  $social
     * @param  string  $title
     * @param  string  $auth
     *
     * @return mixed
     */
    public static function addAccount(string $social, string $title, array $auth)
    {
        $item = [
            'social_type' => $social,
            'title'       => $title,
            'options'     => serialize($auth),
            'created_at'  => (string) SfalCarbon::now(),
            'updated_at'  => (string) SfalCarbon::now(),
        ];

        return SfalRepositoryFactory::make('accounts')->addAccount($item, [ '%s', '%s', '%s', '%s', '%s', ]);
    }

    /**
     * @param  int  $beforeID
     * @param  string  $social
     * @param  string  $title
     * @param  string  $auth
     *
     * @return mixed
     */
    public static function updateAccount(int $beforeID, string $social, string $title, array $auth)
    {
        $item = [
            'social_type' => $social,
            'title'       => $title,
            'options'     => serialize($auth),
            'updated_at'  => (string) SfalCarbon::now(),
        ];

        return SfalRepositoryFactory::make('accounts')->updateAccount($beforeID, $item, [ '%s', '%s', '%s', '%s', ]);
    }

    /**
     * @param  int  $ID
     *
     * @return bool
     */
    public static function existAccount(int $ID)
    {
        return SfalRepositoryFactory::make('accounts')->existAccount($ID) ?: false;
    }

    /**
     * @param $account
     * @return void
     */
    private static function normalizeAccountOptions(&$account)
    {
        $account->options = unserialize($account->options);
    }

    /**
     * @param $account
     *
     * this will add social account to account ( 'social' normalizer method )
     */
    private static function normalizeAccountSocial(&$account)
    {
        $account->social = SfalSocialsManager::getInstance()->getSocialByID($account->social_type);
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
