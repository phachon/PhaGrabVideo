<?php
/**
 * api
 * @author: panchao
 * Time: 12:16
 */
class Controller_Api extends Controller_Base {

	protected $_validateToken = FALSE;

	/**
	 * 检测api
	 */
	public function action_index() {
		return $this->success('api ready success');
	}

	/**
	 * 验证 token name 是否合法
	 */
	public function action_token() {
		$name = Arr::get($_POST, 'name', '');
		$token = Arr::get($_POST, 'token', '');

		if(!$name || !$token) {
			return $this->error('name or token is null');
		}

		$accounts = Business::factory('Account')->getAccountByName($name);
		if($accounts->count() == 0) {
			return $this->error('name is not validate');
		}

		if($token != md5($name . $accounts->current()->getPassword()) ) {
			return $this->error('token is not validate');
		}

		return $this->success('validate token success');
	}
}