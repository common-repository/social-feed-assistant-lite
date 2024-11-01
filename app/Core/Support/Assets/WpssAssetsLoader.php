<?php

namespace App\Core\Support\Assets;

defined('ABSPATH') || exit('no access');

final class WpssAssetsLoader
{
    private static $instance;
    private $prefix;

    private function __construct(string $prefix)
    {
        return $this->setPrefix($prefix);
    }

    /**
     * @param  mixed  $prefix
     *
     * @return \App\Core\Support\Assets\WpssAssetsLoader
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * register style handler on wordpress
     *
     * @param  string  $handle
     * @param  string  $src
     * @param  array  $deps
     * @param  bool  $ver
     * @param  string  $media
     *
     * @return $this
     */
    public function registerStyle(string $handle, string $src, array $deps = [], bool $ver = false, string $media = 'all'): self
    {
        wp_register_style($this->prefix . "_{$handle}", $src, $deps, $ver, $media);

        return $this;
    }

    /**
     * register script handler on wordpress
     *
     * @param  string  $handle
     * @param  string  $src
     * @param  array  $deps
     * @param  bool  $ver
     * @param  bool  $in_footer
     *
     * @return $this
     */
    public function registerScript(string $handle, string $src, array $deps = [], bool $ver = false, bool $in_footer = false): self
    {
        wp_register_script($this->prefix . "_{$handle}", $src, $deps, $ver, $in_footer);

        return $this;
    }

    /**
     * @param  string  $handle
     * @param  string  $src
     * @param  array  $deps
     * @param  bool  $ver
     * @param  string  $media
     *
     * @return $this
     */
    public function enqueueStyle(string $handle, string $src = '', array $deps = [], bool $ver = false, string $media = 'all'): self
    {
        wp_enqueue_style($this->prefix . "_{$handle}", $src, $deps, $ver, $media);

        return $this;
    }

    /**
     * enqueue registered script
     *
     * @param  string  $handle
     * @param  string  $src
     * @param  array  $deps
     * @param  bool  $ver
     * @param  bool  $in_footer
     *
     * @return $this
     */
    public function enqueueScript(string $handle, string $src = '', array $deps = [], bool $ver = false, bool $in_footer = false): self
    {
        wp_enqueue_script($this->prefix . "_{$handle}", $src, $deps, $ver, $in_footer);
        return $this;
    }

    /**
     * enqueue wordpress core media scripts
     */
    public function enqueueMedia()
    {
        wp_enqueue_media();

        return $this;
    }

    /**
     * @param  string  $handle
     * @param  string  $objectName
     * @param  array  $data
     *
     *  localize object before script loaded
     *
     * @return $this
     */
    public function localizeScript(string $handle, string $objectName, array $data): self
    {
        wp_localize_script($this->prefix . "_{$handle}", $objectName, $data);

        return $this;
    }

    public static function getInstance(string $prefix = 'wp-ss')
    {
        if (null === self::$instance) {
            self::$instance = new self($prefix);
        }

        return self::$instance;
    }
}
