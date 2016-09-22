<?php
/**
 * 视频下载 log model
 * @author: phachon@163.com
 * Time: 16:12
 */
class Model_Log_Download extends Model_Base {

	const LEVEL_INFO = 0;       //提示
	const LEVEL_WARNING = 1;    //警告
	const LEVEL_ERROR = 2;      //错误
	const LEVEL_DEBUG = 3;      //调试

	public function getLevel() {
		switch($this->level) {
			case self::LEVEL_ERROR:
				return '<span class="label label-danger">ERROR</span>';
				break;
			case self::LEVEL_WARNING:
				return '<span class="label label-warning">WARNING</span>';
				break;
			case self::LEVEL_INFO:
				return '<span class="label label-info">INFO</span>';
				break;
			case self::LEVEL_DEBUG:
				return '<span class="label label-info">DEBUG</span>';
				break;
			default:
				return '';
		}
	}

	/**
	 * time
	 * @param string $format
	 * @return mixed
	 */
	public function getCreateTime($format = '') {
		return $format ? date($format, $this->create_time) : $this->create_time;
	}
}