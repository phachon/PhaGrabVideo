<?php
/**
 * author 用户类
 * @author phachon@163.com
 */
class Author {

	protected static $_instance = NULL;

	protected $_accountId = '';

	protected $_name = '';

	protected $_email = '';

	protected $_phone = '';

	protected $_mobile = '';

	protected $_givenName = '';

	protected $_roles = array ();

	protected static $_account = array ();

	public static function instance() {
		if (self::$_instance === NULL) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		if(Session::instance()->get('author')) {
			self::$_account = Session::instance()->get('author');
		}
	}

	/**
	 * 检查是否已经登录
	 * @return boolean
	 */
	public function isLogin() {

		$isLogin = TRUE;
		$account = Session::instance()->get('author');
		if(!$account) {
			$isLogin = FALSE;
		}
		return $isLogin;
	}

	public static function accountId() {
		return is_object(self::$_account) ? self::$_account->getAccountId() : 0;
	}

	public static function givenName() {
		return is_object(self::$_account) ? self::$_account->getGivenName() : '';
	}

	public static function name() {
		return is_object(self::$_account) ? self::$_account->getName() : '';
	}

	public static function email() {
		return is_object(self::$_account) ? self::$_account->getEmail() : '';
	}

	public static function phone() {
		return is_object(self::$_account) ? self::$_account->getPhone() : '';
	}

	public static function mobile() {
		return is_object(self::$_account) ? self::$_account->getMobile() : '';
	}

	public static function roleId() {
		$roles = Business::factory('Role')->getRoleByRoleId(self::$_account->getAccountId());
		$roleId = $roles->current()->getRoleId();
		return $roleId;
	}
}