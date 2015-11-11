<?php
require_once './lib/set_error_reporting.php';

require_once './lib/pdo_recruit.php';
require_once './lib/PasswordHash.php';
require_once './lib/aes.php';
require_once './lib/system_config.php';

$selectStmt_department_login_information=$pdo->prepare("select * from department_login_information where department_id=:department_id");
$update_department_login_information=$pdo->prepare("update department_login_information set password=:new_password where department_id=:department_id");
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

$display_show=<<<END_OF_TEXT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>部门密码修改</title>
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
    
    <script type="text/javascript">
	 	
		function check()
		{
            if(document.getElementById("old_password").value == ""){  
                alert("请输入旧密码!"); 
				return false;  
            }
			else if(document.getElementById("password").value == ""){  
                alert("新密码不能为空!"); 
				return false;  
            }
			else if(document.getElementById("confirm_password").value == ""){  
                alert("确认密码不能为空!"); 
				return false;  
            }
			else if((document.getElementById("password").value.length<6)||(document.getElementById("password").value.length>16)){  
                alert("密码过长或过短，请介于6-16位之间!"); 
				return false;  
            }
			else if(document.getElementById("confirm_password").value != document.getElementById("password").value){  
                alert("两次输入密码不相同!"); 
				return false;  
            }
			else{ 
               return true;
            }  
        }
 </script>  
    
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
                          <i class="icon-briefcase"></i> 网络部
                          <i class="icon-caret-down"></i>
                      </a>

                      <ul class="dropdown-menu">
                         <li><a tabindex="-1" href="check_registration_information.php">查看报名人员信息</a></li>
                             <li><a tabindex="-1" href="#">面试情况录入</a></li>
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
    <div class="span4 offset4 dialog">
        <div class="block">
            <div class="block-heading">部门密码修改界面</div>
            <div class="block-body">
                <form action="password_change.php" method="post" onSubmit="return check()">
                    旧密码
                  <input type="password" name="old_password" id="old_password" class="span12">
                    <label>新密码</label>
                    <input type="password" name="password" id="password" class="span12">
                    <label>确认密码</label>
                    <input type="password" id="confirm_password" class="span12">
                    <input name="submit" type="submit" value="修改密码" class="btn btn-primary pull-right">
                    <a href="index.php"><input type="button" value="返回首页" class="btn pull-right"></input></a>
                    <div class="clearfix"></div>
                </form>
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

$display_show=str_replace('var u="URL";', 'var u="'.TRACKERURL.'";', $display_show);
$display_show=str_replace("_paq.push(['setSiteId', id]);","_paq.push(['setSiteId', ".SITEID."]);", $display_show);
$display_show=str_replace('<noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>', '<noscript><p><img src="'.TRACKERURL.'?idsite='.SITEID.'" style="border:0;" alt="" /></p></noscript>', $display_show); 


if ($_POST['submit']) {
    $old_password=$_POST['old_password'];
    
    $pdo->query("set names 'latin1'");
    $new_password=$aes->encode($_POST['password']);
    $selectStmt_department_login_information->execute();
    $arr=$selectStmt_department_login_information->fetch();
    $selectStmt_department_login_information->closeCursor();
    if ($arr[id]=="") {
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo '<script type="text/javascript">alert("您的账户已被注销，您已被强制下线，如有问题请速联系相关人员！！");location.href="sign-in.php"</script>';
    }

    $original_password=$aes->decode($arr[password]);
    if ($old_password == $original_password) {
        $update_department_login_information->bindValue(':department_id', $department_id);
        $update_department_login_information->bindValue(':new_password', $new_password);
        $update_department_login_information->execute();
        $update_department_login_information->closeCursor();

        $selectStmt_department_login_information->execute();
        $arrcheck=$selectStmt_department_login_information->fetch();
        $selectStmt_department_login_information->closeCursor();
        if ($aes->decode($arrcheck[password]) != $_POST['password']) {
            $update_department_login_information->bindValue(':department_id', $department_id);
            $update_department_login_information->bindValue(':new_password', $arr[2]);
            $update_department_login_information->execute();
            $update_department_login_information->closeCursor();
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo '<script type="text/javascript">alert("对不起，由于服务器繁忙，密码更改失败，请稍后再试");location.href="password_change.php"</script>';
        }
        else {
            setcookie("Entrance","",time()-3600);
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo '<script type="text/javascript">alert("更改密码成功，请重新登录");location.href="sign-in.php"</script>';
        }
    }
    else {
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo '<script type="text/javascript">alert("您的旧密码输入错误，请重新输入");location.href="password_change.php"</script>';
    }
}

$display_show=preg_replace('/网络部/', $department_name, $display_show);
echo $display_show;

}
else {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}
?>