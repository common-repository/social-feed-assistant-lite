<?php

defined('ABSPATH') || exit('no access');

return [
	'social-stream' => [
		'/accounts'           => 'SfalAccountsTemplateController@accounts',
		'/accounts/new'       => 'SfalAccountsTemplateController@new',
		'/accounts/edit/{id}' => 'SfalAccountsTemplateController@edit',
		'/accounts/list'      => 'SfalAccountsTemplateController@table',
		'/404'                => 'SfalNotFoundTemplateController@err404',
	],
	'social-feed'   => [
		'/feeds'			 => 'SfalFeedsTemplateController@feeds',
		'/feeds/new' 		 => 'SfalFeedsTemplateController@new',
		'/feeds/edit/{id}'   => 'SfalFeedsTemplateController@edit',
		'/streams'           => 'SfalStreamsTemplateController@streams',
		'/streams/new'       => 'SfalStreamsTemplateController@new',
		'/streams/edit/{id}' => 'SfalStreamsTemplateController@edit',
		'/settings' 		 => 'SfalSettingsTemplateController@index',
	],
];
