<?php
/**
 * 账号管理
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Account extends Controller_Template {

	protected $_default = 'layouts/account';

	/**
	 * 添加 account
	 */
	public function action_add() {
		$roles = Business::factory('Role')->getRoles();

		$this->_default->content = View::factory('account/form')
			->set('roles', $roles);
	}

	/**
	 * 添加 account 保存
	 */
	public function action_save() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$givenName = Arr::get($_POST, 'given_name', '');
		$name = Arr::get($_POST, 'name', '');
		$email = Arr::get($_POST, 'email', '');
		$mobile = Arr::get($_POST, 'mobile', '');
		$phone = Arr::get($_POST, 'phone', '');
		$roleId = Arr::get($_POST, 'role_id', '');

		$values = [
			'given_name' => $givenName,
			'name' => $name,
			'email' => $email,
			'mobile' => $mobile,
			'phone' => $phone,
			'role_id' => $roleId,
		];

		try {
			$result = Business::factory('Account')->create($values);
		} catch (Exception $e) {
			Logs::instance()->write('添加账号失败: '.$e->getMessage());
			return $this->error($e->getMessage());
		}
		Logs::instance()->write('添加账号 '.$result[0].'成功');
		return $this->success('添加账号成功', URL::site('account/add'));
	}

	/**
	 * account 列表
	 */
	public function action_list() {

		$keyword = Arr::get($_GET, 'keyword', '');
		if($keyword) {
			$total = Business::factory('Account')->countAccountsBykeyword($keyword);
			$paginate = Paginate::factory($total);
			$accounts = Business::factory('Account')->getAccountsByKeywordAndLimit($keyword, $paginate->offset(), $paginate->number());
		} else {
			$total = Business::factory('Account')->countAccounts();
			$paginate = Paginate::factory($total);
			$accounts = Business::factory('Account')->getAccountsByLimit($paginate->offset(), $paginate->number());
		}
		$this->_default->content = View::factory('account/list')
			->set('accounts', $accounts)
			->set('paginate', $paginate);

	}

	/**
	 * account 修改
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
		$this->_default->content = View::factory('account/form')
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
			Logs::instance()->write('修改账号 '.$accountId.' 失败: '.$e->getMessage());
			return $this->error($e->getMessage());
		}
		Logs::instance()->write('修改账号 '.$accountId.'成功');
		return $this->success('修改账号成功', URL::site('video/list'));
	}

	/**
	 * 删除
	 */
	public function action_delete() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$accountId = Arr::get($_GET, 'account_id', '');

		try {
			$result = Business::factory('Account')->updateStatusByAccountId(Model_Account::STATUS_DELETE, $accountId);
			if(!$result) {
				Logs::instance()->write('屏蔽账号 '.$accountId.' 失败');
				return $this->error('屏蔽账号失败');
			}
		} catch (Exception $e) {
			Logs::instance()->write('屏蔽账号 '.$accountId.' 失败: '.$e->getMessage());
			return $this->error($e->getMessage());
		}
		Logs::instance()->write('屏蔽账号 '.$accountId.' 成功');
		return $this->success('屏蔽账号成功', URL::site('account/list'));
	}

	/**
	 * 恢复账号
	 */
	public function action_review() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$accountId = Arr::get($_GET, 'account_id', '');

		try {
			$result = Business::factory('Account')->updateStatusByAccountId(Model_Account::STATUS_NORMAL, $accountId);
			if(!$result) {
				Logs::instance()->write('恢复账号 '.$accountId.' 失败');
				return $this->error('恢复账号失败');
			}
		} catch (Exception $e) {
			Logs::instance()->write('恢复账号 '.$accountId.' 失败: '.$e->getMessage());
			return $this->error($e->getMessage());
		}
		Logs::instance()->write('恢复账号 '.$accountId.' 成功');
		return $this->success('恢复账号成功', URL::site('account/list'));
	}
}