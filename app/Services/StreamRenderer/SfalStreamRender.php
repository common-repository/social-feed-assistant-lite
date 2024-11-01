<?php

namespace SFAL\Services\StreamRenderer;

defined('ABSPATH') || exit('no access');

use Tightenco\Collect\Support\Collection;
use SFAL\Services\StreamRenderer\Presenters\SfalStreamClassicTemplateHandler;
use SFAL\Services\StreamRenderer\Presenters\SfalStreamTileTemplateHandler;
use SFAL\Services\SfalStreamsService;

class SfalStreamRender
{
    const TEMPLATES = ['classic' => SfalStreamClassicTemplateHandler::class, 'tile' => SfalStreamTileTemplateHandler::class];

    private static $stream;
    private static $options;
    private static $posts;
    private static $feeds;

    private static $page;
    private static $count;

    /**
     * initial stream
     *
     * @param integer $streamID
     * @return void
     */
    private static function init(int $streamID)
    {
        self::$stream = SfalStreamsService::getStream($streamID, [], ['options', 'relatedOptions']);
        self::$feeds = SfalStreamsService::getStreamFeedIds($streamID);

        self::$posts = SfalStreamsService::getStreamPosts($streamID, self::$feeds);
        self::$options = self::$stream->options;
    }

    /**
     * @param integer $streamID
     * @param integer $page
     * @param integer $count
     * @return void
     */
    public static function render(int $streamID, int $page = 1, int $count = 4)
    {
        self::init($streamID);

        self::$page = $page;
        self::$count = $count;

        if (self::$posts->count() < 1) {
            return [ 'items' => null, 'count' => 0, 'page' => $page ];
        }

        $order = (int) self::$options->general->itemsOrder ?? 3;

        self::sortAndPaginatePosts(self::$posts, $order);
        
        $posts = self::getTemplateHandler(self::$options->general->postSettings->template ?? 'classic')::render(self::$options, self::$posts);

        return [
            'items' => $posts,
            'count' => count(self::$posts),
            'page'  => $page
        ];
    }

    /**
     * sort and paginate stream posts with items order
     * 1 => publication date
     * 2 => source list position
     * 3 => random shuffle
     *
     * @param Collection $posts
     * @param integer $itemsOrder
     * @return void
     */
    private static function sortAndPaginatePosts(Collection &$posts, int $itemsOrder = 3)
    {
        $sortables = [
            1 => "sortByPublicationDate",
            2 => "sortBySourceListPosition",
            3 => "sortByRandom",
        ];

        array_key_exists($itemsOrder, $sortables) && self::{$sortables[ $itemsOrder ]}($posts);
    }

    /**
     * @param Collection $posts
     * @return void
     */
    private static function sortByPublicationDate(Collection &$posts)
    {
        $posts = $posts->sortByDesc('timestamp')->forPage(self::$page, self::$count)->all();
    }

    /**
     * @param Collection $posts
     * @return void
     */
    private static function sortBySourceListPosition(Collection &$posts)
    {
        $sources = self::$feeds;
        $posts = $posts->toArray();
        usort($posts, function ($postOne, $postTwo) use ($sources) {
            $res = (array_search($postOne->feed_id, $sources) > array_search($postTwo->feed_id, $sources));
            return $postOne->feed_id == $postTwo->feed_id ? $postOne->feed_content > $postTwo->feed_content : $res;
        });

        $posts = collect($posts)->forPage(self::$page, self::$count)->all();
    }

    /**
     * @param Collection $posts
     * @return void
     */
    private static function sortByRandom(Collection &$posts)
    {
        $posts = $posts->sortBy('rand_order')->forPage(self::$page, self::$count)->shuffle()->all();
    }

    /**
     * @param string $name
     * @return void
     */
    private static function getTemplateHandler(string $name) : string
    {
        return array_key_exists($name, self::TEMPLATES) ? self::TEMPLATES[$name] : self::TEMPLATES['classic'];
    }
}
