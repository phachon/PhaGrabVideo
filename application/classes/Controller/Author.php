<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 登录管理
 * @author phachon@163.com
 */
class Controller_Author extends Controller {

	protected $_default = 'layouts/login';

	/**
	 * login view
	 */
	public function action_index() {

		$content = View::factory($this->_default);
		$this->response->body($content);
	}

	/**
	 * 登录
	 * @return json
	 */
	public function action_login() {

		$name = Arr::get($_POST, 'name', '');
		$password = Arr::get($_POST, 'password', '');

		if($name == '') {
			return Prompt::jsonError('用户名不能为空!');
		}
		if($password == '') {
			return Prompt::jsonError('密码不能为空!');
		}

		$accounts = Business::factory('Account')->getAccountByName($name);
		if($accounts->count() == 0) {
			Logs::instance()->write('登录失败');
			return Prompt::jsonError('账号或密码错误!');
		}
		$account = $accounts->current();
		if($account->getPassword() != md5($password)) {
			return Prompt::jsonError('账号或密码错误!');
		}
		if($account->status == Model_Account::STATUS_DELETE) {
			return Prompt::jsonError('账号已被屏蔽!');
		}

		//保存 seesion 信息
		Session::instance()->set('author', $account);
		Logs::instance()->write('账号 '.$name.' 登录成功');
		return Prompt::jsonSuccess('登录成功', URL::site('main/index'));

	}

	/**
	 * 退出
	 */
	public function action_logout() {

		$account = Session::instance()->get('author');
		Logs::instance()->write($account->getName().' 退出登录');
		Session::instance()->delete('author');
		return Prompt::successView('退出成功', URL::site('author/index'));
	}

	/**
	 * 注册
	 */
	public function action_register() {
		$content = View::factory('layouts/register');
		$this->response->body($content);
	}

	/**
	 * 注册保存
	 */
	public function action_save() {

		$name = Arr::get($_POST, 'name', '');
		$givenName = Arr::get($_POST, 'given_name', '');
		$email = Arr::get($_POST, 'email', '');
		$mobile = Arr::get($_POST, 'mobile', '');
		$password = Arr::get($_POST, 'password', '');
		$repass = Arr::get($_POST, 'repass', '');
		$captcha = Arr::get($_POST, 'captcha', '');

		if($_SESSION['captcha'] != $captcha) {
			return Prompt::jsonError('验证码输入错误!');
		}
		if($password !== $repass) {
			return Prompt::jsonError('两次密码输入不一致!');
		}
		$values = [
			'name' => $name,
			'given_name' => $givenName,
			'email' => $email,
			'mobile' => $mobile,
			'password' => $password,
			'role_id' => Model_Role::DEFAULT_ROLE_ID,
		];

		try {
			$result = Business::factory('Account')->create($values);
		} catch (Exception $e) {
			return Prompt::jsonError($e);
		}

		return Prompt::jsonSuccess('恭喜你注册成功,请重新登录', URL::site('author/index'));
	}

	/**
	 * 验证码
	 */
	public function action_captcha() {
		header('Content-type: image/jpeg');
		$builder = new CaptchaBuilder();
		$builder->build(109, 40)->output();
		$_SESSION['captcha'] = $builder->getPhrase();
	}
}