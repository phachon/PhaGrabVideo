<?php
/**
 * 日志管理
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Log extends Controller_Template {

	protected $_default = 'layouts/log';

	/**
	 * log 列表
	 */
	public function action_list() {
		$keywords = Arr::get($_GET, 'keywords', '');
		
		if($keywords != '') {
			$total = Business::factory('Log')->countLogsByKeywords($keywords);
			$paginate = Paginate::factory($total);
			$logs = Business::factory('Log')->getLogsByKeywordsAndLimit($keywords, $paginate->offset(), $paginate->number());
		} else {
			$total = Business::factory('Log')->countLogs();
			$paginate = Paginate::factory($total);
			$logs = Business::factory('Log')->getLogsByLimit($paginate->offset(), $paginate->number());
		}
		$this->_default->content = View::factory('log/list')
			->set('logs', $logs)
			->set('paginate', $paginate);

	}
}