<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'default' => array
	(
		'type'       => 'PDO',
		'connection' => array(
			'dsn'        => 'mysql:host=localhost;port=3306;dbname=pha_grab_video;charset=utf8',
			'username'   => 'root',
			'password'   => '123456',
			'persistent' => FALSE,
		),
		'table_prefix' => 'grab_',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
	
	'grab' => array
	(
		'type'       => 'PDO',
		'connection' => array(
			'dsn'        => 'mysql:host=localhost;port=3306;dbname=pha_grab_video;charset=utf8',
			'username'   => 'root',
			'password'   => '123456',
			'persistent' => FALSE,
		),
		'table_prefix' => 'grab_',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
);