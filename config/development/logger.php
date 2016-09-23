<?php
/**
 * 日志信息配置
 * @author phachon@163.com
 */
return array(

	/**
	 * 行为日志（数据库）
	 */
	'behave_log' => array(
		'type' => 'database',
		'parameters' => array (
			'group' 	 => 'grab',
			'table'      => 'log',
			'slice'		 => '',
		),
		'columns' => array(
			'message' => '',
			'ip' => Request::$client_ip,
			'referer' => Request::current()->referrer(),
			'user_agent' => Request::$user_agent,
			'account_id' => '',
			'account_name' => '',
			'create_time' => time(),
		),
	),

	/**
	 * 下载日志（数据库）
	 */
	'grab_log_download' => array(
		'type' => 'database',
		'parameters' => array (
			'group' 	 => 'grab',
			'table'      => 'log_download',
			'slice'		 => '',
		),
		'columns' => array(
			'message' => '',
			'level' => 0,
			'extra' => '',
			'url_id' => 0,
			'create_time' => time(),
		),
	),
);
