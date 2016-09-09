<?php
/**
 * account model
 * @author: phachon@163.com
 * Time: 16:12
 */
class Model_Account extends Model_Base {

	const STATUS_DELETE = -1;
	const STATUS_NORMAL = 0;

	/**
	 * 状态
	 * @return string
	 */
	public function getStatus() {
		if(!$this->status) {
			return "<span class='label label-success'>正常</span>";
		}else {
			return "<span class='label label-danger'>屏蔽</span>";
		}
	}

	/**
	 * 获取角色
	 */
	public function getRole() {
		$role = Business::factory('Role')->getRoleByRoleId($this->role_id);
		if($role->count() > 0) {
			$roleName = $role->current()->getName();
		}else {
			$roleName = '';
		}
		return $roleName;
	}
	/**
	 * time
	 * @param string $format
	 * @return mixed
	 */
	public function getCreateTime($format = '') {
		return $format ? date($format, $this->create_time) : $this->create_time;
	}
}