<?php

namespace WPSF\Services;

defined('ABSPATH') || exit('no access');

use App\Core\Libs\Carbon\WpssCarbon;
use App\Core\Socials\WpssSocialsManager;
use Tightenco\Collect\Support\Collection;
use App\Core\Services\WpssAccountsService;
use App\Core\Repository\Factory\WpssRepositoryFactory;
use WPSF\Services\FeedsCacheManager\WpsfFeedsCacheManager;

/**
 * Class WpsfFeedsService
 *
 * @see \WPSF\Repositories\FeedsRepository\WpsfFeedsRepository::getAllFeeds()
 * @see \WPSF\Repositories\FeedsRepository\WpsfFeedsRepository::getFeedByID()
 * @see \WPSF\Repositories\FeedsRepository\WpsfFeedsRepository::deleteFeed()
 * @see \WPSF\Repositories\FeedsRepository\WpsfFeedsRepository::addFeed()
 * @see \WPSF\Repositories\FeedsRepository\WpsfFeedsRepository::updateFeed()
 * @see \WPSF\Repositories\FeedsRepository\WpsfFeedsRepository::existFeed()
 */
class WpsfFeedsService
{
    /**
     * we put here normalizer methods
     *
     * @var array
     */
    private static $normalizes = [
        'social'  => 'normalizeFeedSocial',
        'content' => 'normalizeFeedContent',
        'account' => 'normalizeFeedAccount',
    ];

    /**
     * @param  array  $normalize
     *
     * @return array
     */
    public static function getFeeds(array $normalize = [ 'social', 'content', 'account' ])
    {
        $feeds = collect(WpssRepositoryFactory::make('feeds')->getAllFeeds());

        if (! $normalize) {
            return $feeds->sortByDesc('created_at')->all();
        }

        self::normalizeFeeds($feeds, $normalize);

        return $feeds->sortByDesc('created_at')->all();
    }

    /**
     * @param  int  $ID
     * @param  array  $columns
     * @param  array  $normalize
     *
     * @return mixed
     */
    public static function getFeed(int $ID, array $columns = [], array $normalize = [])
    {
        $feed = WpssRepositoryFactory::make('feeds')->getFeedByID($ID, $columns);

        if (! $normalize) {
            return $feed;
        }

        self::normalizeFeed($feed, $normalize);

        return $feed;
    }

    /**
     * @return mixed|string|null
     */
    public static function getLastFeedID()
    {
        return WpssRepositoryFactory::make('feeds')->getLastFeedID();
    }

    public static function getFeedsNeedForRebuild()
    {
        return WpssRepositoryFactory::make('feeds')->getFeedsNeedForRebuild();
    }

    /**
     * @param  int  $ID
     *
     * @return mixed
     */
    public static function deleteFeed(int $ID)
    {
        return WpssRepositoryFactory::make('feeds')->deleteFeed($ID);
    }

    /**
     * @param  int  $accountID
     * @param  string  $social
     * @param  string  $type
     * @param  string  $content
     * @param  int  $updateFrequency
     * @param  string  $excludes
     * @param  string  $includes
     *
     * @return mixed
     */
    public static function addFeed(
        int $accountID,
        string $name,
        string $social,
        string $type,
        string $content,
        int $updateFrequency = 24,
        string $excludes = '',
        string $includes = ''
    ) {
        $item = [
            'account_id'       => $accountID,
            'name'             => $name,
            'social_type'      => $social,
            'type'             => $type,
            'content'          => WpssRemoveWhitespaces($content),
            'frequency_update' => $updateFrequency,
            'exclude'          => WpssRemoveWhitespaces($excludes),
            'include'          => WpssRemoveWhitespaces($includes),
            'updated_at'       => (string) WpssCarbon::now(),
            'created_at'       => (string) WpssCarbon::now(),
        ];

        return WpssRepositoryFactory::make('feeds')->addFeed($item, [ '%d', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', ]);
    }

    public static function addAndBuildFeedCache(
        int $accountID,
        string $name,
        string $social,
        string $type,
        string $content,
        int $updateFrequency = 24,
        string $excludes = '',
        string $includes = ''
    ) {
        return WpssRepositoryFactory::make('feeds')->transaction(function () use (
            $accountID,
            $name,
            $social,
            $type,
            $content,
            $updateFrequency,
            $excludes,
            $includes
        ) {
            if (!self::addFeed($accountID, $name, $social, $type, $content, $updateFrequency, $excludes, $includes)) {
                throw new \Exception(__('Feed Created Faild!', 'wp-ss'));
            }
            $id  = WpssRepositoryFactory::make('feeds')->getLastInsertedID();
            $resBuildCache = WpsfFeedsCacheManager::CacheFeedPosts((int) $id, $social, $type, $content, (int) $accountID, (string) $excludes, (string) $includes);
            if ($resBuildCache !== true) {
                self::deleteFeed($id);
                throw new \Exception($resBuildCache);
            }
            self::updateSuccessFeedRebuild($id);
            return true;
        });
    }

    /**
     * @param  int  $beforeID
     * @param  int  $accountID
     * @param  string  $social
     * @param  string  $type
     * @param  string  $content
     * @param  int  $updateFrequency
     * @param  string  $excludes
     * @param  string  $includes
     *
     * @return mixed
     */
    public static function updateFeed(
        int $beforeID,
        int $accountID,
        string $name,
        string $social,
        string $type,
        string $content,
        int $updateFrequency = 24,
        string $excludes = '',
        string $includes = ''
    ) {
        $item = [
            'account_id'       => $accountID,
            'name'             => $name,
            'social_type'      => $social,
            'type'             => $type,
            'content'          => WpssRemoveWhitespaces($content),
            'frequency_update' => $updateFrequency,
            'exclude'          => WpssRemoveWhitespaces($excludes),
            'include'          => WpssRemoveWhitespaces($includes),
            'updated_at'       => (string) WpssCarbon::now(),
        ];

        return WpssRepositoryFactory::make('feeds')->updateFeed($beforeID, $item, [ '%d', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s' ]);
    }

    public static function updateFeedAndRebuildCache(
        int $beforeID,
        int $accountID,
        string $name,
        string $social,
        string $type,
        string $content,
        int $updateFrequency = 24,
        string $excludes = '',
        string $includes = ''
    )
    {
        return WpssRepositoryFactory::make('feeds')->transaction(function () use (
            $beforeID,
            $accountID,
            $name,
            $social,
            $type,
            $content,
            $updateFrequency,
            $excludes,
            $includes
        ) {
            if (!self::updateFeed($beforeID, $accountID, $name, $social, $type, $content, $updateFrequency, $excludes, $includes)) {
                throw new \Exception(__('Feed Updated Faild!', 'wp-ss'));
            }
            $resBuildCache = WpsfFeedsCacheManager::CacheFeedPosts((int) $beforeID, $social, $type, $content, (int) $accountID, (string) $excludes, (string) $includes);
            if ($resBuildCache !== true) {
                throw new \Exception($resBuildCache);
            }
            self::updateSuccessFeedRebuild($beforeID);
            return true;
        });
    }

    /**
     * @param integer $feedID
     * @param string $error
     * @return void
     */
    public static function updateFeedError(int $feedID, string $error = '')
    {
        $item = [
            'cache_error' =>  $error,
            'updated_at'   => (string) WpssCarbon::now()
        ];
        return WpssRepositoryFactory::make('feeds')->updateFeed($feedID, $item, [ '%s', '%s' ]);
    }

    /**
     * @param integer $feedID
     * @return void
     */
    public static function updateSuccessFeedRebuild(int $feedID)
    {
        $item = [
            'cache_error' => '',
            'last_cache'  => (int) WpssCarbon::now()->timestamp,
            'updated_at'  => (string) WpssCarbon::now()
        ];
        return WpssRepositoryFactory::make('feeds')->updateFeed($feedID, $item, [ '%s', '%d', '%s' ]);
    }

    /**
     * @param  int  $ID
     *
     * @return bool
     */
    public static function existFeed(int $ID)
    {
        return WpssRepositoryFactory::make('feeds')->existFeed($ID) ?: false;
    }

    /**
     * this will add social to feed item ( 'social' normalizer method )
     *
     * @param $feed
     */
    private static function normalizeFeedSocial(&$feed)
    {
        $feed->social = WpssSocialsManager::getInstance()->getSocialByID($feed->social_type);
    }

    /**
     * this will normalize feed item content ( 'content' normalizer method )
     *
     * @param $feed
     */
    private static function normalizeFeedContent(&$feed)
    {
        $feed->content = explode(",", (string) $feed->content);
    }

    /**
     * this will add account to feed item ( 'account' normalizer method )
     *
     * @param $feed
     */
    private static function normalizeFeedAccount(&$feed)
    {
        $feed->account = WpssAccountsService::existAccount((int) $feed->account_id)
        ? WpssAccountsService::getAccount((int) $feed->account_id, [ 'title' ])
        : null;
    }

    /**
     * @param  \Tightenco\Collect\Support\Collection  $feeds
     * @param  array  $normalizes
     */
    private static function normalizeFeeds(Collection &$feeds, array $normalizes = [ 'social', 'content', 'account' ])
    {
        $feeds->transform(function ($item) use ($normalizes) {
            self::normalizeFeed($item, $normalizes);

            return $item;
        });
    }

    /**
     * @param $feed
     * @param  array  $normalizes
     *
     * @see normalizeFeedSocial
     * @see normalizeFeedContent
     * @see normalizeFeedAccount
     */
    private static function normalizeFeed(&$feed, $normalizes = [ 'social', 'content', 'account' ])
    {
        foreach ($normalizes as $normalizer) {
            if (array_key_exists($normalizer, self::$normalizes)) {
                self::{self::$normalizes[ $normalizer ]}($feed);
            }
        }
    }
}
