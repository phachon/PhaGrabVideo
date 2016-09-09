<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Task demo
 * @author phachon@163.com
 */
class Task_Base extends Minion_Task {

    protected $_options = array(
        'foo' => 'bar',
        'bar' => NULL,
    );
 
    /**
     * This is a demo task
     * @return null
     */
    protected function _execute(array $params) {

    }
}