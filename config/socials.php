<?php

defined('ABSPATH') || exit('no access');

use SFAL\Core\Socials\Instagram\SfalInstagram as Instagram;

return [
	'instagram' => [
		'id'    => 'instagram',
		'title' => __( 'instagram', 'sfal' ),
		'icon'  => 'lni-instagram-original',
		'class' => Instagram::class,
	]
];
