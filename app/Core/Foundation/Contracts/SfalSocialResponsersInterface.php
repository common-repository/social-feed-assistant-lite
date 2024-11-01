<?php

namespace SFAL\Core\Foundation\Contracts;

use stdClass;

interface SfalSocialResponsersInterface
{
    public static function make(int $feedId, int $contentId, string $content, stdClass $account, int $count, array $mediaLinks, stdClass $feed);
}