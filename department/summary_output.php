<?php
require_once './lib/set_error_reporting.php';

require_once './lib/pdo_recruit.php';
require_once './lib/PasswordHash.php';
require_once './lib/aes.php';
require_once './lib/system_config.php';

header("Content-type: text/html;charset=utf-8");

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

$display_block_1=<<<END_OF_TEXT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
p {
    line-height:0.5;
	font-size:14px;
}
</style>
<title>部门名字签到表</title>

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
<h2 align="center">社团名字报名信息汇总</h2>
<p align="left">部门名称：部门名字</p>
<p align="left">志愿顺序：第一志愿 </p>
<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="36"><p align="center">序号 </p></td>
    <td width="68"><p align="center">学号 </p></td>
    <td width="71"><p align="center">姓名 </p></td>
    <td width="155"><p align="center">学院 </p></td>
    <td width="198"><p align="center">专业 </p></td>
    <td width="121"><p align="center">联系电话 </p></td>
    <td width="86"><p align="center">签到 </p></td>
  </tr>
END_OF_TEXT;

$display_block_1=str_replace('var u="URL";', 'var u="'.TRACKERURL.'";', $display_block_1);
$display_block_1=str_replace("_paq.push(['setSiteId', id]);","_paq.push(['setSiteId', ".SITEID."]);", $display_block_1);
$display_block_1=str_replace('<noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>', '<noscript><p><img src="'.TRACKERURL.'?idsite='.SITEID.'" style="border:0;" alt="" /></p></noscript>', $display_block_1); 

$display_block_2=<<<END_OF_TEXT
  <tr>
    <td width="36"><p align="center">&nbsp;</p></td>
    <td width="68"><p align="center">&nbsp;</p></td>
    <td width="71"><p align="center">&nbsp;</p></td>
    <td width="155"><p align="center">&nbsp;</p></td>
    <td width="198"><p align="center">&nbsp;</p></td>
    <td width="121"><p align="center">&nbsp;</p></td>
    <td width="86"><p align="center">&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
END_OF_TEXT;

$selectStmt_first_choice=$pdo->prepare("select * from student_choice join student_basic_information 
    on student_choice.student_id = student_basic_information.student_id
    where student_choice.first_choice=:first_id");
$selectStmt_second_choice=$pdo->prepare("select * from student_choice join student_basic_information
    on student_choice.student_id = student_basic_information.student_id
    where student_choice.second_choice=:second_id");

$showlist="";

if ($_POST['choice'] == 1) {
    $selectStmt_first_choice->bindValue(':first_id', $id);
    $selectStmt_first_choice->execute();
    $arr=$selectStmt_first_choice->fetchAll();
    $rowcount=$selectStmt_first_choice->rowCount();
    $selectStmt_first_choice->closeCursor();
    
    for ($i = 0; $i < $rowcount; $i++) {
        $display_show=<<<END_OF_TEXT
  <tr>
    <td><p align="center">1</p></td>
    <td><p align="center">学号</p></td>
    <td><p align="center">学生姓名</p></td>
    <td><p align="center">学院</p></td>
    <td><p align="center">专业</p></td>
    <td><p align="center">phone</p></td>
    <td><p align="center">&nbsp;</p></td>
  </tr>
END_OF_TEXT;
        $display_show=preg_replace('/1/', ($i+1), $display_show);
        $display_show=preg_replace('/学号/', $arr[$i][student_id], $display_show);
        $display_show=preg_replace('/学生姓名/', $arr[$i][name], $display_show);
        $display_show=preg_replace('/学院/', $arr[$i][school], $display_show);
        $display_show=preg_replace('/专业/', $arr[$i][major], $display_show);
        $display_show=preg_replace('/phone/', $arr[$i][phone], $display_show);
        $showlist.=$display_show;
    }
}
else if ($_POST['choice']==2) {
    $selectStmt_second_choice->bindValue(':second_id', $id);
    $selectStmt_second_choice->execute();
    $arr=$selectStmt_second_choice->fetchAll();
    $rowcount=$selectStmt_second_choice->rowCount();
    $selectStmt_second_choice->closeCursor();
    $display_block_1=preg_replace('/第一志愿/', '第二志愿', $display_block_1);
    
    for ($i = 0; $i < $rowcount; $i++) {
        $display_show=<<<END_OF_TEXT
  <tr>
    <td><p align="center">1</p></td>
    <td><p align="center">学号</p></td>
    <td><p align="center">学生姓名</p></td>
    <td><p align="center">学院</p></td>
    <td><p align="center">专业</p></td>
    <td><p align="center">phone</p></td>
    <td><p align="center">&nbsp;</p></td>
  </tr>
END_OF_TEXT;
        $display_show=preg_replace('/1/', ($i+1), $display_show);
        $display_show=preg_replace('/学号/', $arr[$i][student_id], $display_show);
        $display_show=preg_replace('/学生姓名/', $arr[$i][name], $display_show);
        $display_show=preg_replace('/学院/', $arr[$i][school], $display_show);
        $display_show=preg_replace('/专业/', $arr[$i][major], $display_show);
        $display_show=preg_replace('/phone/', $arr[$i][phone], $display_show);
        $showlist.=$display_show;
    }
}

$display_block_1=preg_replace('/社团名字/', ASSOCIATION_NAME, $display_block_1);
$display_block_1=preg_replace('/部门名字/', $department_name, $display_block_1);

echo $display_block_1.$showlist.$display_block_2;

}
else {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}

?>