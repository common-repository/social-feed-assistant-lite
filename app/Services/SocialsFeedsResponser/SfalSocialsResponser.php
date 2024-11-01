<?php

namespace SFAL\Services\SocialsFeedsResponser;

defined('ABSPATH') || exit('no access');

use Exception;
use SFAL\Services\SocialsFeedsResponser\Responders\SfalInstagramFeedsResponder;
class SfalSocialsResponser
{
    public static function get(int $feed, string $social, string $type, array $contents, int $account = 0, array $excludes = [], array $includes = [], int $count = 0)
    {
        $responders = [
            'instagram' => SfalInstagramFeedsResponder::class
        ];

        if(!array_key_exists($social, $responders)) {
            throw new Exception(__('social is not valid', 'sfal'));
        }

        return $responders[$social]::response( $feed, $type, $contents, $account, $excludes, $includes, $count ) ?? [[], []];
    }
}