<?php
abstract class Dao {
	
	/**
	 * 数据库配key
	 * @var string
	 */
	protected $_db = NULL;
	
	/**
	 * 表名
	 * @var string
	 */
	protected $_tableName = '';
	
	/**
	 * 主键
	 * @var string
	 */
	protected $_primaryKey = '';

	/**
	 * Create a new dao instance.
	 *
	 *     $dao = Dao::factory($name);
	 *
	 * @param   string  $name   dao name
	 * @return  Dao
	 */
	public static function factory($name, $db = NULL) {

		$class = 'Dao_'.$name;

		return new $class($db);
	}

	public function __construct($db = NULL) {
		if($db) {
			$this->_db = $db;
		}
		
		if(is_string($this->_db)) {
			$this->_db = Database::instance($this->_db);
		}
	}
}
