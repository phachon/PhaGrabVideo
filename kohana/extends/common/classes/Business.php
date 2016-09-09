<?php
/**
 * Business 基类
 * @author: phachon@163.com
 * Time: 14:49
 */
abstract class Business {

	/**
	 * 注册对象树
	 * @var array
	 */
	protected static $_objTree = [];

	public static function factory($name) {

		$class = "Business_$name";
		if(!isset(self::$_objTree[$class])) {
			self::$_objTree[$class] = new $class();
		}
		return self::$_objTree[$class];
	}
}