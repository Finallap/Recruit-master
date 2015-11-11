<?php
require_once './lib/set_error_reporting.php';

require_once './lib/pdo_recruit.php';
require_once './lib/PasswordHash.php';
require_once './lib/aes.php';
require_once './lib/system_config.php';

$selectStmt_department_login_information=$pdo->prepare("select * from department_login_information where department_id=:department_id");
$selectStmt_department_basic_information=$pdo->prepare("select * from department_basic_information where department_id=:department_id");

$department_id=$_COOKIE['Did'];
$selectStmt_department_login_information->bindValue(':department_id', $department_id);
$selectStmt_department_login_information->execute();
$loginfo=$selectStmt_department_login_information->fetch();
$selectStmt_department_login_information->closeCursor();
$id=$loginfo[id];
$logpasswd=$aes->decode($loginfo[password]);
$hasher = new PasswordHash(8, FALSE);
$Entrance=$_COOKIE['Entrance'];
$Hull='$2a$08$'.substr($Entrance, 3, strlen($Entrance)-9);
$check_message=$logpasswd.$passwd_identifier;
$if_match=$hasher->CheckPassword($check_message, $Hull);

$pdo->query("set names 'utf8'");
$selectStmt_department_basic_information->bindValue(':department_id', $department_id);
$selectStmt_department_basic_information->execute();
$basicinfo=$selectStmt_department_basic_information->fetch();
$department_name=$basicinfo[department_name];

if ($logpasswd!="" && $_COOKIE['Entrance'] && !$if_match) {

    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("身份伪造，您的敏感操作已被记录！");location.href="sign-in.php"</script>';
}
else if ($_COOKIE['Did'] && $_COOKIE['Entrance'] && $logpasswd=="") {

    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的账户已被注销，您已被强制下线，如有问题请速联系相关人员！！");location.href="sign-in.php"</script>';
}
else if ($_COOKIE['Did'] && $if_match) {

$display_block=<<<END_OF_TEXT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>招新报名表—学生学号</title>

    <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="URL";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', id]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>
    <!-- End Piwik Code -->

</head>

<body>
 <table border="1" cellspacing="0" cellpadding="0" width="643">
  <tr>
    <td width="643" colspan="5" align="center" valign="middle"><p align="center">社团名字招新报名表 </p></td>
  </tr>
  <tr>
    <td width="113" rowspan="5" align="center" valign="middle"><p>&ldquo;我的&rdquo; <br />
      资料 </p></td>
    <td width="113" align="center" valign="middle"><p align="center">姓名 </p></td>
    <td width="151" valign="middle"><p align="center">用户名字</p></td>
    <td width="113"><p align="center">性别 </p></td>
    <td width="151" align="center" valign="middle"><p align="center">#性别#</p></td>
  </tr>
  <tr>
    <td width="113" align="center" valign="middle"><p align="center">学号 </p></td>
    <td width="151" align="center" valign="middle"><p align="center">学生学号</p></td>
    <td width="113" align="center" valign="middle"><p align="center">籍贯 </p></td>
    <td width="151" align="center" valign="middle"><p align="center">学生籍贯</p></td>
  </tr>
  <tr>
   <td width="113" align="center" valign="middle"><p align="center">出生日期 </p></td>
    <td width="151" align="center" valign="middle"><p align="center">学生生日</p></td>
    <td width="113" align="center" valign="middle"><p align="center">学院专业 </p></td>
    <td width="151" align="center" valign="middle"><p align="center">学生学院<br>学生专业</p></td>
  </tr>
  <tr>
    <td width="113" align="center" valign="middle"><p align="center">宿舍地址 </p></td>
    <td width="151" valign="middle"><p align="center">学生宿舍</p></td>
    <td width="113" valign="middle"><p align="center">联系方式 </p></td>
    <td width="151" align="center" valign="middle"><p align="center">学生电话</p></td>
  </tr>
  <tr>
    <td width="113" align="center" valign="middle"><p align="center">QQ</p></td>
    <td width="151" align="center" valign="middle"><p align="center">学生QQ</p></td>
    <td width="113" align="center" valign="middle"><p align="center">邮箱 </p></td>
    <td width="151" align="center" valign="middle"><p align="center">学生邮箱</p></td>
  </tr>
  <tr>
    <td width="113" rowspan="2"><p align="center">&ldquo;我的&rdquo; <br />
      志愿 </p></td>
    <td width="113" align="center" valign="middle"><p align="center">第一志愿 </p></td>
    <td width="151" align="center" valign="middle"><p align="center">学生1志愿</p></td>
    <td width="113" align="center" valign="middle"><p align="center">第二志愿 </p></td>
    <td width="151" align="center" valign="middle"><p align="center">学生2志愿</p></td>
  </tr>
  <tr>
    <td width="529" colspan="4"><p align="center">是否服从社团调剂安排： if_agree_adjust </p></td>
  </tr>
  <tr>
    <td width="113" align="center" valign="middle"><p align="center">主要荣誉 </p></td>
    <td width="529" colspan="4" valign="top"><p align="left">glory</p></td>
  </tr>
  <tr>
    <td width="113" align="center" valign="middle"><p align="center">特长爱好 </p></td>
    <td width="529" colspan="4" valign="top"><p align="left">hobby</p></td>
  </tr>
  <tr>
    <td width="113" align="center" valign="middle"><p align="center">自我评价 </p></td>
    <td width="529" colspan="4" valign="top"><p>evaluation</p></td>
  </tr>
  <tr>
    <td width="113" align="center" valign="middle"><p align="center">对社团 <br />
      第一印象 </p></td>
    <td width="529" colspan="4" valign="top"><p>impress</p></td>
  </tr>
  <tr>
    <td width="113" align="center" valign="middle"><p align="center">对所报 <br />
      部门期望 </p></td>
    <td width="529" colspan="4" valign="top"><p align="left">wish</p></td>
  </tr>
</table>
</body>
</html>
END_OF_TEXT;

$display_block=str_replace('var u="URL";', 'var u="'.TRACKERURL.'";', $display_block);
$display_block=str_replace("_paq.push(['setSiteId', id]);","_paq.push(['setSiteId', ".SITEID."]);", $display_block);
$display_block=str_replace('<noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>', '<noscript><p><img src="'.TRACKERURL.'?idsite='.SITEID.'" style="border:0;" alt="" /></p></noscript>', $display_block); 


$pdo->query("set names 'utf8'");
$selectStmt=$pdo->prepare("select * from student_status join student_choice on student_status.student_id=student_choice.student_id
    join student_basic_information on student_status.student_id = student_basic_information.student_id
    join student_more_information on student_status.student_id = student_more_information.student_id
    where student_status.student_id=:student_id");
$selectStmt_department_basic_information_id=$pdo->prepare("select * from department_basic_information where id=:choice_id");

$student_id=$_GET['student_id'];


$selectStmt->bindValue(':student_id', $student_id);
$selectStmt->execute();
$arr=$selectStmt->fetch();
$selectStmt->closeCursor();

$selectStmt_department_basic_information_id->bindValue(':choice_id', $arr[first_choice]);
$selectStmt_department_basic_information_id->execute();
$arr_first=$selectStmt_department_basic_information_id->fetch();
$first_name=$arr_first[department_name];
$selectStmt_department_basic_information_id->closeCursor();

$selectStmt_department_basic_information_id->bindValue(':choice_id', $arr[second_choice]);
$selectStmt_department_basic_information_id->execute();
$arr_second=$selectStmt_department_basic_information_id->fetch();
$second_name=$arr_second[department_name];
$selectStmt_department_basic_information_id->closeCursor();

if ($id==$arr_first[id] || $id==$arr_second[id]) {

    $display_block=preg_replace('/社团名字/', ASSOCIATION_NAME, $display_block);
    $display_block=preg_replace('/部门名称/', $department_name, $display_block);
    $display_block=preg_replace('/学号姓名/', "学号：".$arr[student_id]." 姓名：".$arr[student_name], $display_block);
    $display_block=preg_replace('/用户名字/', $arr[name], $display_block);
    if ($arr[sex] == "male") {
        $display_block=preg_replace('/#性别#/', "男", $display_block);
    }
    else if ($arr[sex] == "female"){
        $display_block=preg_replace('/#性别#/', "女", $display_block);
    }
    $display_block=preg_replace('/学生学号/', $arr[student_id], $display_block);
    $display_block=preg_replace('/学生籍贯/', $arr[province].$arr[city], $display_block);
    $display_block=preg_replace('/学生生日/', $arr[birthday], $display_block);
    $display_block=preg_replace('/学生学院/', $arr[school], $display_block);
    $display_block=preg_replace('/学生专业/', $arr[major], $display_block);
    $display_block=preg_replace('/学生宿舍/', $arr[address], $display_block);
    $display_block=preg_replace('/学生电话/', $arr[phone], $display_block);
    $display_block=preg_replace('/学生QQ/', $arr[qq], $display_block);
    $display_block=preg_replace('/学生邮箱/', $arr[email], $display_block);
    $display_block=preg_replace('/学生1志愿/', $first_name, $display_block);
    $display_block=preg_replace('/学生2志愿/', $second_name, $display_block);
    if ($arr[if_agree_adjust] == "agree") {
        $display_block=preg_replace('/if_agree_adjust/', '✔  是     □  否', $display_block);
    }
    else {
        $display_block=preg_replace('/if_agree_adjust/', '□  是     ✔  否', $display_block);
    }
    
    $display_block=preg_replace('/glory/', $arr[glory], $display_block);
    $display_block=preg_replace('/hobby/', $arr[hobby], $display_block);
    $display_block=preg_replace('/evaluation/', $arr[evaluation], $display_block);
    $display_block=preg_replace('/impress/', $arr[impress], $display_block);
    $display_block=preg_replace('/wish/', $arr[wish], $display_block);
    
    
    echo $display_block;
}
else {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("此用户未填报您的部门");location.href="check_registration_information.php"</script>';
}

}
else {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}
?>