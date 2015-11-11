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
                          <i class="icon-briefcase"></i> 网络部
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
            <div class="faq-content">
    <h1 class="page-title">欢迎进入线上招新系统管理后台</h1>
    <div class="row-fluid">
        <div class="span9">
          <div class="block">
            <p class="block-heading">下面是一些部门报名信息的统计了~</p>
                <div class="block-body">
                  <p>部门名称：网络部</p>
                  <p>报名总人数：总报名人数</p>
                  
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
                      <td width="138" rowspan="2"><p align="center">志愿顺序 </p></td>
                      <td width="138"><p align="center">第一志愿 </p></td>
                      <td width="138"><p align="center">第一志愿人数</p></td>
                      <td width="138"><p align="center">第一志愿百分比</p></td>
                    </tr>
                    <tr>
                      <td width="138"><p align="center">第二志愿 </p></td>
                      <td width="138"><p align="center">第二志愿人数</p></td>
                      <td width="138"><p align="center">第二志愿百分比</p></td>
                    </tr>
                  </table>
<p>&nbsp;</p>
                </div>
          </div>

            <div class="block">
              <p class="block-heading">想导出报名汇总表了？</p>
                <div class="block-body">
                <div class="row-fluid">
                  <p>好多小鲜肉，快来戳这里导出信息总表吧~</p>
                <form action="summary_output.php" method="post">
                <label>导出志愿选择：</label>
                <select name="choice" id="choice">
                 	<option value="1">第一志愿</option>
          			<option value="2">第二志愿</option>
                </select>
                <input type="submit" value="导出签到表" class="btn btn-primary"/>
                </form> 
                  </div>
                </div>
            </div>        
    
            <div class="block">
              <p class="block-heading">想录取小鲜肉了？</p>
                <div class="block-body">
                <div class="row-fluid">
                  <p>小鲜肉速速到碗里来，想让小鲜肉速速进入部门快来戳这里吧~</p>
                  <a href="interview_situation_input.php" class="btn btn-primary"><i class="icon-hand-right"></i> 面试情况录入</a>
                    <div class="clearfix"></div>
                  </div>
                </div>
            </div>
            <div class="block">
              <p class="block-heading">一些关于线上招新系统的使用提示</p>
                <div class="block-body">
                    <h3>很高兴大家能使用线上招新系统后台管理系统，接下来我们一起阅读一些系统使用提醒吧~</h3>
                    <p>1.本后台管理系统部门登陆后只能看到本部门报名人员的信息，且必须该同学已经确认提交报名信息。</p>

                    <p>2.本后台管理系统在录入面试信息的时候可以无限次修改，但请大家本着负责的态度来填写了~</p>

                    <p>3.本后台管理系统的信息查看和报名录入是分开的，在信息查看页面中有报名表导出，打开网页后在浏览器点击“打印”即可打印报名表，“报名信息统计”页面中也有汇总表的导出。</p>

                    <p>4.更多说明请查看“使用说明”，在使用过程中发现系统问题可及时报告爱·服务公益社团。</p>
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


$selectStmt_All=$pdo->prepare("select * from student_status join student_choice 
    on student_status.student_id = student_choice.student_id
    join student_basic_information on student_status.student_id = student_basic_information.student_id
    where student_status.ifconfirm = '1' and
    (student_choice.first_choice=:id_first or student_choice.second_choice=:id_second) 
    and (student_basic_information.sex=:sex_1 or student_basic_information.sex=:sex_2)
    ");

$selectStmt_All->bindValue(":id_first", $id);
$selectStmt_All->bindValue(":id_second", $id);
$selectStmt_All->bindValue(':sex_1', "male");
$selectStmt_All->bindValue(':sex_2', "*");
$selectStmt_All->execute();
$male_count=$selectStmt_All->rowCount();
$selectStmt_All->closeCursor();

$selectStmt_All->bindValue(":id_first", $id);
$selectStmt_All->bindValue(":id_second", $id);
$selectStmt_All->bindValue(':sex_1', "*");
$selectStmt_All->bindValue(':sex_2', "female");
$selectStmt_All->execute();
$female_count=$selectStmt_All->rowCount();
$selectStmt_All->closeCursor();

$male_female_total=$male_count+$female_count;
$male_percent=round($male_count / $male_female_total * 100, 1)."%";
$female_percent=round($female_count / $male_female_total * 100, 1)."%";

$selectStmt_All->bindValue(":id_first", $id);
$selectStmt_All->bindValue(":id_second", "*");
$selectStmt_All->bindValue(':sex_1', "male");
$selectStmt_All->bindValue(':sex_2', "female");
$selectStmt_All->execute();
$firstchoice_count=$selectStmt_All->rowCount();
$selectStmt_All->closeCursor();

$selectStmt_All->bindValue(":id_first", "*");
$selectStmt_All->bindValue(":id_second", $id);
$selectStmt_All->bindValue(':sex_1', "male");
$selectStmt_All->bindValue(':sex_2', "female");
$selectStmt_All->execute();
$secondchoice_count=$selectStmt_All->rowCount();
$selectStmt_All->closeCursor();

$first_second_total=$firstchoice_count + $secondchoice_count;
$first_percent=round($firstchoice_count / $first_second_total * 100, 1)."%";
$second_percent=round($secondchoice_count / $first_second_total * 100, 1)."%";

$display_block=preg_replace("/网络部/", $department_name, $display_block);
$display_block=preg_replace("/总报名人数/", $male_female_total, $display_block);
$display_block=preg_replace("/男生人数/", $male_count, $display_block);
$display_block=preg_replace("/男生百分比/", $male_percent, $display_block);
$display_block=preg_replace("/女生人数/", $female_count, $display_block);
$display_block=preg_replace("/女生百分比/", $female_percent, $display_block);
$display_block=preg_replace("/第一志愿人数/", $firstchoice_count, $display_block);
$display_block=preg_replace("/第一志愿百分比/", $first_percent, $display_block);
$display_block=preg_replace("/第二志愿人数/", $secondchoice_count, $display_block);
$display_block=preg_replace("/第二志愿百分比/", $second_percent, $display_block);

echo $display_block;

}
else if ($_COOKIE['Entrance'] && !$_COOKIE['Did']) {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}
else {
    echo '<script type="text/javascript">location.href="sign-in.php"</script>';
}
?>
