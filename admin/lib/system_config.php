<?php
	header("Content-type: text/html;charset=utf-8");
	error_reporting(E_ERROR);

	//数据库连接常量，修改此处
	define(DBNAME, 'recruit-bae-test');//数据库名
	define(HOST, 'localhost');//主机名
	define(PORT,'3306');//端口号
	define(DB_USER, 'root');//数据库用户名
	define(DB_PASSWORD, '');//数据库密码

	//加解密所用的key，修改此处
	define(AES_KEY, 'yiW7BPNI8ax0O39opkKCCFQS');//AES_KEY长度不能超过32个字符
	define(ENCRYPTION_KEY, 'yiW7BPNI8ax0O39opkKCCFQSeBUqzvI7MdQRGdFEfhs');

	//社团名字，修改此处
	define(ASSOCIATION_NAME, '学生发展中心（爱·服务公益社团）');

	//piwik统计参数设置
	define(TRACKERURL, '//182.254.159.149/piwik/');
	define(SITEID, '3');
?>