<?php
	header("Content-type: text/html;charset=utf-8");
	error_reporting(E_ERROR);

	//数据库连接常量，修改此处
	define(DBNAME, '');//数据库名
	define(HOST, '');//主机名
	define(PORT,'');//端口号
	define(DB_USER, '');//数据库用户名
	define(DB_PASSWORD, '');//数据库密码

	//加解密所用的key，修改此处
	define(AES_KEY, '');//AES_KEY长度不能超过32个字符
	define(ENCRYPTION_KEY, '');

	//社团名字，修改此处
	define(ASSOCIATION_NAME, '爱·服务公益社团');

	//piwik统计参数设置
	define(TRACKERURL, '');
	define(SITEID, '');
?>