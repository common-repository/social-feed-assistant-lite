<?php

namespace App\Core\Support\Request;

defined('ABSPATH') || exit('no access');

class WpssRequest
{
    private static $instance;
    public $method;
    public $uri;
    private $params;
    private $ip;
    private $agent;

    /**
     * WpssRequest constructor.
     */
    public function __construct()
    {
        $this->agent  = $_SERVER['HTTP_USER_AGENT'];
        $this->ip     = $_SERVER['REMOTE_ADDR'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri    = $_SERVER['REQUEST_URI'];
        $this->params = $_REQUEST;
    }

    /**
     * @param  string  $key
     *
     * @return string
     */
    public function param(string $key)
    {
        $val = $this->params[$key] ?? null;
        if (is_array($val)) {
            return array_map('sanitize_text_field', $val);
        }
        return sanitize_text_field($val ?? null);
    }

    /**
     * @return mixed
     */
    public function params()
    {
        return $this->params;
    }

    /**
     * @param  array  $keys
     *
     * @return array
     */
    public function only(array $keys)
    {
        if (empty($keys)) {
            return [];
        }

        return array_filter($this->params, function ($k) use ($keys) {
            if (in_array($k, $keys)) {
                return true;
            }
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * @param  array  $keys
     *
     * @return array
     */
    public function except(array $keys = [])
    {
        if (empty($keys)) {
            return $this->params;
        }

        return array_filter($this->params, function ($k) use ($keys) {
            if (! in_array($k, $keys)) {
                return true;
            }
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * @param  string  $name
     *
     * @return string
     */
    public function __get(string $name)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->param($name);
        }
    }

    /**
     * @param  string  $key
     *
     * @return bool
     */
    public function keyExists(string $key)
    {
        return isset($this->params[ $key ]);
    }

    /**
     * @param  string  $key
     */
    public function removeParam(string $key)
    {
        unset($this->params[ $key ]);
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->method == 'POST';
    }

    /**
     * @param  string  $location
     * @param  int  $status
     * @param  string  $x_redirect_by
     */
    public static function redirect(string $location, int $status = 302, string $x_redirect_by = 'WordPress')
    {
        wp_redirect($location, $status, $x_redirect_by);
    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
