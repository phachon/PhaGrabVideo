<?php
/**
 * api 控制器基类
 * Class Controller_Api_Base
 * @author phachon@163.com
 */
class Controller_Base extends Controller {

	/**
	 * return data type
	 * @var string
	 */
	protected $_dataType = '';

	/**
	 * return format
	 * @var array
	 */
	protected $_returnFormats = [
		'json', 'xml', 'jsonp'
	];

	/**
	 * auto return
	 * @var bool
	 */
	protected $_autoResponse = TRUE;

	/**
	 * auto return json code
	 * @var int
	 */
	protected $_code = 1;

	/**
	 * auto return json message
	 * @var string
	 */
	protected $_message = 'ok';

	/**
	 * auto return json redirect
	 * @var null
	 */
	protected $_redirect = null;

	/**
	 * auto return json data
	 * @var array
	 */
	protected $_data = [];

	/**
	 * return body
	 * @var string
	 */
	protected $_body = '';

	/**
	 * jsonp
	 * @var string
	 */
	protected $_jsonp = '';

	/**
	 * token
	 * @var string
	 */
	protected $_token = '';

	/**
	 * name
	 * @var string
	 */
	protected $_name = '';

	/**
	 * account_id
	 * @var int
	 */
	protected $_accountId = 0;
	
	/**
	 * action before
	 */
	public function before() {

		$token = Arr::get($_REQUEST, 'token', '');
		$name = Arr::get($_REQUEST, 'name', '');

		if(!$token) {
			header('HTTP/1.1 403 Forbidden');
			exit('Your access to token is not found');
		}
		if(!$name) {
			header('HTTP/1.1 403 Forbidden');
			exit('Your access to name is not found');
		}

		$accounts = Business::factory('Account')->getAccountByName($name);

		if($accounts->count() == 0) {
			header('HTTP/1.1 403 Forbidden');
			exit('Your access to name is not valid');
		}
		if($accounts->current()->getStatus() != 0) {
			header('HTTP/1.1 403 Forbidden');
			exit('Your access to name is blocked');
		}
		if($token != $accounts->current()->getToken()) {
			header('HTTP/1.1 403 Forbidden');
			exit('Your access to token is not valid');
		}

		$this->_token = $token;
		$this->_name = $name;
		$this->_accountId = $accounts->current()->getAccountId();

		$this->_dataType = Arr::get($_REQUEST, 'data_type', 'json');
		$this->_jsonp = Arr::get($_REQUEST, 'data_type', 'jsonp');

		parent::before();
	}

	/**
	 * execute
	 * @return Response
	 */
	public function execute() {
		$this->before();

		$action = $this->request->action();

		$action = 'action_'.$action;

		if(!method_exists($this, $action)) {
			exit('The requested URL :'. $this->request->uri() .' was not found on this server.');
		}

		$this->{$action}();

		$this->after();

		return $this->response;
	}

	/**
	 * action after
	 */
	public function after() {
		$dataType = in_array($this->_dataType, $this->_returnFormats) ? $this->_dataType : 'json';

		if($dataType == 'json') {
			$this->response->headers('Content-type', 'application/json');
		}

		if($dataType == 'xml') {
			$this->response->headers('Content-type', 'text/xml');
		}

		if($dataType == 'jsonp') {
			$this->response->headers('Content-type', 'application/json');
		}

		if($this->_autoResponse === TRUE) {
			$data = array(
				'code' => $this->_code,
				'message' => $this->_message,
				'data' => $this->_data
			);

			if($dataType == 'json') {
				$this->_body = json_encode($data);
			}

			if($dataType == 'xml') {
				$this->_body = self::xml($data);
			}

			if($dataType == 'jsonp') {
				$this->_body = htmlspecialchars($this->_jsonp) . '(' . json_encode($data) . ')';
			}
		}
		$this->response->body($this->_body);

		parent::after();
	}

	/**
	 * return json when error
	 * @param string $message
	 * @param array $data
	 */
	public function error($message, $data = []) {
		$this->_code = 0;
		$this->_message = $message;
		$this->_data = $data;
	}

	/**
	 * return json when success
	 * @param string $message
	 * @param array $data
	 */
	public function success($message, $data = []) {
		$this->_code = 1;
		$this->_message = $message;
		$this->_data = $data;
	}

	static public function xml($data = array()) {
		static $xml = '';

		foreach($data as $key => $item) {
			if (is_numeric($key)) $key='item';
			$xml .= "<$key>";
			if(!is_array($item)) {
				$xml .= $item;
			} else {
				self::xml($item);
			}
			$xml .= "</$key>";
		}
		return "<document>".$xml."</document>";
	}
}
