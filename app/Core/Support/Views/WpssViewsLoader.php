<?php

namespace App\Core\Support\Views;

defined('ABSPATH') || exit('no access');

final class WpssViewsLoader
{
    private static $instance = null;
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     *
     * @param  string  $view
     * @param  array  $data
     */
    public function load(string $view, array $data = [])
    {
        $resolvedPath = $this->resolvePath($view);
        $this->validatePath($resolvedPath);

        if ($data) {
            extract($data);
        }

        require $resolvedPath;
    }

    /**
     * this will return loaded path
     *
     * @param  string  $view
     * @param  array  $data
     *
     * @return false|string
     */
    public function get(string $view, array $data = [])
    {
        ob_start();
        $this->load($view, $data);

        return ob_get_clean();
    }

    /**
     * this will resolve and convert path to valid format
     *
     * @param  string  $view
     *
     * @return string
     */
    private function resolvePath(string $view)
    {
        $resolvedFormattedPath = $this->resolvePathFormat($view);

        return $this->resolveFullPath($resolvedFormattedPath);
    }

    /**
     * @param  string  $view
     *
     * @return string|string[]
     */
    private function resolvePathFormat(string $view)
    {
        return str_replace('.', DIRECTORY_SEPARATOR, $view);
    }

    /**
     * @param  string  $path
     *
     * @return string
     */
    private function resolveFullPath(string $path)
    {
        return $this->path . $path . '.php';
    }

    /**
     *
     * this will check is file readable and exists
     *
     * @param  string  $path
     *
     * @return bool
     */
    private function isValidPath(string $path)
    {
        return is_readable($path);
    }

    /**
     * this will check is view path valid , if it wasn't exists and readable file wp_die and exception error
     *
     * @param  string  $path
     */
    private function validatePath(string $path)
    {
        if (! $this->isValidPath($path)) {
            wp_die(sprintf(__('the view path : %s to be loaded is not exists', 'wp-ss'), $path));
        }
    }

    /**
     * @param  string  $path
     *
     * @return \App\Core\Support\Views\WpssViewsLoader
     */
    public static function getInstance(string $path): self
    {
        if (null === self::$instance) {
            self::$instance = new static($path);
        }

        return self::$instance;
    }
}
