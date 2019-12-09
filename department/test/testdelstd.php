<?php
/*
 * Created by wolf on 2015年8月10日 下午5:13:12
 */
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once '../lib/pdo_recruit.php';
// require_once '../lib/aes.php';

// $pdo->query("insert into student_choice (id,student_id) values ('3','H14')");


$pdo->query("delete from student_basic_information");
$pdo->query("delete from student_choice");
$pdo->query("delete from student_interview_condition");
$pdo->query("delete from student_login_information");
$pdo->query("delete from student_more_information");
$pdo->query("delete from student_status");

echo ">>> delete all students success!";