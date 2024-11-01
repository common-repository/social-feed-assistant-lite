<?php

namespace SFAL\Services;

defined('ABSPATH') || exit('no access');

use Exception;
use SFAL\Core\Libs\Carbon\SfalCarbon;
use Tightenco\Collect\Support\Collection;
use SFAL\Core\Repository\Factory\SfalRepositoryFactory;

/**
 * Class SfalStreamsService
 *
 * @see \SFAL\Repositories\StreamsRepository\SfalStreamsRepository::getAllStreams()
 * @see \SFAL\Repositories\StreamsRepository\SfalStreamsRepository::getStreamByID()
 * @see \SFAL\Repositories\StreamsRepository\SfalStreamsRepository::getLastStreamID()
 * @see \SFAL\Repositories\StreamsRepository\SfalStreamsRepository::deleteStream()
 * @see \SFAL\Repositories\StreamsRepository\SfalStreamsRepository::addStream()
 * @see \SFAL\Repositories\StreamsRepository\SfalStreamsRepository::updateStream()
 * @see \SFAL\Repositories\StreamsRepository\SfalStreamsRepository::existStream()
 */
class SfalStreamsService
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
        $streams = collect(SfalRepositoryFactory::make('streams')->getAllStreams([ 'id', 'name', 'options', 'updated_at', 'created_at' ]));

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
        $stream = SfalRepositoryFactory::make('streams')->getStreamByID($ID, $columns);

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
        return SfalRepositoryFactory::make('streams')->getLastStreamID();
    }

    /**
     * @return mixed
     */
    public static function getAfterAutoIncreament()
    {
        return SfalRepositoryFactory::make('streams')->getAfterAutoIncreament();
    }

    /**
     * @param  int  $streamID
     *
     * @return mixed
     */
    public static function getStreamFeeds(int $streamID, $normalize = [ 'sourceFeeds', 'social' ])
    {
        return SfalStreamsSourcesService::getSourcesByStreamID($streamID, [ 'feed_id' ], $normalize);
    }

    /**
     * @param integer $streamID
     * @return mixed
     */
    public static function getStreamFilters(int $streamID)
    {
        return SfalRepositoryFactory::make('filters')->getFiltersByStreamID($streamID);
    }

    /**
     *
     * @param integer $streamID
     * @return mixed
     */
    public static function getStreamFeedIds(int $streamID)
    {
        return SfalStreamsSourcesService::getSourceIdsByStreamID($streamID);
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

        return collect(SfalFeedPostsService::getPostByFeeds($feeds, $columns));
    }

    /**
     * @param  int  $ID
     *
     * @return mixed
     */
    public static function deleteStream(int $ID)
    {
        return SfalRepositoryFactory::make('streams')->deleteStream($ID);
    }

    public static function deleteFiltersByStreamID(int $id)
    { 
        return SfalRepositoryFactory::make('filters')->deleteFiltersByStreamID($id);
    }

    /**
     * @param  string  $name
     * @param  \stdClass  $options
     * @param  array  $filters
     *
     * @return mixed
     */
    public static function addStream(string $name, \stdClass $options, array $sources, array $filters = [])
    {
        $item = [
            'name'       => $name,
            'options'    => serialize($options),
            'created_at' => (string) SfalCarbon::now(),
            'updated_at' => (string) SfalCarbon::now(),
        ];

        return SfalTransaction(function() use ($item, $sources, $filters) {
            $resultCreated = SfalRepositoryFactory::make('streams')->addStream($item, [ '%s', '%s', '%s', '%s' ]);
            if(!$resultCreated) {
                throw new Exception(__('Stream created faild!', 'sfal'));
            }
            $id = self::getLastStreamID();
            SfalStreamsSourcesService::replaceStreamSource($id, $sources);
            self::replaceStreamFilters($id, $filters);
            return true;
        });
    }

    /**
     * @param  int  $beforeID
     * @param  string  $name
     * @param  \stdClass  $options
     * @param  array  $filters
     *
     * @return mixed
     */
    public static function updateStream(int $beforeID, string $name, \stdClass $options, array $sources, array $filters = [])
    {
        $item = [
            'name'       => $name,
            'options'    => serialize($options),
            'updated_at' => (string) SfalCarbon::now(),
        ];

        return SfalTransaction(function() use ($item, $beforeID, $sources, $filters) {
            $resultUpated = SfalRepositoryFactory::make('streams')->updateStream($beforeID, $item, [ '%s', '%s', '%s' ]);
            if(!$resultUpated) {
                throw new Exception(__('Stream updated faild!', 'sfal'));
            }
            SfalStreamsSourcesService::replaceStreamSource($beforeID, $sources);
            self::replaceStreamFilters($beforeID, $filters);
            return true;
        });
    }

    private static function replaceStreamFilters(int $streamID, array $filters)
    {
        self::deleteFiltersByStreamID($streamID);
        foreach ($filters as $feed) {
            $item = [
                'stream_id'  => $streamID,
                'feed_id'    => $feed->feed,
                'feed_content' => $feed->feedContent,
                'title' => $feed->title,
                'created_at' => (string) SfalCarbon::now(),
                'updated_at' => (string) SfalCarbon::now(),
            ];
            $format = [ '%d', '%d', '%d', '%s', '%s', '%s' ];
            $result = SfalRepositoryFactory::make('filters')->addFilter($item, $format);
            if(!$result) {
                throw new Exception(__('Stream filters created faild!', 'sfal'));
            }
        }
        return true;
    }

    /**
     * @param  int  $ID
     *
     * @return bool
     */
    public static function existStream(int $ID)
    {
        return SfalRepositoryFactory::make('streams')->existStream($ID) ?: false;
    }

    /**
     * prepare stream options with merge default optons
     *
     * @param array $options
     * @return array
     */
    public static function prepareStreamOptions(array $options) : array
    {
        $replacedOptions = array_replace_recursive(SfalConfig('stream.options'), $options);
        return SfalArrayMapRecursive(function($val) {
            return $val === "on" ? 1 : $val;
        }, $replacedOptions);
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
        $stream->filters = self::getStreamFilters((int) $stream->id);
    }

    /**
     * this will normalize stream options and attach it realted options ( 'relatedOptions' normalizer method )
     *
     * @param object $stream
     * @return void
     */
    private static function normalizeStreamRelatedOptions(&$stream)
    {
        $stream->options->relatedOptions = (object) get_option('sfal_general_settings');
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
