<?php
/**
 * 视频下载日志 dao
 * @author: phachon@163.com
 * Time: 2016-08-16 12:06
 */
class Dao_Log_Download extends Dao {

	protected $_db = 'grab';

	protected $_tableName = 'log_download';

	protected $_primaryKey = 'log_download_id';

	/**
	 * 根据关键字获取日志数量
	 * @param string $keywords
	 * @return array
	 */
	public function countLogsByKeywords($keywords) {
		$select = DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName);

		if($keywords) {
			$select->where(key($keywords), '=', $keywords[key($keywords)]);
		}
		return $select->execute($this->_db)
			->get('recordCount');
	}

	/**
	 * 根据关键字分页获取日志
	 * @param string $keywords
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getLogsByKeywordsAndLimit($keywords, $offset, $number) {

		$select = DB::select('*')
			->from($this->_tableName)
			->order_by($this->_primaryKey, 'DESC');
		if($keywords) {
			$select->where(key($keywords), '=', $keywords[key($keywords)]);
		}
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Log_Download')
			->execute($this->_db);
	}

	/**
	 * 获取日志总数
	 * @return array
	 */
	public function countLogs() {
		return DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName)
			->execute($this->_db)
			->get('recordCount');
	}

	/**
	 * 分页获取下载日志信息
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getLogsByLimit($offset, $number) {

		$select = DB::select('*')
			->from($this->_tableName)
			->order_by($this->_primaryKey, 'DESC');
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Log_Download')
			->execute($this->_db);
	}

	/**
	 * 获取所有的下载日志
	 */
	public function getLogs() {
		return DB::select('*')
			->from($this->_tableName)
			->as_object('Model_Log_Download')
			->execute();
	}

	/**
	 * 根据 url_id 来查找日志
	 * @param integer $urlId
	 * @return array
	 */
	public function getLogsByUrlId($urlId) {
		$select = DB::select('*')
			->from($this->_tableName)
			->where('url_id', '=', $urlId)
			->order_by($this->_primaryKey, 'DESC');
		return $select->as_object('Model_Log_Download')
			->execute($this->_db);
	}

}