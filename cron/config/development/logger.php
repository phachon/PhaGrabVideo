<?php
/**
 * 日志信息配置
 * @author phachon@163.com
 */
return array(

	/**
	 * 抓取视频日志
	 * type:database
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
			'video_id' => 0,
			'create_time' => time(),
		),
	),
);
