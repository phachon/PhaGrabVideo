<?php
/**
 * role dao
 * @author: phachon@163.com
 * Time: 2016-08-18 12:06
 */
class Dao_Role extends Dao {

	protected $_db = 'grab';

	protected $_tableName = 'role';

	protected $_primaryKey = 'role_id';

	const STATUS_DELETE = -1;
	const STATUS_NORMAL = 0;

	/**
	 * insert a role
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
	 * 根据名称获取角色数量
	 * @param string $name
	 * @return array
	 */
	public function countRolesByName($name) {
		return DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName)
			->where('name', 'LIKE', '%'.$name.'%')
			->execute($this->_db)
			->get('recordCount');
	}

	/**
	 * 根据名称分页获取角色
	 * @param string $name
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getRolesByNameAndLimit($name, $offset, $number) {

		$select = DB::select('*')
			->from($this->_tableName)
			->where('name', 'LIKE', '%'.$name.'%');
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Role')
			->execute($this->_db);
	}

	/**
	 * 获取角色总数
	 * @return array
	 */
	public function countRoles() {
		return DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName)
			->execute($this->_db)
			->get('recordCount');
	}

	/**
	 * 分页获取角色信息
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getRolesByLimit($offset, $number) {

		$select = DB::select('*')
			->from($this->_tableName);
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Role')
			->execute($this->_db);
	}

	/**
	 * 根据 role_id 来查找角色
	 * @param integer $roleId
	 * @return array
	 */
	public function getRoleByRoleId($roleId) {
		return DB::select('*')
			->from($this->_tableName)
			->where($this->_primaryKey, '=', $roleId)
			->and_where('status', '=', self::STATUS_NORMAL)
			->as_object('Model_Role')
			->execute($this->_db);
	}

	/**
	 * 根据 roleId 修改角色信息
	 * @param array $values
	 * @param integer $roleId
	 * @return integer
	 */
	public function updateByRoleId($values, $roleId) {
		return DB::update($this->_tableName)
			->set($values)
			->where($this->_primaryKey, '=', $roleId)
			->execute($this->_db);
	}

	/**
	 * 获取所有的角色
	 */
	public function getRoles() {
		return DB::select('*')
			->from($this->_tableName)
			->where('status', '=', self::STATUS_NORMAL)
			->as_object('Model_Role')
			->execute();
	}
}