<?php

namespace SFAL\Services\MakePosts\Responsers\InstagramPostsResponser;

use Exception;
use InstagramScraper\Instagram;
use InstagramScraper\Model\Account;
use InstagramScraper\Model\Media;
use Phpfastcache\Helper\Psr16Adapter;
use SFAL\Core\Foundation\Contracts\SfalSocialResponsersInterface;
use SFAL\Core\Utils\SfalObjectUtil;
use SFAL\Services\MakePosts\Responsers\Traits\SfalSocialResponsersTrait;
use stdClass;
use Unirest\Request;

defined('ABSPATH') || exit('no access');

class SfalInstagramResponser implements SfalSocialResponsersInterface
{
    use SfalSocialResponsersTrait;

    const USERNAME = 'getMediasByUsername';
    const LOCATION = 'getMediasByUsername';
    const HASHTAG  = 'getMediasByUsername';

    const TYPES = [
        'username' => self::USERNAME,
        'user' => self::USERNAME,
        'location' => self::LOCATION,
        'locate' => self::LOCATION,
        'hashtag' => self::HASHTAG,
        'hash' => self::HASHTAG
    ];

    const REQUIRED_ACCOUNT = true;

    private static $api = null;
    private static $instanceCache = null;
    private static $isHashtagMethod = false;

    private static $makeByUrls = false;

    private static $returnPureLinks = false;

    // cache data
    private static $accounts = [];
    private static $accountIds = [];
    private static $accountsMeta = [];
    private static $accountsMetaIds = [];

    /**
     * initial dependencies
     *
     * @return void
     */
    private static function init($account)
    {
        Request::verifyPeer(false);
        Request::verifyHost(false);
        Request::curlOpt(CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        Request::curlOpt(CURLOPT_FOLLOWLOCATION, true);

        $username = $account->options['instagram']['username'] ?? '';
        $password = $account->options['instagram']['password'] ?? '';

        if (!$username || !$password) {
            throw new Exception(__('Used account for feed is not valid', 'sfal'));
        }

        $instanceCache = self::$instanceCache ?? self::$instanceCache = new Psr16Adapter('Files');

        self::$api = Instagram::withCredentials($username, $password, $instanceCache);
        self::$api->login();
    }

    /**
     * make media urls or collection of Models
     *
     * @param integer $feedId
     * @param integer $contentId
     * @param string $content
     * @param stdClass $account
     * @param integer $count
     * @param array $mediaLinks
     * @param stdClass $feed
     * @return mixed
     */
    public static function make(int $feedId, int $contentId, string $content, stdClass $account, int $count, array $mediaLinks, stdClass $feed)
    {
        self::init($account);
        self::setFilters($feed->includes, $feed->excludes);
        self::setFilterMethod();

        $mediaLinks && self::$makeByUrls = true;

        $medias = $mediaLinks
        ? self::makeMediasByLinks($mediaLinks)
        : self::makeMedias(self::TYPES['username'], $content, $count);

        if (self::$returnPureLinks) {
            return self::pluckLinksFromMedias($medias);
        }

        return self::evaluateAndPrepaerMedias($medias, $feedId, $contentId);
    }

    /**
     * perpare and make media models
     *
     * @param array $medias
     * @param integer $feedId
     * @param integer $contentId
     * @return Collection
     */
    public static function evaluateAndPrepaerMedias(array $medias, int $feedId, int $contentId)
    {
        $posts    = [];
        $comments = [];
        foreach ($medias as $media) {
            if (false === ($media = self::getAndFilterMedia($media))) {
                continue;
            }

            $postId = $media->getId();
            $user = self::getAndSetUsermeta($media->getOwner()->getUsername());
            $post = SfalInstagramBoilreplates::postBoilreplate($media, $user, $feedId, $contentId);

            $posts[$postId] = SfalObjectUtil::toObject($post);

            self::addComments($media, $comments, $postId, $feedId, $contentId);
        }

        return [ collect($posts), collect($comments) ];
    }

    /**
     * @param boolean $bool
     * @return void
     */
    public static function setReturnPureLinks(bool $bool)
    {
        self::$returnPureLinks = $bool;
    }

    /**
     * pluck and return links from array of medias
     *
     * @param array $medias
     * @return array
     */
    private static function pluckLinksFromMedias(array $medias) : array
    {
        return collect($medias)->map(function ($media) {
            return (string) $media->getLink();
        })->toArray();
    }

    /**
     * make pure medias for proccess and prepare
     *
     * @param string $feedType
     * @param string $content
     * @param integer $count
     * @param string $maxId
     * @return array
     */
    private static function makeMedias(string $feedType, string $content, int $count, string $maxId = '') : array
    {
        $method = self::getMethodType($feedType);
        return self::{$method}($content, $count, $maxId);
    }

    /**
     * make pure medias by array of links
     *
     * @param array $mediaLinks
     * @return array
     */
    private static function makeMediasByLinks(array $mediaLinks) : array
    {
        $medias = [];
        foreach ($mediaLinks as $url) {
            $medias[] = self::$api->getMediaByUrl($url);
        }
        return $medias;
    }

    /**
     * get method of medias resolver.
     *
     * @param string $feedType
     * @return string
     */
    private static function getMethodType(string $feedType) : string
    {
        return array_key_exists($feedType, self::TYPES) ? self::TYPES[$feedType] : self::TYPES['username'];
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

        if (self::$isHashtagMethod && !self::$makeByUrls) {
            $media = self::$api->getMediaByUrl($link);
        }

        $username = (string) $media->getOwner()->getUsername();
        $text     = (string) $media->getCaption();

        if (!self::isSuitablePost($link, $username, $text)) {
            return false;
        }

        return (self::$isHashtagMethod && !self::$makeByUrls) ? $media : self::$api->getMediaByUrl($link);
    }

    /**
     * get and organized post comments
     *
     * @param Media $post
     * @return void
     */
    private static function addComments(Media $post, array &$collection, string $postId, int $feedId, int $contentId)
    {
        foreach ($post->getComments() as $comment) {
            $collection[] = SfalObjectUtil::toObject(SfalInstagramBoilreplates::commentBoilreplate($comment, $postId, $feedId, $contentId));
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
     *
     * @param integer $id
     * @return Account
     */
    private static function getAccountByID(int $id) : Account
    {
        if (array_key_exists($id, self::$accountIds)) {
            return self::$accountIds[$id];
        }

        self::$accountIds[$id] = $user = self::$api->getAccountByID($id);
        return self::$accounts[$user->getUsername()] = $user;
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

        return self::$accountsMeta[$username] = SfalInstagramBoilreplates::userBoilreplate(self::getAccountByUsername($username));
    }

    /**
     * @param string $username
     * @return void
     */
    private static function getAndSetUsermetaByID(int $id) : array
    {
        if (array_key_exists($id, self::$accountsMetaIds)) {
            return self::$accountsMetaIds[$id];
        }

        self::$accountsMetaIds[$id] = $user = SfalInstagramBoilreplates::userBoilreplate(self::getAccountByID($id));
        return self::$accountsMeta[$user['username']] = $user;
    }

    /**
     * get account medias by given username
     *
     * @param string $username
     * @return void
     */
    private static function getMediasByUsername(string $username, int $count, string $maxId)
    {
        return self::$api->getMediasByUserId(self::getAccountByUsername($username)->getId(), $count, $maxId);
    }
}
