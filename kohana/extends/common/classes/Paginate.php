<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 分页类
 * @author phachon@163.com
 */
class Paginate {

	/**
	 * 分页数据
	 * @var array
	 */
	protected $_pageData = array ();
	
	/**
	 * 当前页
	 * @var integer
	 */
	protected $_pageIndex = 0;
	
	/**
	 * 每页条数
	 * @var integer
	 */
	protected $_pageSize = 15;
	
	/**
	 * 总共条数
	 * @var integer
	 */
	protected $_total = 0;


	public static function factory($total, $defaultPageSize = 15, $defaultPageIndex = 0) {

		$pageSize = Arr::get($_GET, 'page_size', $defaultPageSize);
		$pageIndex = Arr::get($_GET, 'page_index', $defaultPageIndex);
		unset($_GET['page_size']);
		unset($_GET['page_index']);
		$urlQuery = $_GET;
		return new self($pageSize, $pageIndex, $total, $urlQuery);
	}

	public function __construct($pageSize, $pageIndex, $total, $urlQuery = array ()) {

		$this->_pageSize = $pageSize;
		$this->_pageIndex = $pageIndex;
		$this->_total = $total;

		$this->_pageData = array (
			'pageSize' => $pageSize,
			'pageIndex' => $pageIndex,
			'total' => $total,
			'urlQuery' => $urlQuery,
		);
	}

	public function pageSize() {
		return $this->_pageSize;
	}

	public function pageIndex() {
		return $this->_pageIndex;
	}

	public function pageData() {
		return json_encode($this->_pageData, true);
	}

	public function total() {
		return $this->_total;
	}

	public function offset() {

		return $this->_pageIndex * $this->_pageSize;
	}

	public function number() {
		return $this->_pageSize;
	}
}