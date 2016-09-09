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
	 * 抓取视频日志（数据库）
	 */
	'video_log' => array(
		'type' => 'database',
		'parameters' => array (
			'group' 	 => 'grab',
			'table'      => 'log_video',
			'slice'		 => '',
		),
		'columns' => array(
			'message' => '',
			'level' => 0,
			'extra' => '',
			'url_id' => 0,
			'grab_video_id' => 0,
			'upload_video_id' => 0,
			'create_time' => time(),
		),
	),
);
