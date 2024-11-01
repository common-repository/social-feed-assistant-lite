<?php

namespace App\Core\Support\Config;

defined('ABSPATH') || exit('no access');

use App\Core\Support\Config\Contract\WpssConfigContract;

final class WpssConfigService implements WpssConfigContract
{
    const CONFIG_PATH = 'config';

    private $path;
    private $configs = [];
    private static $instance;

    /**
     * WpssConfigService constructor.
     *
     * @param  string  $path
     */
    private function __construct(string $path)
    {
        $this->path = trailingslashit($path . DIRECTORY_SEPARATOR . self::CONFIG_PATH);
    }

    /**
     * @param  string  $config
     *
     * @return array|null
     */
    public function get(string $config)
    {
        list($file, $configPath) = $this->resolveConfigString($config);

        if (empty($configPath)) {
            return $this->all($config);
        }

        $config = $this->getConfig($file);

        return (! is_null($config)) ? $this->getValue($config->toArray(), $configPath) : null;
    }

    /**
     * @param  string  $config
     *
     * @return bool
     */
    public function has(string $config)
    {
        return ($this->get($config)) ? true : false;
    }

    /**
     * @param  string  $config
     *
     * @return array
     */
    public function all(string $config)
    {
        $file   = $this->resolveConfigString($config)[0];
        $config = $this->getConfig($file);

        return (! is_null($config)) ? $config->toArray() : [];
    }

    /**
     * @param $config
     * @param  array  $path
     *
     * @return mixed
     */
    private function getValue($config, array $path)
    {
        if (empty($path)) {
            return $config;
        }

        $key = array_shift($path);

        return $this->getValue($config[ $key ], $path);
    }

    /**
     * @param  string  $file
     *
     * @return string
     */
    private function resolveFileName(string $file)
    {
        return "{$this->path}{$file}.php";
    }

    /**
     * @param  string  $file
     *
     * @return mixed|null
     */
    private function read(string $file)
    {
        $fileName = $this->resolveFileName($file);

        return (file_exists($fileName)) ? require_once($fileName) : null;
    }

    /**
     * @param  string  $file
     *
     * @return \App\Core\Support\Config\WpssConfig
     */
    private function loadConfig(string $file)
    {
        $content = $this->read($file);

        return (null !== $content) ? new WpssConfig($content) : null;
    }

    /**
     * @param  string  $name
     *
     * @return \App\Core\Support\Config\WpssConfig|mixed|null
     */
    private function getConfig(string $name)
    {
        if (! array_key_exists($name, $this->configs)) {
            return $this->configs[ $name ] = $this->loadConfig($name);
        }

        return $this->configs[ $name ];
    }

    /**
     * @param  string  $strConfig
     *
     * @return array
     */
    private function resolveConfigString(string $strConfig)
    {
        $tokens = $this->getStrConfigTokens($strConfig);
        $file   = array_shift($tokens);

        return [ $file, $tokens ];
    }

    /**
     * @param  string  $strConfig
     *
     * @return array
     */
    private function getStrConfigTokens(string $strConfig): array
    {
        return explode('.', $strConfig);
    }

    /**
     * @param  string  $path
     *
     * @return static
     */
    public static function getInstance(string $path)
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($path);
        }

        return self::$instance;
    }
}
