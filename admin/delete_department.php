<?php
/*
 * Created by wolf on 2015年8月24日 下午6:31:13
 */

require_once './lib/set_error_reporting.php';
require_once './lib/pdo_recruit.php';
require_once './lib/aes.php';
require_once './lib/encryption.php';
require_once './lib/PasswordHash.php';

$insertStmt_blacklist=$pdo->prepare("insert into blacklist (ip,PHP_Cookie,student_id,Channel,time,type) values (:ip,:PHP_Cookie,:student_id,:Channel,Now(),:type)");
$selectStmt=$pdo->prepare("select * from admin_loginfo where admin_id=:admin_id");

$admin_id=decrypt($_COOKIE['Web_Cookie']);
$selectStmt->bindValue(':admin_id', $admin_id);
$selectStmt->execute();
$loginfo=$selectStmt->fetch();
$selectStmt->closeCursor();
$logpasswd=$aes->decode($loginfo[password]);
$hasher = new PasswordHash(8, FALSE);
$Path=$_COOKIE['Path'];
$Hull='$2a$08$'.substr($Path, 3, strlen($Path)-9);
$check_message=$logpasswd.$passwd_identifier;
$if_match=$hasher->CheckPassword($check_message, $Hull);

if ($logpasswd!="" && $_COOKIE['Path'] && !$if_match) {
    $ip=$_SERVER["REMOTE_ADDR"];
    $Web_Cookie=$_COOKIE['Web_Cookie'];
    $pdo->query("set names 'utf8'");
    $insertStmt_blacklist->bindValue(':ip', $ip);
    $insertStmt_blacklist->bindValue(':PHP_Cookie', $Web_Cookie);
    $insertStmt_blacklist->bindValue(':student_id', $admin_id);
    $insertStmt_blacklist->bindValue(':Channel', $Path);
    $insertStmt_blacklist->bindValue(':type', "伪造cookie");
    $insertStmt_blacklist->execute();
    $insertStmt_blacklist->closeCursor();
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("身份伪造，您的敏感操作已被记录！");location.href="sign-in.php"</script>';
}
else if ($_COOKIE['Web_Cookie'] && $_COOKIE['Path'] && $logpasswd=="") {

    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的账户已被注销，您已被强制下线，如有问题请速联系相关人员！！");location.href="sign-in.php"</script>';
}
else if ($_COOKIE['Web_Cookie'] && $if_match) {

$switch=true;

if ($switch) {
    $deleteStmt_department_login_information=$pdo->prepare("delete from department_login_information where department_id=:department_id");
    $deleteStmt_department_basic_information=$pdo->prepare("delete from department_basic_information where department_id=:department_id");
    $selectStmt_department_login_information=$pdo->prepare("select * from department_login_information where department_id=:department_id");
    $selectStmt_department_basic_information=$pdo->prepare("select * from department_basic_information where department_id=:department_id");
    
    $department_id=$_GET['department_id'];
    echo $department_id;
    
    $check=true;
    $count=-1;
    
    while ($check) {
        echo ">>> 开始删除";echo "<br>";
        $checkcount=0;
        $count++;
        echo ">>> 正在删除登录信息";echo "<br>";
        $deleteStmt_department_login_information->bindValue(':department_id', $department_id);
        $deleteStmt_department_login_information->execute();
        $deleteStmt_department_login_information->closeCursor();
        echo ">>> 正在删除基本信息";echo "<br>";
        $deleteStmt_department_basic_information->bindValue(':department_id', $department_id);
        $deleteStmt_department_basic_information->execute();
        $deleteStmt_department_basic_information->closeCursor();
        echo ">>> 开始检查";echo "<br>";
        $selectStmt_department_login_information->bindValue(':department_id', $department_id);
        $selectStmt_department_login_information->execute();
        $arr=$selectStmt_department_login_information->fetch();
        $selectStmt_department_login_information->closeCursor();
        if ($arr[id]=="") {
            $checkcount++;
            echo '<font color=green>SUCCESS</font>';echo "<br>";
        }
        else {
            echo '<font color=red>Failed</font>';echo "<br>";
        }
        $selectStmt_department_basic_information->bindValue(':department_id', $department_id);
        $selectStmt_department_basic_information->execute();
        $arr=$selectStmt_department_basic_information->fetch();
        $selectStmt_department_basic_information->closeCursor();
        if ($arr[id]=="") {
            $checkcount++;
            echo '<font color=green>SUCCESS</font>';echo "<br>";
        }
        else {
            echo '<font color=red>Failed</font>';echo "<br>";
        }
        if ($checkcount==2) {
            echo ">>> 检查完毕，删除完成";echo "<br>";
            $check=false;
        }
        else {
            echo ">>> 检查发现：删除未彻底，开始第".($count+2)."次尝试";echo "<br>";echo "<br>";
        }
    }
    
    echo '<script type="text/javascript">alert("删除成功");location.href="department_information.php"</script>';
    
}
else {
    echo '<script type="text/javascript">alert("此功能已停止使用！");location.href="department_information.php"</script>';
}


}
else if ($_COOKIE['Path'] && !$_COOKIE['Web_Cookie']) {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}
else {
    echo '<script type="text/javascript">location.href="sign-in.php"</script>';
}

?>