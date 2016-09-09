<?php
/**
 * 日志信息配置
 */
return array(

	/**
	 * 运行日志（文件）
	 */
	'run_log' => array (

		'type' => 'file',
		'parameters' => array (
			'name' => 'run_log',
			'ext' => 'log',
			'path' => APPPATH.'/logs',
			'slice' => '',
		)

	),

	/**
	 * api 日志
	 */
	'default' => array(
		'type' => 'database',
		'parameters' => array (
			'group' 	 => 'log_api', 
			'table'      => 'lis_api_log',
			'slice'		 => '',
		),
		'columns' => array(
			'controller',
			'action',
			'get',
			'post',
			'message',
			'ip',
			'create_time',
		),
	),
);
