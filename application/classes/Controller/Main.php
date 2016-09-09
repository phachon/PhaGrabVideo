<?php
/**
 * main
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Main extends Controller_Template {

	protected $_default = 'layouts/default';

	public function action_index() {
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
		$this->_default->content = View::factory('main/index')
			->set('menus', $menus);
	}
}