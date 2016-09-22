<?php
/**
 * 支持的抓取网站管理
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Website extends Controller_Template {

	protected $_default = 'layouts/website';

	/**
	 * 添加 website
	 */
	public function action_add() {
		$this->_default->content = View::factory('website/form');
	}

	/**
	 * 添加 website 保存
	 */
	public function action_save() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$name = Arr::get($_POST, 'name', '');
		$url = Arr::get($_POST, 'url', '');
		$issueKey = Arr::get($_POST, 'issue_key', '');

		$values = [
			'name' => $name,
			'url' => $url,
			'issue_key' => $issueKey,
		];

		try {
			$result = Business::factory('Website')->create($values);
		} catch (Exception $e) {
			Logs::instance()->write('添加网站失败: '.$e->getMessage());
			return $this->error('添加网站失败: '.$e->getMessage());
		}
		Logs::instance()->write('添加网站成功 '.$result[0].' 成功');
		return $this->success('添加网站成功', URL::site('website/add'));
	}

	/**
	 * website 列表
	 */
	public function action_list() {

		$name = Arr::get($_GET, 'keyword', '');
		if($name != '') {
			$total = Business::factory('Website')->countWebsitesByName($name);
			$paginate = Paginate::factory($total);
			$websites = Business::factory('Website')->getWebsitesByNameAndLimit($name, $paginate->offset(), $paginate->number());
		} else {
			$total = Business::factory('Website')->countWebsites();
			$paginate = Paginate::factory($total);
			$websites = Business::factory('Website')->getWebsitesByLimit($paginate->offset(), $paginate->number());
		}
		$this->_default->content = View::factory('website/list')
			->set('websites', $websites)
			->set('paginate', $paginate);

	}

	/**
	 * website 修改
	 */
	public function action_edit() {
		$websiteId = Arr::get($_GET, 'website_id', '');

		$website = Business::factory('Website')->getWebsiteByWebsiteId($websiteId);
		if($website->count() > 0) {
			$website = $website->current();
		}else {
			return Prompt::warningView('没有找到该网站');
		}
		$this->_default->content = View::factory('website/form')
			->set('website', $website);
	}

	/**
	 * 修改保存
	 */
	public function action_modify() {
		$this->_contentType = self::CONTENT_TYPE_JSON;

		$websiteId = Arr::get($_POST, 'website_id', '');
		$name = Arr::get($_POST, 'name', '');
		$url = Arr::get($_POST, 'url', '');
		$issueKey = Arr::get($_POST, 'issue_key', '');

		$values = [
			'name' => $name,
			'url' => $url,
			'issue_key' => $issueKey,
		];

		try {
			$result = Business::factory('Website')->updateByWebsiteId($values, $websiteId);
			if(!$result) {
				Logs::instance()->write('修改网站 '.$websiteId.' 失败');
				return $this->error('修改网站失败');
			}
		} catch (Exception $e) {
			Logs::instance()->write('修改网站 '.$websiteId.' 失败: '.$e->getMessage());
			return $this->error('修改网站失败: '.$e->getMessage());
		}
		Logs::instance()->write('修改网站 '.$websiteId.' 成功');
		return $this->success('修改网站成功', URL::site('website/list'));
	}
}