<?php
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
	'namespace' => 'App\Api\V1\Auth',

	'middleware' => [
		'api.throttle',
	],

	'limit' => app('config')['app']['rate_limit'], 'expires' => 1,

], function ($api) {
	$api->post('/auth', [
		'as' => 'user.login',
		'uses' => 'AuthController@auth'
	]);
});