<?php
/**
 * website business
 * @author: phachon@163.com
 * Time: 216-08-08 11:27
 */
class Business_Website extends Business {

	/**
	 * 创建一条 website
	 * @param array $values
	 * @throws Business_Exception
	 * @return integer
	 */
	public function create(array $values) {

		$fields = array (
			'name' => '',
			'url' => '',
			'issue_key' => '',
			'status' => Dao_Website::STATUS_NORMAL,
			'create_time' => time(),
			'update_time' => time(),
		);

		$values = array_intersect_key($values, $fields);
		$values = $values + $fields;
		$name = Arr::get($values, 'name', '');
		$url = Arr::get($values, 'url', '');

		$errors = [];
		if(!$name) {
			$errors[] = '名称不能为空';
		}
		if(!$url) {
			$errors[] = 'url不能为空';
		}
		if($errors) {
			throw new Business_Exception(implode(' ',$errors));
		}

		return Dao::factory('Website')->insert($values);
	}

	/**
	 * 根据名称获取网站数量
	 * @param string $name
	 * @return array
	 */
	public function countWebsitesByName($name) {
		return Dao::factory('Website')->countWebsitesByName($name);
	}

	/**
	 * 根据名称分页获取网站
	 * @param string $name
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getWebsitesByNameAndLimit($name, $offset, $number) {
		return Dao::factory('Website')->getWebsitesByNameAndLimit($name, $offset, $number);
	}

	/**
	 * 获取网站总数
	 * @return array
	 */
	public function countWebsites() {
		return Dao::factory('Website')->countWebsites();
	}

	/**
	 * 分页获取网站信息
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getWebsitesByLimit($offset, $number) {
		return Dao::factory('Website')->getWebsitesByLimit($offset, $number);
	}

	/**
	 * 根据 website_id 来查找网站
	 * @param integer $websiteId
	 * @return mixed
	 */
	public function getWebsiteByWebsiteId($websiteId = 0) {
		if(!$websiteId) {
			return FALSE;
		}
		return Dao::factory('Website')->getWebsiteByWebsiteId($websiteId);
	}

	/**
	 * 根据 websiteId 来修改网站
	 * @param array $values
	 * @param integer $websiteId
	 * @return mixed
	 * @throws Business_Exception
	 */
	public function updateByWebsiteId($values, $websiteId) {
		if(!$websiteId) {
			return FALSE;
		}

		$fields = array (
			'name' => '',
			'url' => '',
			'issue_key' => '',
			'delogo_position' => '',
		);

		$values = array_intersect_key($values, $fields);
		$values = $values + $fields;
		$name = Arr::get($values, 'name', '');
		$url = Arr::get($values, 'url', '');
		$delogoPosition = Arr::get($values, 'delogo_position', '');
		$values['update_time'] = time();

		$errors = [];
		if(!$name) {
			$errors[] = '名称不能为空';
		}
		if(!$url) {
			$errors[] = 'url不能为空';
		}
		if(!$delogoPosition) {
			$errors[] = '没有选择遮标位置';
		}
		if($errors) {
			throw new Business_Exception(implode(' ',$errors));
		}

		return Dao::factory('Website')->updateByWebsiteId($values, $websiteId);
	}

	/**
	 * 获取所有的网站
	 */
	public function getWebsites() {
		return Dao::factory('Website')->getWebsites();
	}
}