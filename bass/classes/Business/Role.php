<?php
/**
 * role business
 * @author: phachon@163.com
 * Time: 216-08-08 11:27
 */
class Business_Role extends Business {

	/**
	 * 创建一个角色
	 * @param array $values
	 * @throws Business_Exception
	 * @return integer
	 */
	public function create(array $values) {

		$fields = array (
			'name' => '',
			'status' => Dao_Role::STATUS_NORMAL,
			'create_time' => time(),
			'update_time' => time(),
		);

		$values = array_intersect_key($values, $fields);
		$values = $values + $fields;
		$name = Arr::get($values, 'name', '');

		$errors = [];
		if(!$name) {
			$errors[] = '名称不能为空';
		}
		if($errors) {
			throw new Business_Exception(implode(' ',$errors));
		}

		return Dao::factory('Role')->insert($values);
	}

	/**
	 * 根据名称获取角色数量
	 * @param string $name
	 * @return array
	 */
	public function countRolesByName($name) {
		return Dao::factory('Role')->countRolesByName($name);
	}

	/**
	 * 根据名称分页获取角色
	 * @param string $name
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getRolesByNameAndLimit($name, $offset, $number) {
		return Dao::factory('Role')->getRolesByNameAndLimit($name, $offset, $number);
	}

	/**
	 * 获取角色总数
	 * @return array
	 */
	public function countRoles() {
		return Dao::factory('Role')->countRoles();
	}

	/**
	 * 分页获取角色信息
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getRolesByLimit($offset, $number) {
		return Dao::factory('Role')->getRolesByLimit($offset, $number);
	}

	/**
	 * 根据 role_id 来查找角色
	 * @param integer $roleId
	 * @return mixed
	 */
	public function getRoleByRoleId($roleId = 0) {
		if(!$roleId) {
			return FALSE;
		}
		return Dao::factory('Role')->getRoleByRoleId($roleId);
	}

	/**
	 * 根据 roleId 来修改角色
	 * @param array $values
	 * @param integer $roleId
	 * @return mixed
	 * @throws Business_Exception
	 */
	public function updateByRoleId($values, $roleId) {
		if(!$roleId) {
			return FALSE;
		}

		$fields = array (
			'name' => '',
		);

		$values = array_intersect_key($values, $fields);
		$values = $values + $fields;
		$name = Arr::get($values, 'name', '');
		$values['update_time'] = time();

		$errors = [];
		if(!$name) {
			$errors[] = '名称不能为空';
		}
		if($errors) {
			throw new Business_Exception(implode(' ',$errors));
		}

		return Dao::factory('Role')->updateByRoleId($values, $roleId);
	}

	/**
	 * 获取所有的角色
	 */
	public function getRoles() {
		return Dao::factory('Role')->getRoles();
	}

	/**
	 * 根据 roleId 来修改权限
	 * @param string $privilegeMenu
	 * @param integer $roleId
	 * @return mixed
	 * @throws Business_Exception
	 */
	public function updatePrivilegeByRoleId($privilegeMenu, $roleId) {
		if (!$roleId) {
			return FALSE;
		}
		$values = array(
			'privilege_menu' => $privilegeMenu ? $privilegeMenu : 'profile',
			'update_time' => time(),
		);

		return Dao::factory('Role')->updateByRoleId($values, $roleId);
	}
}