<?php

defined('ABSPATH') || exit('no access');

use SFAL\Admin\Menus\Controllers\SfalDashboardController;

return [
	'social-stream' => [
		'dashboard' => [
			'page_title' => __( 'SFAL-Dashboard', 'sfal' ),
			'menu_title' => __( 'Feed Assistant', 'sfal' ),
			'capability' => 'manage_options',
			'function'   => [ SfalDashboardController::class, 'index' ],
			'icon'       => 'dashicons-instagram',
			'loaded'     => [  SfalDashboardController::class, 'loaded' ],
		],
	],
];