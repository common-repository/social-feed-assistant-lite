<?php

defined('ABSPATH') || exit('no access');

use SFAL\Admin\Menus\Controllers\SfalDashboardController;
use SFAL\Admin\Menus\Controllers\SfalGeneralSettingsController;
use SFAL\Admin\Menus\Controllers\SfalSocialFeedController;

return [
	'social-stream' => [
		'dashboard' => [
			'parent'	 => 'dashboard',
			'page_title' => __( 'SFAL-Dashboard', 'sfal' ),
			'menu_title' => __( 'Dashboard', 'sfal' ),
			'capability' => 'manage_options',
			'function'   => [ SfalDashboardController::class, 'index' ],
			'icon'       => 'dashicons-instagram',
			'loaded'     => [  SfalDashboardController::class, 'loaded' ],
		],
		'general-settings' => [
			'parent'	 => 'dashboard',
			'page_title' => __( 'SFAL-General-settings', 'sfal' ),
			'menu_title' => __( 'General Settings', 'sfal' ),
			'capability' => 'manage_options',
			'function'   => [ SfalGeneralSettingsController::class, 'index' ],
			'icon'       => 'dashicons-settings',
			'loaded'     => [  SfalGeneralSettingsController::class, 'loaded' ],
		],
	],
	'social-feed'   => [
		'social-feed' => [
			'parent'     => 'dashboard',
			'page_title' => __( 'SFAL-Social-feed', 'sfal' ),
			'menu_title' => __( ' Social Feed Assistant', 'sfal' ),
			'capability' => 'manage_options',
			'function'   => [ SfalSocialFeedController::class, 'index' ],
			'loaded'     => [ SfalSocialFeedController::class, 'loaded' ],
			'prefix'     => 'sfal',
		],
	],
];