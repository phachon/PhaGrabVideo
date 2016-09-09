<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 提示跳转类  -- success,error,warning
 * @author phachon@163.com
 */
class Prompt {

	const  ERROR 	= 0;
	const  SUCCESS 	= 1;
	const  WARNING 	= 2;

	const ERRORVIEW 	= 'error';
	const SUCCESSVIEW 	= 'success';
	const WARNINGVIEW 	= 'warning';

	/**
	 * 成功返回 json 格式数据
	 * @param  string $messages  
	 * @param  string $redirect 
	 * @param  array  $data
	 * @return null
	 */
	public static function jsonSuccess($messages, $redirect = NULL, array $data = array ()) {

		return self::_message(self::SUCCESS, $messages, $redirect, $data);
	}

	/**
	 * 错误返回 json 格式数据
	 * @param  string $errors  
	 * @param  string $redirect 
	 * @param  array  $data
	 * @return null
	 */
	public static function jsonError($errors, $redirect = NULL, array $data = array ()) {

		return self::_message(self::ERROR, $errors, $redirect, $data);
	}

	/**
	 * 警告返回 json 格式数据
	 * @param  string $warnings  
	 * @param  string $redirect 
	 * @param  array  $data
	 * @return null
	 */
	public static function jsonWarning($warnings, $redirect = NULL, array $data = array ()) {

		return self::_message(self::WARNING, $warnings, $redirect, $data);
	}

	/**
	 * 返回 json 格式数据
	 * @param  integer $code
	 * @param  string  $messages
	 * @param  string  $redirect 
	 * @param  array   $data
	 * @return null
	 */
	protected static function _message($code, $messages, $redirect = NULL, array $data = array ()) {
		
		if(!is_array($messages)) {
			$messages = array($messages);
		}

		$data = array (
			'code' => $code,
			'messages' => $messages,
			'redirect' => $redirect,
			'data' => $data,
		);

		echo json_encode($data, true);
		//exit();
		return 1;
	}

	/**
	 * 返回错误页面
	 * @param  String $message  信息
	 * @param  String $redirect 跳转url
	 * @param  integer $timeout 停留时间
	 */
	public static function errorView($message, $redirect = NULL, $timeout = 3) {
		self::_messageView(self::ERRORVIEW, $message, $redirect, $timeout);
	}

	/**
	 * 返回警告页面
	 * @param  String $message  信息
	 * @param  String $redirect 跳转url
	 * @param  integer $timeout 停留时间
	 */
	public static function warningView($message, $redirect = NULL, $timeout = 3) {
		self::_messageView(self::WARNINGVIEW, $message, $redirect, $timeout);
	}

	/**
	 * 返回成功页面
	 * @param  String $message  信息
	 * @param  String $redirect 跳转url
	 * @param  integer $timeout 停留时间
	 */
	public static function successView($message, $redirect = NULL, $timeout = 3) {
		self::_messageView(self::SUCCESSVIEW, $message, $redirect, $timeout);
	}

	/**
	 * 返回页面
	 * @param  String $view 页面
	 * @param  String $message  信息
	 * @param  String $redirect 跳转url
	 * @param  integer $timeout 停留时间
	 */
	protected static function _messageView($view, $message, $redirect, $timeout) {
		echo View::factory('prompt/' . $view)
				->set('message', $message)
				->set('redirect', $redirect)
				->set('timeout', $timeout);
		exit();
	}
}