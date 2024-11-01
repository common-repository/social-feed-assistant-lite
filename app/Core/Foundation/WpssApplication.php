<?php

namespace App\Core\Foundation;

use App\Core\Foundation\Init\WpssCore;
use App\Core\Foundation\Init\WpssInstall;
use App\Core\Foundation\Uninstall\WpssUninstall;

defined('ABSPATH') || exit('no access');

final class WpssApplication
{
    /**
     * Application current version
     */
    const VERSION = '1.0.0';
    const DB_VERSION = '1';

    /**
     * Application prefix
     */
    const PLUGIN_PREFIX = 'wpss';

    /**
     * Application required php version
     */
    const PHPVER = '7.0.0';

    private static $instance;
    private static $baseFile;
    private $isPossibleToRun = false;

    /**
     * this will initialize and bootstrap application
     *
     * @return bool
     */
    public function bootstrap(string $base)
    {
        self::$baseFile = $base;
        if (! $this->isPossibleToRun()) {
            return false;
        }
        $this->init();
    }

    /**
     * this will init plugin base actions , etc : activation , deactivation , uninstall
     */
    public function init()
    {
        register_activation_hook(self::$baseFile, [ $this, 'activation' ]);
        register_activation_hook(self::$baseFile, [ $this, 'deactivation' ]);
        register_uninstall_hook(self::$baseFile, [ self::class, 'uninstall' ]);

        WpssCore::init(self::VERSION, self::PLUGIN_PREFIX);
    }

    public function activation()
    {
        WpssInstall::activate();
    }

    public function deactivation()
    {
        WpssUninstall::deactivation();
    }

    public static function uninstall()
    {
        WpssUninstall::uninstall();
    }

    public function getPrefix(): string
    {
        return self::PLUGIN_PREFIX;
    }

    /**
     * get new instance of this class
     * this method handle class with singleton design pattern
     *
     * @return static
     */
    public static function get(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * this will echo error on wordpress admin top
     *
     * @param  string  $error
     */
    private function printError(string $error)
    {
        printf('<div class="error"><p> %s </p></div>', $error);
    }

    /**
     * this will check php version requirement for this plugin
     *
     * @return bool
     */
    private function phpRequire()
    {
        if (version_compare(phpversion(), self::PHPVER, '>=')) {
            return true;
        }

        $error = sprintf(esc_html__('WpSs ( Wordpress Social Stream ) requires PHP%s to be run current!', 'wp-ss'), self::PHPVER);
        $this->printError($error);

        return false;
    }

    /**
     * this will check php requirements before run and initialize
     */
    private function isPossibleToRun()
    {
        return $this->isPossibleToRun = $this->phpRequire();
    }
}
