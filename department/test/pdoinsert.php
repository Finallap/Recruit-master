<?php
/*
 * Created by wolf on 2015年8月16日 下午7:35:29
 */
set_time_limit(0);
require_once '../lib/pdo_recruit.php';
require_once '../lib/RandChar.php';

$i=0;

while ($i < 40) {
    $i++;
    $student_id=$randCharObj->getRandChar(9);
    $pdo->query("set names 'utf8'");
    $pdo->query("insert into student_login_information (student_id) values ('$student_id')");
    $pdo->query("insert into student_status (student_id,ifconfirm,confirm_time) values ('$student_id','1',Now())");
    $pdo->query("insert into student_basic_information (student_id,sex,school) values ('$student_id','male','海外教育学院')");
    $pdo->query("insert into student_choice (student_id,first_choice,second_choice) values ('$student_id','5','4')");
    $pdo->query("insert into student_more_information (student_id,glory,hobby,evaluation,impress,wish) values ('$student_id','1','2','3','4','5')");
    $pdo->query("insert into student_interview_condition (student_id,second_choice_first_round) values ('$student_id','pass')");
}

$i=0;
while ($i < 10) {
    $i++;
    $student_id=$randCharObj->getRandChar(9);
    $pdo->query("set names 'utf8'");
    $pdo->query("insert into student_login_information (student_id) values ('$student_id')");
    $pdo->query("insert into student_status (student_id,ifconfirm,confirm_time) values ('$student_id','1',Now())");
    $pdo->query("insert into student_basic_information (student_id,sex,school) values ('$student_id','male','教育科学与技术学院')");
    $pdo->query("insert into student_choice (student_id,first_choice,second_choice) values ('$student_id','5','4')");
    $pdo->query("insert into student_more_information (student_id,glory,hobby,evaluation,impress,wish) values ('$student_id','1','2','3','4','5')");
    $pdo->query("insert into student_interview_condition (student_id,second_choice_first_round) values ('$student_id','pass')");
}

$i=0;
while ($i < 2) {
    $i++;
    $student_id=$randCharObj->getRandChar(9);
    $pdo->query("set names 'utf8'");
    $pdo->query("insert into student_login_information (student_id) values ('$student_id')");
    $pdo->query("insert into student_status (student_id,ifconfirm,confirm_time) values ('$student_id','1',Now())");
    $pdo->query("insert into student_basic_information (student_id,sex,school) values ('$student_id','male','其他')");
    $pdo->query("insert into student_choice (student_id,first_choice,second_choice) values ('$student_id','5','4')");
    $pdo->query("insert into student_more_information (student_id,glory,hobby,evaluation,impress,wish) values ('$student_id','1','2','3','4','5')");
    $pdo->query("insert into student_interview_condition (student_id,second_choice_first_round) values ('$student_id','pass')");
}

$i=0;
while ($i < 10) {
    $i++;
    $student_id=$randCharObj->getRandChar(9);
    $pdo->query("set names 'utf8'");
    $pdo->query("insert into student_login_information (student_id) values ('$student_id')");
    $pdo->query("insert into student_status (student_id,ifconfirm,confirm_time) values ('$student_id','1',Now())");
    $pdo->query("insert into student_basic_information (student_id,sex,school) values ('$student_id','female','传媒与艺术学院')");
    $pdo->query("insert into student_choice (student_id,first_choice,second_choice) values ('$student_id','5','4')");
    $pdo->query("insert into student_more_information (student_id,glory,hobby,evaluation,impress,wish) values ('$student_id','1','2','3','4','5')");
    $pdo->query("insert into student_interview_condition (student_id,second_choice_first_round) values ('$student_id','pass')");
}

$i=0;

while ($i < 40) {
    $i++;
    $student_id=$randCharObj->getRandChar(9);
    $pdo->query("set names 'utf8'");
    $pdo->query("insert into student_login_information (student_id) values ('$student_id')");
    $pdo->query("insert into student_status (student_id,ifconfirm,confirm_time) values ('$student_id','1',Now())");
    $pdo->query("insert into student_basic_information (student_id,sex,school) values ('$student_id','male','贝尔英才学院')");
    $pdo->query("insert into student_choice (student_id,first_choice,second_choice) values ('$student_id','5','4')");
    $pdo->query("insert into student_more_information (student_id,glory,hobby,evaluation,impress,wish) values ('$student_id','1','2','3','4','5')");
    $pdo->query("insert into student_interview_condition (student_id,first_choice_second_round) values ('$student_id','pass')");
}


$i=0;

while ($i < 40) {
    $i++;
    $student_id=$randCharObj->getRandChar(9);
    $pdo->query("set names 'utf8'");
    $pdo->query("insert into student_login_information (student_id) values ('$student_id')");
    $pdo->query("insert into student_status (student_id,ifconfirm,confirm_time) values ('$student_id','1',Now())");
    $pdo->query("insert into student_basic_information (student_id,sex,school) values ('$student_id','female','人文与社会科学学院')");
    $pdo->query("insert into student_choice (student_id,first_choice,second_choice) values ('$student_id','4','5')");
    $pdo->query("insert into student_more_information (student_id,glory,hobby,evaluation,impress,wish) values ('$student_id','1','2','3','4','5')");
    $pdo->query("insert into student_interview_condition (student_id,second_choice_second_round) values ('$student_id','notpass')");
}

$i=0;

while ($i < 40) {
    $i++;
    $student_id=$randCharObj->getRandChar(9);
    $pdo->query("set names 'utf8'");
    $pdo->query("insert into student_login_information (student_id) values ('$student_id')");
    $pdo->query("insert into student_status (student_id,ifconfirm,confirm_time) values ('$student_id','1',Now())");
    $pdo->query("insert into student_basic_information (student_id,sex,school) values ('$student_id','female','光电工程学院')");
    $pdo->query("insert into student_choice (student_id,first_choice,second_choice) values ('$student_id','4','5')");
    $pdo->query("insert into student_more_information (student_id,glory,hobby,evaluation,impress,wish) values ('$student_id','1','2','3','4','5')");
    $pdo->query("insert into student_interview_condition (student_id,second_choice_first_round) values ('$student_id','notpass')");
}


echo "insert success";