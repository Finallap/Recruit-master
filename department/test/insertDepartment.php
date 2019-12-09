<?php
/*
 * Created by wolf on 2015年8月18日 下午7:52:37
 */

require_once '../lib/pdo_recruit.php';
require_once '../lib/aes.php';

$password=$aes->encode("123123");
$pdo->query("insert into department_login_information (id,department_id,password) values ('4','xcb','$password')");