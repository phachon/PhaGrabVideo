<?php
/**
 * Url 相关接口
 * @author: phachon@163.com
 * Time: 10:49
 */
class Controller_Url extends Controller_Base {

	/**
	 * index
	 */
	public function action_index() {
		return;
	}

	/**
	 * 根据状态获取获取url
	 */
	public function action_getUrls() {

		$status = Arr::get($_GET, 'status', '');

		if($status == '') {
			return $this->error('status error');
		} elseif ($status == Model_Url::STATUS_DEFAULT
			|| $status == Model_Url::STATUS_FAILED
			|| $status == Model_Url::STATUS_SUCCESS) {

			$urls = Business::factory('Url')->getUrlsByStatus($status);
		}else {
			return $this->error('status error');
		}

		if($urls->count() == 0) {
			return $this->success('no url data');
		}
		$values = [];
		foreach ($urls as $url) {
			$values[] = [
				'url_id' => intval($url->getUrlId()),
				'url' => $url->getUrl(),
				'website_id' => intval($url->getWebsiteId()),
				'account_id' => intval($url->getAccountId()),
				'status' => intval($url->getStatus()),
				'create_time' => intval($url->getCreateTime()),
				'update_time' => intval($url->getUpdateTime()),
			];
		}

		return $this->_data = $values;
	}

	/**
	 * 根据 url_id 来修改 url 状态
	 */
	public function action_updateStatus() {

		$urlId = Arr::get($_GET, 'url_id', 0);
		$status = Arr::get($_GET, 'status', 0);

		if(!is_numeric($urlId) || !$urlId) {
			return $this->error('url_id must integer');
		}
		if(!is_numeric($urlId)) {
			return $this->error('status must integer');
		}

		$urls = Business::factory('Url')->getUrlByUrlId($urlId);
		if($urls->count() == 0) {
			return $this->error('url_id not exists');
		}

		try {
			$result = Business::factory('Url')->updateStatusByUrlId($status, $urlId);
			if(!$result) {
				return $this->error('update status failed');
			}
		} catch (Exception $e) {
			return $this->error($e->getMessage());
		}
	}
}