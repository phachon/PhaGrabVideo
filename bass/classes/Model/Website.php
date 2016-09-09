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

	public function getDelogoRelPosition() {
		$positionArray = [
			'1' => '左上',
			'2' => '右上',
			'3' => '左下',
			'4' => '右下',
		];

		$delogoPosition = explode(',', $this->delogo_position);
		foreach ($delogoPosition as &$position) {
			$position = $positionArray[$position];
		}

		return implode('/', $delogoPosition);
	}
}