<?php

date_default_timezone_set('Asia/Jakarta');
$_SERVER['CI_ENV'] = 'development'; // ci env: development, testing, production

$config['web'] = [
	'base_url' => 'http://localhost/ukk_lelang/', // base url
	'title' => 'LELANG', // title web
	'meta' => [
		'description' => 'LELANG', // deskripsi web
		'author' => 'LELANG', // author web
		'keywords' => 'LELANG', // keyword web
	],
	'favicon' => '',
];

$config['db'] = [
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'ukk_lelang'
];
