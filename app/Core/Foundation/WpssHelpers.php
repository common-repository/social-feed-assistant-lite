<?php

defined('ABSPATH') || exit('no access');

use App\Core\Support\Views\WpssViewsLoader as View;
use App\Core\Support\Config\WpssConfigService as Config;
use App\Core\Support\Request\WpssRequest as Request;

if (! function_exists('WpssConfig')) :
    function WpssConfig(string $key = '')
    {
        if (! $key) {
            return Config::getInstance(WPSS_PATH);
        }

        return Config::getInstance(WPSS_PATH)->get($key);
    }
endif;

if (! function_exists('WpssViews')) :
    function WpssViews(string $view = '', array $data = [])
    {
        if (! $view) {
            return View::getInstance((string) WpssConfig('app.viewPath'));
        }

        return View::getInstance((string) WpssConfig('app.viewPath'))->load($view, $data);
    }
endif;

if (! function_exists('WpssRequest')) :
    function WpssRequest(string $key = '')
    {
        if ($key) {
            return Request::getInstance()->param($key);
        }

        return Request::getInstance();
    }
endif;

if (! function_exists('WpssInput')) :
    function WpssInput(string $key)
    {
        return WpssRequest($key);
    }
endif;

if (! function_exists('WpssRemoveWhitespaces')) :
    function WpssRemoveWhitespaces(string $string)
    {
        return preg_replace('/\s+/', '', $string);
    }
endif;

if (! function_exists('WpssJsonCleanDecode')) :
    function WpssJsonCleanDecode($json, $assoc = false, $depth = 512, $options = 0)
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
if (! function_exists('WpssNumberFormatShort')) :
    function WpssNumberFormatShort(int $number)
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
