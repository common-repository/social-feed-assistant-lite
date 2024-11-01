<?php

namespace SFAL\Core\Repository\Factory;

defined('ABSPATH') || exit('no access');

use SFAL\Repositories\FeedsRepository\SfalFeedsRepository;
use SFAL\Repositories\StreamsRepository\SfalStreamsRepository;
use SFAL\Repositories\StreamSourcesRepository\SfalStreamSourcesRepository;
use SFAL\Repositories\AccountsRepository\SfalAccountsRepository;
use SFAL\Repositories\FeedCommentsRepository\SfalFeedCommentsRepository;
use SFAL\Repositories\FeedContentsRepository\SfalFeedContentsRepository;
use SFAL\Repositories\FeedPostsRepository\SfalFeedPostsRepository;
use SFAL\Repositories\StreamFiltersRepository\SfalStreamFiltersRepository;

class SfalRepositoryFactory
{
    private static $alias = [
        'accounts' => SfalAccountsRepository::class,
        'feeds'    => SfalFeedsRepository::class,
        'feed_contents' => SfalFeedContentsRepository::class,
        'streams'  => SfalStreamsRepository::class,
        'sources'  => SfalStreamSourcesRepository::class,
        'filters'  => SfalStreamFiltersRepository::class,
        'post'     => SfalFeedPostsRepository::class,
        'comment'  => SfalFeedCommentsRepository::class
    ];
    private static $repositories = [];

    public static function make($repo)
    {
        $repo = self::hasOnAlias($repo) ? self::$alias[ $repo ] : $repo;

        return self::resolveRepo($repo);
    }

    private static function resolveRepo($repo)
    {
        if (! class_exists($repo)) {
            return false;
        }

        self::hasRepo($repo) || self::storeRepo($repo);

        return self::getRepo($repo);
    }

    private static function storeRepo($repo)
    {
        self::$repositories[ $repo ] = new $repo;
    }

    private static function hasRepo($repo)
    {
        return array_key_exists($repo, self::$repositories);
    }

    private static function getRepo($repo)
    {
        return self::$repositories[ $repo ] ?? null;
    }

    private static function hasOnAlias($repo)
    {
        return array_key_exists($repo, self::$alias);
    }
}
