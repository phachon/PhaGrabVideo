<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 文件日志类
 * @author phachon@163.com
 */
class Logger_File extends Logger {

	/**
	 * 日志文件名
	 * @var string
	 */
	protected $_fileName = '';

	/**
	 * 日志文件路径
	 * @var string
	 */
	protected $_filePath = '';

	/**
	 * 日志路径切分方式
	 * @var string
	 */
	protected $_slice = '';

	/**
	 * 初始化配置参数
	 */
	public function __construct() {

		$this->_fileName = self::$_parameters['name'];
		$this->_ext = self::$_parameters['ext'];
		$this->_filePath = self::$_parameters['path'];
		$this->_slice = isset(self::$_parameters['slice']) ? self::$_parameters['slice'] : '';
	}

	/**
	 * 写入文件
	 * @param mixed $data
	 * @return boolean
	 */
	public function write($data) {

		if(is_array($data)) {
			$data = json_encode($data, TRUE);
		}
		$this->_data = $data;
		return $this;
	}

	/**
	 * 执行
	 * @param  string $name
	 * @return boolean
	 */
	public function execute() {

		$logPath = Logger_File_Path::factory($this->_slice)->getPath();

		if(!is_dir($logPath)) {
			mkdir($logPath, 0777);
		}
		if(!is_writable($logPath)) {
			throw new Logger_File_Exception("$logPath is not write");
		}

		$info = date('Y-m-d H:i:s') . ' --- ' . $this->_data . "\r\n";

		file_put_contents($logPath . $this->_fileName . "." . $this->_ext, $info, FILE_APPEND);
	}

}