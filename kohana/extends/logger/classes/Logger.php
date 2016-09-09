<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 日志基类
 * @author phachon@163.com
 * eg: Logger::factory('success_log')->write($data)->execute();
 */
abstract class Logger {
	
	/**
	 *  要写入的数据
	 * @var string | array
	 */
	protected $_data;

	/**
	 * 配置文件key
	 * @var string
	 */
	protected static $_key = '';

	/**
	 * 参数
	 * @var array
	 */
	protected static $_parameters = array();

	/**
	 * 字段
	 * @var array
	 */
	protected static $_columns = array();

	/**
	 * 工厂
	 * @param  string $key
	 * @return object
	 */
	public static function factory($key) {

		$logConfig = Kohana::$config->load('logger.'. $key);

		$type = ucfirst(strtolower($logConfig['type']));
		self::$_parameters = $logConfig['parameters'];
		self::$_columns = isset($logConfig['columns']) ? $logConfig['columns'] : array();
		self::$_key = $key;
		
		$className = "Logger_" . $type;
		if(class_exists($className)) {
			return new $className();
		}else {
			return new Logger_File();
		}
	}

	abstract public function write($data);

	abstract public function execute();
}
