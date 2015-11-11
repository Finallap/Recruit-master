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

$display_block_1=<<<END_OF_TEXT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>报名信息查看导出</title>
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
            <h1 class="page-title">面试信息录入</h1>

 	  <p class="block-heading"> 
     		学号 姓名 <br> 
     		所选第一志愿   所选第二志愿<br>
      <a href="" class="btn btn-primary" onclick="javascript:history.back(-1);"><i class="icon-download"></i>返回录入检索页面</a>
        <a href="application_form_output.php?student_id=web_student_id" class="btn btn-primary"><i class="icon-search"></i>查看报名信息</a>
        </p>
               
            <p class="block-heading">该同学目前面试情况</p>
                <div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>面试轮次</th>
          <th>志愿顺序</th>
          <th>面试部门</th>
          <th>面试情况</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td rowspan="2">1</td>
          <td>第一志愿</td>
          <td>第一轮第一志愿</td>
END_OF_TEXT;

$display_block_1=str_replace('var u="URL";', 'var u="'.TRACKERURL.'";', $display_block_1);
$display_block_1=str_replace("_paq.push(['setSiteId', id]);","_paq.push(['setSiteId', ".SITEID."]);", $display_block_1);
$display_block_1=str_replace('<noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>', '<noscript><p><img src="'.TRACKERURL.'?idsite='.SITEID.'" style="border:0;" alt="" /></p></noscript>', $display_block_1); 

    
// <td>
// <form action="" method="post">
// <input name="round" id="round" type="hidden" value="1">
// <select id="result" name="result" class="input-small">
//           <option selected="select" value="unsure">未录入</option>
//           <option value="pass">面试通过</option>
//           <option value="notpass">未通过</option>
// </select>
// <input type="submit" id="" name="" value="保存结果" class="btn btn-primary" onclick= "if(confirm( '是否确定录入第一轮面试结果？ ')==false)return   false; ">
// </form>
    
    
$display_block_2=<<<END_OF_TEXT
</tr>
        <tr>
          <td>第二志愿</td>
          <td>第一轮第二志愿</td>
END_OF_TEXT;
    
    
    
//           <td>未通过<img src="images/wrong.png" width="20" height="20"></td>
          
$display_block_3=<<<END_OF_TEXT
</tr>
        <tr>
          <td rowspan="2">2</td>
          <td>第一志愿</td>
          <td>第二轮第一志愿</td>
END_OF_TEXT;
    
    
// <td>
// <form action="" method="post">
// <input name="round" id="round" type="hidden" value="2">
// <select id="result" name="result" class="input-small">
//           <option selected="select" value="0">未录入</option>
//           <option value="1">面试通过</option>
//           <option value="2">未通过</option>
// </select>
// <input type="submit" id="" name="" value="保存结果" class="btn btn-primary" onclick= "if(confirm( '是否确定录入第二轮面试结果？ ')==false)return   false; ">
// </form>
// </td>
          
          
$display_block_4=<<<END_OF_TEXT
</tr>
        <tr>
          <td>第二志愿</td>
          <td>第二轮第二志愿</td>
END_OF_TEXT;
    
    
//           <td>未录入<img src="images/question.png" width="20" height="20"></td>
          
$display_block_5=<<<END_OF_TEXT
</tr>
      </tbody>
    </table>
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

$pdo->query("set names 'utf8'");
$selectStmt_All=$pdo->prepare("select * from student_status join student_interview_condition on student_status.student_id = student_interview_condition.student_id
    join student_choice on student_choice.student_id = student_status.student_id
    join student_basic_information on student_status.student_id = student_basic_information.student_id
    where student_status.student_id = :student_id");
$selectStmt_department=$pdo->prepare("select * from department_basic_information where id=:id");
$updateStmt_first_1=$pdo->prepare("update student_interview_condition set first_choice_first_round=:condition,confirm_first_1=:ifconfirm where student_id=:student_id");
$updateStmt_first_2=$pdo->prepare("update student_interview_condition set first_choice_second_round=:condition,confirm_first_2=:ifconfirm where student_id=:student_id");
$updateStmt_second_1=$pdo->prepare("update student_interview_condition set second_choice_first_round=:condition,confirm_second_1=:ifconfirm where student_id=:student_id");
$updateStmt_second_2=$pdo->prepare("update student_interview_condition set second_choice_second_round=:condition,confirm_second_2=:ifconfirm where student_id=:student_id");

if ($_GET['choice'] == 1) {
    $get_choice=1;
 
}
else if ($_GET['choice'] == 2) {
    $get_choice=2;
   
}
else {
    $get_choice=-1;
    
}

if ($_GET['sex'] == "male") {
    $get_sex="male";
    
}
else if ($_GET['sex'] == "female") {
    $get_sex="female";
    
}
else {
    $get_sex="-1";
    
}

if ($_GET['page']=="undefined" || $_GET['page']=="") {
    $page=1;
}
else {
    $page=preg_replace('/#/', "", $_GET['page']);
}

if ($_GET['school'] == "") {
    $school_status="&school=-1";
}
else {
    $school_status="&school=".$_GET['school'];
}

$tailMessage="page=".$page."&choice=".$get_choice."&sex=".$get_sex.$school_status;


$student_id=$_GET['student_id'];
$selectStmt_All->bindValue(':student_id', $student_id);
$selectStmt_All->execute();
$arr=$selectStmt_All->fetch();
$selectStmt_All->closeCursor();

$id_first=$arr[first_choice];
$id_second=$arr[second_choice];
$selectStmt_department->bindValue(':id', $id_first);
$selectStmt_department->execute();
$arr_first=$selectStmt_department->fetch();
$selectStmt_department->closeCursor();
$selectStmt_department->bindValue(':id', $id_second);
$selectStmt_department->execute();
$arr_second=$selectStmt_department->fetch();
$selectStmt_department->closeCursor();

if ($id==$arr_first[id] || $id==$arr_second[id]) {

if ($arr_second[department_name] == "") {
    $arr_second[department_name] = "未填报";
}

$display_block_1=preg_replace('/学号/', "学号：".$arr[student_id], $display_block_1);
$display_block_1=preg_replace('/姓名/', "姓名：".$arr[name], $display_block_1);
$display_block_1=preg_replace('/所选第一志愿/', "第一志愿：".$arr_first[department_name], $display_block_1);
$display_block_1=preg_replace('/所选第二志愿/', "第二志愿：".$arr_second[department_name], $display_block_1);
$display_block_1=preg_replace('/第一轮第一志愿/', $arr_first[department_name], $display_block_1);
$display_block_2=preg_replace('/第一轮第二志愿/', $arr_second[department_name], $display_block_2);
$display_block_3=preg_replace('/第二轮第一志愿/', $arr_first[department_name], $display_block_3);
$display_block_4=preg_replace('/第二轮第二志愿/', $arr_second[department_name], $display_block_4);


function confirm_1 ($string) {
    if ($string=="pass") {
        $showMessage=<<<END_OF_TEXT
            
            <td nowrap="nowrap">
            <form action="" method="post">
            面试通过<img src="images/right.png" width="20" height="20">
            <input type="submit" id="" name="change1" value="修改结果" class="btn btn-primary" onclick= "if(confirm( '是否确定要修改结果？ ')==false)return   false; ">
            </form>
            </td>
        
END_OF_TEXT;
        return $showMessage;
    }
    else if ($string == "notpass") {
        $showMessage=<<<END_OF_TEXT
        
            <td nowrap="nowrap">
            <form action="" method="post">
            未通过<img src="images/wrong.png" width="20" height="20">
            <input type="submit" id="" name="change1" value="修改结果" class="btn btn-primary" onclick= "if(confirm( '是否确定要修改结果？ ')==false)return   false; ">
            </form>
            </td>
        
END_OF_TEXT;
        return $showMessage;
    }
}

function confirm_2 ($string) {
    if ($string=="pass") {
        $showMessage=<<<END_OF_TEXT
            
            <td nowrap="nowrap">
            <form action="" method="post">
            面试通过<img src="images/right.png" width="20" height="20">
            <input type="submit" id="" name="change2" value="修改结果" class="btn btn-primary" onclick= "if(confirm( '是否确定要修改结果？ ')==false)return   false; ">
            </form>
            </td>
        
END_OF_TEXT;
        return $showMessage;
    }
    else if ($string == "notpass") {
        $showMessage=<<<END_OF_TEXT
            
            <td nowrap="nowrap">
            <form action="" method="post">
            未通过<img src="images/wrong.png" width="20" height="20">
            <input type="submit" id="" name="change2" value="修改结果" class="btn btn-primary" onclick= "if(confirm( '是否确定要修改结果？ ')==false)return   false; ">
            </form>
            </td>
        
END_OF_TEXT;
        return $showMessage;
    }
}

function show($string) {
    if ($string=="pass") {
        $showMessage='
            <td>面试通过<img src="images/right.png" width="20" height="20"></td>
        ';
        return $showMessage;
    }
    else if ($string=="notpass") {
        $showMessage='
            <td>未通过<img src="images/wrong.png" width="20" height="20"></td>
        ';
        return $showMessage;
    }
    else if ($string=="none") {
        $showMessage='
            <td>- - - - - -</td>
        ';
        return $showMessage;
    }
    else {
        $showMessage='
            <td>未录入<img src="images/question.png" width="20" height="20"></td>
        ';
        return $showMessage;
    }
}

if ($arr[first_choice] == $id) {
    //第一论第一志愿
    if ($arr[confirm_first_1] == 1) {
        $showMessage_first_1=confirm_1($arr[first_choice_first_round]);
    }
    else {
        $showMessage_first_1='
          <td>
          <form action="" method="post">
          <input name="round" id="round" type="hidden" value="2">
          <select id="result" name="result" class="input-small">
          <option selected="select" value="unsure">未录入</option>
          <option value="pass">面试通过</option>
          <option value="notpass">未通过</option>
          </select>
          <input type="submit" id="" name="save1" value="保存结果" class="btn btn-primary">
          </form>
          </td>
          ';
    }
    
    if ($_POST['save1']) {
        if ($_POST['result']=="unsure") {
            echo '<script type="text/javascript">alert("请选择是否面试通过")</script>';
        }
        else {
            $updateStmt_first_1->bindValue(':condition', $_POST['result']);
            $updateStmt_first_1->bindValue(':ifconfirm', "1");
            $updateStmt_first_1->bindValue(':student_id', $student_id);
            $updateStmt_first_1->execute();
            $updateStmt_first_1->closeCursor();
            $showMessage_first_1=confirm_1($_POST['result']);
        }
    }
    
    if ($_POST['change1']) {
        $updateStmt_first_1->bindValue(':condition', "unsure");
        $updateStmt_first_1->bindValue(':ifconfirm', "0");
        $updateStmt_first_1->bindValue(':student_id', $student_id);
        $updateStmt_first_1->execute();
        $updateStmt_first_1->closeCursor();
        
        $updateStmt_first_2->bindValue(':condition', "unsure");
        $updateStmt_first_2->bindValue(':ifconfirm', "0");
        $updateStmt_first_2->bindValue(':student_id', $student_id);
        $updateStmt_first_2->execute();
        $updateStmt_first_2->closeCursor();
        
        $showMessage_first_1='
          <td>
          <form action="" method="post">
          <input name="round" id="round" type="hidden" value="2">
          <select id="result" name="result" class="input-small">
          <option selected="select" value="unsure">未录入</option>
          <option value="pass">面试通过</option>
          <option value="notpass">未通过</option>
          </select>
          <input type="submit" id="" name="save1" value="保存结果" class="btn btn-primary">
          </form>
          </td>
    ';
    }
    
    $selectStmt_All->execute();
    $arr=$selectStmt_All->fetch();
    $selectStmt_All->closeCursor();
    
    //第二轮第一志愿
    if ($arr[first_choice_first_round] == "notpass") {
        $updateStmt_first_2->bindValue(':condition', "notpass");
        $updateStmt_first_2->bindValue(':ifconfirm', "1");
        $updateStmt_first_2->bindValue(':student_id', $student_id);
        $updateStmt_first_2->execute();
        $updateStmt_first_2->closeCursor();
        
        $showMessage_first_2='
            <td>未通过<img src="images/wrong.png" width="20" height="20"></td>
            ';
    }
    else if ($arr[confirm_first_2] == 1) {
        $showMessage_first_2=confirm_2($arr[first_choice_second_round]);
    }
    else {
        $showMessage_first_2='
          <td>
          <form action="" method="post">
          <input name="round" id="round" type="hidden" value="2">
          <select id="result" name="result" class="input-small">
          <option selected="select" value="unsure">未录入</option>
          <option value="pass">面试通过</option>
          <option value="notpass">未通过</option>
          </select>
          <input type="submit" id="" name="save2" value="保存结果" class="btn btn-primary">
          </form>
          </td>
          ';
    }
    
    if ($_POST['save2']) {
        if ($arr[first_choice_first_round] == "unsure") {
            echo '<script type="text/javascript">alert("请先确定第一轮面试结果")</script>';
        }
        else if ($_POST['result']=="unsure") {
            echo '<script type="text/javascript">alert("请选择是否面试通过")</script>';
        }
        else {
            $updateStmt_first_2->bindValue(':condition', $_POST['result']);
            $updateStmt_first_2->bindValue(':ifconfirm', "1");
            $updateStmt_first_2->bindValue(':student_id', $student_id);
            $updateStmt_first_2->execute();
            $updateStmt_first_2->closeCursor();
            $showMessage_first_2=confirm_2($_POST['result']);
        }
    }
    
    if ($_POST['change2']) {
        $updateStmt_first_2->bindValue(':condition', "unsure");
        $updateStmt_first_2->bindValue(':ifconfirm', "0");
        $updateStmt_first_2->bindValue(':student_id', $student_id);
        $updateStmt_first_2->execute();
        $updateStmt_first_2->closeCursor();
        $showMessage_first_2='
          <td>
          <form action="" method="post">
          <input name="round" id="round" type="hidden" value="2">
          <select id="result" name="result" class="input-small">
          <option selected="select" value="unsure">未录入</option>
          <option value="pass">面试通过</option>
          <option value="notpass">未通过</option>
          </select>
          <input type="submit" id="" name="save2" value="保存结果" class="btn btn-primary">
          </form>
          </td>
    ';
    }
    
    if ($id_second!=0 && $id_second!=-1) {
        //第一轮第二志愿
        $showMessage_second_1=show($arr[second_choice_first_round]);
        
        //第二轮第二志愿
        $showMessage_second_2=show($arr[second_choice_second_round]);
    }
    else {
        //第一轮第二志愿
        $showMessage_second_1=show("none");
        
        //第二轮第二志愿
        $showMessage_second_2=show("none");
    }
    
    
}


if ($arr[second_choice] == $id) {
    //第一论第二志愿
    if ($arr[confirm_second_1] == 1) {
        $showMessage_second_1=confirm_1($arr[second_choice_first_round]);
        echo "here";
    }
    else {
        $showMessage_second_1='
          <td>
          <form action="" method="post">
          <input name="round" id="round" type="hidden" value="2">
          <select id="result" name="result" class="input-small">
          <option selected="select" value="unsure">未录入</option>
          <option value="pass">面试通过</option>
          <option value="notpass">未通过</option>
          </select>
          <input type="submit" id="" name="save1" value="保存结果" class="btn btn-primary">
          </form>
          </td>
          ';
    }

    if ($_POST['save1']) {
        if ($_POST['result']=="unsure") {
            echo '<script type="text/javascript">alert("请选择是否面试通过")</script>';
        }
        else {
            $updateStmt_second_1->bindValue(':condition', $_POST['result']);
            $updateStmt_second_1->bindValue(':ifconfirm', "1");
            $updateStmt_second_1->bindValue(':student_id', $student_id);
            $updateStmt_second_1->execute();
            $updateStmt_second_1->closeCursor();
            $showMessage_second_1=confirm_1($_POST['result']);
        }
    }

    if ($_POST['change1']) {
        $updateStmt_second_1->bindValue(':condition', "unsure");
        $updateStmt_second_1->bindValue(':ifconfirm', "0");
        $updateStmt_second_1->bindValue(':student_id', $student_id);
        $updateStmt_second_1->execute();
        $updateStmt_second_1->closeCursor();

        $updateStmt_second_2->bindValue(':condition', "unsure");
        $updateStmt_second_2->bindValue(':ifconfirm', "0");
        $updateStmt_second_2->bindValue(':student_id', $student_id);
        $updateStmt_second_2->execute();
        $updateStmt_second_2->closeCursor();

        $showMessage_second_1='
          <td>
          <form action="" method="post">
          <input name="round" id="round" type="hidden" value="2">
          <select id="result" name="result" class="input-small">
          <option selected="select" value="unsure">未录入</option>
          <option value="pass">面试通过</option>
          <option value="notpass">未通过</option>
          </select>
          <input type="submit" id="" name="save1" value="保存结果" class="btn btn-primary">
          </form>
          </td>
    ';
    }

    $selectStmt_All->execute();
    $arr=$selectStmt_All->fetch();
    $selectStmt_All->closeCursor();

    //第二轮第二志愿
    if ($arr[second_choice_first_round] == "notpass") {
        $updateStmt_second_2->bindValue(':condition', "notpass");
        $updateStmt_second_2->bindValue(':ifconfirm', "1");
        $updateStmt_second_2->bindValue(':student_id', $student_id);
        $updateStmt_second_2->execute();
        $updateStmt_second_2->closeCursor();
        
        $showMessage_second_2='
            <td>未通过<img src="images/wrong.png" width="20" height="20"></td>
            ';
    }
    else if ($arr[confirm_second_2] == 1) {
        $showMessage_second_2=confirm_2($arr[second_choice_second_round]);
    }
    else {
        $showMessage_second_2='
          <td>
          <form action="" method="post">
          <input name="round" id="round" type="hidden" value="2">
          <select id="result" name="result" class="input-small">
          <option selected="select" value="unsure">未录入</option>
          <option value="pass">面试通过</option>
          <option value="notpass">未通过</option>
          </select>
          <input type="submit" id="" name="save2" value="保存结果" class="btn btn-primary">
          </form>
          </td>
          ';
    }

    if ($_POST['save2']) {
        if ($arr[second_choice_first_round] == "unsure") {
            echo '<script type="text/javascript">alert("请先确定第一轮面试结果")</script>';
        }
        else if ($_POST['result']=="unsure") {
            echo '<script type="text/javascript">alert("请选择是否面试通过")</script>';
        }
        else {
            $updateStmt_second_2->bindValue(':condition', $_POST['result']);
            $updateStmt_second_2->bindValue(':ifconfirm', "1");
            $updateStmt_second_2->bindValue(':student_id', $student_id);
            $updateStmt_second_2->execute();
            $updateStmt_second_2->closeCursor();
            $showMessage_second_2=confirm_2($_POST['result']);
        }
    }

    if ($_POST['change2']) {
        $updateStmt_second_2->bindValue(':condition', "unsure");
        $updateStmt_second_2->bindValue(':ifconfirm', "0");
        $updateStmt_second_2->bindValue(':student_id', $student_id);
        $updateStmt_second_2->execute();
        $updateStmt_second_2->closeCursor();
        $showMessage_second_2='
          <td>
          <form action="" method="post">
          <input name="round" id="round" type="hidden" value="2">
          <select id="result" name="result" class="input-small">
          <option selected="select" value="unsure">未录入</option>
          <option value="pass">面试通过</option>
          <option value="notpass">未通过</option>
          </select>
          <input type="submit" id="" name="save2" value="保存结果" class="btn btn-primary">
          </form>
          </td>
    ';
    }

    //第一轮第一志愿
    $showMessage_first_1=show($arr[first_choice_first_round]);

    //第二轮第一志愿
    $showMessage_first_2=show($arr[first_choice_second_round]);


}


$display_block_1=preg_replace('/部门名称/', $department_name, $display_block_1);
$display_block_1=preg_replace('/web_student_id/', $student_id, $display_block_1);

echo $display_block_1.$showMessage_first_1.$display_block_2.$showMessage_second_1.$display_block_3.$showMessage_first_2.
$display_block_4.$showMessage_second_2.$display_block_5;

}
else {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("此用户未填报您的部门");location.href="interview_situation_input.php"</script>';
}

}
else {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}

?>