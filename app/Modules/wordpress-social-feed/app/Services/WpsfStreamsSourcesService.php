<?php

namespace WPSF\Services;

defined('ABSPATH') || exit('no access');

use stdClass;
use App\Core\Libs\Carbon\WpssCarbon;
use App\Core\Socials\WpssSocialsManager;
use Tightenco\Collect\Support\Collection;
use App\Core\Repository\Factory\WpssRepositoryFactory;

/**
 * Class WpsfStreamsSourcesService
 *
 * @see \WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository::getAllSources()
 * @see \WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository::getSourceByID()
 * @see \WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository::deleteSource()
 * @see \WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository::deleteSourceByStreamID()
 * @see \WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository::addSource()
 * @see \WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository::transaction()
 * @see \WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository::updateSource()
 * @see \WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository::updateSourceByStreamID()
 * @see \WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository::existSource()
 * @see \WPSF\Repositories\StreamsSourcesRepository\WpsfStreamsSourcesRepository::existSourceByStreamID()
 */
class WpsfStreamsSourcesService
{
    /**
     * we put here normalizer methods
     *
     * @var array
     */
    private static $normalizes = [
        'sourceFeeds' => 'normalizeSourceFeed',
        'social'      => 'normalizeSourceFeedSocial',
    ];

    /**
     * @param  array  $normalize
     *
     * @return array
     */
    public static function getSources(array $normalize = [ 'sourceFeeds', 'social' ])
    {
        $sources = collect(WpssRepositoryFactory::make('sources')->getAllSources());

        if (! $normalize) {
            return $sources->sortByDesc('created_at')->all();
        }

        self::normalizeSources($sources, $normalize);

        return $sources->sortByDesc('created_at')->all();
    }

    /**
     * @param  int  $ID
     * @param  array  $columns
     * @param  array  $normalize
     *
     * @return mixed
     */
    public static function getSource(int $ID, array $columns = [], array $normalize = [ 'sourceFeeds', 'social' ])
    {
        $source = WpssRepositoryFactory::make('sources')->getSourceByID($ID, $columns);

        if (! $normalize) {
            self::normalizeFeeds($source);
            return $source;
        }

        self::normalizeSource($source, $normalize);

        return $source;
    }
    
    public static function getSourceByStreamID(int $streamID, array $columns = [], array $normalize = [ 'sourceFeeds', 'social' ])
    {
        $source = WpssRepositoryFactory::make('sources')->getSourceByStreamID($streamID, $columns);

        if (! $normalize) {
            self::normalizeFeeds($source);
            return $source;
        }

        self::normalizeSource($source, $normalize);

        return $source;
    }

    /**
     *
     * @param integer $streamID
     * @return void
     */
    public static function getSourceIdsByStreamID(int $streamID)
    {
        if (!($source = WpssRepositoryFactory::make('sources')->getSourceByStreamID($streamID, ['feeds']) ?: [])) {
            return [];
        }

        return self::getSourceFeedsIds($source);
    }

    /**
     * @param  int  $ID
     *
     * @return mixed
     */
    public static function deleteSource(int $ID)
    {
        return WpssRepositoryFactory::make('sources')->deleteSource($ID);
    }

    /**
     *
     * @param integer $streamID
     * @return void
     */
    public static function deleteSourceByStreamID(int $streamID)
    {
        return WpssRepositoryFactory::make('sources')->deleteSourceByStreamID($streamID);
    }

    /**
     * @param  int  $streamID
     * @param  \stdClass  $feeds
     *
     * @return mixed
     */
    public static function addSource(int $streamID, array $feeds)
    {
        $feeds = self::normalizeFeedsOrder($feeds);
        $item = [
            'stream_id'  => $streamID,
            'feeds'      => serialize($feeds),
            'updated_at' => (string) WpssCarbon::now(),
            'created_at' => (string) WpssCarbon::now(),
        ];

        return WpssRepositoryFactory::make('sources')->addSource($item, [ '%d', '%s', '%s', '%s' ]);
    }

    /**
     * @param  string  $name
     * @param  \stdClass  $options
     * @param  \stdClass  $feeds
     * @param  array  $filters
     *
     * @return mixed
     */
    public static function addStreamWithSource(string $name, stdClass $options, array $feeds, array $filters = [])
    {
        return WpssRepositoryFactory::make('sources')->transaction(function () use ($name, $options, $feeds, $filters) {
            $resStream = WpsfStreamsService::addStream($name, $options, $filters);
            $streamID  = WpssRepositoryFactory::make('sources')->getLastInsertedID();
            $resSource = self::addSource($streamID, $feeds);
            if (!$resStream || !$resSource) {
                throw new \Exception("false");
            }
            return true;
        });
    }

    /**
     * @param  int  $beforeID
     * @param  int  $streamID
     * @param  string  $feeds
     *
     * @return mixed
     */
    public static function updateSource(int $beforeID, int $streamID, array $feeds)
    {
        $feeds = self::normalizeFeedsOrder($feeds);
        $item = [
            'stream_id'  => $streamID,
            'feeds'      => serialize($feeds),
            'updated_at' => (string) WpssCarbon::now(),
        ];

        return WpssRepositoryFactory::make('sources')->updateSource($beforeID, $item, [ '%d', '%s', '%s' ]);
    }

    /**
     * @param  int  $streamID
     * @param  \stdClass  $feeds
     *
     * @return mixed
     */
    public static function updateSourceByStreamID(int $streamID, array $feeds)
    {
        $feeds = self::normalizeFeedsOrder($feeds);
        $item = [
            'feeds'      => serialize($feeds),
            'updated_at' => (string) WpssCarbon::now(),
        ];

        return WpssRepositoryFactory::make('sources')->updateSourceByStreamID($streamID, $item);
    }

    /**
     * @param  int  $beforeID
     * @param  string  $name
     * @param  \stdClass  $options
     * @param  \stdClass  $feeds
     * @param  array  $filters
     *
     * @return mixed
     */
    public static function updateStreamWithSource(int $beforeID, string $name, stdClass $options, array $feeds, array $filters = [])
    {
        return WpssRepositoryFactory::make('sources')->transaction(function () use ($beforeID, $name, $options, $feeds, $filters) {
            $resUpdateStream = WpsfStreamsService::updateStream($beforeID, $name, $options, $filters);
            $resUpdateSource = self::updateSourceByStreamID($beforeID, $feeds);
            if (!$resUpdateStream || !$resUpdateSource) {
                throw new \Exception('false');
            }
            return true;
        });
    }

    /**
     * @param  int  $ID
     *
     * @return bool
     */
    public static function existSource(int $ID)
    {
        return WpssRepositoryFactory::make('sources')->existSource($ID) ?: false;
    }

    /**
     * @param integer $streamID
     * @return void
     */
    public static function existSourceByStreamID(int $streamID)
    {
        return WpssRepositoryFactory::make('sources')->existSourceByStreamID($streamID) ?: false;
    }

    /**
     * @param [type] $source
     * @return void
     */
    private static function getSourceFeedsIds($source)
    {
        self::normalizeFeeds($source);
        
        return array_keys((array) $source->feeds);
    }

    /**
     * @param stdClass $sources
     * @return void
     */
    public static function normalizeFeedsOrder(array $sources) : stdClass
    {
       $result = [];
       foreach($sources as $source) {
           $id = $source->id;
           $multi = $source->multi;
           $isExists = array_key_exists($id, $result);
           $isExists || $result[$id] = [$multi];
           $isExists && $result[$id][] = $multi;
       }
       return (object) $result;
    }

    /**
     * this will normalize source item feeds format , convert it from string to array ( 'feeds' normalizer method )
     *
     * @param $source
     */
    private static function normalizeFeeds(&$source)
    {
        $source->feeds = unserialize($source->feeds);
    }

    /**
     * this will normalize source item feeds ( 'sourceFeeds' normalizer method )
     *
     * @param $source
     * @param $key
     * @param $feed
     */
    private static function normalizeSourceFeed(&$source, $key, $contents)
    {
        $feed = WpsfFeedsService::getFeed((int) $key, [ 'id', 'content', 'name', 'social_type' ], [ 'content' ]);
        $source->feeds->{$key}       = $feed;
        $source->feeds->{$key}->uses = $contents;

        foreach ($source->feeds->{$key}->uses as $value) {
            if (!array_key_exists($value, $feed->content)) {
                unset($source->feeds->{$key}->uses[ $value ]);
                continue;
            }
            $source->feeds->{$key}->uses[ $value ] = $feed->content[ $value ];
        }
    }

    /**
     * this will normalize source item feeds social ( 'social' normalizer method )
     *
     * @param $source
     * @param $key
     */
    private static function normalizeSourceFeedSocial(&$source, $key)
    {
        $source->feeds->$key->social = WpssSocialsManager::getInstance()->getSocialByID($source->feeds->$key->social_type);
    }

    /**
     * @param  \Tightenco\Collect\Support\Collection  $sources
     * @param  array  $normalizes
     */
    private static function normalizeSources(Collection &$sources, array $normalizes = [ 'sourceFeeds', 'social' ])
    {
        $sources->transform(function ($item) use ($normalizes) {
            self::normalizeSource($item, $normalizes);

            return $item;
        });
    }

    /**
     * @param $source
     * @param  array  $normalizes
     *
     * @return mixed
     *
     * @see normalizeFeeds
     * @see normalizeSourceFeed
     * @see normalizeSourceFeedSocial
     */
    private static function normalizeSource(&$source, array $normalizes = [ 'sourceFeeds', 'social' ])
    {
        self::normalizeFeeds($source);
        foreach ($normalizes as $normalizer) {
            if (array_key_exists($normalizer, self::$normalizes)) {
                foreach ($source->feeds as $key => $contents) {
                    if (!WpsfFeedsService::existFeed((int) $key)) {
                        unset($source->feeds->$key);
                        continue;
                    }
                    self::{self::$normalizes[ $normalizer ]}($source, $key, $contents);
                }
            }
        }

        return $source;
    }
}
