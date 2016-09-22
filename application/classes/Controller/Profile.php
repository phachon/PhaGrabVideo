<?php
/**
 * 个人中心
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Profile extends Controller_Template {

	protected $_default = 'layouts/profile';

	/**
	 * 个人中心
	 */
	public function action_index() {
		$this->_autoRender = false;

		$this->_body = View::factory('profile/index');
	}

	/**
	 * 我的资料
	 */
	public function action_info() {
		$account = Session::instance()->get('author');
		$accounts = Business::factory('Account')->getAccountByAccountId($account->getAccountId());
		$account = $accounts->current();
		if(!$account) {
			return Prompt::errorView('账号未登录', URL::site('author/index'));
		}
		$this->_default->content = View::factory('profile/list')
			->set('account', $account);
	}

	/**
	 * 修改
	 */
	public function action_edit() {
		$accountId = Arr::get($_GET, 'account_id', '');

		$account = Business::factory('Account')->getAccountByAccountId($accountId);
		if($account->count() > 0) {
			$account = $account->current();
		}else {
			return Prompt::warningView('没有找到该账号');
		}

		$roles = Business::factory('Role')->getRoles();
		$this->_default->content = View::factory('profile/form')
			->set('account', $account)
			->set('roles', $roles);
	}

	/**
	 * 修改保存
	 */
	public function action_modify() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$accountId = Arr::get($_POST, 'account_id', '');
		$givenName = Arr::get($_POST, 'given_name', '');
		$email = Arr::get($_POST, 'email', '');
		$mobile = Arr::get($_POST, 'mobile', '');
		$phone = Arr::get($_POST, 'phone', '');
		$roleId = Arr::get($_POST, 'role_id', '');
		
		$values = [
			'given_name' => $givenName,
			'email' => $email,
			'mobile' => $mobile,
			'phone' => $phone,
			'role_id' => $roleId,
		];

		try {
			Business::factory('Account')->updateByAccountId($values, $accountId);
		} catch (Exception $e) {
			Logs::instance()->write('修改个人资料 '.$accountId.' 失败: '.$e->getMessage());
			return $this->error($e->getMessage());
		}
		Logs::instance()->write('修改个人资料 '.$accountId.'成功');
		return $this->success('修改个人资料成功', URL::site('video/list'));
	}

	/**
	 * 修改密码
	 */
	public function action_editpass() {

		$accountId = Arr::get($_GET, 'account_id', '');
		$this->_default->content = View::factory('profile/password')
			->set('accountId', $accountId);
	}

	/**
	 * 修改密码保存
	 */
	public function action_modifypass() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$accountId = Arr::get($_POST, 'account_id', '');
		$oldPassword = Arr::get($_POST, 'old_password', '');
		$newPassword = Arr::get($_POST, 'new_password', '');
		$renewPassword = Arr::get($_POST, 'renew_password', '');

		if(!$accountId) {
			return Prompt::errorView('account_id 出错', URL::site('profile/info'));
		}

		$errors = array ();
		if(!$oldPassword) {
			$errors[] = '密码不能为空';
		}
		$account = Business::factory('Account')->getAccountByAccountId($accountId)->current();
		if($account->getPassword() != md5($oldPassword)) {
			$errors[] = '当前密码错误';
		}
		if(!$newPassword) {
			$errors[] = '新密码不能为空';
		}
		if($newPassword != $renewPassword) {
			$errors[] = '两次输入的密码不一致';
		}
		if($errors) {
			return $this->error(implode(' ',$errors));
		}
		try {
			$result = Business::factory('Account')->updatePasswordByAccountId($newPassword, $accountId);
			if(!$result) {
				Logs::instance()->write('修改密码' .$accountId. '失败');
				return $this->error('修改密码' .$accountId. '失败');
			}
		} catch (Exception $e) {
			Logs::instance()->write('修改密码' .$accountId. '失败');
			return $this->error('修改密码' .$accountId. '失败: '.$e->getMessage());
		}

		Logs::instance()->write('修改密码' .$accountId. '成功');
		return $this->success('修改密码成功', URL::site('profile/info'));
	}
}