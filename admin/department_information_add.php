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
    <title>部门增加页面</title>
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
            if(document.getElementById("department_id").value == ""){  
                alert("请输入新增部门登陆ID!"); 
				return false;  
            }
			else if(document.getElementById("department_name").value == ""){  
                alert("部门名称不能为空!"); 
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
            <h1 class="page-title">部门增加页面</h1>
            <div class="well">
              <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">新增部门</a></li>
      <li><a href="department_information.php">返回部门维护页面</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <form action="" method="post" id="tabs" onSubmit="return check()">
     <label>部门登陆ID</label>
    <input type="text" id="department_id" name="department_id" class="input-xlarge">
        <label>密码</label>
        <input type="password"  id="password" name="password" class="input-xlarge">
        <label>确认密码</label>
        <input type="password"  id="confirm_password" class="input-xlarge">
        <label>部门名称</label>
        <input type="text" id="department_name" name="department_name" class="input-xlarge">
        <label>
          <input name="submit" type="submit" value="保存" class="btn btn-primary">
      <input type="reset" value="重置" class="btn">
</label>
    </form>
      </div>
      
    </div>

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

<Script language="javascript">

function GetRequest() {

   var url = location.search; //获取url中"?"符后的字串

   var theRequest = new Object();

   if (url.indexOf("?") != -1) {

      var str = url.substr(1);

      strs = str.split("&");

      for(var i = 0; i < strs.length; i ++) 
	  {
         theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
      }
   }
   document.getElementById("department_id").value=theRequest["department_id"];
}
</script>
END_OF_TEXT;

$display_block=str_replace('var u="URL";', 'var u="'.TRACKERURL.'";', $display_block);
$display_block=str_replace("_paq.push(['setSiteId', id]);","_paq.push(['setSiteId', ".SITEID."]);", $display_block);
$display_block=str_replace('<noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>', '<noscript><p><img src="'.TRACKERURL.'?idsite='.SITEID.'" style="border:0;" alt="" /></p></noscript>', $display_block); 


$insertStmt_department_login_information=$pdo->prepare("insert into department_login_information (department_id,password)
    values (:department_id,:password)");
$insertStmt_department_basic_information=$pdo->prepare("insert into department_basic_information (id,department_id,department_name)
    values (:id,:department_id,:department_name)");
$deleteStmt=$pdo->prepare("delete from department_login_information where department_id=:department_id");
$selectStmt=$pdo->prepare("select * from department_login_information where department_id=:department_id");

if ($_POST['submit']) {
    $department_id=$_POST['department_id'];
    $password=$aes->encode($_POST['password']);
    $department_name=$_POST['department_name'];
    
    $selectStmt->bindValue(':department_id', $department_id);
    $selectStmt->execute();
    $check=$selectStmt->fetch();
    $selectStmt->closeCursor();
    
    if ($check[id]=="") {
        $pdo->query("set names 'latin1'");
        $insertStmt_department_login_information->bindValue(':department_id', $department_id);
        $insertStmt_department_login_information->bindValue(':password', $password);
        $insertStmt_department_login_information->execute();
        $insertStmt_department_login_information->closeCursor();
        
        $selectStmt->execute();
        $arr=$selectStmt->fetch();
        $selectStmt->closeCursor();
        
        if ($arr[department_id]==$_POST['department_id'] && $aes->decode($arr[password])==$_POST['password']) {
            $pdo->query("set names 'utf8'");
            $insertStmt_department_basic_information->bindValue(':id', $arr[id]);
            $insertStmt_department_basic_information->bindValue(':department_id', $department_id);
            $insertStmt_department_basic_information->bindValue(':department_name', $department_name);
            $insertStmt_department_basic_information->execute();
            $insertStmt_department_basic_information->closeCursor();
            
            echo '<script type="text/javascript">alert("添加部门成功");location.href="department_information.php"</script>';
        }
        else {
            $deleteStmt->bindValue(':department_id', $department_id);
            $deleteStmt->execute();
            $deleteStmt->closeCursor();
            echo '<script type="text/javascript">alert("添加失败，请稍后再试");location.href="department_information.php"</script>';
        }
        
    }
    else {
        echo '<script type="text/javascript">alert("添加失败，部门已存在");location.href="department_information.php"</script>';
    }
    
}

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