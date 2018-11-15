<?php
/**
 * 写日志相关接口
 * @author: phachon@163.com
 * Time: 10:49
 */
class Controller_Log extends Controller_Base {

	/**
	 * 写入抓取日志
	 */
	public function action_download() {

		$level = Arr::get($_POST, 'level', 0);
		$message = Arr::get($_POST, 'message', '');
		$extra = Arr::get($_POST, 'extra', '');
		$urlId = Arr::get($_POST, 'url_id', 0);

		if(!is_numeric($level)) {
			return $this->error('level must integer');
		}
		if(!$message) {
			return $this->error('message not empty');
		}
		if(!$urlId || !is_numeric($urlId)) {
			return $this->error('url_id si error');
		}

		$urls = Business::factory('Url')->getUrlByUrlId($urlId);
		if($urls->count() == 0) {
			return $this->error('url_id not exists');
		}
		if($urls->current()->getAccountId() != $this->_accountId) {
			return $this->error('You do not have permission to operate this url');
		}
		
		try {
			Log_Download::instance($level)
				->message($message)
				->extra($extra)
				->urlId($urlId)
				->write();
		} catch (Exception $e) {
			return $this->error($e->getMessage());
		}
	}
}