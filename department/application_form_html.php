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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>报名信息查看页面</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.8.1.min.js" type="text/javascript"></script>

    <!-- Demo page code -->
    
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

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

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7"> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8"> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9"> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
            	<a class="brand" href="index.php"><img src="images/logo.png" width="195" height="22"></a>
                <ul class="nav pull-right">
                <li id="fat-menu" class="dropdown">
                        <a href="index.php" id="drop3" role="button" class="dropdown-toggle">
                             返回首页
                        </a>
                    </li>
                
                  <li id="fat-menu" class="dropdown">
                      <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="icon-briefcase"></i> 部门名称
                          <i class="icon-caret-down"></i>
                      </a>

                      <ul class="dropdown-menu">
                         <li><a tabindex="-1" href="check_registration_information.php">查看报名人员信息</a></li>
                             <li><a tabindex="-1" href="interview_situation_input.php">面试情况录入</a></li>
                  <li><a tabindex="-1" href="registration_information_static.php">报名信息统计</a></li>
                          <li><a tabindex="-1" href="password_change.php">部门密码修改</a></li>
                          <li class="divider"></li>
                          <li><a tabindex="-1" href="sign-in.php">注销</a></li>
                      </ul>
                    </li>
                    
                    <li id="fat-menu" class="dropdown">
                        <a href="sign-in.php" id="drop3" role="button" class="dropdown-toggle">
                             注销
                        </a>
                    </li>
                    
              </ul>

          </div>
        </div>
    </div>
    

    <div class="container-fluid">
        
        <div class="row-fluid">
            <div class="span3">
                <div class="sidebar-nav">
                  <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu"><i class="icon-dashboard"></i>社团与系统介绍</div>
                    <ul id="dashboard-menu" class="nav nav-list collapse in">
                    	 <li><a href="association_introduction.php">社团介绍</a></li>
                            <li><a href="department_introduction.php">部门介绍</a></li>
                      <li><a href="system_description.php">关于系统</a></li>
                        
                    </ul>
                <div class="nav-header" data-toggle="collapse" data-target="#accounts-menu"><i class="icon-briefcase"></i>信息与查看与录入</div>
                <ul id="accounts-menu" class="nav nav-list collapse in">
                  <li><a tabindex="-1" href="check_registration_information.php">查看报名人员信息</a></li>
                             <li><a tabindex="-1" href="interview_situation_input.php">面试情况录入</a></li>
                  <li><a tabindex="-1" href="registration_information_static.php">报名信息统计</a></li>
                </ul>
                <div class="nav-header" data-toggle="collapse" data-target="#legal-menu"><i class="icon-legal"></i>部门密码修改</div>
                <ul id="legal-menu" class="nav nav-list collapse in">
                 <li><a tabindex="-1" href="password_change.php">部门密码修改</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <h1 class="page-title">报名信息查看</h1>

<div class="block">
 	  <p class="block-heading"> 
     		学号姓名
      </p>
      <p class="block-heading"> 
        <a href="javascript:history.go(-1);" class="btn btn-primary"><i class="icon-download"></i> 返回检索页面</a>
      <a href="application_form_output.php?student_id=学生学号" class="btn btn-primary"><i class="icon-repeat"></i> 导出</a>
      </p>
                <div class="block-body">
                <div class="row-fluid">
                <table border="1" cellspacing="0" cellpadding="0" width="643" class="table">
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
                  <div class="clearfix"></div>
                  </div>
      </div>
          </div>


<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
    </div>
</div>

        </div>
    </div>
    

    <footer>
          <hr>
          <p>技术支持：&copy; 2015 <a href="http://www.aifuwu.org">学生发展中心（爱·服务公益社团）</a></p>
        </footer>   

    

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    
    
    
    
    
    

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
    $display_block=preg_replace('/学号姓名/', "学号：".$arr[student_id]." 姓名：".$arr[name], $display_block);
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