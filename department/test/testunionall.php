<?php
/*
 * Created by wolf on 2015年8月17日 上午10:06:33
 */

require_once '../lib/pdo_recruit.php';

$pdo->query("set names 'utf8'");
$selectStmt=$pdo->prepare("select * from student_status join student_choice on student_status.student_id=student_choice.student_id 
    join student_basic_information on student_status.student_id = student_basic_information.student_id
    join student_more_information on student_status.student_id = student_more_information.student_id
    where student_status.student_id=:student_id");
    
$selectStmt->bindValue(':student_id', "zV2mVBqGO");
$selectStmt->execute();
$arr=$selectStmt->fetch();
$selectStmt->closeCursor();

print_r($arr);