<?php
/**
 * 下载日志类
 * @author: phachon@163.com
 * Time: 14:30
 */
class Log_Download {

	const LEVEL_INFO = 0;       //提示
	const LEVEL_WARNING = 1;    //警告
	const LEVEL_ERROR = 2;      //错误
	const LEVEL_DEBUG = 3;      //调试

	/**
	 * 日志级别
	 * @var int
	 */
	protected static $_level = 0;

	/**
	 * url_id
	 * @var int
	 */
	protected $_urlId = 0;

	/**
	 * 日志提示信息
	 * @var string
	 */
	protected $_message = '';

	/**
	 * grab_video_id
	 * @var int
	 */
	protected $_grabVideoId = 0;

	/**
	 * 具体描述信息
	 * @var string
	 */
	protected $_extra = '';

	/**
	 * instance
	 * @var null
	 */
	protected static $_instance = NULL;

	/**
	 * @param integer $level
	 * @return Log_Grab|null
	 */
	public static function instance($level) {

		self::$_level = $level;
		if(self::$_instance === NULL) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	protected function __construct() {}

	/**
	 * 提示性信息
	 */
	public static function info() {
		return self::instance(self::LEVEL_INFO);
	}

	/**
	 * 警告性信息
	 */
	public static function warning() {
		return self::instance(self::LEVEL_WARNING);
	}

	/**
	 * 错误信息
	 */
	public static function error() {
		return self::instance(self::LEVEL_ERROR);
	}

	/**
	 * 调试信息
	 */
	public static function debug() {
		return self::instance(self::LEVEL_DEBUG);
	}

	/**
	 * set urlId
	 * @param integer $urlId
	 * @return object
	 */
	public function urlId($urlId) {
		$this->_urlId = $urlId;
		return $this;
	}

	/**
	 * 提示信息
	 * @param $message
	 * @return object
	 */
	public function message($message) {
		$this->_message = $message;
		return $this;
	}

	/**
	 * 具体描述信息
	 * @param $extra
	 * @return object
	 */
	public function extra($extra) {
		$this->_extra = $extra;
		return $this;
	}

	/**
	 * grab_video_id
	 * @param integer $grabVideoId
	 * @return object
	 */
	public function grabVideoId($grabVideoId) {
		$this->_grabVideoId = $grabVideoId;
		return $this;
	}

	public function write() {
		$data = array (
			'message' => $this->_message,
			'level' => self::$_level,
			'extra' => $this->_extra,
			'url_id' => $this->_urlId,
			'grab_video_id' => $this->_grabVideoId,
		);

		try {
			Logger::factory('grab_log_download')->write($data)->execute();
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}
}