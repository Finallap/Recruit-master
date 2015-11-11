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
    
$display_block_1=<<<END_OF_TEXT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>线上报名系统首页</title>
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
                            <i class="icon-user"></i>
END_OF_TEXT;

$display_block_1=str_replace('var u="URL";', 'var u="'.TRACKERURL.'";', $display_block_1);
$display_block_1=str_replace("_paq.push(['setSiteId', id]);","_paq.push(['setSiteId', ".SITEID."]);", $display_block_1);
$display_block_1=str_replace('<noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>', '<noscript><p><img src="'.TRACKERURL.'?idsite='.SITEID.'" style="border:0;" alt="" /></p></noscript>', $display_block_1);
    
$display_block_2=<<<END_OF_TEXT
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="basic_information_setting.php">基本资料设置</a></li>
                            <li><a tabindex="-1" href="volunteer_setting.php">部门志愿设置</a></li>
                            <li><a tabindex="-1" href="more_information_setting.php">更多资料设置</a></li>
                             <li><a tabindex="-1" href="information_confirmation.php">报名信息确认</a></li>
                            <li><a tabindex="-1" href="interview_situation.php">面试情况查询</a></li>
                            <li><a tabindex="-1" href="password_change.php">个人密码修改</a></li>
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
                            <li><a href="use_instructions.php">使用说明</a></li>
                      <li><a href="system_description.php">关于系统</a></li>
                        
                    </ul>
                <div class="nav-header" data-toggle="collapse" data-target="#accounts-menu"><i class="icon-briefcase"></i>信息录入与确认</div>
                <ul id="accounts-menu" class="nav nav-list collapse in">
                  <li><a tabindex="-1" href="basic_information_setting.php">基本资料设置</a></li>
                            <li><a tabindex="-1" href="volunteer_setting.php">部门志愿设置</a></li>
                            <li><a tabindex="-1" href="more_information_setting.php">更多资料设置</a></li>
                  <li><a tabindex="-1" href="information_confirmation.php">报名信息确认</a></li>
                </ul>
                <div class="nav-header" data-toggle="collapse" data-target="#legal-menu"><i class="icon-legal"></i>个人信息修改导出</div>
                <ul id="legal-menu" class="nav nav-list collapse in">
                 <li><a tabindex="-1" href="password_change.php">个人密码修改</a></li>
                  <li ><a href="information_export.php">报名表导出</a></li>
                  <li><a href="interview_situation.php">面试情况查询</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="faq-content">
    <h1 class="page-title">欢迎进入线上招新系统</h1>
    <div class="row-fluid">
        <div class="span9">
          <div class="block">
            <p class="block-heading">请按以下顺序完成信息录入</p>
                <div class="block-body">
                    <ol>
END_OF_TEXT;

                    
$display_block_3=<<<END_OF_TEXT
                    </ol>
                </div>
          </div>

            <div class="block">
              <p class="block-heading">是否被部门录取了？</p>
                <div class="block-body">
                <div class="row-fluid">
                  <p>想查看自己的面试结果，是不是很幸运的被部门录取了呢，快来点击这里吧~</p>
                  <a href="interview_situation.php" class="btn btn-primary">点我看结果</a>
                    <div class="clearfix"></div>
                  </div>
                </div>
            </div>

            <div class="block">
                <p class="block-heading">一些关于线上招新系统的使用提示</p>
                <div class="block-body">
                    <h3>很高兴大家能使用线上招新系统，接下来我们一起阅读一些系统使用提醒吧~</h3>
                    <p>1.本系统负责社团线上招新的信息录入、整理、面试情况查看功能，请大家确保填写的信息真实有效。</p>

                    <p>2.所有报名信息在点击“报名确认”前都可以无限次修改，但请大家注意报名时间~在报名确认后，所有信息都无法更改，详见“使用说明”。</p>

                    <p>3.在填写完信息并确认后，在首页点击“报名表导出”，即可导出报名表。并可在浏览器点击“打印”打印报名表。</p>

                    <p>4.更多帮助请点击“使用说明”页面。</p>
                </div>
            </div>
        </div>
        <div class="span3">
		<div class="well toc">
		          <h3>联系我们</h3>
		          <h4>微信公众号：</h4>
		           <p>njuptservice</p>
		                <h4>网址：</h4>
		                <p><a href="http://www.aifuwu.org">http://www.aifuwu.org</a></p>
		                <h4>E-mail：</h4>
		                <p>aifuwu@aifuwu.org</p>
		                <h4>地址：</h4>
		                <address>
		江苏省南京市栖霞区<br>
		南京邮电大学仙林校区<br>
		图书馆一楼学生事务中心大厅
		</address>
		                <div style="text-align: center;">
		                    <a class="btn" href=""><img src="images/wechat.png" width="25" height="25"></a>
		                    <a class="btn" href="http://weibo.com/njuptaifuwu"><img src="images/sina.png" width="25" height="25"></a>
		                    <a class="btn" href="http://page.renren.com/601861848"><img src="images/renren.png" width="25"></a>
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



$selectStmt_student_status->bindValue(':student_id', $student_id);
$selectStmt_student_status->execute();
$arr=$selectStmt_student_status->fetch();
$selectStmt_student_status->closeCursor();
if ($arr[basicinfo_fill]==1) {
    $basicinfo_status="<li><a href=".'"basic_information_setting.php">'."基本资料设置（已完成）"."<img src=".'"images/right.png"'.' width="20" height="20"></a></li>';
}
else {
    $basicinfo_status="<li><a href=".'"basic_information_setting.php">'."基本资料设置（未完成）"."<img src=".'"images/question.png"'.' width="20" height="20"></a></li>';
}
if ($arr[department_wish_fill]==1) {
    $department_wish_status='<li><a href="volunteer_setting.php">部门志愿设置（已完成）<img src="images/right.png" width="20" height="20"></a></li>';
}
else {
    $department_wish_status='<li><a href="volunteer_setting.php">部门志愿设置（未完成）<img src="images/question.png" width="20" height="20"></a></li>';
}
if ($arr[moreinfo_fill]==1) {
    $moreinfo_status='<li><a href="more_information_setting.php">更多资料设置（已完成）<img src="images/right.png" width="20" height="20"></a></li>';
}
else {
    $moreinfo_status='<li><a href="more_information_setting.php">更多资料设置（未完成）<img src="images/question.png" width="20" height="20"></a></li>';
}
if ($arr[ifconfirm] ==1) {
    $confirm_status='<li><a href="information_confirmation.php">报名信息确认（已确认）<img src="images/right.png" width="20" height="20"></a></li>';
}
else {
    $confirm_status='<li><a href="information_confirmation.php">报名信息确认（所有信息填完后必须确认生效）<img src="images/wrong.png" width="20" height="20"></a></li>';
}

echo $display_block_1.$student_id.$display_block_2.$basicinfo_status.$department_wish_status.$moreinfo_status.$confirm_status.$display_block_3;

}
else if ($_COOKIE['Channel'] && !$_COOKIE['PHP_Cookie']) {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}
else {
    echo '<script type="text/javascript">location.href="sign-in.php"</script>';
}
?>