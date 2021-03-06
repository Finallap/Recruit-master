<?php
/*
 * Created by wolf on 2015年8月24日 下午12:24:41
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

if ($_GET['student_id']) {

    date_default_timezone_set('prc');       //设置时区
    
    $ifconfirm=$_POST['situation'];
    
    $selectStmt=$pdo->prepare("select * from student_status where student_id=:student_id");
    $updateStmt=$pdo->prepare("update student_status set ifconfirm=:ifconfirm,confirm_time=:confirm_time where student_id=:student_id");
    
    $student_id=$_GET['student_id'];
    $check=true;
    
    while ($check) {
        echo ">>> 开始修改状态";echo "<br>";
        $updateStmt->bindValue(':student_id', $student_id);
        $updateStmt->bindValue(':ifconfirm', $ifconfirm);
        if ($ifconfirm==0) {
            $updateStmt->bindValue(':confirm_time', '');
        }
        else if ($ifconfirm==1) {
            $updateStmt->bindValue(':confirm_time', date("Y-m-d H:i:s",time()));
        }
        $updateStmt->execute();
        $updateStmt->closeCursor();
        echo ">>> 状态修改完毕";echo "<br>";
    
        echo ">>> 开始检查";echo "<br>";
        $selectStmt->bindValue(':student_id', $student_id);
        $selectStmt->execute();
        $arr=$selectStmt->fetch();
        $selectStmt->closeCursor();
    
        if ($arr[ifconfirm]==$ifconfirm) {
            echo "<font color=green>SUCCESS</font>";echo "<br>";
            if ($ifconfirm==0 && $arr[confirm_time]=="") {
                $check=false;
                echo "<font color=green>SUCCESS</font>";echo "<br>";
                echo ">>> 检查完毕";echo "<br>";
            }
            else if ($ifconfirm==1 && $arr[confirm_time]!="") {
                $check=false;
                echo "<font color=green>SUCCESS</font>";echo "<br>";
                echo ">>> 检查完毕";echo "<br>";
            }
        }
        else {
            echo "<font color=red>FAILED</font>";echo "<br>";
            echo ">>> 状态修改失败，正在进行再次尝试";echo "<br>";
        }
    }
    
    
    $show='<script type="text/javascript">alert("状态修改成功");location.href="interview_situation_input.php";</script>';
    $show=preg_replace('/#学号#/', $student_id, $show);
    echo $show;
}
else if ($_GET['department_id']) {
    $pdo->query("set names 'utf8'");
    $selectStmt=$pdo->prepare("select * from department_basic_information where department_id=:department_id");
    $updateStmt=$pdo->prepare("update department_basic_information set department_name=:department_name where department_id=:department_id");
    
    $department_id=$_GET['department_id'];
    $department_name=$_POST['department_name'];
    $check=true;
    
    while ($check) {
        echo ">>> 开始修改部门名称";echo "<br>";
        $updateStmt->bindValue(':department_id', $department_id);
        $updateStmt->bindValue(':department_name', $department_name);
        $updateStmt->execute();
        $updateStmt->closeCursor();
        echo ">>> 名称修改完毕";echo "<br>";
        
        echo ">>> 开始检查";echo "<br>";
        $selectStmt->bindValue(':department_id', $department_id);
        $selectStmt->execute();
        $arr=$selectStmt->fetch();
        $selectStmt->closeCursor();
        if ($arr[department_name]==$department_name) {
            $check=false;
            echo "<font color=green>SUCCESS</font>";echo "<br>";
            echo ">>> 检查完毕";echo "<br>";
        }
        else {
            echo "<font color=red>FAILED</font>";echo "<br>";
            echo ">>> 状态修改失败，正在进行再次尝试";echo "<br>";
        }
    }
    
    echo '<script type="text/javascript">alert("部门名称修改成功");location.href="department_information.php";</script>';
}


}
else if ($_COOKIE['Path'] && !$_COOKIE['Web_Cookie']) {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}
else {
    echo '<script type="text/javascript">location.href="sign-in.php"</script>';
}
