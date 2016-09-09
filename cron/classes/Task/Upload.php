<?php
/**
 *
 * @author: phachon@163.com
 * Time: 14:37
 */
class Task_Upload extends Minion_Task {

	protected $_options = array(
		'foo' => 'bar',
		'bar' => NULL,
	);

	/**
	 * gvs 系统 account_id
	 * @var string
	 */
	protected $_accountId = 4902;

	/**
	 * execute
	 * @param array $params
	 */
	protected function _execute(array $params) {

		$videos = Business::factory('Video')->getDefaultVideos();
		if($videos->count() > 0) {
			foreach($videos as $video) {
				$grabVideoId = $video->getGrabVideoId();
				$title = $video->getTitle();
				$fileName = $video->getFileName();
				$urlId = $video->getUrlId();

				$urls = Business::factory('Url')->getUrlByUrlId($urlId);
				$websiteId = $urls->current()->getWebsiteId();
				$websites = Business::factory('Website')->getWebsiteByWebsiteId($websiteId);
				$position = $websites->current()->getDelogoPosition();
				
				//上传
				try {
					$video = Video::instance()
//						->grabVideoId($grabVideoId)
//						->urlId($urlId)
						->title($title)
						->position($position)
						->fileName($fileName)
						->accountId($this->_accountId)
						->videoFile(VIDEODIR.$fileName.'.flv')
						->createVideo()
						->upload();
				} catch (Exception $e) {
					Log_Video::error()
						->grabVideoId($grabVideoId)
						->urlId($urlId)
						->message('上传视频失败')->extra($e->getMessage())
						->write();
					Business::factory('Video')->updateStatusByGrabVideoId(Model_Video::STATUS_UPLOAD_FAILED, $grabVideoId);
					//exit();
					continue;
				}

				//修改video_id和状态
				$values = [
					'video_id' => $video->getVideoId(),
					'status' => Model_Video::STATUS_UPLOAD_SUCCESS
				];

				Business::factory('Video')->updateByGrabVideoId($values, $grabVideoId);
				
				Log_Video::info()
					->grabVideoId($grabVideoId)
					->urlId($urlId)
					->videoId($video->getVideoId())->extra(json_encode($video->getVideoInfo()))
					->message('上传视频成功')
					->write();
				//exit();
			}
		}
	}
}