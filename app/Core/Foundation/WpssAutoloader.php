<?php

namespace App\Core\Foundation;

defined('ABSPATH') || exit('no access');

final class WpssAutoloader
{
    private static $baseRoot;

    /**
     * this method register plugin all autoloader
     */
    public static function register(string $baseRoot)
    {
        self::$baseRoot = $baseRoot;
        self::initComposerAutoload();
    }

    /**
     * this method will initial composer created autoloader for load whole plugin classes
     */
    private static function initComposerAutoload()
    {
        require_once self::$baseRoot . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
    }
}
