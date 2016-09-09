<?php
/**
 * 写日志相关接口
 * @author: panchao
 * Time: 10:49
 */
class Controller_Log extends Controller_Base {

	/**
	 * 写入抓取日志
	 */
	public function action_grab() {

		$level = Arr::get($_POST, 'level', 0);
		$message = Arr::get($_POST, 'message', '');
		$extra = Arr::get($_POST, 'extra', '');
		$urlId = Arr::get($_POST, 'url_id', 0);
		$grabVideoId = Arr::get($_POST, 'grab_video_id', 0);
		$uploadVideoId = Arr::get($_POST, 'upload_video_id', 0);

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

		try {
			Log_Video::instance($level)
				->message($message)
				->extra($extra)
				->urlId($urlId)
				->grabVideoId($grabVideoId)
				->uploadVideoId($uploadVideoId)
				->write();
		} catch (Exception $e) {
			return $this->error($e->getMessage());
		}
	}
}