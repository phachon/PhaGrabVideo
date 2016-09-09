<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 日志路径不切分
 * @author phachon@163.com
 */
class Logger_File_Path_Null extends Logger_File_Path {


	/**
	 * 得到路径
	 * @return string
	 */
	public function getPath() {

		return $this->_filePath . DIRECTORY_SEPARATOR;
	}
}