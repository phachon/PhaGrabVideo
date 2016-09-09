<?php
/**
 * website dao
 * @author: phachon@163.com
 * Time: 2016-08-16 12:06
 */
class Dao_Website extends Dao {

	protected $_db = 'grab';

	protected $_tableName = 'website';

	protected $_primaryKey = 'website_id';

	const STATUS_DISABLE = -1;

	const STATUS_NORMAL = 0;

	/**
	 * insert a website
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
	 * 根据名称获取网站数量
	 * @param string $name
	 * @return array
	 */
	public function countWebsitesByName($name) {
		return DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName)
			->where('name', 'LIKE', '%'.$name.'%')
			->execute($this->_db)
			->get('recordCount');
	}

	/**
	 * 根据名称分页获取网站
	 * @param string $name
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getWebsitesByNameAndLimit($name, $offset, $number) {

		$select = DB::select('*')
			->from($this->_tableName)
			->where('name', 'LIKE', '%'.$name.'%');
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Website')
			->execute($this->_db);
	}

	/**
	 * 获取网站总数
	 * @return array
	 */
	public function countWebsites() {
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
	public function getWebsitesByLimit($offset, $number) {

		$select = DB::select('*')
			->from($this->_tableName);
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Website')
			->execute($this->_db);
	}

	/**
	 * 根据 website_id 来查找网站
	 * @param integer $websiteId
	 * @return array
	 */
	public function getWebsiteByWebsiteId($websiteId) {
		return DB::select('*')
			->from($this->_tableName)
			->where($this->_primaryKey, '=', $websiteId)
			->as_object('Model_Website')
			->execute($this->_db);
	}

	/**
	 * 根据 websiteId 修改网站信息
	 * @param array $values
	 * @param integer $websiteId
	 * @return integer
	 */
	public function updateByWebsiteId($values, $websiteId) {
		return DB::update($this->_tableName)
			->set($values)
			->where($this->_primaryKey, '=', $websiteId)
			->execute($this->_db);
	}

	/**
	 * 获取所有的网站
	 */
	public function getWebsites() {
		return DB::select('*')
			->from($this->_tableName)
			->where('status', '=', self::STATUS_NORMAL)
			->as_object('Model_Website')
			->execute();
	}


}