<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 数据库日志类
 */
class Logger_Database extends Logger {

	/**
	 * 数据库连接group
	 * @var string
	 */
	protected $_group = '';

	/**
	 * 表
	 * @var string
	 */
	protected $_table = '';

	/**
	 * 表切分
	 * @var string
	 */
	protected $_slice = '';
	
	/**
	 * 初始化配置参数
	 */
	public function __construct() {

		$this->_group = self::$_parameters['group'];
		$this->_table = self::$_parameters['table'];
		$this->_slice = isset(self::$_parameters['slice']) ? self::$_parameters['slice'] : '';

	}

	/**
	 * 写入
	 * @param string | array $data
	 * @return object
	 */
	public function write($data) {

		if(self::$_columns) {

			$data = array_intersect_key($data, self::$_columns);
			$data = $data + self::$_columns;
		}
		if(is_string($data)) {
			$data = array ($data);
		}
		if(!is_array($data)) {
			throw new Logger_Database_Exception("write data error must is an array");
		}
		$this->_data = $data;

		return $this;
	}

	/**
	 * 得到切分后表名
	 * @param  string $key 
	 * @return string
	 */
	protected function _tableName($key) {

		//return Slice::table($this->_slice)->name($this->_table)->key($key)->execute();
	}

	/**
	 * 执行
	 * @return boolean
	 */
	public function execute() {

		Logger_Database_Handler::init()->insert($this->_data);
	}
}