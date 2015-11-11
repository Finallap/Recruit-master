<?php 
require_once './lib/set_error_reporting.php';
require_once './lib/pdo_recruit.php';
require_once './lib/aes.php';
require_once './lib/encryption.php';
require_once './lib/PasswordHash.php';
require_once './lib/system_config.php';

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

$display_block=<<<END_OF_TEXT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>线上报名系统管理后台</title>
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
                          <i class="icon-briefcase"></i> Admin
                          <i class="icon-caret-down"></i>
                      </a>

                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="check_registration_information.php">查看报名人员信息</a></li>
                  <li><a tabindex="-1" href="interview_situation_input.php">报名人员状态操作</a></li>
                  <li><a tabindex="-1" href="registration_information_static.php">报名信息统计</a></li>
                    <li><a tabindex="-1" href="department_information.php">部门信息维护</a></li>
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
                    	 <li><a href="./association_introduction.php">社团介绍</a></li>
                            <li><a href="./department_introduction.php">部门介绍</a></li>
                      <li><a href="./system_description.php">关于系统</a></li>
                        
                    </ul>
                <div class="nav-header" data-toggle="collapse" data-target="#accounts-menu"><i class="icon-briefcase"></i>报名信息查看与操作</div>
                <ul id="accounts-menu" class="nav nav-list collapse in">
                  <li><a tabindex="-1" href="check_registration_information.php">查看报名人员信息</a></li>
                  <li><a tabindex="-1" href="interview_situation_input.php">报名人员删除与状态重置</a></li>
                  <li><a tabindex="-1" href="registration_information_static.php">报名信息统计</a></li>
                </ul>
                <div class="nav-header" data-toggle="collapse" data-target="#legal-menu"><i class="icon-legal"></i>部门增加与维护</div>
                <ul id="legal-menu" class="nav nav-list collapse in">
                <li><a tabindex="-1" href="department_information.php">部门信息维护</a></li>
                 <li><a tabindex="-1" href="password_change.php">Admin密码修改</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="faq-content">
    <h1 class="page-title">欢迎进入线上招新系统超级管理员后台</h1>
    <div class="row-fluid">
        <div class="span9">
          <div class="block">
            <p class="block-heading">下面是一些社团报名信息的统计了~</p>
                <div class="block-body">
                  <p>报名总人数：R报名人数R</p>
                  
                  <table class="table-condensed" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="138"><p align="center">&nbsp;</p></td>
                      <td width="138"><p align="center">&nbsp;</p></td>
                      <td width="138"><p align="center">人数 </p></td>
                      <td width="138"><p align="center">百分比 </p></td>
                    </tr>
                    <tr>
                      <td width="138" rowspan="2"><p align="center">性别 </p></td>
                      <td width="138"><p align="center">男 </p></td>
                      <td width="138"><p align="center">男生人数</p></td>
                      <td width="138"><p align="center">男生百分比</p></td>
                    </tr>
                    <tr>
                      <td width="138"><p align="center">女 </p></td>
                      <td width="138"><p align="center">女生人数</p></td>
                      <td width="138"><p align="center">女生百分比</p></td>
                    </tr>
                    <tr>
                      <td width="138" rowspan="2"><p align="center">报名状态 </p></td>
                      <td width="138"><p align="center">已确认</p></td>
                      <td width="138"><p align="center">已确认人数</p></td>
                      <td width="138"><p align="center">已确认百分比</p></td>
                    </tr>
                    <tr>
                      <td width="138"><p align="center">待确认</p></td>
                      <td width="138"><p align="center">待确认人数</p></td>
                      <td width="138"><p align="center">待确认百分比</p></td>
                    </tr>
                  </table>
<p>&nbsp;</p>
                </div>
          </div>
          <div class="block">
            <p class="block-heading">一些关于线上招新系统超级管理员的使用提示</p>
                <div class="block-body">
                    <h3>很高兴大家能使用线上招新系统后台管理系统，接下来我们一起阅读一些系统使用提醒吧~</h3>
                    <p>1.请Admin管理员在初次登陆后及时更改密码，以免带来不必要的麻烦。</p>

                    <p>2.本后台管理系统Admin登陆后可看到所有报名社团的人员，包括未确认报名的人员。</p>

                    <p>3.本后台管理系统Admin拥有改变个人用户报名状态，重置个人用户密码，删除个人用户的权利，其中重置后的个人密码为学号。</p>

                    <p>4.本后台管理系统可进行部门用户管理，增加删除部门，重置部门密码。请在删除部门时三思而后行，删除部门会导致已经报名改部门的同学找不到对应的部门。</p>
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

$display_block=str_replace('var u="URL";', 'var u="'.TRACKERURL.'";', $display_block);
$display_block=str_replace("_paq.push(['setSiteId', id]);","_paq.push(['setSiteId', ".SITEID."]);", $display_block);
$display_block=str_replace('<noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>', '<noscript><p><img src="'.TRACKERURL.'?idsite='.SITEID.'" style="border:0;" alt="" /></p></noscript>', $display_block); 

$pdo->query("set names 'utf8'");
$selectStmt=$pdo->prepare("select * from student_status join student_basic_information 
    on student_status.student_id = student_basic_information.student_id
    ");
    
$selectStmt->execute();
$arr=$selectStmt->fetchAll();
$rowcount=$selectStmt->rowCount();
$selectStmt->closeCursor();

$contain[male]=0;$contain[female]=0;$contain[confirm]=0;$contain[notconfirm]=0;
for ($i = 0; $i < $rowcount; $i++) {
    $contain[$arr[$i][sex]]++;
    if ($arr[$i][ifconfirm] == 1) {
        $contain[confirm]++;
    }
    else {
        $contain[notconfirm]++;
    }
}    

$male_female_total=$contain[male] + $contain[female];
$male_percent=round($contain[male] / $male_female_total * 100, 1)."%";
$female_percent=round($contain[female] / $male_female_total * 100, 1)."%";

$all_confirm = $contain[confirm] + $contain[notconfirm];
$confirm_percent=round($contain[confirm] / $all_confirm * 100, 1)."%";
$notconfirm_percent=round($contain[notconfirm] / $all_confirm * 100, 1)."%";

$display_block=preg_replace('/R报名人数R/', $all_confirm, $display_block);
$display_block=preg_replace('/男生人数/', $contain[male], $display_block);
$display_block=preg_replace('/男生百分比/', $male_percent, $display_block);
$display_block=preg_replace('/女生人数/', $contain[female], $display_block);
$display_block=preg_replace('/女生百分比/', $female_percent, $display_block);
$display_block=preg_replace('/已确认人数/', $contain[confirm], $display_block);
$display_block=preg_replace('/已确认百分比/', $confirm_percent, $display_block);
$display_block=preg_replace('/待确认人数/', $contain[notconfirm], $display_block);
$display_block=preg_replace('/待确认百分比/', $notconfirm_percent, $display_block);

echo $display_block;

}
else if ($_COOKIE['Path'] && !$_COOKIE['Web_Cookie']) {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}
else {
    echo '<script type="text/javascript">location.href="sign-in.php"</script>';
}

?>