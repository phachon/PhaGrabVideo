<?php
/**
 * log dao
 * @author: phachon@163.com
 * Time: 2016-08-16 12:06
 */
class Dao_Log extends Dao {

	protected $_db = 'grab';

	protected $_tableName = 'log';

	protected $_primaryKey = 'log_id';

	/**
	 * 根据关键字获取网站数量
	 * @param string $keywords
	 * @return array
	 */
	public function countLogsByKeywords($keywords) {
		$select = DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName);
		if($keywords) {
			$select->where('message', 'LIKE', '%'.$keywords.'%')
				->or_where('ip', '=', $keywords)
				->or_where('account_name', '=', $keywords);
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
			$select->where('message', 'LIKE', '%'.$keywords.'%')
				->or_where('ip', '=', $keywords)
				->or_where('account_name', '=', $keywords);
		}
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Log')
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

		return $select->as_object('Model_Log')
			->execute($this->_db);
	}

	/**
	 * 获取所有的网站
	 */
	public function getLogs() {
		return DB::select('*')
			->from($this->_tableName)
			->as_object('Model_Log')
			->execute();
	}


}