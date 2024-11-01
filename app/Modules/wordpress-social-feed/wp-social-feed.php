<?php

/**
 * Wordpress Social Feed Plugin
 *
 * @wordpress-plugin
 * Plugin Name: Wordpress Social Feed
 * Plugin URI: http://www.google.com
 * Description: A Amazing plugin for Social Feed on Wordpress.
 * Version: 1.0.0
 * Requires at least: 5.0.0
 * Requires PHP: 7.0.0
 * Author: ebrahim
 * Author URI: https://virgool.io/@a3raham
 * Developer: a3raham
 * Developer URI: https://virgool.io/@a3raham
 * Text Domain: wp-sf
 * Domain Path: /languages
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

use WPSF\Init\WpsfCore;
use WPSF\Init\WpsfInstall;

defined('ABSPATH') || exit('no access');

final class WPSF
{
    /**
     * Wordpress social feed current version
     */
    const VERSION = '1.0.0';
    const DB_VERSION = '1';
    /**
     * Wordpress social feed prefix
     */
    const PLUGIN_PREFIX = 'wpsf';

    private static $instance;

    public function __construct()
    {
        $this->defineConstant();
    }

    /**
     * this will define plugin base constants
     */
    private function defineConstant()
    {
        define('WPSF_PATH', plugin_dir_path(__FILE__));
        define('WPSF_URL', plugin_dir_url(__FILE__));
    }

    /**
     * this will init plugin base actions , etc : activation , deactivation , uninstall
     */
    public function init()
    {
        if ($this->isSinglePlugin()) {
            register_activation_hook(__FILE__, [ $this, 'activation' ]);
            register_activation_hook(__FILE__, [ $this, 'deactivation' ]);
            register_uninstall_hook(__FILE__, [ self::class, 'uninstall' ]);
        } else {
            $this->activation();
        }

        WpsfCore::init(self::VERSION, self::PLUGIN_PREFIX);
    }

    /**
     * this will call on plugin will be active
     */
    private function activation()
    {
        WpsfInstall::activate();
    }

    /**
     * this will call on plugin will be deactivate
     */
    private function deactivation()
    {
    }

    /**
     * this will call on plugin will be uninstall
     */
    private function uninstall()
    {
    }

    public function getPrefix() : string
    {
        return (string) self::PLUGIN_PREFIX;
    }

    /**
     * Create an instance from WPSS class.
     *
     * @access public
     * @return \WPSF
     */
    public static function instance(): self
    {
        if (! self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function isSinglePlugin()
    {
        return false;
    }
}

if (! function_exists('WPSF')) :
    function WPSF()
    {
        return WPSF::instance();
    }
endif;

WPSF()->init();
