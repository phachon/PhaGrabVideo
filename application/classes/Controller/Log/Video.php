<?php
/**
 * 抓取视频日志管理
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Log_Video extends Controller_Template {

	protected $_default = 'layouts/log/video';

	/**
	 * log 列表
	 */
	public function action_list() {
		$keyword = trim(Arr::get($_GET, 'keyword', ''));
		$searchType = trim(Arr::get($_GET, 'search_type', ''));

		$keywords = [];
		if($keyword && $searchType && in_array($searchType, ['url_id', 'video_id', 'grab_video_id'])) {
			$keywords[$searchType] = $keyword;
		}
		if($keywords) {
			$total = Business::factory('Log_Video')->countLogsByKeywords($keywords);
			$paginate = Paginate::factory($total);
			$logs = Business::factory('Log_Video')->getLogsByKeywordsAndLimit($keywords, $paginate->offset(), $paginate->number());
		} else {
			$total = Business::factory('Log_Video')->countLogs();
			$paginate = Paginate::factory($total);
			$logs = Business::factory('Log_Video')->getLogsByLimit($paginate->offset(), $paginate->number());
		}
		$this->_default->content = View::factory('log/video/list')
			->set('logs', $logs)
			->set('paginate', $paginate);
	}
}