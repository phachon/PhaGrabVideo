<?php
/**
 * 视频下载日志 business
 * @author: phachon@163.com
 * Time: 216-08-18 11:27
 */
class Business_Log_Download extends Business {

	/**
	 * 根据关键字获取日志数量
	 * @param string $keywords
	 * @return array
	 */
	public function countLogsByKeywords($keywords) {
		return Dao::factory('Log_Download')->countLogsByKeywords($keywords);
	}

	/**
	 * 根据关键字分页获取日志
	 * @param string $keywords
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getLogsByKeywordsAndLimit($keywords, $offset, $number) {
		return Dao::factory('Log_Download')->getLogsByKeywordsAndLimit($keywords, $offset, $number);
	}

	/**
	 * 获取日志总数
	 * @return array
	 */
	public function countLogs() {
		return Dao::factory('Log_Download')->countLogs();
	}

	/**
	 * 分页获取日志信息
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getLogsByLimit($offset, $number) {
		return Dao::factory('Log_Download')->getLogsByLimit($offset, $number);
	}

	/**
	 * 获取所有的日志
	 */
	public function getLogs() {
		return Dao::factory('Log_Download')->getLogs();
	}

	/**
	 * 根据 url_id 来查找日志
	 * @param $urlId
	 * @return array
	 */
	public function getLogsByUrlId($urlId) {
		return Dao::factory('Log_Download')->getLogsByUrlId($urlId);
	}

	/**
	 * 根据 grab_video_id 来查找日志
	 * @param integer $grabVideoId
	 * @return array
	 */
	public function getLogsByGrabVideoId($grabVideoId) {
		return Dao::factory('Log_Download')->getLogsByGrabVideoId($grabVideoId);
	}

}