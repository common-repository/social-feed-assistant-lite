<?php
/**
 * Wordpress iThemelandco Social Feed Assistant Lite
 *
 * @wordpress-plugin
 *
 * Plugin Name: iThemelandco Social Feed Assistant Lite
 * Plugin URI: https://www.ithemelandco.com/Plugins/Social-Feed-Assistant
 * Description: An Amazing plugin for manage your socials feeds with your own wordpress site - Lite
 * Version: 1.1.0
 * Author: iThemelandCo
 * Author URI: https://www.ithemelandco.com
 * Requires at least: 5.0.0
 * Requires PHP: 7.0.0
 * Text Domain: sfal
 * Domain Path: /languages
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

// If this file is called directly , then abort execution.
defined('ABSPATH') || exit('no access');

use SFAL\Core\Foundation\SfalAutoloader;

// Standard define.
define('SFAL_PATH', plugin_dir_path(__FILE__));
define('SFAL_REL_PATH', dirname(plugin_basename( __FILE__ )));
define('SFAL_URL', plugin_dir_url(__FILE__));

if (! class_exists('SfalAutoloader')) {
    require_once SFAL_PATH . 'app' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'Foundation' . DIRECTORY_SEPARATOR . 'SfalAutoloader.php';
    SfalAutoloader::register(SFAL_PATH);
}

$app = require_once SFAL_PATH . 'bootstrap' . DIRECTORY_SEPARATOR . 'app.php';
$app->bootstrap(__FILE__);
