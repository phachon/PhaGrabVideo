<?php
/**
 * log business
 * @author: phachon@163.com
 * Time: 216-08-08 11:27
 */
class Business_Log extends Business {


	/**
	 * 根据关键字获取日志数量
	 * @param string $keywords
	 * @return array
	 */
	public function countLogsByKeywords($keywords) {
		return Dao::factory('Log')->countLogsByKeywords($keywords);
	}

	/**
	 * 根据关键字分页获取日志
	 * @param string $keywords
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getLogsByKeywordsAndLimit($keywords, $offset, $number) {
		return Dao::factory('Log')->getLogsByKeywordsAndLimit($keywords, $offset, $number);
	}

	/**
	 * 获取日志总数
	 * @return array
	 */
	public function countLogs() {
		return Dao::factory('Log')->countLogs();
	}

	/**
	 * 分页获取日志信息
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getLogsByLimit($offset, $number) {
		return Dao::factory('Log')->getLogsByLimit($offset, $number);
	}

	/**
	 * 获取所有的日志
	 */
	public function getLogs() {
		return Dao::factory('Log')->getLogs();
	}
}