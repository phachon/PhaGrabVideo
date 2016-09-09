<?php
/**
 * 角色管理
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Role extends Controller_Template {

	protected $_default = 'layouts/role';

	/**
	 * 添加 role
	 */
	public function action_add() {
		$this->_default->content = View::factory('role/form');
	}

	/**
	 * 添加 role 保存
	 */
	public function action_save() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$name = Arr::get($_POST, 'name', '');

		$values = [
			'name' => $name,
		];

		try {
			$result = Business::factory('Role')->create($values);
		} catch (Exception $e) {
			Logs::instance()->write('添加角色失败: '.$e->getMessage());
			return $this->error($e->getMessage());
		}
		Logs::instance()->write('添加角色 '.$result[0].' 成功');
		return $this->success('添加角色成功', URL::site('role/add'));
	}

	/**
	 * role 列表
	 */
	public function action_list() {

		$name = Arr::get($_GET, 'keyword', '');
		if($name != '') {
			$total = Business::factory('Role')->countRolesByName($name);
			$paginate = Paginate::factory($total);
			$roles = Business::factory('Role')->getRolesByNameAndLimit($name, $paginate->offset(), $paginate->number());
		} else {
			$total = Business::factory('Role')->countRoles();
			$paginate = Paginate::factory($total);
			$roles = Business::factory('Role')->getRolesByLimit($paginate->offset(), $paginate->number());
		}
		$this->_default->content = View::factory('role/list')
			->set('roles', $roles)
			->set('paginate', $paginate);

	}

	/**
	 * role 修改
	 */
	public function action_edit() {
		$roleId = Arr::get($_GET, 'role_id', '');

		$role = Business::factory('Role')->getRoleByRoleId($roleId);
		if($role->count() > 0) {
			$role = $role->current();
		}else {
			return Prompt::warningView('没有找到该角色');
		}
		$this->_default->content = View::factory('role/form')
			->set('role', $role);
	}

	/**
	 * 修改保存
	 */
	public function action_modify() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$roleId = Arr::get($_POST, 'role_id', '');
		$name = Arr::get($_POST, 'name', '');

		$values = [
			'name' => $name,
		];

		try {
			$result = Business::factory('Role')->updateByRoleId($values, $roleId);
			if(!$result) {
				Logs::instance()->write('修改角色 '.$roleId.' 失败');
				return $this->error('修改角色失败');
			}
		} catch (Exception $e) {
			Logs::instance()->write('修改角色 '.$roleId.' 失败: '.$e->getMessage());
			return $this->error('修改角色失败: '.$e->getMessage());
		}
		Logs::instance()->write('修改角色 '.$roleId.' 成功');
		return $this->success('修改角色成功', URL::site('video/list'));
	}

	/**
	 * 赋权限
	 */
	public function action_privilege() {
		$roleId = Arr::get($_GET, 'role_id', '');

		$role = Business::factory('Role')->getRoleByRoleId($roleId);
		if($role->count() > 0) {
			$role = $role->current();
		}else {
			return Prompt::warningView('没有找到该角色');
		}
		$menus = Kohana::$config->load('menus.config');
		$this->_default->content = View::factory('role/privilege')
			->set('menus', $menus)
			->set('role', $role);
	}

	public function action_privilegeSave() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$roleId = Arr::get($_POST, 'role_id', '');
		$privilegeMenus = Arr::get($_POST, 'privilege_menu', array());
		$privilegeMenu = implode(',', $privilegeMenus);
		
		try {
			$result = Business::factory('Role')->updatePrivilegeByRoleId($privilegeMenu, $roleId);
			if(!$result) {
				Logs::instance()->write('修改角色 '.$roleId.' 权限失败');
				return $this->error('修改角色权限失败');
			}
		} catch (Exception $e) {
			Logs::instance()->write('修改角色 '.$roleId.' 权限失败: '.$e->getMessage());
			return $this->error('修改角色失败: '.$e->getMessage());
		}
		Logs::instance()->write('修改角色 '.$roleId.' 权限成功');
		return $this->success('修改角色权限成功', URL::site('video/list'));
	}
}