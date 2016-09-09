<?php
/**
 * 抓取 url
 * @author: phachon@163.com
 * Time: 11:27
 */
class Business_Url extends Business {

	/**
	 * 创建一条 url 信息
	 * @param array $values
	 * @return integer
	 * @throws Business_Exception
	 */
	public function create(array $values) {

		$fields = array (
			'url' => 0,
			'website_id' => '',
			'account_id' => Author::accountId(),
			'status' => Dao_Url::STATUS_DEFAULT,
			'create_time' => time(),
			'update_time' => time(),
		);

		$values = array_intersect_key($values, $fields);
		$values = $values + $fields;
		$url = Arr::get($values, 'url', '');
		$websiteId = Arr::get($values, 'website_id', '');

		$errors = [];
		if(!$url) {
			$errors[] = 'url不能为空';
		}
		if(!Valid::url($url)) {
			$errors[] = 'url不合法';
		}
		if(!Valid::numeric($websiteId) || !$websiteId) {
			$errors[] = '没有选择URL来源';
		}
		if($errors) {
			throw new Business_Exception(implode(' ',$errors));
		}

		//验证 url 是否和来源网站匹配
		$info = parse_url($url);
		$host = $info['host'];
		$websites = Dao::factory('Website')->getWebsiteByWebsiteId($websiteId);
		if(!$websites->count()) {
			throw new Business_Exception('没有选择URL来源');
		}
		$websiteUrl = $websites->current()->getUrl();
		$position = stripos($host, $websiteUrl);
		if($position === false) {
			throw new Business_Exception('url 与来源不匹配');
		}

		return Dao::factory('Url')->insert($values);
	}

	/**
	 * 根据关键字来获取URL总数
	 * @param array $keywords
	 * @return array
	 */
	public function countUrlsByKeywords(array $keywords) {
		return Dao::factory('Url')->countUrlsByKeywords($keywords);
	}

	/**
	 * 根据关键字来分页获取URL
	 * @param array $keywords
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getUrlsByKeywordsAndLimit(array $keywords, $offset, $number) {
		return Dao::factory('Url')->getUrlsByKeywordsAndLimit($keywords, $offset, $number);
	}

	/**
	 * 获取URL总数
	 * @return array
	 */
	public function countUrls() {
		return Dao::factory('Url')->countUrls();
	}

	/**
	 * 分页获取获取URL
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getUrlsByLimit($offset, $number) {
		return Dao::factory('Url')->getUrlsByLimit($offset, $number);
	}

	/**
	 * 根据 url_id 来查找url
	 * @param integer $urlId
	 * @return mixed
	 */
	public function getUrlByUrlId($urlId = 0) {
		if(!$urlId) {
			return FALSE;
		}
		return Dao::factory('Url')->getUrlByUrlId($urlId);
	}

	/**
	 * 获取所有的URL
	 */
	public function getUrls() {
		return Dao::factory('Url')->getUrls();
	}

	/**
	 * 获取待抓取的url
	 */
	public function getDefaultUrls() {
		return Dao::factory('Url')->getDefaultUrls();
	}

	/**
	 * 根据状态获取urls
	 * @param integer $status
	 * @return array
	 */
	public function getUrlsByStatus($status) {
		if(!is_numeric($status)) {
			return [];
		}
		return Dao::factory('Url')->getUrlsByStatus($status);
	}

	/**
	 * 根据 url_id 删除url
	 * @param integer $urlId
	 * @return integer
	 */
	public function deleteByUrlId($urlId) {
		if(!$urlId) {
			return FALSE;
		}

		$values = [
			'status' => Dao_Url::STATUS_DELETE,
			'update_time' => time(),
		];

		return Dao::factory('Url')->updateByUrlId($values, $urlId);
	}

	/**
	 * 根据 url_id 重新抓取url
	 * @param integer $urlId
	 * @return integer
	 */
	public function againByUrlId($urlId) {
		if(!$urlId) {
			return FALSE;
		}

		$values = [
			'status' => Dao_Url::STATUS_DEFAULT,
			'update_time' => time(),
		];

		return Dao::factory('Url')->updateByUrlId($values, $urlId);
	}

	/**
	 * 根据 url_id 来更新状态
	 * @param integer $status
	 * @param integer $urlId
	 * @return integer
	 */
	public function updateStatusByUrlId($status, $urlId) {
		if(!$urlId) {
			return FALSE;
		}

		$values = [
			'status' => intval($status),
			'update_time' => time(),
		];

		return Dao::factory('Url')->updateByUrlId($values, $urlId);
	}
}