<?php

namespace SFAL\Services\SocialsFeedsResponser\Socials\Instagram\Boilreplates;

defined('ABSPATH') || exit('no access');

use InstagramScraper\Model\Account;
use InstagramScraper\Model\Comment;
use InstagramScraper\Model\Media;
use SFAL\Services\SocialsFeedsResponser\Utils\SfalFeedGeneralUtils;

class SfalInstagramBoilreplates
{
    const BASE_INSTAGRAM = "https://www.instagram.com/";
    const BASE_LOCATION  = "https://www.instagram.com/explore/locations/{id}/{slug}/";

    const MEDIA_SETTER = [
        Media::TYPE_IMAGE    => 'setImagePostMedia',
        Media::TYPE_VIDEO    => 'setVideoPostMedia',
        Media::TYPE_SIDECAR  => 'setSidecarAndCarouselPostMedia',
        Media::TYPE_CAROUSEL => 'setSidecarAndCarouselPostMedia'
    ];

    /**
     * convert account data to database structure
     *
     * @param Account $account
     * @return array
     */
    public static function userBoilreplate(Account $account) : array
    {
        $b = [
            'username'   => $account->getUsername(),
            'fullname'   => SfalFeedGeneralUtils::removeEmoji($account->getFullName()),
            'id'         => $account->getId(),
            'bio'        => $account->getBiography(),
            'link'       => self::BASE_INSTAGRAM . $account->getUsername(),
            'profilePic' => [ 'url' => $account->getProfilePicUrl(), 'hd' => $account->getProfilePicUrlHd() ],
            'counts'   => [
                'media'         => $account->getMediaCount(),
                'follows'       => $account->getFollowsCount(),
                'followedBy'    => $account->getFollowedByCount(),
            ]
        ];

        $b['fullname'] = function_exists('mb_convert_encoding') ? mb_convert_encoding($b['fullname'], 'HTML-ENTITIES', 'UTF-8') : $b['fullname'];

        return $b;
    }

    /**
     * convert post data to database structure
     *
     * @param Media $post
     * @param array $user
     * @return void
     */
    public static function postBoilreplate(Media $post, array $user)
    {
        $b = [
            'feed_id'    => (int) $post->feedID,
            'feed_multi' => (int) $post->feedMulti,
            'post_id'    => (string) $post->getId(),
            'type'       => 'instagram',
            'media_type' => (string) $post->getType(),
            'user'       => (object) $user,
            'text'       => (string) $post->getCaption(),
            'permalink'  => (string) $post->getLink(),
            'rand_order' => (float) 0 + mt_rand() / mt_getrandmax() * (1 - 0),
            'timestamp'  => (int) $post->getCreatedTime(),
            'carousel'   => [],
            'media'      => (object) [],
            'images'     => [
                'thumbnail' => $post->getImageThumbnailUrl(),
                'low'       => $post->getImageLowResolutionUrl(),
                'standard'  => $post->getImageStandardResolutionUrl() ?: $post->getImageThumbnailUrl(),
                'high'      => $post->getImageHighResolutionUrl(),
            ],
            'videos' => [
                'low'       => $post->getVideoLowResolutionUrl(),
                'standard'  => $post->getVideoStandardResolutionUrl() ?: $post->getVideoLowResolutionUrl(),
                'bandwidth' => $post->getVideoLowBandwidthUrl()
            ],
            'location' => [
                'id'        => $post->getLocationId(),
                'slug'      => $post->getLocationSlug(),
                'name'      => $post->getLocationName(),
                'address'   => $post->getLocationAddress(),
                'link'      => str_replace( ['{id}', '{slug}'], [$post->getLocationId(), $post->getLocationSlug()], self::BASE_LOCATION)
            ],
            'additional' => ['likes' => (string) $post->getLikesCount(), 'comments' => (string) $post->getCommentsCount()]

        ];

        self::setPostMedia($b, $post);
        return $b;
    }

    /**
     * convert comment data to database structure
     *
     * @param Comment $comment
     * @return array
     */
    public static function commentBoilreplate(Comment $comment) : array
    {
        return [
            'feed_id'       => (int) $comment->feedID,
            'feed_multi'    => (int) $comment->feedMulti,
            'post_id'       => (string) $comment->postID,
            'from'          => (object) self::userBoilreplate($comment->getOwner()),
            'text'          => (string) $comment->getText(),
            'created_time'  => (int) $comment->getCreatedAt()
        ];
    }

    /**
     * set post data media for image type
     *
     * @param array $b
     * @return void
     */
    private static function setImagePostMedia(array &$b)
    {
        $b['media'] = ['type' => Media::TYPE_IMAGE, 'url' => $b['images']];
    }

    /**
     * set post data media for video type
     *
     * @param array $b
     * @return void
     */
    private static function setVideoPostMedia(array &$b)
    {
        $b['media'] = ['type' => Media::TYPE_VIDEO, 'url' => $b['videos']];
    }

    /**
     * set post data media for carousel and sidecar type
     *
     * @param array $b
     * @param Media $post
     * @return void
     */
    private static function setSidecarAndCarouselPostMedia(array &$b, Media $post)
    {
        $medias = $b['media_type'] == Media::TYPE_SIDECAR ? $post->getSidecarMedias() : $post->getCarouselMedia();
        foreach ($medias as $media) {
            $b['carousel'][] =  self::createMedia($media);
        }
    }

    /**
     * @param array $b
     * @param Media $post
     * @return void
     */
    private static function setPostMedia(array &$b, Media $post)
    {
        array_key_exists($b['media_type'], self::MEDIA_SETTER) && self::{self::MEDIA_SETTER[$b['media_type']]}($b, $post);
    }

    /**
     * this will create array for post media with consideration of media type
     *
     * @param Media $media
     * @return void
     */
    private static function createMedia(Media $media)
    {
        if (Media::TYPE_VIDEO == $media->getType() && $media->getVideoStandardResolutionUrl()) {
            return ['type' => Media::TYPE_VIDEO, 'url' => [
                'low'       => $media->getVideoLowResolutionUrl(),
                'standard'  => $media->getVideoStandardResolutionUrl() ?: $media->getVideoLowResolutionUrl(),
                'bandwidth' => $media->getVideoLowBandwidthUrl()
            ] ];
        }
        return ['type' => Media::TYPE_IMAGE, 'url' => [
            'thumbnail' => $media->getImageThumbnailUrl(),
            'low'       => $media->getImageLowResolutionUrl(),
            'standard'  => $media->getImageStandardResolutionUrl() ?: $media->getImageThumbnailUrl(),
            'high'      => $media->getImageHighResolutionUrl(),
        ]];
    }
}
