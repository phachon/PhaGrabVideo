<?php
/**
 * role model
 * @author: phachon@163.com
 * Time: 16:12
 */
class Model_Role extends Model_Base {

	const STATUS_DELETE = -1;
	const STATUS_NORMAL = 0;

	const DEFAULT_ROLE_ID = 2;

	/**
	 * 状态
	 * @return string
	 */
	public function getStatus() {
		if(!$this->status) {
			return "<span class='text-success'>正常</span>";
		}else {
			return "<span class='text-warning'>不可用</span>";
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
}