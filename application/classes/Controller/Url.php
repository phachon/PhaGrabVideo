<?php
/**
 * 抓取的 URL 管理
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Url extends Controller_Template {

	protected $_default = 'layouts/url';

	/**
	 * 添加 url
	 */
	public function action_add() {
		$websites = Business::factory('Website')->getWebsites();
		$this->_default->content = View::factory('url/form')
			->set('websites', $websites);
	}

	/**
	 * 添加 url 保存
	 */
	public function action_save() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$urls = Arr::get($_POST, 'urls', '');
		$websiteId = Arr::get($_POST, 'website_id', 0);

		$errors = [];
		if(count($urls) > 5) {
			$errors[] = '抓取url不能大于5条';
		}
		if($errors) {
			return $this->error($errors);
		}

		$urls = explode("\n", $urls);
		$urlIds = [];
		foreach ($urls as $url) {
			try {
				$values = [
					'url' => $url,
					'website_id' => $websiteId,
				];
				$result = Business::factory('Url')->create($values);
			} catch (Exception $e) {
				Logs::instance()->write('添加URL失败: '.$e->getMessage());
				return $this->error('添加URL失败: ' . $e->getMessage());
			}
			$urlIds[] = $result[0];
			Log_Video::info()->urlId($result[0])
				->message('添加url成功')
				->write();
		}
		Logs::instance()->write('添加URL '.implode(',',$urlIds).' 成功');
		return $this->success('添加URL成功', URL::site('url/add'));
	}

	/**
	 * url 列表
	 */
	public function action_list() {
		$websiteId = intval(Arr::get($_GET, 'website_id', 0));
		$status = Arr::get($_GET, 'status', '');
		$url = trim(Arr::get($_GET, 'url', ''));

		$keywords = [];
		if($websiteId) {
			$keywords['website_id'] = $websiteId;
		}
		if($status !== '' && is_numeric($status)) {
			$keywords['status'] = $status;
		}
		if($url != '') {
			$keywords['url'] = $url;
		}
		if($keywords) {
			$total = Business::factory('Url')->countUrlsByKeywords($keywords);
			$paginate = Paginate::factory($total);
			$urls = Business::factory('Url')->getUrlsByKeywordsAndLimit($keywords, $paginate->offset(), $paginate->number());
		} else {
			$total = Business::factory('Url')->countUrls();
			$paginate = Paginate::factory($total);
			$urls = Business::factory('Url')->getUrlsByLimit($paginate->offset(), $paginate->number());
		}

		$websites = Business::factory('Website')->getWebsites();
		$this->_default->content = View::factory('url/list')
			->set('urls', $urls)
			->set('websites', $websites)
			->set('paginate', $paginate);
	}

	/**
	 * url 删除
	 */
	public function action_delete() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$urlId = Arr::get($_GET, 'url_id', 0);
		try {
			$result = Business::factory('Url')->deleteByUrlId($urlId);
			if(!$result) {
				Logs::instance()->write('删除URL '.$urlId.' 失败');
				return $this->error('删除URL失败');
			}
		} catch (Exception $e) {
			Logs::instance()->write('删除URL '.$urlId.' 失败: '.$e->getMessage());
			return $this->error('删除URL失败: ' . $e->getMessage());
		}

		Logs::instance()->write('删除URL成功 '.$urlId.' 成功');
		return $this->success('删除URL成功', URL::site('url/list'));
	}

	/**
	 * url 重新抓取
	 */
	public function action_again() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$urlId = Arr::get($_GET, 'url_id', 0);
		try {
			$result = Business::factory('Url')->againByUrlId($urlId);
			if(!$result) {
				Logs::instance()->write('重新抓取URL '.$urlId.' 失败');
				return $this->error('重新抓取URL失败');
			}
		} catch (Exception $e) {
			Logs::instance()->write('重新抓取URL '.$urlId.' 失败: '.$e->getMessage());
			return $this->error('重新抓取URL失败: ' . $e->getMessage());
		}

		Logs::instance()->write('重新抓取URL '.$urlId.' 成功');
		Log_Video::info()->urlId($urlId)
			->message('重新抓取url')
			->write();
		return $this->success('重新抓取URL成功', URL::site('url/list'));
	}

	/**
	 * 日志信息
	 */
	public function action_log() {
		$urlId = Arr::get($_GET, 'url_id', '');

		$logs = Business::factory('Log_Video')->getLogsByUrlId($urlId);

		$this->_default->content = View::factory('url/log')
			->set('logs', $logs);
	}
}