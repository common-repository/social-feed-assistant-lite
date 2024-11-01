<?php

namespace SFAL\Services;

defined('ABSPATH') || exit('no access');

use Exception;
use stdClass;
use SFAL\Core\Libs\Carbon\SfalCarbon;
use SFAL\Core\Socials\SfalSocialsManager;
use Tightenco\Collect\Support\Collection;
use SFAL\Core\Repository\Factory\SfalRepositoryFactory;

/**
 * Class SfalStreamsSourcesService
 *
 * @see \SFAL\Repositories\StreamsSourcesRepository\SfalStreamsSourcesRepository::getAllSources()
 * @see \SFAL\Repositories\StreamsSourcesRepository\SfalStreamsSourcesRepository::getSourceByID()
 * @see \SFAL\Repositories\StreamsSourcesRepository\SfalStreamsSourcesRepository::deleteSource()
 * @see \SFAL\Repositories\StreamsSourcesRepository\SfalStreamsSourcesRepository::deleteSourceByStreamID()
 * @see \SFAL\Repositories\StreamsSourcesRepository\SfalStreamsSourcesRepository::addSource()
 * @see \SFAL\Repositories\StreamsSourcesRepository\SfalStreamsSourcesRepository::transaction()
 * @see \SFAL\Repositories\StreamsSourcesRepository\SfalStreamsSourcesRepository::updateSource()
 * @see \SFAL\Repositories\StreamsSourcesRepository\SfalStreamsSourcesRepository::updateSourceByStreamID()
 * @see \SFAL\Repositories\StreamsSourcesRepository\SfalStreamsSourcesRepository::existSource()
 * @see \SFAL\Repositories\StreamsSourcesRepository\SfalStreamsSourcesRepository::existSourceByStreamID()
 */
class SfalStreamsSourcesService
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
    
    public static function getSourcesByStreamID(int $streamID, array $columns = [], array $normalize = [ 'sourceFeeds', 'social' ])
    {
        $sources = SfalRepositoryFactory::make('sources')->getSourcesByStreamID($streamID, $columns);
        
        self::normalizeFeeds($sources);

        $normalize && self::normalizeSources($sources, $normalize);

        return $sources;
    }

    /**
     *
     * @param integer $streamID
     * @return void
     */
    public static function getSourceIdsByStreamID(int $streamID)
    {
        if (!($sources = SfalRepositoryFactory::make('sources')->getSourcesByStreamID($streamID, ['feed_id']) ?: [])) {
            return [];
        }

        return self::getSourceFeedsIds($sources);
    }

    /**
     *
     * @param integer $streamID
     * @return void
     */
    public static function deleteSourceByStreamID(int $streamID)
    {
        return SfalRepositoryFactory::make('sources')->deleteSourceByStreamID($streamID);
    }

    /**
     * @param  int  $streamID
     * @param  \stdClass  $feeds
     *
     * @return mixed
     */
    public static function replaceStreamSource(int $streamID, array $sources)
    {
        self::deleteSourceByStreamID($streamID);
        $feeds = self::normalizeFeedsOrder($sources);
        foreach ($feeds as $feed) {
            $item = [
                'stream_id'  => $streamID,
                'feed_id'    => $feed,
                'created_at' => (string) SfalCarbon::now(),
                'updated_at' => (string) SfalCarbon::now(),
            ];
            $format = [ '%d', '%d', '%s', '%s' ];
            $result = SfalRepositoryFactory::make('sources')->addSource($item, $format);
            if(!$result) {
                throw new Exception(__('Stream sources created faild!', 'sfal'));
            }
        }
        return true;
    }

    /**
     * @param  int  $ID
     *
     * @return bool
     */
    public static function existSource(int $ID)
    {
        return SfalRepositoryFactory::make('sources')->existSource($ID) ?: false;
    }

    /**
     * @param integer $streamID
     * @return void
     */
    public static function existSourceByStreamID(int $streamID)
    {
        return SfalRepositoryFactory::make('sources')->existSourceByStreamID($streamID) ?: false;
    }

    /**
     * @param $source
     * @return void
     */
    private static function getSourceFeedsIds($source)
    {
        self::normalizeFeeds($source);
        return array_values((array) $source);
    }

    /**
     * @param stdClass $sources
     * @return void
     */
    public static function normalizeFeedsOrder(array $sources) : stdClass
    {
        $ids = array_map(function ($source) {
            return $source->id;
        }, $sources);

        return (object) array_unique($ids);
    }

    /**
     * this will normalize source item feeds format , convert it from string to array ( 'feeds' normalizer method )
     *
     * @param $source
     */
    private static function normalizeFeeds(&$sources)
    {
        $sources = array_map(function($feed){
            return $feed->feed_id;
        }, $sources);
        $sources = (object) array_combine($sources, $sources);
    }

    /**
     * this will normalize source item feeds ( 'sourceFeeds' normalizer method )
     *
     * @param $source
     * @param $key
     * @param $feed
     */
    private static function normalizeSourceFeed(&$source, $key, $content)
    {
        $feed = SfalFeedsService::getFeed((int) $content, [ 'id', 'name', 'social_type' ], [ 'content' ]);
        $source->{$key} = $feed;
    }

    /**
     * this will normalize source item feeds social ( 'social' normalizer method )
     *
     * @param $source
     * @param $key
     */
    private static function normalizeSourceFeedSocial(&$source, $key)
    {
        $source->$key->social = SfalSocialsManager::getInstance()->getSocialByID($source->$key->social_type);
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
    private static function normalizeSources(&$sources, array $normalizes = [ 'sourceFeeds', 'social' ])
    {
        foreach ($normalizes as $normalizer) {
            if (array_key_exists($normalizer, self::$normalizes)) {
                foreach ($sources as $key => $content) {
                    self::{self::$normalizes[ $normalizer ]}($sources, $key, $content);
                }
            }
        }
        return $sources;
    }
}
