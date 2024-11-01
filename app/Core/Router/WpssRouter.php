<?php

namespace App\Core\Router;

defined('ABSPATH') || exit('no access');

class WpssRouter
{
    private static $routes = [];
    private static $regexs = [
        '/^\//'         => '',
        '/\//'          => '\\/',
        '/\{([\w]+)\}/' => '(?<\1>[\w\n-]+)',
    ];
    private static $baseController = 'App\Core\Router\Templates\Controllers\\';
    /**
     * @var
     *
     * params for each route
     *
     */
    private static $params;

    /**
     * @param  string  $route
     * @param $params
     *
     * add new route to routes property
     *
     * @return self
     */
    public static function add(string $route, $params)
    {
        $route = self::convertToRegex($route);

        $controllerAndMethod = self::getControllerAndMethod($params);

        $params = self::mergeParams($controllerAndMethod, $params);

        self::$routes[ $route ] = $params;

        return new static();
    }

    /**
     * @param  string  $route
     *
     * dispatch and get route template
     *
     * @return bool|mixed
     */
    public static function dispatch(string $route)
    {
        if (false === ($params = self::match($route))) {
            return false;
        }

        $controller = self::getController();

        if (! class_exists($controller)) {
            return false;
        }

        $method = self::getMethod();

        $params['params'] = $params['params'] ?? [];

        return call_user_func_array([ $controller, $method ], $params['params']);
    }

    /**
     * @param  string  $endpoint
     *
     * check is route match with routes list
     *
     * @return array|bool|mixed
     */
    private static function match(string $endpoint)
    {
        foreach (self::$routes as $route => $params) {
            if (! preg_match($route, $endpoint, $matches)) {
                continue;
            }
            $params = self::setMatchParams((array) $matches, $params);

            return self::$params = $params;
        }

        return false;
    }

    /**
     * @param  array  $matches
     * @param  array  $params
     *
     * return matched route params
     *
     * @return array
     */
    private static function setMatchParams(array $matches, array $params): array
    {
        foreach ($matches as $key => $match) {
            if (! is_string($key)) {
                continue;
            }
            $params['params'][ $key ] = $match;
        }

        return $params;
    }

    /**
     * @param $params
     *
     * return controller and method route with param that
     *
     * @return array
     */
    private static function getControllerAndMethod($params): array
    {
        if (is_string($params)) {
            list($controllerAndMethod['controller'], $controllerAndMethod['method']) = explode('@', $params);
        }

        if (is_array($params)) {
            list($controllerAndMethod['controller'], $controllerAndMethod['method']) = explode('@', $params['uses']);
        }

        return $controllerAndMethod ?? [];
    }

    /**
     * @param  array  $controllerAndMethod
     * @param $params
     *
     * merge controllerAndMethod with route params
     *
     * @return array
     */
    private static function mergeParams(array $controllerAndMethod, $params): array
    {
        if (! is_array($params)) {
            return $controllerAndMethod;
        }

        unset($params['uses']);

        return array_merge($controllerAndMethod, $params);
    }

    /**
     * @param  string  $route
     *
     * convert route to regex
     *
     * @return string
     */
    private static function convertToRegex(string $route): string
    {
        $route = preg_replace(array_keys(self::$regexs), self::$regexs, $route);

        return "/^\/?{$route}\/?$/i";
    }

    /**
     *
     * return controllerNamespace
     *
     * @return string
     */
    private static function getControllerNameSpace(): string
    {
        $namespace = array_key_exists('namespace', (array) self::$params) ? self::$params['namespace'] : self::$baseController;

        if (array_key_exists('BaseController', (array) self::$params)) {
            $namespace .= self::$params['BaseController'] . '\\';
        }

        return $namespace;
    }

    /**
     *
     * return route controller
     *
     * @return string
     */
    private static function getController(): string
    {
        return self::getControllerNameSpace() . self::$params['controller'];
    }

    /**
     *
     * return route method
     *
     * @return string
     */
    private static function getMethod(): string
    {
        return self::$params['method'];
    }
}
