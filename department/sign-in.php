<?php 
require_once './lib/set_error_reporting.php';

require_once './lib/pdo_recruit.php';
require_once './lib/aes.php';
require_once './lib/RandChar.php';
require_once './lib/PasswordHash.php';
require_once './lib/system_config.php';

header("Content-type: text/html;charset=utf-8");

$display_block_1=<<<END_OF_TEXT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>招新系统登陆页面</title>
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
                alert("部门ID不能为空!"); 
				return false;  
            }
			else if(document.getElementById("password").value == ""){  
                alert("密码不能为空!"); 
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
                        <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            社团与系统
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="association_introduction.php">社团介绍</a></li>
                            <li><a tabindex="-1" href="department_introduction.php">部门介绍</a></li>
                            <li><a tabindex="-1" href="system_description.php">关于系统</a></li>
                        </ul>
                  </li>
                    
              </ul>

          </div>
      </div>
    </div>
    

    <div class="container-fluid">
        
        <div class="row-fluid">
    <div class="dialog span4">
        <div class="block">
            <div class="block-heading">登陆界面</div>
            <div class="block-body">
                <form action="sign-in.php" method="post" onSubmit="return check()">
                    <label>部门账号</label>
                    <input type="text" name="department_id" value="
END_OF_TEXT;

$display_block_1=str_replace('var u="URL";', 'var u="'.TRACKERURL.'";', $display_block_1);
$display_block_1=str_replace("_paq.push(['setSiteId', id]);","_paq.push(['setSiteId', ".SITEID."]);", $display_block_1);
$display_block_1=str_replace('<noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>', '<noscript><p><img src="'.TRACKERURL.'?idsite='.SITEID.'" style="border:0;" alt="" /></p></noscript>', $display_block_1); 
    

$display_block_2=<<<END_OF_TEXT
" id="department_id" class="span12">
                    <label>密码</label>
                    <input type="password"  name="password" id="password" class="span12">
                    <input name="submit" type="submit" value="登陆" class="btn btn-primary pull-right">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <p>&nbsp;</p>
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

$display_block_error=<<<END_OF_TEXT
<script type="text/javascript">
        alert("部门不存在");
        location.href="sign-in.php";
        </script>
END_OF_TEXT;

$display_block_success=<<<END_OF_TEXT
<script type="text/javascript">
        location.href="index.php";
        </script>
END_OF_TEXT;

setcookie("Entrance","",time()-3600);

if ($_COOKIE['Did']) {
    $department_id=$_COOKIE['Did'];
}
else {
    $department_id="";
}

$selectStmt=$pdo->prepare("select * from department_login_information where department_id=:department_id");

if($_POST['submit']) {
    setcookie("Did", $_POST['department_id'], time()+777600);
    $department_id=$_POST['department_id'];
    $password=$_POST['password'];

    $selectStmt->bindValue(':department_id', $department_id);
    $selectStmt->execute();
    $arr=$selectStmt->fetch();
    $selectStmt->closeCursor();
    if ($arr[id]=="") {
        setcookie("Did", "", time()-3600);
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo $display_block_error;
    }
    else if ($aes->decode($arr[password]) == $password){
        $selectStmt->execute();
        $loginfo=$selectStmt->fetch();
        $selectStmt->closeCursor();
        $logpasswd=$aes->decode($loginfo[password]);
        $hasher = new PasswordHash(8, FALSE);
        $package_message=$logpasswd.$passwd_identifier;
        $Entrance_Shell = $hasher->HashPassword($package_message);
        $Entrance=$randCharObj->getRandChar(3).substr($Entrance_Shell, 7, strlen($Entrance_Shell)-7).$randCharObj->getRandChar(6);
        
        setcookie("Entrance",$Entrance);
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo $display_block_success;
    }   
    else if ($aes->decode($arr[password]) != $password) {
        
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo '<script type="text/javascript">alert("您的密码错误，请重新登录");location.href="sign-in.php"</script>';
    }
}

echo $display_block_1.$department_id.$display_block_2;
?>

