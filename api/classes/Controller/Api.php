<?php
/**
 * api
 * @author: panchao
 * Time: 12:16
 */
class Controller_Api extends Controller_Base {

	public function action_index() {

		return $this->success('api ready success');
	}
}