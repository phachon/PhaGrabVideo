<?php
/**
 * video model
 * @author: phachon@163.com
 * Time: 16:12
 */
class Model_Video extends Model_Base {

	const STATUS_UPLOAD_FAILED = 2;     //上传失败
	const STATUS_UPLOAD_SUCCESS = 1;    //上传成功
	const STATUS_UPLOAD_DEFAULT = 0;    //待上传
	const STATUS_DELETE = -1;           //删除

	/**
	 * 状态
	 * @return string
	 */
	public function getStatus() {
		if($this->status == self::STATUS_UPLOAD_SUCCESS) {
			return "<span class='label label-success'>上传成功</span>";
		}elseif ($this->status == self::STATUS_UPLOAD_FAILED) {
			return "<span class='label label-danger'>上传失败</span>";
		}elseif ($this->status == self::STATUS_UPLOAD_DEFAULT) {
			return "<span class='label label-info'>待上传</span>";
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