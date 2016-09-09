<?php
/**
 * url dao
 * @author: phachon@163.com
 * Time: 2016-08-16 16:06
 */
class Dao_Url extends Dao {

	protected $_db = 'grab';

	protected $_tableName = 'url';

	protected $_primaryKey = 'url_id';

	const STATUS_FAILED = 2; //抓取失败
	const STATUS_SUCCESS = 1; //已抓取
	const STATUS_DEFAULT = 0; //待抓取
	const STATUS_DELETE = -1; //删除

	/**
	 * insert a url
	 * @param array $values
	 * @return integer
	 * @throws Kohana_Exception
	 */
	public function insert($values) {
		return DB::insert($this->_tableName)
			->columns(array_keys($values))
			->values(array_values($values))
			->execute($this->_db);
	}

	/**
	 * 根据关键字来获取URL总数
	 * @param array $keywords
	 * @return array
	 */
	public function countUrlsByKeywords($keywords) {
		$select = DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName)
			->where('status', '!=', self::STATUS_DELETE);
		if(isset($keywords['website_id']) && $keywords['website_id']) {
			$select->and_where('website_id', '=', $keywords['website_id']);
		}
		if(isset($keywords['status']) && $keywords['status'] != self::STATUS_DELETE) {
			$select->and_where('status', '=', $keywords['status']);
		}
		if(isset($keywords['url']) && $keywords['url'] != '') {
			$select->and_where('url', 'LIKE', '%'.$keywords['url'].'%');
		}
		return $select->execute($this->_db)
			->get('recordCount');
	}

	/**
	 * 根据关键字来分页获取URL
	 * @param array $keywords
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getUrlsByKeywordsAndLimit($keywords, $offset, $number) {

		$select = DB::select('*')
			->from($this->_tableName)
			->where('status', '!=', self::STATUS_DELETE)
			->order_by($this->_primaryKey, 'DESC');
		if(isset($keywords['website_id']) && $keywords['website_id']) {
			$select->and_where('website_id', '=', $keywords['website_id']);
		}
		if(isset($keywords['status']) && $keywords['status'] != self::STATUS_DELETE) {
			$select->and_where('status', '=', $keywords['status']);
		}
		if(isset($keywords['url']) && $keywords['url'] != '') {
			$select->and_where('url', 'LIKE', '%'.$keywords['url'].'%');
		}
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Url')
			->execute($this->_db);
	}

	/**
	 * 获取URL总数
	 * @return array
	 */
	public function countUrls() {
		return DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName)
			->where('status', '!=', self::STATUS_DELETE)
			->execute($this->_db)
			->get('recordCount');
	}

	/**
	 * 分页获取获取URL
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getUrlsByLimit($offset, $number) {

		$select = DB::select('*')
			->from($this->_tableName)
			->where('status', '!=', self::STATUS_DELETE)
			->order_by($this->_primaryKey, 'DESC');
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Url')
			->execute($this->_db);
	}

	/**
	 * 根据 url_id 来查找url
	 * @param integer $urlId
	 * @return mixed
	 */
	public function getUrlByUrlId($urlId) {
		return DB::select('*')
			->from($this->_tableName)
			->where($this->_primaryKey, '=', $urlId)
			->where('status', '!=', self::STATUS_DELETE)
			->as_object('Model_Url')
			->execute($this->_db);
	}

	/**
	 * 获取所有的URL
	 */
	public function getUrls() {
		return DB::select('*')
			->from($this->_tableName)
			->as_object('Model_Url')
			->execute();
	}

	/**
	 * 根据状态获取所有的URL
	 * @param integer $status
	 * @return array
	 */
	public function getUrlsByStatus($status) {
		return DB::select('*')
			->from($this->_tableName)
			->where('status', '=', $status)
			->as_object('Model_Url')
			->execute();
	}

	/**
	 * 获取待抓取的 urls
	 */
	public function getDefaultUrls() {
		return DB::select('*')
			->from($this->_tableName)
			->where('status', '=', self::STATUS_DEFAULT)
			->as_object('Model_Url')
			->execute();
	}

	/**
	 * 根据 urlId 修改 url
	 * @param array $values
	 * @param integer $urlId
	 * @return integer
	 */
	public function updateByUrlId($values, $urlId) {
		return DB::update($this->_tableName)
			->set($values)
			->where($this->_primaryKey, '=', $urlId)
			->execute($this->_db);
	}


}