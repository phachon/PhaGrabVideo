<?php
/**
 * main
 * @author: phachon@163.com
 * Time: 12:03
 */
class Controller_Main extends Controller_Template {

	protected $_default = 'layouts/default';

	public function action_index() {
		$menus = Privilege::instance()->getMenus();
		$this->_default->content = View::factory('main/index')
			->set('menus', $menus);
	}
}