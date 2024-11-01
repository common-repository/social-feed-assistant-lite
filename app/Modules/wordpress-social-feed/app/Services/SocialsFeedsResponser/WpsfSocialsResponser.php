<?php

namespace WPSF\Services\SocialsFeedsResponser;

defined('ABSPATH') || exit('no access');

use Exception;
use WPSF\Services\SocialsFeedsResponser\Responders\WpsfInstagramFeedsResponder;

class WpsfSocialsResponser
{
    public static function get(int $feed, string $social, string $type, array $contents, int $account = 0, array $excludes = [], array $includes = [], int $count = 0)
    {
        $responders = [
            'instagram' => WpsfInstagramFeedsResponder::class
        ];

        if(!array_key_exists($social, $responders)) {
            throw new Exception(__('social is not valid', 'wp-ss'));
        }

        return $responders[$social]::response( $feed, $type, $contents, $account, $excludes, $includes, $count ) ?? [[], []];
    }
}