#-----------------------------------
#- Pha Grab Video database
#- author phachon@163.com
#-----------------------------------

#创建数据库
CREATE DATABASE pha_grab_video CHARSET utf8;
#use
use pha_grab_video;

#session 表
DROP TABLE IF EXISTS `grab_session`;
CREATE TABLE `grab_session` (
  `session_id` varchar(24) NOT NULL DEFAULT '' COMMENT 'Session id',
  `last_active` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Last active time',
  `contents` varchar(1000) NOT NULL DEFAULT '' COMMENT 'Session data',
  PRIMARY KEY (`session_id`),
  KEY (`last_active`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 COMMENT='会话信息表';

#用户表
DROP TABLE IF EXISTS `grab_account`;
CREATE TABLE `grab_account` (
  `account_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '账号id',
  `name` char(100) NOT NULL DEFAULT '' COMMENT '用户名',
  `given_name` char(100) NOT NULL DEFAULT '' COMMENT '昵称',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `role_id` int(10) NOT NULL DEFAULT '0' COMMENT '角色id',
  `phone` char(20) NOT NULL DEFAULT '0' COMMENT '电话',
  `mobile` char(18) NOT NULL DEFAULT '0' COMMENT '手机',
  `email` char(100) NOT NULL DEFAULT '' COMMENT '邮箱',
  `token` char(32) NOT NULL DEFAULT '' COMMENT 'Token(用户api验证)',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0 正常 -1 删除',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='用户信息表';

INSERT INTO pha_grab_video.grab_account (name, given_name, password, role_id, phone, mobile, email, status, create_time, update_time) VALUES ('root', 'root', '96e79218965eb72c92a549dd5a330112', 1, '', '15201203612', 'panchao@gomeplus.com', 0, 1471512945, 1471593345);

#角色表
DROP TABLE IF EXISTS `grab_role`;
CREATE TABLE `grab_role` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'role id',
  `name` char(100) NOT NULL DEFAULT '' COMMENT '角色名',
  `privilege_menu` char(200) NOT NULL DEFAULT 'profile' COMMENT '角色权限菜单 profile,url,video',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0 正常 -1 删除',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='用户角色表';

INSERT INTO pha_grab_video.grab_role (name, privilege_menu, status, create_time, update_time) VALUES ('超级管理员', 'all', 0, 1471503644, 1471603059);

#可抓取网站表
DROP TABLE IF EXISTS `grab_website`;
CREATE TABLE `grab_website`(
  `website_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '网站id',
  `name` char(150) NOT NULL DEFAULT '' COMMENT '名称',
  `url` char(200) NOT NULL DEFAULT '' COMMENT 'url',
  `issue_key` char(100) NOT NULL DEFAULT '' COMMENT 'key 值',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0 正常 -1 不可用',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`website_id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='可抓取网站表';

#抓取的视频信息表
DROP TABLE IF EXISTS `grab_video`;
CREATE TABLE `grab_video`(
  `grab_video_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` char(200) NOT NULL DEFAULT '' COMMENT '标题',
  `url` char(200) NOT NULL DEFAULT '' COMMENT 'video_url',
  `file_name` char(200) NOT NULL DEFAULT '' COMMENT '文件名',
  `url_id` int(10) NOT NULL DEFAULT '0' COMMENT '来源网站',
  `account_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 -1 删除 0 默认待上传 1上传成功 2 上传失败',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`grab_video_id`)
)ENGINE=InnoDB CHARSET=UTF8 COMMENT='抓取视频信息表';

#抓取 url 地址表
DROP TABLE IF EXISTS `grab_url`;
CREATE TABLE `grab_url`(
  `url_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'url id',
  `url` char(150) NOT NULL DEFAULT '' COMMENT '抓取地址',
  `website_id` int(10) NOT NULL DEFAULT '0' COMMENT '网站来源',
  `account_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 -1 删除 0待抓取 1已抓取 2抓取失败',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`url_id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='抓取url表';

#日志信息表
DROP TABLE IF EXISTS `grab_log`;
CREATE TABLE `grab_log`(
  `log_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'log id',
  `message` varchar(255) NOT NULL DEFAULT '' COMMENT '信息',
	`ip` char(100) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `user_agent` char(200) NOT NULL DEFAULT '' COMMENT '用户代理',
  `referer` char(100) NOT NULL DEFAULT '' COMMENT 'referer',
	`account_id` int(10) NOT NULL DEFAULT 0 COMMENT '帐号id',
	`account_name` char(100) NOT NULL DEFAULT '' COMMENT '用户名',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	PRIMARY KEY (`log_id`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='日志信息表';

#抓取视频日志表
DROP TABLE IF EXISTS `grab_log_video`;
CREATE TABLE `grab_log_video` (
  `log_video_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'log id',
  `message` varchar(255) NOT NULL DEFAULT '' COMMENT '信息',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '级别，0-info提示描述性信息，1-warn警告性质的信息，2-error错误信息，3-debug调试信息',
  `extra` text NOT NULL  COMMENT '具体描述信息GET,POST,throw',
  `url_id` bigint(20) NOT NULL DEFAULT 0 COMMENT 'url_id',
  `grab_video_id` bigint(20) NOT NULL DEFAULT 0 COMMENT 'grab_video_id',
  `video_id` bigint(20) NOT NULL DEFAULT 0 COMMENT 'video_id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`log_video_id`),
  KEY `url_id` (`url_id`),
  KEY `grab_video_id` (`grab_video_id`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='抓取视频日志表';