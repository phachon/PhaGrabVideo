<?php
/**
 * video
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Video extends Controller_Template {

	protected $_default = 'layouts/video';

	/**
	 * 列表
	 */
	public function action_list() {

		$keywords = trim(Arr::get($_GET, 'keywords', ''));

		if($keywords) {
			$total = Business::factory('Video')->countVideosByKeywords($keywords);
			$paginate = Paginate::factory($total);
			$videos = Business::factory('Video')->getVideosByKeywordsAndLimit($keywords, $paginate->offset(), $paginate->number());
		} else {
			$total = Business::factory('Video')->countVideos();
			$paginate = Paginate::factory($total);
			$videos = Business::factory('Video')->getVideosByLimit($paginate->offset(), $paginate->number());
		}

		$this->_default->content = View::factory('video/list')
			->bind('videos', $videos)
			->set('paginate', $paginate);
	}

	/**
	 * 视频重新上传
	 */
	public function action_again() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$grabVideoId = Arr::get($_GET, 'grab_video_id', 0);
		$grabVideos = Business::factory('Video')->getVideoByGrabVideoId($grabVideoId);
		if($grabVideos->count() == 0) {
			$this->error('视频id错误');
		}
		try {
			$result = Business::factory('Video')->updateStatusByGrabVideoId(Model_Video::STATUS_UPLOAD_DEFAULT, $grabVideoId);
			if(!$result) {
				Logs::instance()->write('重新上传视频失败 '.$grabVideoId.' 失败');
				return $this->error('重新上传视频失败');
			}
		} catch (Exception $e) {
			Logs::instance()->write('重新上传视频失败 '.$grabVideoId.' 失败: '.$e->getMessage());
			return $this->error('重新上传视频失败: ' . $e->getMessage());
		}

		Logs::instance()->write('重新上传视频成功 '.$grabVideoId.' 成功');
		Log_Video::info()
			->urlId($grabVideos->current()->getUrlId())->grabVideoId($grabVideoId)
			->message('重新上传视频')
			->write();
		return $this->success('重新上传视频成功', URL::site('video/list'));
	}

	/**
	 * 视频删除
	 */
	public function action_delete() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$grabVideoId = Arr::get($_GET, 'grab_video_id', 0);
		try {
			$result = Business::factory('Video')->updateStatusByGrabVideoId(Model_Video::STATUS_DELETE, $grabVideoId);
			if(!$result) {
				Logs::instance()->write('删除视频失败 '.$grabVideoId.' 失败');
				return $this->error('删除视频失败');
			}
		} catch (Exception $e) {
			Logs::instance()->write('删除视频失败 '.$grabVideoId.' 失败: '.$e->getMessage());
			return $this->error('删除视频失败: ' . $e->getMessage());
		}

		Logs::instance()->write('删除视频成功 '.$grabVideoId.' 成功');
		return $this->success('删除视频成功', URL::site('video/list'));
	}

	/**
	 * 视频上传日志
	 */
	public function action_log() {
		$grabVideoId = Arr::get($_GET, 'grab_video_id', '');

		$logs = Business::factory('Log_Video')->getLogsByGrabVideoId($grabVideoId);

		$this->_default->content = View::factory('video/log')
			->set('logs', $logs);
	}
}