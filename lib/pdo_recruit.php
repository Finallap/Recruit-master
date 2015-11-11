<?php
/*
 * Created by wolf on 2015年8月7日 下午9:21:26
 */

include_once 'system_config.php';

$dbname=DBNAME;
$host=HOST;
$port=PORT;

$dsn="mysql:dbname=$dbname;host=$host;port=$port";
$user=DB_USER;
$password=DB_PASSWORD;


global $pdo;
$pdo=new PDO($dsn,$user,$password); 
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);