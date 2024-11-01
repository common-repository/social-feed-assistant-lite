<?php

namespace App\Core\Foundation\Facades;

defined('ABSPATH') || exit('no access');

final class WpssModuleActivatorFacade
{
    /**
     * this will first get activated modules , then will load its one by one
     *
     * @param  array  $modules
     */
    public static function includeModules(array $modules)
    {
        $activatedModules = self::getActivatedModules();
        foreach ($modules as $name => $path) {
            if (in_array($name, $activatedModules)) {
                self::includeModule($path);
            }
        }
    }

    /**
     *
     * this will get activated modules from plugin settings on database , then return them
     *
     * @return array
     */
    private static function getActivatedModules(): array
    {
        return [
            'social-feed',
        ];
    }

    /**
     *
     * this will first resolved module path , and then if it was readable include it
     *
     * @param  string  $path
     */
    private static function includeModule(string $path)
    {
        $resolvedPath = self::resolvePath($path);
        if (is_readable($resolvedPath)) {
            require_once $resolvedPath;
        }
    }

    /**
     * this will resolve module path with contact it on plugin base path
     *
     * @param  string  $path
     *
     * @return string
     */
    private static function resolvePath(string $path)
    {
        return WpssConfig('app.modulesPath') . $path;
    }
}
