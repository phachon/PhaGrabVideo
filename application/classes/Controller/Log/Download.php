<?php
/**
 * 视频下载日志管理
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Log_Download extends Controller_Template {

	protected $_default = 'layouts/log/download';

	/**
	 * log 列表
	 */
	public function action_list() {
		$keyword = trim(Arr::get($_GET, 'keyword', ''));
		$searchType = trim(Arr::get($_GET, 'search_type', ''));

		$keywords = [];
		if($keyword && $searchType && in_array($searchType, ['url_id'])) {
			$keywords[$searchType] = $keyword;
		}
		if($keywords) {
			$total = Business::factory('Log_Download')->countLogsByKeywords($keywords);
			$paginate = Paginate::factory($total);
			$logs = Business::factory('Log_Download')->getLogsByKeywordsAndLimit($keywords, $paginate->offset(), $paginate->number());
		} else {
			$total = Business::factory('Log_Download')->countLogs();
			$paginate = Paginate::factory($total);
			$logs = Business::factory('Log_Download')->getLogsByLimit($paginate->offset(), $paginate->number());
		}
		$this->_default->content = View::factory('log/download/list')
			->set('logs', $logs)
			->set('paginate', $paginate);
	}
}