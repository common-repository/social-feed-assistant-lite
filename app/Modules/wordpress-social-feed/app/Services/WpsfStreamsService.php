<?php

namespace WPSF\Services;

defined('ABSPATH') || exit('no access');

use App\Core\Libs\Carbon\WpssCarbon;
use Tightenco\Collect\Support\Collection;
use App\Core\Repository\Factory\WpssRepositoryFactory;

/**
 * Class WpsfStreamsService
 *
 * @see \WPSF\Repositories\StreamsRepository\WpsfStreamsRepository::getAllStreams()
 * @see \WPSF\Repositories\StreamsRepository\WpsfStreamsRepository::getStreamByID()
 * @see \WPSF\Repositories\StreamsRepository\WpsfStreamsRepository::getLastStreamID()
 * @see \WPSF\Repositories\StreamsRepository\WpsfStreamsRepository::deleteStream()
 * @see \WPSF\Repositories\StreamsRepository\WpsfStreamsRepository::addStream()
 * @see \WPSF\Repositories\StreamsRepository\WpsfStreamsRepository::updateStream()
 * @see \WPSF\Repositories\StreamsRepository\WpsfStreamsRepository::existStream()
 */
class WpsfStreamsService
{
    /**
     * we put here normalizer methods
     *
     * @var array
     */
    private static $normalizes = [
        'feeds'   => 'normalizeStreamFeeds',
        'options' => 'normalizeStreamOptions',
        'relatedOptions' => 'normalizeStreamRelatedOptions'
    ];

    /**
     * @param  array  $normalize
     *
     * @return array
     */
    public static function getStreams(array $normalize = [ 'feeds', 'options' ])
    {
        $streams = collect(WpssRepositoryFactory::make('streams')->getAllStreams([ 'id', 'name', 'options', 'updated_at', 'created_at' ]));

        if (! $normalize || !$streams) {
            return $streams->sortByDesc('created_at')->all();
        }

        self::normalizeStreams($streams, $normalize);

        return $streams->sortByDesc('created_at')->all();
    }

    /**
     * @param  int  $ID
     * @param  array  $columns
     * @param  array  $normalize
     *
     * @return mixed
     */
    public static function getStream(int $ID, array $columns = [], array $normalize = [ 'feeds', 'options', 'relatedOptions' ])
    {
        $stream = WpssRepositoryFactory::make('streams')->getStreamByID($ID, $columns);

        if (! $normalize || !$stream) {
            return $stream;
        }

        self::normalizeStream($stream, $normalize);

        return $stream;
    }

    /**
     * @return mixed
     */
    public static function getLastStreamID()
    {
        return WpssRepositoryFactory::make('streams')->getLastStreamID();
    }

    /**
     * @return mixed
     */
    public static function getAfterAutoIncreament()
    {
        return WpssRepositoryFactory::make('streams')->getAfterAutoIncreament();
    }

    /**
     * @param  int  $streamID
     *
     * @return mixed
     */
    public static function getStreamFeeds(int $streamID, $normalize = [ 'sourceFeeds', 'social' ])
    {
        return WpsfStreamsSourcesService::getSourceByStreamID($streamID, [ 'feeds' ], $normalize)->feeds;
    }

    /**
     *
     * @param integer $streamID
     * @return mixed
     */
    public static function getStreamFeedIds(int $streamID)
    {
        return WpsfStreamsSourcesService::getSourceIdsByStreamID($streamID);
    }

    /**
     *
     * @param integer $ID
     * @param integer $page
     * @param array $feeds
     * @param integer $count
     * @param array $columns
     * @return mixed
     */
    public static function getStreamPosts(int $ID, array $feeds = [], array $columns = [])
    {
        $feeds = $feeds ?: self::getStreamFeedIds($ID);

        return collect(WpsfFeedPostsService::getPostByFeeds($feeds, $columns));
    }

    /**
     * @param  int  $ID
     *
     * @return mixed
     */
    public static function deleteStream(int $ID)
    {
        return WpssRepositoryFactory::make('streams')->deleteStream($ID);
    }

    public static function deleteStreamWithSource(int $streamID)
    {
        return WpssRepositoryFactory::make('streams')->transaction(function () use ($streamID) {
            $resStreamDel = self::deleteStream($streamID);
            $resSourceDel = WpsfStreamsSourcesService::deleteSourceByStreamID($streamID);
            if (!$resStreamDel || !$resSourceDel) {
                throw new \Exception('false');
            }
            return true;
        });
    }

    /**
     * @param  string  $name
     * @param  \stdClass  $options
     * @param  array  $filters
     *
     * @return mixed
     */
    public static function addStream(string $name, \stdClass $options, array $filters = [])
    {
        $item = [
            'name'       => $name,
            'options'    => serialize($options),
            'filters'    => serialize($filters),
            'updated_at' => (string) WpssCarbon::now(),
            'created_at' => (string) WpssCarbon::now(),
        ];

        return WpssRepositoryFactory::make('streams')->addStream($item, [ '%s', '%s', '%s', '%s', '%s' ]);
    }

    /**
     * @param  int  $beforeID
     * @param  string  $name
     * @param  \stdClass  $options
     * @param  array  $filters
     *
     * @return mixed
     */
    public static function updateStream(int $beforeID, string $name, \stdClass $options, array $filters = [])
    {
        $item = [
            'name'       => $name,
            'options'    => serialize($options),
            'filters'    => serialize($filters),
            'updated_at' => (string) WpssCarbon::now(),
        ];

        return WpssRepositoryFactory::make('streams')->updateStream($beforeID, $item, [ '%s', '%s', '%s', '%s' ]);
    }

    /**
     * @param  int  $ID
     *
     * @return bool
     */
    public static function existStream(int $ID)
    {
        return WpssRepositoryFactory::make('streams')->existStream($ID) ?: false;
    }

    /**
     * this will normalize stream item feeds ( 'feeds' normalizer method )
     *
     * @param $stream
     */
    private static function normalizeStreamFeeds(&$stream)
    {
        $stream->feeds = (array) self::getStreamFeeds((int) $stream->id);
    }

    /**
     * this will normalize stream item options ( 'options' normalizer method )
     *
     * @param $stream
     */
    private static function normalizeStreamOptions(&$stream)
    {
        $stream->options = unserialize($stream->options);
        $stream->layout  = $stream->options->general->postSettings->layout;

        if (isset($stream->filters)) {
            $stream->filters = unserialize($stream->filters);
        }
    }

    /**
     * this will normalize stream options and attach it realted options ( 'relatedOptions' normalizer method )
     *
     * @param object $stream
     * @return void
     */
    private static function normalizeStreamRelatedOptions(&$stream)
    {
        $stream->options->relatedOptions = (object) get_option('wpsf_general_settings');
    }

    /**
     * @param  \Tightenco\Collect\Support\Collection  $streams
     * @param  array  $normalizes
     */
    private static function normalizeStreams(Collection &$streams, array $normalizes = [ 'feed' ])
    {
        $streams->transform(function ($item) use ($normalizes) {
            self::normalizeStream($item, $normalizes);

            return $item;
        });
    }

    /**
     * @param $stream
     * @param  array  $normalizes
     *
     * @see normalizeStreamFeeds
     * @see normalizeStreamOptions
     */
    private static function normalizeStream(&$stream, array $normalizes = [ 'feed' ])
    {
        foreach ($normalizes as $normalizer) {
            if (array_key_exists($normalizer, self::$normalizes)) {
                self::{self::$normalizes[ $normalizer ]}($stream);
            }
        }
    }
}
