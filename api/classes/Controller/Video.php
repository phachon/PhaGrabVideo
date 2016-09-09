<?php
/**
 * grab视频相关接口
 * @author: phachon@163.com
 * Time: 10:49
 */
class Controller_Video extends Controller_Base {

	/**
	 * index
	 */
	public function action_index() {
		return;
	}

	/**
	 * 根据状态获取视频
	 */
	public function action_getVideos() {
		$status = Arr::get($_GET, 'status', '');

		if($status == '') {
			return $this->error('status error');
		} elseif ($status == Model_Video::STATUS_UPLOAD_DEFAULT
			|| $status == Model_Video::STATUS_UPLOAD_FAILED
			|| $status == Model_Video::STATUS_UPLOAD_SUCCESS) {

			$videos = Business::factory('Video')->getVideosByStatus($status);
		}else {
			return $this->error('status error');
		}
		if($videos->count() == 0) {
			return $this->success('no video data');
		}
		$values = [];
		foreach ($videos as $video) {
			$values[] = [
				'title' => $video->getTitle(),
				'url' => $video->getUrl(),
				'file_name' => $video->getFileName(),
				'upload_video_id' => $video->getUploadVideoId(),
				'url_id' => $video->getUrlId(),
				'account_id' => intval($video->getAccountId()),
				'status' => intval($video->getStatus()),
				'create_time' => intval($video->getCreateTime()),
				'update_time' => intval($video->getUpdateTime()),
			];
		}

		$this->_data = $values;
	}

	/**
	 * 创建视频记录
	 */
	public function create() {

		$title = Arr::get($_POST, 'title', '');
		$url = Arr::get($_POST, 'url', '');
		$urlId = Arr::get($_POST, 'url_id', 0);
		$fileName = Arr::get($_POST, 'file_name', '');

		if(!$urlId || !is_numeric($urlId)) {
			return $this->error('urlId must integer');
		}
		$urls = Business::factory('Url')->getUrlByUrlId($urlId);
		if($urls->count() == 0) {
			return $this->error('url_id not exists');
		}
		if(!$title) {
			return $this->error('title not is empty');
		}
		if(!$fileName) {
			return $this->error('file_name not is empty');
		}

		$values = [
			'title' => $title,
			'url' => $url,
			'url_id' => $urlId,
			'file_name' => $fileName,
		];

		try {
			$result = Business::factory('Video')->create($values);
			if(!$result) {
				return $this->error('创建视频失败');
			}
		} catch (Exception $e) {
			$this->error($e->getMessage());
		}
	}
}