<?php

namespace SFAL\Services;

defined('ABSPATH') || exit('no access');

use Exception;
use SFAL\Core\Libs\Carbon\SfalCarbon;
use SFAL\Core\Socials\SfalSocialsManager;
use Tightenco\Collect\Support\Collection;
use SFAL\Services\SfalAccountService;
use SFAL\Core\Repository\Factory\SfalRepositoryFactory;
use SFAL\Init\SfalCore;
use SFAL\Services\FeedsCacheManager\SfalFeedsCacheManager;
use SFAL\Services\MakePosts\SfalMakePosts;

/**
 * Class SfalFeedsService
 *
 * @see \SFAL\Repositories\FeedsRepository\SfalFeedsRepository::getAllFeeds()
 * @see \SFAL\Repositories\FeedsRepository\SfalFeedsRepository::getFeedByID()
 * @see \SFAL\Repositories\FeedsRepository\SfalFeedsRepository::deleteFeed()
 * @see \SFAL\Repositories\FeedsRepository\SfalFeedsRepository::addFeed()
 * @see \SFAL\Repositories\FeedsRepository\SfalFeedsRepository::updateFeed()
 * @see \SFAL\Repositories\FeedsRepository\SfalFeedsRepository::existFeed()
 */
class SfalFeedsService
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
        $feeds = collect(SfalRepositoryFactory::make('feeds')->getAllFeeds());

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
        $feed = SfalRepositoryFactory::make('feeds')->getFeedByID($ID, $columns);

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
        return SfalRepositoryFactory::make('feeds')->getLastFeedID();
    }

    public static function getFeedContents(int $feedID)
    {
        return SfalRepositoryFactory::make('feed_contents')->getFeedContentsByFeedID($feedID, ['id', 'content']);
    }

    public static function getFeedsNeedForRebuild() : array
    {
        return (array) SfalRepositoryFactory::make('feeds')->getFeedsNeedForRebuild();
    }

    /**
     * @param  int  $ID
     *
     * @return mixed
     */
    public static function deleteFeed(int $ID)
    {
        return SfalRepositoryFactory::make('feeds')->deleteFeed($ID);
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
        int $updateFrequency = 24,
        string $excludes = '',
        string $includes = ''
    ) {
        $item = [
            'account_id'       => $accountID ?: null,
            'name'             => $name,
            'social_type'      => $social,
            'type'             => $type,
            'frequency_update' => $updateFrequency,
            'excludes'         => SfalRemoveWhitespaces($excludes) ?: null,
            'includes'         => SfalRemoveWhitespaces($includes) ?: null,
            'created_at'       => (string) SfalCarbon::now(),
            'updated_at'       => (string) SfalCarbon::now(),
        ];

        $resultCreate = SfalRepositoryFactory::make('feeds')->addFeed($item, [ '%d', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', ]);
        if (!$resultCreate) {
            throw new Exception(__('Feed created faild!', 'sfal'));
        }
        return $resultCreate;
    }

    public static function addAndBuildPosts(
        int $accountID,
        string $name,
        string $social,
        string $type,
        string $contents,
        int $updateFrequency = 24,
        string $excludes = '',
        string $includes = ''
    ) {
        return SfalTransaction(function() use(
            $accountID,
            $name,
            $social,
            $type,
            $contents,
            $updateFrequency,
            $excludes,
            $includes
        ) {
            self::addFeed($accountID, $name, $social, $type, $updateFrequency, $excludes, $includes);
            $id = (int) self::getLastFeedID();
            self::replaceFeedContents($id, $contents);
            if($social == 'instagram') {
                return $id;
            }
            return $id;
        });
    }

    /**
     * remove feed contents and replace with new contents
     *
     * @param integer $feedID
     * @param string $contents
     * @return mixed
     */
    private static function replaceFeedContents(int $feedID, string $contents)
    {
        $contents = explode(',', $contents);
        SfalRepositoryFactory::make('feed_contents')->deleteFeedContentsByFeedID($feedID);
        foreach ($contents as $content) {
            $item = [
                'feed_id'    => $feedID,
                'content'    => $content,
                'created_at' => (string) SfalCarbon::now(),
                'updated_at' => (string) SfalCarbon::now(),
            ];
            $format = ['%d', '%s', '%s', '%s'];
            $result = SfalRepositoryFactory::make('feed_contents')->addFeedContent($item, $format);
            if (!$result) {
                throw new Exception(__('Feed Contents Created Faild!', 'sfal'));
            }
        }
        return true;
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
        int $updateFrequency = 24,
        string $excludes = '',
        string $includes = ''
    ) {
        $item = [
            'account_id'       => $accountID ?: null,
            'name'             => $name,
            'social_type'      => $social,
            'type'             => $type,
            'frequency_update' => $updateFrequency,
            'excludes'         => SfalRemoveWhitespaces($excludes) ?: null,
            'includes'         => SfalRemoveWhitespaces($includes) ?: null,
            'updated_at'       => (string) SfalCarbon::now(),
        ];

        $resultUpdated = SfalRepositoryFactory::make('feeds')->updateFeed($beforeID, $item, [ '%d', '%s', '%s', '%s', '%d', '%s', '%s', '%s' ]);
        if (!$resultUpdated) {
            throw new Exception(__('Feed updated faild!', 'sfal'));
        }
        return $resultUpdated;
    }

    public static function updateFeedAndRebuildCache(
        int $beforeID,
        int $accountID,
        string $name,
        string $social,
        string $type,
        string $contents,
        int $updateFrequency = 24,
        string $excludes = '',
        string $includes = ''
    ) {
        return SfalTransaction(function() use(
            $beforeID,
            $accountID,
            $name,
            $social,
            $type,
            $contents,
            $updateFrequency,
            $excludes,
            $includes
        ) {
            self::updateFeed($beforeID, $accountID, $name, $social, $type, $updateFrequency, $excludes, $includes);
            self::replaceFeedContents($beforeID, $contents);
            if($social == 'instagram') {
                return $beforeID;
            }
            return $beforeID;
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
            'updated_at'   => (string) SfalCarbon::now(),
        ];
        return SfalRepositoryFactory::make('feeds')->updateFeed($feedID, $item, [ '%s', '%s' ]);
    }

    /**
     * @param integer $feedID
     * @return void
     */
    public static function updateSuccessFeedRebuild(int $feedID)
    {
        $item = [
            'cache_error' => null,
            'last_cache'  => (int) SfalCarbon::now()->timestamp,
            'updated_at'  => (string) SfalCarbon::now(),
        ];
        return SfalRepositoryFactory::make('feeds')->updateFeed($feedID, $item, [ '%s', '%d', '%s' ]);
    }

    /**
     * @param  int  $ID
     *
     * @return bool
     */
    public static function existFeed(int $ID)
    {
        return SfalRepositoryFactory::make('feeds')->existFeed($ID) ?: false;
    }

    /**
     * this will add social to feed item ( 'social' normalizer method )
     *
     * @param $feed
     */
    private static function normalizeFeedSocial(&$feed)
    {
        $feed->social = SfalSocialsManager::getInstance()->getSocialByID($feed->social_type);
    }

    /**
     * this will normalize feed item content ( 'content' normalizer method )
     *
     * @param $feed
     */
    private static function normalizeFeedContent(&$feed)
    {
        $feedContents = self::getFeedContents((int)$feed->id);
        $feed->contents = $feedContents;
        array_walk($feedContents, function($val) use ($feed) {
            $feed->contentNames[$val->id] = $val->content;
        });
    }

    /**
     * this will add account to feed item ( 'account' normalizer method )
     *
     * @param $feed
     */
    private static function normalizeFeedAccount(&$feed)
    {
        $feed->account = SfalAccountService::existAccount((int) $feed->account_id)
        ? SfalAccountService::getAccount((int) $feed->account_id, [ 'id', 'social_type', 'title', 'options', ], [ 'options', ])
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
    public static function normalizeFeed(&$feed, $normalizes = [ 'social', 'content', 'account' ])
    {
        foreach ($normalizes as $normalizer) {
            if (array_key_exists($normalizer, self::$normalizes)) {
                self::{self::$normalizes[ $normalizer ]}($feed);
            }
        }
    }
}
