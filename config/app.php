<?php

defined('ABSPATH') || exit('no access');

return [
	'basePath'    => SFAL_PATH,
	'relPath'     => SFAL_REL_PATH,
	'baseUrl'     => SFAL_URL,
	'ajaxUrl'     => trailingslashit( SFAL_URL . 'bootstrap/ajax.php' ),
	'storage'     => trailingslashit( SFAL_PATH . 'storage' ),
	'modulesPath' => trailingslashit( SFAL_PATH . 'app' . DIRECTORY_SEPARATOR . 'Modules' ),
	'distUrl'     => trailingslashit( SFAL_URL . 'resources/dist/' ),
	'assetsUrl'   => trailingslashit( SFAL_URL . 'resources/assets/' ),
	'viewPath'    => trailingslashit( SFAL_PATH . 'resources' . DIRECTORY_SEPARATOR . 'views' ),
];
