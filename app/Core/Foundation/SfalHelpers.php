<?php

defined('ABSPATH') || exit('no access');

use SFAL\Core\Repository\Factory\SfalRepositoryFactory;
use SFAL\Core\Support\Views\SfalViewsLoader as View;
use SFAL\Core\Support\Config\SfalConfigService as Config;
use SFAL\Core\Support\Request\SfalRequest as Request;

if (! function_exists('SfalConfig')) :
    function SfalConfig(string $key = '')
    {
        if (! $key) {
            return Config::getInstance(SFAL_PATH);
        }

        return Config::getInstance(SFAL_PATH)->get($key);
    }
endif;

if (! function_exists('SfalViews')) :
    function SfalViews(string $view = '', array $data = [])
    {
        if (! $view) {
            return View::getInstance((string) SfalConfig('app.viewPath'));
        }

        return View::getInstance((string) SfalConfig('app.viewPath'))->load($view, $data);
    }
endif;

if (! function_exists('SfalRequest')) :
    function SfalRequest(string $key = '')
    {
        if ($key) {
            return Request::getInstance()->param($key);
        }

        return Request::getInstance();
    }
endif;

if (! function_exists('SfalTransaction')) :
    function SfalTransaction(callable $func)
    {
        return SfalRepositoryFactory::make('streams')->transaction($func);
    }
endif;

if (! function_exists('SfalInput')) :
    function SfalInput(string $key)
    {
        return SfalRequest($key);
    }
endif;

if (! function_exists('SfalRemoveWhitespaces')) :
    function SfalRemoveWhitespaces(string $string)
    {
        return preg_replace('/\s+/', '', $string);
    }
endif;

if (! function_exists('SfalJsonCleanDecode')) :
    function SfalJsonCleanDecode($json, $assoc = false, $depth = 512, $options = 0)
    {
        // search and remove comments like /* */ and //
        $json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $json);
        $json = stripslashes($json);

        if (version_compare(phpversion(), '5.4.0', '>=')) {
            return json_decode($json, $assoc, $depth, $options);
        }

        if (version_compare(phpversion(), '5.3.0', '>=')) {
            return json_decode($json, $assoc, $depth);
        }

        return json_decode($json, $assoc);
    }
endif;

// this function convert numbers for short formats
if (! function_exists('SfalNumberFormatShort')) :
    function SfalNumberFormatShort(int $number)
    {

        // 1 - 999
        $n_format = floor($number);
        $suffix   = '';

        switch (true) {
            case $number >= 1000 && $number < 1000000:
                // 1k-999k
                $n_format = floor($number / 1000);
                $suffix   = 'K+';
                break;
            case $number >= 1000000 && $number < 1000000000:
                // 1m-999m
                $n_format = floor($number / 1000000);
                $suffix   = 'M+';
                break;
            case $number >= 1000000000 && $number < 1000000000000:
                // 1b-999b
                $n_format = floor($number / 1000000000);
                $suffix   = 'B+';
                break;
            case   $number >= 1000000000000:
                // 1t+
                $n_format = floor($number / 1000000000000);
                $suffix   = 'T+';
                break;
        }

        return ! empty($n_format . $suffix) ? $n_format . $suffix : 0;
    }

endif;

if(! function_exists('SfalArrayMapRecursive')) :
    function SfalArrayMapRecursive(callable $callback, array $array)
    {
      $func = function ($item) use (&$func, &$callback) {
        return is_array($item) ? array_map($func, $item) : call_user_func($callback, $item);
      };
    
      return array_map($func, $array);
    }
endif;
