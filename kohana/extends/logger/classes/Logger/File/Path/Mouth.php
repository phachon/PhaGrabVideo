<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 日志路径按月份分
 * @author phachon@163.com
 */
class Logger_File_Path_Mouth extends Logger_File_Path {


	/**
	 * 得到路径
	 * @return string
	 */
	public function getPath() {

		return $this->_filePath . DIRECTORY_SEPARATOR . 
				date('Y', time()) . DIRECTORY_SEPARATOR . 
				date('m', time()) . DIRECTORY_SEPARATOR;
	}
}