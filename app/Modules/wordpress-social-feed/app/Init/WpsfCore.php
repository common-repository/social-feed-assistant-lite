<?php

namespace WPSF\Init;

defined('ABSPATH') || exit('no access');

use WPSF\Ajax\WpsfAjax;
use WPSF\Admin\WpsfAdmin;
use App\Core\Foundation\Contracts\WpssBaseCore;
use App\Core\Support\Shortcode\WpssShortcodeHandler;
use WPSF\Init\Activator\WpsfCheckCronActivator;
use WPSF\Shortcodes\WpsfShowStreamShortcode;
use WPSF\User\WpsfUser;

class WpsfCore extends WpssBaseCore
{
    private static $prefix;
    private static $version;

    protected static function setVersion(string $version)
    {
        self::$version = $version;
    }

    protected static function setPrefix(string $prefix)
    {
        self::$prefix = $prefix;
    }

    /**
     * @inheritDoc
     */
    protected static function everyWhere()
    {
        WpsfCheckCronActivator::removeRebuildCacheEvent();
        add_action('init', function () {
            WpssShortcodeHandler::add('wp-sfstream', [ WpsfShowStreamShortcode::class, 'handle' ]);
        });
    }

    /**
     * @inheritDoc
     */
    protected static function admin()
    {
        WpsfAdmin::init(self::$prefix, self::$version);
    }

    /**
     * @inheritDoc
     */
    protected static function frontend()
    {
        WpsfUser::init(self::$prefix, self::$version);
    }

    /**
     * @inheritDoc
     */
    protected static function ajax()
    {
        WpsfAjax::init(self::$prefix, self::$version);
    }

    /**
     * @inheritDoc
     */
    protected static function doIncludes()
    {
        // TODO: Implement doIncludes() method.
    }
}
