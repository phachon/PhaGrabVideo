<?php
/**
 * url model
 * @author: phachon@163.com
 * Time: 16:12
 */
class Model_Url extends Model_Base {

	const STATUS_FAILED = 2; //抓取失败
	const STATUS_SUCCESS = 1; //已抓取
	const STATUS_DEFAULT = 0; //待抓取
	const STATUS_DELETE = -1; //删除

	/**
	 * 状态
	 * @return string
	 */
	public function getStatus() {
		if($this->status == self::STATUS_DEFAULT) {
			return "<span class='label label-info'>待抓取</span>";
		}elseif ($this->status == self::STATUS_SUCCESS) {
			return "<span class='label label-success'>抓取成功</span>";
		}elseif ($this->status == self::STATUS_FAILED) {
			return "<span class='label label-danger'>抓取失败</span>";
		}
	}

	/**
	 * time
	 * @param string $format
	 * @return mixed
	 */
	public function getCreateTime($format = '') {
		return $format ? date($format, $this->create_time) : $this->create_time;
	}

	/**
	 * 获取URL来源
	 */
	public function getWebsite() {
		$websites = Business::factory('Website')->getWebsiteByWebsiteId($this->website_id);
		if($websites->count() > 0) {
			return $websites->current()->getName();
		}else {
			return '';
		}
	}

	/**
	 * 获取账号名
	 */
	public function getAccountName() {
		$accounts = Business::factory('Account')->getAccountByAccountId($this->account_id);
		if($accounts->count() > 0) {
			return $accounts->current()->getName();
		}else {
			return $this->account_id;
		}
	}
}