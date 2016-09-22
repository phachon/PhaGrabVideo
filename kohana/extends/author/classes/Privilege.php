<?php
/**
 * 用户权限的控制
 * 权限的控制只到控制器，不做细分
 * @author: phachon@163.com
 * Time: 9:55
 */
class Privilege {

	protected static $_instance = null;

	protected $_default = [
		'author', 'main'
	];

	public static function instance() {
		if(self::$_instance === null) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * 获取权限菜单
	 */
	public function getMenus() {
		$account = Business::factory('Account')->getAccountByAccountId(Author::accountId());
		$account = $account->current();
		$roleId = $account->getRoleId();
		$role = Business::factory('Role')->getRoleByRoleId($roleId)->current();
		$privilegeMenus = explode(',', $role->getPrivilegeMenu());
		$allMenus = Kohana::$config->load('menus.config');
		$menus = [];
		if(Author::accountId() == 1) {
			$menus = $allMenus;
		}else {
			foreach ($allMenus as $key => $values) {
				if (!in_array($key, $privilegeMenus)) {
					continue;
				}
				$menus[$key] = $values;
			}
		}

		return $menus;
	}

	public function control($controller) {

		if(Author::accountId() == 1) {
			return TRUE;
		}
		if(in_array($controller, $this->_default)) {
			return TRUE;
		}
		$controller = explode('_', $controller)[0];

		//获取用户的权限
		$account = Business::factory('Account')->getAccountByAccountId(Author::accountId());
		$account = $account->current();
		$roleId = $account->getRoleId();
		$role = Business::factory('Role')->getRoleByRoleId($roleId)->current();
		$privilegeMenus = explode(',', $role->getPrivilegeMenu());

		if(in_array($controller, $privilegeMenus)) {
			return TRUE;
		}
		return FALSE;
	}
}