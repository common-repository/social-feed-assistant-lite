<?php

namespace WPSF\Services\SocialsFeedsResponser\Responders;

defined('ABSPATH') || exit('no access');

use App\Core\Utils\WpssObjectUtil;
use InstagramScraper\Instagram;
use InstagramScraper\Model\Account;
use InstagramScraper\Model\Media;
use Phpfastcache\Helper\Psr16Adapter;
use Unirest\Request;
use WPSF\Services\SocialsFeedsResponser\Responders\BaseHandler\WpsfSocialsFeedsResponderHandler;
use WPSF\Services\SocialsFeedsResponser\Socials\Instagram\Boilreplates\WpsfInstagramBoilreplates;

class WpsfInstagramFeedsResponder extends WpsfSocialsFeedsResponderHandler
{
    const USERNAME = 'getMediasByUsername';
    const LOCATION = 'getMediasByLocation';
    const HASHTAG  = 'getMediasByTag';

    const TYPES = [
        'username' => self::USERNAME,
        'user' => self::USERNAME,
        'location' => self::LOCATION,
        'locate' => self::LOCATION,
        'hashtag' => self::HASHTAG,
        'hash' => self::HASHTAG
    ];

    private static $method;

    private static $feedID;
    private static $type;

    private static $accounts = [];
    private static $accountsMeta = [];

    private static $posts = [];
    private static $comments = [];

    // daynamic . . .
    private static $postID;
    private static $multiKey;
    private static $multiContent;

    /**
     * initial dependencies
     *
     * @return void
     */
    public static function init()
    {
        Request::verifyPeer(false);
        Request::verifyHost(false);
        Request::curlOpt(CURLOPT_IPRESOLVE, self::USE_IPV4 ? CURL_IPRESOLVE_V4 : CURL_IPRESOLVE_V6);
        Request::curlOpt(CURLOPT_FOLLOWLOCATION, true);

        self::$api = new Instagram;
    }

    /**
     * @param integer $feed
     * @param string $type
     * @param array $contents
     * @param integer $account
     * @param array $excludes
     * @param array $includes
     * @return void
     */
    public static function response(int $feed, string $type, array $contents, int $account = 0, array $excludes = [], array $includes = [], int $count = 0)
    {
        self::init();
        self::setFilters($includes, $excludes);
        self::setFilterMethod();
        self::$countPost = $count;
        self::$feedID = $feed;
        self::$type   = $type;
        self::$contentCount = count($contents);
        self::$method = array_key_exists($type, self::TYPES) ? self::TYPES[$type] : self::TYPES['username'];

        foreach ($contents as $multiKey => $content) {
            self::$multiKey     = (int) $multiKey;
            self::$multiContent = (string) $content;
            self::setFeedContentPosts();
        }

        return [collect(self::$posts ?? []), collect(self::$comments ?? [])];
    }

    /**
     * get and set each contents post
     *
     * @return void
     */
    private static function setFeedContentPosts()
    {
        $medias = self::{self::$method}(self::$multiContent);

        foreach ($medias as $media) {
            if (false === ($media = self::getAndFilterMedia($media))) {
                continue;
            }

            $media->feedID    = self::$feedID;
            $media->feedMulti = self::$multiKey;
            
            self::$postID = $media->getId();

            $user = self::getAndSetUsermeta($media->getOwner()->getUsername());
            $post = WpsfInstagramBoilreplates::postBoilreplate($media, $user);

            self::$posts[$media->getId()] = WpssObjectUtil::toObject($post);
            self::addComments($media);
        }
    }

    /**
     * retrieve and filter media for check suitabled post
     *
     * @param Media $media
     * @return Media|bool
     */
    private static function getAndFilterMedia(Media $media)
    {
        $link = (string) $media->getLink();

        if (self::HASHTAG == self::$method) {
            $media = self::$api->getMediaByUrl($link);
        }

        $username = (string) $media->getOwner()->getUsername();
        $text     = (string) $media->getCaption();

        if (!self::isSuitablePost($link, $username, $text)) {
            return false;
        }

        return self::HASHTAG == self::$method ? $media : self::$api->getMediaByUrl($link);
    }

    /**
     * get and organized post comments
     *
     * @param Media $post
     * @return void
     */
    private static function addComments(Media $post)
    {
        foreach ($post->getComments() as $comment) {
            $comment->feedID = self::$feedID;
            $comment->feedMulti = self::$multiKey;
            $comment->postID = self::$postID;
            self::$comments[] = WpssObjectUtil::toObject(WpsfInstagramBoilreplates::commentBoilreplate($comment));
        }
    }

    /**
     * @param string $username
     * @return Account
     */
    private static function getAccountByUsername(string $username) : Account
    {
        if (array_key_exists($username, self::$accounts)) {
            return self::$accounts[$username];
        }
        return self::$accounts[$username] = self::$api->getAccount($username);
    }
    
    /**
     * @param string $username
     * @return void
     */
    private static function getAndSetUsermeta(string $username) : array
    {
        if (array_key_exists($username, self::$accountsMeta)) {
            return self::$accountsMeta[$username];
        }

        return self::$accountsMeta[$username] = WpsfInstagramBoilreplates::userBoilreplate(self::getAccountByUsername($username));
    }

    /**
     * get account medias by given username
     *
     * @param string $username
     * @return void
     */
    private static function getMediasByUsername(string $username)
    {
        return self::$api->getMediasByUserId(self::getAccountByUsername($username)->getId(), self::getMediasCount(), self::MEDIA_MAXID);
    }

    /**
     * get medias by location id
     *
     * @param string $location
     * @return void
     */
    private static function getMediasByLocation(string $location)
    {
        return self::$api->getMediasByLocationId($location, self::getMediasCount());
    }
    
    /**
     * get medias by tag
     *
     * @param string $tag
     * @return void
     */
    private static function getMediasByTag(string $tag)
    {
        return self::$api->getMediasByTag($tag, self::getMediasCount());
    }
}
