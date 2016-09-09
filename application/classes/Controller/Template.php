<?php
/**
 * 控制器基类
 * Class Controller_Template
 * @author phachon@163.com
 */
class Controller_Template extends Controller {

	/**
	 * content type html
	 */
	const CONTENT_TYPE_HTML = 'text/html';

	/**
	 * content type json
	 */
	const CONTENT_TYPE_JSON = 'application/json';

	/**
	 * content type xml
	 */
	const CONTENT_TYPE_XML = 'text/xml';

	/**
	 * default render
	 * @var string
	 */
	protected $_default = 'layouts/default';

	/**
	 * content type
	 * @var string
	 */
	protected $_contentType = 'text/html';

	/**
	 * auto render
	 * @var bool
	 */
	protected $_autoRender = TRUE;

	/**
	 * auto return json code
	 * @var int
	 */
	protected $_code = 0;

	/**
	 * auto return json messages
	 * @var string
	 */
	protected $_messages = '';

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
	 * login url
	 * @var string
	 */
	protected $_loginURL = '';

	/**
	 * action before
	 */
	public function before() {

		$host = "http://" . $_SERVER['HTTP_HOST'];
		$loginUrl = $host . URL::site('/author');
		$isLogin = Author::instance()->isLogin();
		$controller = strtolower(Request::$current->controller());

		if(!$isLogin) {
			Controller::redirect($loginUrl);
		}
		//权限控制
		if(!Privilege::instance()->control($controller)) {
			Prompt::errorView('没有权限', URL::site('main/index'));
		}
		parent::before();

		if($this->_autoRender === TRUE) {
			if($this->_contentType == self::CONTENT_TYPE_HTML) {
				$this->_default = View::factory($this->_default);
			}
		}
	}

	/**
	 * action after
	 */
	public function after() {
		$this->response->headers('Content-type', $this->_contentType);

		if($this->_autoRender === TRUE) {
			if($this->_contentType == self::CONTENT_TYPE_HTML) {
				$this->_body = $this->_default->render();
			}
			if($this->_contentType == self::CONTENT_TYPE_JSON) {
				$body = [
					'code' => $this->_code,
					'messages' => $this->_messages,
					'redirect' => $this->_redirect,
					'data' => $this->_data,
				];
				$this->_body = json_encode($body, true);
			}
			if($this->_contentType == self::CONTENT_TYPE_XML) {
				//TODO xml
				$this->_body = '';
			}

		}
		$this->response->body($this->_body);
		parent::after();
	}

	/**
	 * return json when error
	 * @param string $messages
	 * @param array $data
	 */
	public function error($messages, $data = []) {
		$this->_code = 0;
		$this->_messages = is_array($messages) ? $messages : [$messages];
		$this->_data = $data;
	}

	/**
	 * return json when success
	 * @param string $messages
	 * @param string $redirect
	 * @param array $data
	 */
	public function success($messages, $redirect = '', $data = []) {
		$this->_code = 1;
		$this->_messages = is_array($messages) ? $messages : [$messages];
		$this->_redirect = $redirect;
		$this->_data = $data;
	}
}
