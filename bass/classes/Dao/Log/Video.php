<?php
/**
 * 抓取视频日志 dao
 * @author: phachon@163.com
 * Time: 2016-08-16 12:06
 */
class Dao_Log_Video extends Dao {

	protected $_db = 'grab';

	protected $_tableName = 'log_video';

	protected $_primaryKey = 'log_video_id';

	/**
	 * 根据关键字获取网站数量
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
	 * 根据关键字分页获取网站
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

		return $select->as_object('Model_Log_Video')
			->execute($this->_db);
	}

	/**
	 * 获取网站总数
	 * @return array
	 */
	public function countLogs() {
		return DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName)
			->execute($this->_db)
			->get('recordCount');
	}

	/**
	 * 分页获取网站信息
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

		return $select->as_object('Model_Log_Video')
			->execute($this->_db);
	}

	/**
	 * 获取所有的网站
	 */
	public function getLogs() {
		return DB::select('*')
			->from($this->_tableName)
			->as_object('Model_Log_Video')
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
		return $select->as_object('Model_Log_Video')
			->execute($this->_db);
	}

	/**
	 * 根据 grab_video_id 来查找日志
	 * @param integer $grabVideoId
	 * @return array
	 */
	public function getLogsByGrabVideoId($grabVideoId) {
		$select = DB::select('*')
			->from($this->_tableName)
			->where('grab_video_id', '=', $grabVideoId)
			->order_by($this->_primaryKey, 'DESC');
		return $select->as_object('Model_Log_Video')
			->execute($this->_db);
	}


}