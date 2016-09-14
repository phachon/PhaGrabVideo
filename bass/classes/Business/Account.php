<?php
/**
 * account business
 * @author: phachon@163.com
 * Time: 216-08-08 11:27
 */
class Business_Account extends Business {

	/**
	 * 创建一个账号
	 * @param array $values
	 * @throws Business_Exception
	 * @return integer
	 */
	public function create(array $values) {

		$fields = array (
			'given_name' => '',
			'name' => '',
			'email' => '',
			'mobile' => '',
			'phone' => '',
			'role_id' => 0,
			'status' => Dao_Account::STATUS_NORMAL,
			'create_time' => time(),
			'update_time' => time(),
		);

		$values = array_intersect_key($values, $fields);
		$values = $values + $fields;
		$name = Arr::get($values, 'name', '');
		$email = Arr::get($values, 'email', '');
		$mobile = Arr::get($values, 'mobile', '');
		$roleId = Arr::get($values, 'role_id', 0);

		$errors = [];
		if(!$name) {
			$errors[] = '用户名不能为空';
		}
		if(!$email) {
			$errors[] = '邮箱不能为空';
		}
		if(!$mobile) {
			$errors[] = '手机不能为空';
		}
		if(!$roleId) {
			$errors[] = '没有选择角色';
		}
		if($errors) {
			throw new Business_Exception(implode(' ',$errors));
		}

		$accounts = Dao::factory('Account')->getAccountByName($name);
		if($accounts->count() > 0) {
			throw new Business_Exception('用户名已存在');
		}
		$values['password'] = md5('123456');
		$values['token'] = md5($values['name'].':'.$values['password']);

		return Dao::factory('Account')->insert($values);
	}

	/**
	 * 根据用户名查找用户
	 * @param string $name
	 * @return array
	 */
	public function getAccountByName($name) {
		return Dao::factory('Account')->getAccountByName($name);
	}

	/**
	 * 根据关键字获取账号数量
	 * @param string $keyword
	 * @return array
	 */
	public function countAccountsByKeyword($keyword) {
		return Dao::factory('Account')->countAccountsByKeyword($keyword);
	}

	/**
	 * 根据关键字分页获取账号
	 * @param string $keyword
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getAccountsByKeywordAndLimit($keyword, $offset, $number) {
		return Dao::factory('Account')->getAccountsByKeywordAndLimit($keyword, $offset, $number);
	}

	/**
	 * 获取账号总数
	 * @return array
	 */
	public function countAccounts() {
		return Dao::factory('Account')->countAccounts();
	}

	/**
	 * 分页获取账号信息
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getAccountsByLimit($offset, $number) {
		return Dao::factory('Account')->getAccountsByLimit($offset, $number);
	}

	/**
	 * 根据 account_id 来查找账号
	 * @param integer $accountId
	 * @return mixed
	 */
	public function getAccountByAccountId($accountId = 0) {
		if(!$accountId) {
			return FALSE;
		}
		return Dao::factory('Account')->getAccountByAccountId($accountId);
	}

	/**
	 * 根据 accountId 来修改账号
	 * @param array $values
	 * @param integer $accountId
	 * @return mixed
	 * @throws Business_Exception
	 */
	public function updateByAccountId($values, $accountId) {
		if(!$accountId) {
			return FALSE;
		}

		$fields = array (
			'given_name' => '',
			'email' => '',
			'mobile' => '',
			'phone' => '',
			'role_id' => 0,
		);

		$values = array_intersect_key($values, $fields);
		$values = $values + $fields;
		$email = Arr::get($values, 'email', '');
		$mobile = Arr::get($values, 'mobile', '');
		$roleId = Arr::get($values, 'role_id', '');
		$values['update_time'] = time();

		$errors = [];
		if(!$email) {
			$errors[] = '邮箱不能为空';
		}
		if(!$mobile) {
			$errors[] = '手机不能为空';
		}
		if(!$roleId) {
			$errors[] = '没有选择角色';
		}
		if($errors) {
			throw new Business_Exception(implode(' ',$errors));
		}

		return Dao::factory('Account')->updateByAccountId($values, $accountId);
	}

	/**
	 * 获取所有的账号
	 */
	public function getAccounts() {
		return Dao::factory('Account')->getAccounts();
	}

	/**
	 * 根据 account_id 来修改状态
	 * @param integer $status
	 * @param integer $accountId
	 * @return mixed
	 */
	public function updateStatusByAccountId($status, $accountId) {
		if(!$accountId) {
			return FALSE;
		}

		$values = [
			'status' => $status,
			'update_time' => time()
		];
		return Dao::factory('Account')->updateByAccountId($values, $accountId);
	}

	/**
	 * 根据 account_id 来修改密码
	 * @param $password
	 * @param $accountId
	 * @return integer
	 */
	public function updatePasswordByAccountId($password, $accountId) {
		if(!$accountId) {
			return FALSE;
		}

		$values = [
			'password' => md5($password),
			'update_time' => time()
		];
		return Dao::factory('Account')->updateByAccountId($values, $accountId);
	}
}