<?php
/**
 * 菜单配置
 * @author: phachon@163.com
 * Time: 11:03
 */
return array (

	'config' => array (
		
		//个人中心
		'profile' => array (
			'name' => '个人中心',
			'icon' => 'glyphicon glyphicon-wrench',
			'submenu' => array (
				array(
					'name' => '我的资料',
					'icon' => 'glyphicon glyphicon-list',
					'href' => 'profile/info',
				)
			),
		),

		//账号管理
		'account' => array (
			'name' => '账号管理',
			'icon' => 'glyphicon glyphicon-user',
			'submenu' => array (
//				array(
//					'name' => '添加账号',
//					'icon' => 'glyphicon glyphicon-list',
//					'href' => 'account/add',
//				),
				array(
					'name' => '账号列表',
					'icon' => 'glyphicon glyphicon-list',
					'href' => 'account/list',
				)
			),
		),

		//角色管理
		'role' => array (
			'name' => '角色管理',
			'icon' => 'glyphicon glyphicon-pushpin',
			'submenu' => array (
				array(
					'name' => '添加角色',
					'icon' => 'glyphicon glyphicon-list',
					'href' => 'role/add',
				),
				array(
					'name' => '角色列表',
					'icon' => 'glyphicon glyphicon-list',
					'href' => 'role/list',
				)
			),
		),

		//视频来源
		'website' => array (
			'name' => '视频来源',
			'icon' => 'glyphicon glyphicon-globe',
			'submenu' => array (
				array(
					'name' => '添加网站',
					'icon' => 'glyphicon glyphicon-list',
					'href' => 'website/add',
				),
				array(
					'name' => '网站列表',
					'icon' => 'glyphicon glyphicon-list',
					'href' => 'website/list',
				)
			),
		),

		//url 管理
		'url' => array (
			'name' => 'URL管理',
			'icon' => 'glyphicon glyphicon-share',
			'submenu' => array (
				array(
					'name' => '添加URL',
					'icon' => 'glyphicon glyphicon-list',
					'href' => 'url/add',
				),
				array(
					'name' => 'URL列表',
					'icon' => 'glyphicon glyphicon-list',
					'href' => 'url/list',
				)
			),
		),

		//视频管理
//		'video' => array (
//			'name' => '视频管理',
//			'icon' => 'glyphicon glyphicon-play-circle',
//			'submenu' => array (
//				array(
//					'name' => '视频列表',
//					'icon' => 'glyphicon glyphicon-list',
//					'href' => 'video/list',
//				),
//				array(
//					'name' => '我的视频',
//					'icon' => 'glyphicon glyphicon-list',
//					'href' => 'video/my',
//				)
//			),
//		),

		//日志管理
		'log' => array (
			'name' => '日志管理',
			'icon' => 'glyphicon glyphicon-inbox',
			'submenu' => array (
				array(
					'name' => '行为日志',
					'icon' => 'glyphicon glyphicon-list',
					'href' => 'log/list',
				),
				array(
					'name' => '抓取日志',
					'icon' => 'glyphicon glyphicon-list',
					'href' => 'log_download/list',
				)
			),
		),
	)
);