<?php
/**
 * website model
 * @author: phachon@163.com
 * Time: 16:12
 */
class Model_Website extends Model_Base {

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
}