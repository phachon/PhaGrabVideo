<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 文件日志路径切分
 * @author phachon@163.com
 */
abstract class Logger_File_Path extends Logger_File {

	/**
	 * 工厂
	 * @param  string $slice 
	 * @return object
	 */
	public static function factory($slice) {

		$slice = strtolower($slice);
		if($slice == '') {
			return new Logger_File_Path_Null();
		}
		if($slice == 'year') {
			return new Logger_File_Path_Year();
		}
		if($slice == 'mouth') {
			return new Logger_File_Path_Mouth();
		}
		if($slice == 'day') {
			return new Logger_File_Path_Day();
		}

		return new Logger_File_Path_Null();
	}

	abstract public function getPath();
}