<?php

namespace App\Core\Repository\Factory;

defined('ABSPATH') || exit('no access');

use WPSF\Repositories\FeedsRepository\WpsfFeedsRepository;
use WPSF\Repositories\StreamsRepository\WpsfStreamsRepository;
use WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository;
use App\Core\Repository\Repositories\AccountsRepository\WpssAccountsRepository;
use WPSF\Repositories\FeedCommentsRepository\WpsfFeedCommentsRepository;
use WPSF\Repositories\FeedPostsRepository\WpsfFeedPostsRepository;

class WpssRepositoryFactory
{
    private static $alias = [
        'accounts' => WpssAccountsRepository::class,
        'feeds'    => WpsfFeedsRepository::class,
        'streams'  => WpsfStreamsRepository::class,
        'sources'  => WpsfStreamsSourcesRepository::class,
        'post'     => WpsfFeedPostsRepository::class,
        'comment'  => WpsfFeedCommentsRepository::class
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

        if (! self::hasRepo($repo)) {
            self::storeRepo($repo);
        }

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
