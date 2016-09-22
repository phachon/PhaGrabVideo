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
	 * 根据状态获取待下载的 url
	 */
	public function action_getDefaultUrls() {

		$urls = Business::factory('Url')->getUrlsByAccountIdAndStatus($this->_accountId, Model_Url::STATUS_DEFAULT);
		if($urls->count() == 0) {
			return $this->success('no url data');
		}
		$values = [];
		foreach ($urls as $url) {
			$values[] = [
				'url_id' => intval($url->getUrlId()),
				'url' => $url->getUrl(),
				'website_id' => intval($url->getWebsiteId()),
				'status' => intval($url->getStatus()),
				'create_time' => intval($url->getCreateTime()),
				'update_time' => intval($url->getUpdateTime()),
			];
		}

		return $this->_data = $values;
	}

	/**
	 * 根据 url_id 来修改 url 状态为成功
	 */
	public function action_downloadSuccess() {

		$urlId = Arr::get($_GET, 'url_id', 0);

		if(!is_numeric($urlId) || !$urlId) {
			return $this->error('url_id must integer');
		}

		$urls = Business::factory('Url')->getUrlByUrlId($urlId);
		if($urls->count() == 0) {
			return $this->error('url_id not exists');
		}
		if($urls->current()->getAccountId() != $this->_accountId) {
			return $this->error('You do not have permission to operate this url');
		}

		try {
			$result = Business::factory('Url')->updateStatusByUrlId(Model_Url::STATUS_SUCCESS, $urlId);
			if(!$result) {
				return $this->error('update status failed');
			}
		} catch (Exception $e) {
			return $this->error($e->getMessage());
		}
	}

	/**
	 * 根据 url_id 来修改 url 状态为失败
	 */
	public function action_downloadFailed() {

		$urlId = Arr::get($_GET, 'url_id', 0);

		if(!is_numeric($urlId) || !$urlId) {
			return $this->error('url_id must integer');
		}

		$urls = Business::factory('Url')->getUrlByUrlId($urlId);
		if($urls->count() == 0) {
			return $this->error('url_id not exists');
		}

		if($urls->current()->getAccountId() != $this->_accountId) {
			return $this->error('You do not have permission to operate this url');
		}

		try {
			$result = Business::factory('Url')->updateStatusByUrlId(Model_Url::STATUS_FAILED, $urlId);
			if(!$result) {
				return $this->error('update status failed');
			}
		} catch (Exception $e) {
			return $this->error($e->getMessage());
		}
	}
}