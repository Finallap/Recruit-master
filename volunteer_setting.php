<?php 
require_once './lib/set_error_reporting.php';
require_once './lib/encryption.php';
require_once './lib/pdo_recruit.php';
require_once './lib/PasswordHash.php';
require_once './lib/aes.php';
require_once './lib/sql_protect.php';
require_once './lib/xss.php';
require_once './lib/system_config.php';

$insertStmt_blacklist=$pdo->prepare("insert into blacklist (ip,PHP_Cookie,student_id,Channel,time,type) values (:ip,:PHP_Cookie,:student_id,:Channel,Now(),:type)");
$selectStmt_student_login_information=$pdo->prepare("select * from student_login_information where student_id=:student_id");
$selectStmt_student_choice=$pdo->prepare("select * from student_choice where student_id=:student_id");
$selectStmt_department_basic_information=$pdo->prepare("select * from department_basic_information where id=:id");
$selectStmt_student_status=$pdo->prepare("select * from student_status where student_id=:student_id");
$update_student_choice=$pdo->prepare("update student_choice set first_choice=:first_choice_id,second_choice=:second_choice_id where student_id=:student_id");
$update_student_choice_ifagreeadjust=$pdo->prepare("update student_choice set if_agree_adjust=:if_agree_adjust where student_id=:student_id");
$update_student_status=$pdo->prepare("update student_status set department_wish_fill=:department_wish_fill where student_id=:student_id");

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
    <title>部门志愿录入</title> 
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
            if (document.getElementById("first_choice").value == -1) {
                alert("第一志愿必填，不能为空!（可只选第一志愿）"); 
				return false; 
            }
            else if(document.getElementById("first_choice").value == document.getElementById("second_choice").value){  
                alert("第一第二志愿相同，请重新选择!（可只选第一志愿）"); 
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
          <div class="span9 offset2">
            <h1 class="page-title">部门志愿选择</h1>
            <div class="well">
              <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">信息录入</a></li>
      <li><a href="index.php">返回首页</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <form action="volunteer_setting.php" method="post" id="tabs" onSubmit="return check()">
        <label>第一志愿</label>
        <select name="first_choice" id="first_choice" class="input-xlarge">
END_OF_TEXT;
    
$display_block_3=<<<END_OF_TEXT
    </select>
         <label>第二志愿</label>
        <select name="second_choice" id="second_choice" class="input-xlarge">
END_OF_TEXT;

$display_block_4=<<<END_OF_TEXT
    </select>
    
    	 <label style="float：left;width:125px;"><input name="if_agree_adjust" type="checkbox" value="agree" 
END_OF_TEXT;
    
//     value="agree" checked="true"
        
$display_block_5=<<<END_OF_TEXT

        <label style="float：left;width:112px;">
          <input name="submit" type="submit" value="保存" class="btn btn-primary">
      <input name="reset" type="reset" value="重置" class="btn">
  </label>
    </form>
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

$display_skip=<<<END_OF_TEXT
<script type="text/javascript">
        location.href="more_information_setting.php";
        </script>
END_OF_TEXT;

// $display_reset=<<<END_OF_TEXT
// <script type="text/javascript">
//         location.href="volunteer_setting.php";
//         </script>
// END_OF_TEXT;



// $conn=mysql_connect("localhost","root","");
// mysql_select_db("recruit",$conn);
// mysql_query("set names 'utf8'");
// $result=mysql_query("select * from department_basic_information");
// $first_choice="";
// while ($row=mysql_fetch_array($result)) {
//     $first_choice.="<option value=".$row[id].">".$row[department_name]."</option>";
//     $second_choice.="<option value=".$row[id].">".$row[department_name]."</option>";
// }

$pdo->query("set names 'utf8'");
$selectStmt_student_choice->bindValue(':student_id', $student_id);
$selectStmt_student_choice->execute();
$arr=$selectStmt_student_choice->fetch();
$first_choice_id=$arr[first_choice];
$second_choice_id=$arr[second_choice];
$if_agree_adjust=$arr[if_agree_adjust];

if ($first_choice_id==0 || $first_choice_id==-1) {
    $stmt=$pdo->query("select * from department_basic_information");
    $first_choice.="<option selected=".'"selected"'." value="."-1".">请选择部门</option>";
    foreach ($stmt as $row) {
        $first_choice.="<option value=".$row[id].">".$row[department_name]."</option>";
    } 
}
else {
    $selectStmt_department_basic_information->bindValue(':id', $first_choice_id);
    $selectStmt_department_basic_information->execute();
    $arr1=$selectStmt_department_basic_information->fetch();
    $selectStmt_department_basic_information->closeCursor();
    $first_choice_name=$arr1[department_name];
    
    $stmt=$pdo->query("select * from department_basic_information");
    foreach ($stmt as $row) {
        if ($row[id]==$first_choice_id) {
            $first_choice.="<option selected=".'"selected"'." value=".$first_choice_id.">".$first_choice_name."</option>";
        }
        else {
            $first_choice.="<option value=".$row[id].">".$row[department_name]."</option>";
        }
        
    }
    
    
}

if ($second_choice_id==0 || $second_choice_id==-1) {
    $stmt=$pdo->query("select * from department_basic_information");
    $second_choice.="<option selected=".'"selected"'." value="."-1".">无</option>";
    foreach ($stmt as $row) {
        $second_choice.="<option value=".$row[id].">".$row[department_name]."</option>";
    }
}
else {
    $selectStmt_department_basic_information->bindValue(':id', $second_choice_id);
    $selectStmt_department_basic_information->execute();
    $arr2=$selectStmt_department_basic_information->fetch();
    $selectStmt_department_basic_information->closeCursor();
    $second_choice_name=$arr2[department_name];
    
    $stmt=$pdo->query("select * from department_basic_information");
    $second_choice.="<option value="."-1".">无</option>";
    foreach ($stmt as $row) {
        if ($row[id]==$second_choice_id) {
            $second_choice.="<option selected=".'"selected"'." value=".$second_choice_id.">".$second_choice_name."</option>";
        }
        else {
            $second_choice.="<option value=".$row[id].">".$row[department_name]."</option>";
        }
    }
    
    
}

if ($if_agree_adjust=="agree") {
    $ifagree=" checked".">是否服从部门调剂</label>";
}
else {
    $ifagree=">是否服从部门调剂</label>";
}


if ($_POST['submit']) {
    $selectStmt_student_status->bindValue(':student_id', $student_id);
    $selectStmt_student_status->execute();
    $status_check_arr=$selectStmt_student_status->fetch();
    $selectStmt_student_status->closeCursor();
    if ($status_check_arr[ifconfirm]==1) {
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo '<script type="text/javascript">alert("您已确认提交，无法再进行修改！如需修改，请联系管理员");location.href="index.php"</script>';
    }
    else {
        $first_choice_id=$_POST['first_choice'];
        $second_choice_id=$_POST['second_choice'];
        
        $selectStmt_department_basic_information->bindValue(':id', $first_choice_id);
        $selectStmt_department_basic_information->execute();
        $arr1=$selectStmt_department_basic_information->fetch();
        $selectStmt_department_basic_information->closeCursor();
        $first_choice_name=$arr1[department_name];
        
        $selectStmt_department_basic_information->bindValue(':id', $second_choice_id);
        $selectStmt_department_basic_information->execute();
        $arr2=$selectStmt_department_basic_information->fetch();
        $selectStmt_department_basic_information->closeCursor();
        $second_choice_name=$arr2[department_name];
        if ($second_choice_id==-1) {
            $second_choice_name="safe";
        }
        
        if ($first_choice_name!="" && $second_choice_name!="") {
            
            $check_sql_inject=$first_choice_id.$separator.$second_choice_id;
            if (sql_checkstr($check_sql_inject)=="illegal") {
                // pdo preparestmt insert blacklist
                $insertStmt_blacklist->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
                $insertStmt_blacklist->bindValue(':PHP_Cookie', $_COOKIE['PHP_Cookie']);
                $insertStmt_blacklist->bindValue(':student_id', $student_id);
                $insertStmt_blacklist->bindValue(':Channel', $check_sql_inject."");
                $insertStmt_blacklist->bindValue(':type', "sql_inject");
                $insertStmt_blacklist->execute();
                $insertStmt_blacklist->closeCursor();
            }
            $check_xss_attack=$first_choice_id.$separator.$second_choice_id;
            if (xss_checkstr($check_xss_attack)=="xss") {
                // xss_inject insert blacklist
                $insertStmt_blacklist->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
                $insertStmt_blacklist->bindValue(':PHP_Cookie', $_COOKIE['PHP_Cookie']);
                $insertStmt_blacklist->bindValue(':student_id', $student_id);
                $insertStmt_blacklist->bindValue(':Channel', $check_xss_attack."");
                $insertStmt_blacklist->bindValue(':type', "xss_inject");
                $insertStmt_blacklist->execute();
                $insertStmt_blacklist->closeCursor();
                echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                echo '<script type="text/javascript">alert("输入内容含符号 < ，我们将对其进行过滤！如有问题，请联系管理员")</script>';
            }
            
            clean_xss($first_choice_id);
            clean_xss($second_choice_id);
            
            $update_student_choice->bindValue(':first_choice_id', $first_choice_id);
            $update_student_choice->bindValue(':second_choice_id', $second_choice_id);
            $update_student_choice->bindValue(':student_id', $student_id);
            $update_student_choice->execute();
            $update_student_choice->closeCursor();
            
            if ($_POST['if_agree_adjust']=="agree") {
                $update_student_choice_ifagreeadjust->bindValue(':if_agree_adjust', "agree");
                $update_student_choice_ifagreeadjust->bindValue(':student_id', $student_id);
                $update_student_choice_ifagreeadjust->execute();
                $update_student_choice_ifagreeadjust->closeCursor();
            }
            else {
                $update_student_choice_ifagreeadjust->bindValue(':if_agree_adjust', "disagree");
                $update_student_choice_ifagreeadjust->bindValue(':student_id', $student_id);
                $update_student_choice_ifagreeadjust->execute();
                $update_student_choice_ifagreeadjust->closeCursor();
            }
            
            $update_student_status->bindValue(':department_wish_fill', "1");
            $update_student_status->bindValue(':student_id', $student_id);
            $update_student_status->execute();
            $update_student_status->closeCursor();
            
            if ($status_check_arr[moreinfo_fill]==0) {
                echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                echo $display_skip;
            }
            else {
                echo '<script type="text/javascript">location.href="information_confirmation.php"</script>';
            }
        }
        else {
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo '<script type="text/javascript">alert("无效部门，您的敏感操作已被记录！")</script>';
        }
        
    }
    
}

echo $display_block_1.$student_id.$display_block_2.$first_choice.$display_block_3.$second_choice.$display_block_4.$ifagree.$display_block_5;

// if ($_POST['reset']) {
//     $first_choice_id=0;
//     $second_choice_id=0;
//     $pdo->query("update student_choice set first_choice='$first_choice_id' where student_id='$student_id'");
//     $pdo->query("update student_choice set second_choice='$second_choice_id' where student_id='$student_id'");
//     echo $display_reset;
// }

}
else {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}
?>