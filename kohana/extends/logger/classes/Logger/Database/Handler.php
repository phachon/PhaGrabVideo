<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 日志数据库操作
 * @author phachon@163.com
 */
class Logger_Database_Handler extends Logger_Database {


	/**
	 * 初始化对象
	 * @return object
	 */
	public static function init() {

		return new self();
	}

	public function __construct() {

		parent::__construct();
	}

	/**
	 * 插入信息
	 * @param  array $data
	 * @return boolean
	 */
	public function insert(array $data) {

		return DB::insert($this->_table)
			->columns(array_keys($data))
			->values(array_values($data))
			->execute($this->_group);
	}

}