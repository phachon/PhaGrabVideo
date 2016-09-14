<?php
/**
 * 视频信息业务
 * @author: phachon@163.com
 * Time: 11:27
 */
class Business_Video extends Business {

	/**
	 * 创建一条视频信息
	 * @param array $values
	 * @return integer
	 * @throws Business_Exception
	 */
	public function create(array $values) {

		$fields = array (
			'title' => '',
			'url' => '',
			'file_name' => '',
			'upload_video_id' => 0,
			'url_id' => 0,
			'account_id' => 0,
			'status' => Dao_Video::STATUS_UPLOAD_DEFAULT,
			'create_time' => time(),
			'update_time' => time(),
		);

		$values = array_intersect_key($values, $fields);
		$values = $values + $fields;
		$title = Arr::get($values, 'title', '');
		$fileName = Arr::get($values, 'file_name', '');

		$errors = [];
		if(!$title) {
			$errors[] = 'title不能为空';
		}
		if(!$fileName) {
			$errors[] = 'file_name 不能为空';
		}
		if($errors) {
			throw new Business_Exception(implode(' ',$errors));
		}

		return Dao::factory('Video')->insert($values);
	}

	/**
	 * 根据关键字来获取视频总数
	 * @param array $keywords
	 * @return array
	 */
	public function countVideosByKeywords(array $keywords) {
		return Dao::factory('Video')->countVideosByKeywords($keywords);
	}

	/**
	 * 根据关键字来分页获取视频总数
	 * @param array $keywords
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getVideosByKeywordsAndLimit(array $keywords, $offset, $number) {
		return Dao::factory('Video')->getVideosByKeywordsAndLimit($keywords, $offset, $number);
	}

	/**
	 * 获取视频总数
	 * @return array
	 */
	public function countVideos() {
		return Dao::factory('Video')->countVideos();
	}

	/**
	 * 分页获取获取视频
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getVideosByLimit($offset, $number) {
		return Dao::factory('Video')->getVideosByLimit($offset, $number);
	}

	/**
	 * 根据 garb_video_id 来查找视频
	 * @param integer $grabVideoId
	 * @return mixed
	 */
	public function getVideoByGrabVideoId($grabVideoId = 0) {
		if(!$grabVideoId) {
			return FALSE;
		}
		return Dao::factory('Video')->getVideoByGrabVideoId($grabVideoId);
	}

	/**
	 * 获取所有的视频
	 * @return array
	 */
	public function getVideos() {
		return Dao::factory('Video')->getVideos();
	}

	/**
	 * 获取待上传的视频
	 */
	public function getDefaultVideos() {
		return Dao::factory('Video')->getDefaultVideos();
	}

	/**
	 * 根据状态来查找视频
	 * @param integer $status
	 * @return array
	 */
	public function getVideosByStatus($status) {
		return Dao::factory('Video')->getVideosByStatus($status);
	}

	/**
	 * 根据 grab_video_id 来修改视频状态
	 * @param integer $status
	 * @param integer $grabVideoId
	 * @return integer
	 */
	public function updateStatusByGrabVideoId($status, $grabVideoId) {
		if(!$grabVideoId) {
			return FALSE;
		}

		$values = [
			'status' => intval($status),
			'update_time' => time(),
		];

		return Dao::factory('Video')->updateByGrabVideoId($values, $grabVideoId);
	}

	/**
	 * 根据 grab_video_id 来修改视频信息
	 * @param $values
	 * @param $grabVideoId
	 * @return integer
	 */
	public function updateByGrabVideoId($values, $grabVideoId) {
		if(!$grabVideoId) {
			return FALSE;
		}

		$fields = array (
			'title' => '',
			'url' => '',
			'file_name' => '',
			'video_id' => 0,
			'url_id' => 0,
			'account_id' => 0,
			'status' => Dao_Video::STATUS_UPLOAD_DEFAULT,
		);

		$values = array_intersect_key($values, $fields);
		$values['update_time'] = time();

		return Dao::factory('Video')->updateByGrabVideoId($values, $grabVideoId);
	}
}