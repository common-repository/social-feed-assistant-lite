<?php

namespace WPSF\Services\StreamRenderer\Utils;

defined('ABSPATH') || exit('no access');
class WpsfStreamSettingsUtil
{
    /**
     * @param \stdClass $options
     * @return boolean
     */
    public static function isPossibleToShow(\stdClass $options) : bool
    {
        $mobile = self::isMobileDevice();

        if ($mobile && $options->general->hideStreamOnMobile) {
            return false;
        }

        if (! $mobile && $options->general->hideStreamOnDesktop) {
            return false;
        }

        if (! is_user_logged_in() && $options->general->privateStream) {
            return false;
        }

        return true;
    }
    
    /**
     * @return boolean
     */
    private static function isMobileDevice() : bool
    {
        return (bool) preg_match(
            "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
            $_SERVER["HTTP_USER_AGENT"]
        );
    }
}
