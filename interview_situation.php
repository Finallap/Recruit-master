<?php
require_once './lib/set_error_reporting.php';

require_once './lib/encryption.php';
require_once './lib/pdo_recruit.php';
require_once './lib/PasswordHash.php';
require_once './lib/aes.php';
require_once './lib/system_config.php';

$insertStmt_blacklist=$pdo->prepare("insert into blacklist (ip,PHP_Cookie,student_id,Channel,time,type) values (:ip,:PHP_Cookie,:student_id,:Channel,Now(),:type)");
$selectStmt_student_login_information=$pdo->prepare("select * from student_login_information where student_id=:student_id");
$selectStmt_student_status=$pdo->prepare("select * from student_status where student_id=:student_id");

$student_id=decrypt($_COOKIE['PHP_Cookie']);
$selectStmt_student_login_information->bindValue(':student_id', $student_id);
$selectStmt_student_login_information->execute();
$loginfo=$selectStmt_student_login_information->fetch();
$selectStmt_student_login_information->closeCursor();
$logpasswd=$aes->decode($loginfo[password]);
$hasher = new PasswordHash(8, FALSE);
$Channel=$_COOKIE['Channel'];
$Hull='$2a$08$'.substr($Channel, 3, strlen($Channel)-9);
$check_message=$logpasswd.$passwd_identifier;
$if_match=$hasher->CheckPassword($check_message, $Hull);


if ($logpasswd!="" && $_COOKIE['Channel'] && !$if_match) {
    $ip=$_SERVER["REMOTE_ADDR"];
    $PHP_Cookie=$_COOKIE['PHP_Cookie'];
    $pdo->query("set names 'utf8'");
    $insertStmt_blacklist->bindValue(':ip', $ip);
    $insertStmt_blacklist->bindValue(':PHP_Cookie', $PHP_Cookie);
    $insertStmt_blacklist->bindValue(':student_id', $student_id);
    $insertStmt_blacklist->bindValue(':Channel', $Channel);
    $insertStmt_blacklist->bindValue(':type', "伪造cookie");
    $insertStmt_blacklist->execute();
    $insertStmt_blacklist->closeCursor();
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("身份伪造，您的敏感操作已被记录！");location.href="sign-in.php"</script>';
}
else if ($_COOKIE['PHP_Cookie'] && $_COOKIE['Channel'] && $logpasswd=="") {

    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的账户已被注销，您已被强制下线，如有问题请速联系相关人员！！");location.href="sign-in.php"</script>';
}
else if ($_COOKIE['PHP_Cookie'] && $if_match) {

$display_block=<<<END_OF_TEXT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>面试情况查看页面</title>
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
      <script src="javascripts/html5.js"></script>
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
                            社团与系统
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="association_introduction.php">社团介绍</a></li>
                            <li><a tabindex="-1" href="department_introduction.php">部门介绍</a></li>
                            <li><a tabindex="-1" href="use_instructions.php">使用说明</a></li>
                            <li><a tabindex="-1" href="system_description.php">关于系统</a></li>
                        </ul>
                  </li>
                    
                    <li id="fat-menu" class="dropdown">
                        <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> 学生学号
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="basic_information_setting.php">基本资料设置</a></li>
                            <li><a tabindex="-1" href="#.php">部门志愿设置</a></li>
                            <li><a tabindex="-1" href="more_information_setting.php">更多资料设置</a></li>
                             <li><a tabindex="-1" href="information_confirmation.php">报名信息确认</a></li>
                            <li><a tabindex="-1" href="interview_situation.php">面试情况查询</a></li>
                            <li><a tabindex="-1" href="password_change.php">个人密码修改</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="sign-in.php">注销</a></li>
                        </ul>
                    </li>
                    
                    
              </ul>

          </div>
        </div>
    </div>
    

    <div class="container-fluid">
        
        <div class="row-fluid">
          <div class="span9 offset1">
            <div class="faq-content">
    <h1 class="page-title offset2">面试情况查看页面</h1>
    <div class="row-fluid">
        <div class="span9 offset2">
          <div>
            <p class="block-heading">以下为面试情况（注：因各方面原因，结果或有变动，一切以最终结果为准）</p>
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
          <td>第一志愿部门</td>
  第一志愿第一轮面试
          </tr>
        <tr>
          <td>第二志愿</td>
          <td>第二志愿部门</td>
  第二志愿第一轮面试
          </tr>
        <tr>
          <td rowspan="2">2</td>
          <td>第一志愿</td>
          <td>第一志愿部门</td>
  第一志愿第二轮面试
          </tr>
        <tr>
          <td>第二志愿</td>
          <td>第二志愿部门</td>
  第二志愿第二轮面试
          </tr>
      </tbody>
    </table>
</div>
          </div>
        </div>
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
$selectStmt_interview=$pdo->prepare("select * from student_choice join student_interview_condition 
    on student_choice.student_id = student_interview_condition.student_id
    join student_status on student_choice.student_id = student_status.student_id
    where student_choice.student_id = :student_id");
$selectStmt_department_basic_information_id=$pdo->prepare("select * from department_basic_information where id=:choice_id");

$selectStmt_interview->bindValue(':student_id', $student_id);
$selectStmt_interview->execute();
$arr=$selectStmt_interview->fetch();
$selectStmt_interview->closeCursor();

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

if ($first_name=="") {
    $first_name="未填报";
}

if ($second_name=="") {
    $second_name="未填报";
}

function show($string) {
    if ($string=="pass") {
        $showMessage=<<<END_OF_TEXT
        <td>面试通过<img src="images/right.png" width="20" height="20"></td>
END_OF_TEXT;
        return $showMessage;
    }
    else if ($string=="notpass") {
        $showMessage=<<<END_OF_TEXT
        <td>未通过<img src="images/wrong.png" width="20" height="20"></td>
END_OF_TEXT;
        return $showMessage;
    }
    else if ($string=="none") {
        $showMessage=<<<END_OF_TEXT
        <td>- - - - - -</td>
END_OF_TEXT;
        return $showMessage;
    }
    else if ($string=="needconfirm") {
        $showMessage=<<<END_OF_TEXT
        <td>报名信息未确认</td>
END_OF_TEXT;
        return $showMessage;
    }
    else {
        $showMessage=<<<END_OF_TEXT
        <td>待定中<img src="images/question.png" width="20" height="20"></td>
END_OF_TEXT;
        return $showMessage;
    }
}

if ($arr[ifconfirm] == 1) {
    if ($arr[first_choice]!=0 && $arr[first_choice]!=-1 && $first_name!="未填报") {
        $showMessage_first_1=show($arr[first_choice_first_round]);
        $showMessage_first_2=show($arr[first_choice_second_round]);
    }
    else {
        $showMessage_first_1=show("none");
        $showMessage_first_2=show("none");
    }
    
    if ($arr[second_choice]!=0 && $arr[second_choice]!=-1 && $second_name!="未填报") {
        $showMessage_second_1=show($arr[second_choice_first_round]);
        $showMessage_second_2=show($arr[second_choice_second_round]);
    }
    else {
        $showMessage_second_1=show("none");
        $showMessage_second_2=show("none");
    }
}
else {
    if ($arr[first_choice]!=0 && $arr[first_choice]!=-1) {
        $showMessage_first_1=show("needconfirm");
        $showMessage_first_2=show("needconfirm");
    }
    else {
        $showMessage_first_1=show("none");
        $showMessage_first_2=show("none");
    }
    
    if ($arr[second_choice]!=0 && $arr[second_choice]!=-1) {
        $showMessage_second_1=show("needconfirm");
        $showMessage_second_2=show("needconfirm");
    }
    else {
        $showMessage_second_1=show("none");
        $showMessage_second_2=show("none");
    }
}

$display_block=preg_replace('/学生学号/', $student_id, $display_block);
$display_block=preg_replace('/第一志愿部门/', $first_name, $display_block);
$display_block=preg_replace('/第二志愿部门/', $second_name, $display_block);
$display_block=preg_replace('/第一志愿第一轮面试/', $showMessage_first_1, $display_block);
$display_block=preg_replace('/第二志愿第一轮面试/', $showMessage_second_1, $display_block);
$display_block=preg_replace('/第一志愿第二轮面试/', $showMessage_first_2, $display_block);
$display_block=preg_replace('/第二志愿第二轮面试/', $showMessage_second_2, $display_block);

echo $display_block;

}
else {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}
?>