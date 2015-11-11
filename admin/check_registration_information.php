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
            <h1 class="page-title">报名人员查看</h1>

<div class="block">
      <p class="block-heading">共TotalNumber条记录，查询导符合条件的记录MatchNumber条！可进行记录筛选：</p>
                <div class="block-body">
                <div class="row-fluid">
                  <form action="" method="get">
                  <input type="hidden" name="page" value=""  id="page"/>        
                <label class="pull-left">
    性别：
        <select name="sex" id="sex" class="input-medium">
END_OF_TEXT;
               
$display_block_1=str_replace('var u="URL";', 'var u="'.TRACKERURL.'";', $display_block_1);
$display_block_1=str_replace("_paq.push(['setSiteId', id]);","_paq.push(['setSiteId', ".SITEID."]);", $display_block_1);
$display_block_1=str_replace('<noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>', '<noscript><p><img src="'.TRACKERURL.'?idsite='.SITEID.'" style="border:0;" alt="" /></p></noscript>', $display_block_1); 
          
          
$display_block_2=<<<END_OF_TEXT
    </select>
    			</label>
    
    &emsp;学院：
        <select name="school" id="school" class="input-large">
          <option selected="selected" value="-1">不限</option>
          <option value="通信与信息工程学院">通信与信息工程学院</option>
          <option value="电子科学与工程学院">电子科学与工程学院</option>
          <option value="光电工程学院">光电工程学院</option>
          <option value="计算机软件学院">计算机软件学院</option>
          <option value="自动化学院">自动化学院</option>
          <option value="材料科学与工程学院">材料科学与工程学院</option>
          <option value="物联网学院">物联网学院</option>
          <option value="理学院">理学院</option>
          <option value="地理与生物信息学院">地理与生物信息学院</option>
          <option value="传媒与艺术学院">传媒与艺术学院</option>
          <option value="管理学院">管理学院</option>
          <option value="经济学院">经济学院</option>
          <option value="人文与社会科学学院">人文与社会科学学院</option>
          <option value="外国语学院">外国语学院</option>
          <option value="教育科学与技术学院">教育科学与技术学院</option>
          <option value="海外教育学院">海外教育学院</option>
          <option value="贝尔英才学院">贝尔英才学院</option>
          <option value="其他">其他</option>
    </select>
    			<button type="submit" name="" value="send" class="btn btn-primary" onclick="GetRequest()">检索</button>
                
                  </form>
                    <div class="clearfix"></div>
                  </div>
      </div>
          </div>

<div class="well">
    <table width="920" class="table">
      <thead>
        <tr>
          <th width="28">#</th>
          <th width="87">学号</th>
          <th width="57">姓名</th>
          <th width="45">性别</th>
          <th width="142">学院</th>
          <th width="111">专业</th>
          <th width="99">第一志愿</th>
          <th width="91">第二志愿</th>
          <th width="88">操作</th>
        </tr>
      </thead>
      <tbody>
END_OF_TEXT;
      
      
      
//         <tr>
//           <td>1</td>
//           <td>B13010812</td>
//           <td>方垣闰</td>
//           <td>男</td>
//           <td>通信与信息工程学院</td>
//           <td>通信工程</td>
//           <td>网络部</td>
//           <td>考评部</td>
//           <td>
//               <a href="application_form_html.php?student_id=B13010812"><i class="icon-search"></i> 查看</a>
//                <a href="application_form_output.php?student_id=B13010812"><i class="icon-download"></i> 导出</a>
//           </td>
//         </tr>
//         <tr>
//           <td>2</td>
//           <td>B14010101</td>
//           <td>方垣闰</td>
//           <td>女</td>
//           <td>计算机软件学院</td>
//           <td>信息安全</td>
//           <td>宣传部</td>
//           <td>秘书处</td>
//           <td>
//              <a href="application_form_html.php?student_id=B13010812"><i class="icon-search"></i> 查看</a>
//                <a href="application_form_output.php?student_id=B13010812"><i class="icon-download"></i> 导出</a>
//           </td>
//         </tr>
//         <tr>
//           <td>3</td>
//           <td>B14010101</td>
//           <td>方垣闰</td>
//           <td>男</td>
//           <td>自动化学院</td>
//           <td>数字媒体艺术</td>
//           <td>业务服务部</td>
//           <td>采编部</td>
//           <td>
//               <a href="application_form_html.php?student_id=B13010812"><i class="icon-search"></i> 查看</a>
//                <a href="application_form_output.php?student_id=B13010812"><i class="icon-download"></i> 导出</a>
//           </td>
//         </tr>
//         <tr>
//           <td>4</td>
//           <td>B14010101</td>
//           <td>方垣闰</td>
//           <td>男</td>
//           <td>自动化学院</td>
//           <td>数字媒体艺术</td>
//           <td>宣传部</td>
//           <td>无</td>
//           <td>
//              <a href="application_form_html.php?student_id=B13010812"><i class="icon-search"></i> 查看</a>
//                <a href="application_form_output.php?student_id=B13010812"><i class="icon-download"></i> 导出</a>
//           </td>
//         </tr>
//         <tr>
//           <td>5</td>
//           <td>B14010101</td>
//           <td>方垣闰</td>
//           <td>女</td>
//           <td>自动化学院</td>
//           <td>数字媒体艺术</td>
//           <td>网络部</td>
//           <td>发展部</td>
//           <td>
//               <a href="application_form_html.php?student_id=B13010812"><i class="icon-search"></i> 查看</a>
//                <a href="application_form_output.php?student_id=B13010812"><i class="icon-download"></i> 导出</a>
//           </td>
//         </tr>
//         <tr>
//           <td>6</td>
//           <td>B15050402</td>
//           <td>方垣闰</td>
//           <td>男</td>
//           <td>自动化学院</td>
//           <td>数字媒体艺术</td>
//           <td>网络部</td>
//           <td>网络服务部</td>
//           <td>
//              <a href="application_form_html.php?student_id=B13010812"><i class="icon-search"></i> 查看</a>
//                <a href="application_form_output.php?student_id=B13010812"><i class="icon-download"></i> 导出</a>
//           </td>
//         </tr>
//       </tbody>
//     </table>
// </div>
// <div class="pagination">
//     <ul>
//         <li><a href="#">上一页</a></li>
//         <li><a href="#">1</a></li>
//         <li><a href="?page=2">2</a></li>
//         <li><a href="?page=3">3</a></li>
//         <li><a href="#">4</a></li>
//         <li><a href="#">下一页</a></li>
//     </ul>
// </div>



$display_block_3=<<<END_OF_TEXT
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
   document.getElementById("page").value=theRequest["page"];
}
</script>
END_OF_TEXT;


$pdo->query("set names 'utf8'");
$selectStmt_Total=$pdo->prepare("select * from student_status 
    join student_choice on student_status.student_id = student_choice.student_id
    join student_basic_information on student_status.student_id = student_basic_information.student_id
    order by student_status.id");
$selectStmt_All_noschool=$pdo->prepare("select * from student_status 
    join student_choice on student_status.student_id = student_choice.student_id
    join student_basic_information on student_status.student_id = student_basic_information.student_id
    and (student_basic_information.sex=:sex_0 or student_basic_information.sex=:sex_1 or student_basic_information.sex=:sex_2)
    order by student_status.id");
$selectStmt_All_hasschool=$pdo->prepare("select * from student_status
    join student_choice on student_status.student_id = student_choice.student_id
    join student_basic_information on student_status.student_id = student_basic_information.student_id
    and (student_basic_information.sex=:sex_0 or student_basic_information.sex=:sex_1 or student_basic_information.sex=:sex_2) and student_basic_information.school=:school
    order by student_status.id");
$select_department_basic_information=$pdo->prepare("select * from department_basic_information where id=:id");

// if ($_GET['choice'] == 1) {
//     $get_choice=1;

// }
// else if ($_GET['choice'] == 2) {
//     $get_choice=2;
     
// }
// else {
//     $get_choice=-1;

// }

$get_choice=-1;

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

$selectStmt_Total->execute();
$TotalNumber=$selectStmt_Total->rowCount();
$selectStmt_Total->closeCursor();

$display_block_1=preg_replace('/TotalNumber/', $TotalNumber, $display_block_1);

if ($_GET['choice'] == 1) {
    $get_choice=1;
    $display_choice=<<<END_OF_TEXT
          <option value="-1">不限</option>
          <option selected="selected" value="1">第一志愿</option>
          <option value="2">第二志愿</option>
END_OF_TEXT;
}
else if ($_GET['choice'] == 2) {
    $get_choice=2;
    $display_choice=<<<END_OF_TEXT
          <option value="-1">不限</option>
          <option value="1">第一志愿</option>
          <option selected="selected" value="2">第二志愿</option>
END_OF_TEXT;
}
else {
    $get_choice=-1;
    $display_choice=<<<END_OF_TEXT
          <option selected="selected" value="-1">不限</option>
          <option value="1">第一志愿</option>
          <option value="2">第二志愿</option>
END_OF_TEXT;
}

if ($_GET['sex'] == "male") {
    $get_sex="male";
    $display_sex=<<<END_OF_TEXT
          <option value="-1">不限</option>
          <option selected="selected" value="male">男</option>
          <option value="female">女</option>
END_OF_TEXT;
}
else if ($_GET['sex'] == "female") {
    $get_sex="female";
    $display_sex=<<<END_OF_TEXT
          <option value="-1">不限</option>
          <option value="male">男</option>
          <option selected="selected" value="female">女</option>
END_OF_TEXT;
}
else {
    $get_sex="-1";
    $display_sex=<<<END_OF_TEXT
          <option selected="selected" value="-1">不限</option>
          <option value="male">男</option>
          <option value="female">女</option>
END_OF_TEXT;
}

if ($_GET['page']=="undefined" || $_GET['page']=="") {
    $page=1;
}
else {
    $page=preg_replace('/#/', "", $_GET['page']);
}
$page_size = 10;

$display_message="";

$choice_status="&choice="."$get_choice";
$sex_status="&sex="."$get_sex";
if ($_GET['school'] == "") {
    $school_status="&school=-1";
}
else {
    $school_status="&school=".$_GET['school'];
}

if ($_GET['choice'] == "" && $_GET['sex'] == "" && $_GET['school'] == "") {
//     $selectStmt_All_noschool->bindValue(':first_id', $id);
//     $selectStmt_All_noschool->bindValue(':second_id', $id);
    $selectStmt_All_noschool->bindValue(':sex_0', "");
    $selectStmt_All_noschool->bindValue(':sex_1', "male");
    $selectStmt_All_noschool->bindValue(':sex_2', "female");
    $selectStmt_All_noschool->execute();
    $arr=$selectStmt_All_noschool->fetchAll();              //二维数组，存放所有符合条件的数据
    $totalCount=$selectStmt_All_noschool->rowCount();       //查询到的总条数
    $selectStmt_All_noschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);

}


if ($get_choice == -1 && $get_sex == "-1" && $_GET['school'] == -1) {
//     $selectStmt_All_noschool->bindValue(':first_id', $id);
//     $selectStmt_All_noschool->bindValue(':second_id', $id);
    $selectStmt_All_noschool->bindValue(':sex_0', "");
    $selectStmt_All_noschool->bindValue(':sex_1', "male");
    $selectStmt_All_noschool->bindValue(':sex_2', "female");
    $selectStmt_All_noschool->execute();
    $arr=$selectStmt_All_noschool->fetchAll();              //二维数组，存放所有符合条件的数据
    $totalCount=$selectStmt_All_noschool->rowCount();       //查询到的总条数
    $selectStmt_All_noschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);

}

if ($get_choice == -1 && $get_sex == "-1" && $_GET['school'] !="" && $_GET['school'] != -1) {
//     $selectStmt_All_hasschool->bindValue(':first_id', $id);
//     $selectStmt_All_hasschool->bindValue(':second_id', $id);
    $selectStmt_All_hasschool->bindValue(':sex_0', "");
    $selectStmt_All_hasschool->bindValue(':sex_1', "male");
    $selectStmt_All_hasschool->bindValue(':sex_2', "female");
    $selectStmt_All_hasschool->bindValue(':school', $_GET['school']);
    $selectStmt_All_hasschool->execute();
    $arr=$selectStmt_All_hasschool->fetchAll();
    $totalCount=$selectStmt_All_hasschool->rowCount();
    $selectStmt_All_hasschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);
    $display_block_2=str_replace('<option selected="selected" value="-1">不限</option>//replace', '<option value="-1">不限</option>', $display_block_2);
    $display_block_2=str_replace('<option value="'.$_GET['school'].'">'.$_GET['school'].'</option>', '<option selected="selected" value="'.$_GET['school'].'">'.$_GET['school'].'</option>', $display_block_2);

}

if ($get_choice == -1 && $get_sex == "male" && $_GET['school'] == -1) {
//     $selectStmt_All_noschool->bindValue(':first_id', $id);
//     $selectStmt_All_noschool->bindValue(':second_id', $id);
    $selectStmt_All_noschool->bindValue(':sex_0', "");
    $selectStmt_All_noschool->bindValue(':sex_1', "male");
    $selectStmt_All_noschool->bindValue(':sex_2', "*");
    $selectStmt_All_noschool->execute();
    $arr=$selectStmt_All_noschool->fetchAll();              //二维数组，存放所有符合条件的数据
    $totalCount=$selectStmt_All_noschool->rowCount();       //查询到的总条数
    $selectStmt_All_noschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);

}

if ($get_choice == -1 && $get_sex == "male" && $_GET['school'] !="" && $_GET['school'] != -1) {
//     $selectStmt_All_hasschool->bindValue(':first_id', $id);
//     $selectStmt_All_hasschool->bindValue(':second_id', $id);
    $selectStmt_All_hasschool->bindValue(':sex_0', "");
    $selectStmt_All_hasschool->bindValue(':sex_1', "male");
    $selectStmt_All_hasschool->bindValue(':sex_2', "*");
    $selectStmt_All_hasschool->bindValue(':school', $_GET['school']);
    $selectStmt_All_hasschool->execute();
    $arr=$selectStmt_All_hasschool->fetchAll();
    $totalCount=$selectStmt_All_hasschool->rowCount();
    $selectStmt_All_hasschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);
    $display_block_2=str_replace('<option selected="selected" value="-1">不限</option>//replace', '<option value="-1">不限</option>', $display_block_2);
    $display_block_2=str_replace('<option value="'.$_GET['school'].'">'.$_GET['school'].'</option>', '<option selected="selected" value="'.$_GET['school'].'">'.$_GET['school'].'</option>', $display_block_2);

}

if ($get_choice == -1 && $get_sex == "female" && $_GET['school'] == -1) {
//     $selectStmt_All_noschool->bindValue(':first_id', $id);
//     $selectStmt_All_noschool->bindValue(':second_id', $id);
    $selectStmt_All_noschool->bindValue(':sex_0', "");
    $selectStmt_All_noschool->bindValue(':sex_1', "*");
    $selectStmt_All_noschool->bindValue(':sex_2', "female");
    $selectStmt_All_noschool->execute();
    $arr=$selectStmt_All_noschool->fetchAll();              //二维数组，存放所有符合条件的数据
    $totalCount=$selectStmt_All_noschool->rowCount();       //查询到的总条数
    $selectStmt_All_noschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);

}

if ($get_choice == -1 && $get_sex == "female" && $_GET['school'] !="" && $_GET['school'] != -1) {
//     $selectStmt_All_hasschool->bindValue(':first_id', $id);
//     $selectStmt_All_hasschool->bindValue(':second_id', $id);
    $selectStmt_All_hasschool->bindValue(':sex_0', "");
    $selectStmt_All_hasschool->bindValue(':sex_1', "*");
    $selectStmt_All_hasschool->bindValue(':sex_2', "female");
    $selectStmt_All_hasschool->bindValue(':school', $_GET['school']);
    $selectStmt_All_hasschool->execute();
    $arr=$selectStmt_All_hasschool->fetchAll();
    $totalCount=$selectStmt_All_hasschool->rowCount();
    $selectStmt_All_hasschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);
    $display_block_2=str_replace('<option selected="selected" value="-1">不限</option>//replace', '<option value="-1">不限</option>', $display_block_2);
    $display_block_2=str_replace('<option value="'.$_GET['school'].'">'.$_GET['school'].'</option>', '<option selected="selected" value="'.$_GET['school'].'">'.$_GET['school'].'</option>', $display_block_2);

}

if ($get_choice == 1 && $get_sex == "-1" && $_GET['school'] == -1) {
//     $selectStmt_All_noschool->bindValue(':first_id', $id);
//     $selectStmt_All_noschool->bindValue(':second_id', "*");
    $selectStmt_All_noschool->bindValue(':sex_0', "");
    $selectStmt_All_noschool->bindValue(':sex_1', "male");
    $selectStmt_All_noschool->bindValue(':sex_2', "female");
    $selectStmt_All_noschool->execute();
    $arr=$selectStmt_All_noschool->fetchAll();              //二维数组，存放所有符合条件的数据
    $totalCount=$selectStmt_All_noschool->rowCount();       //查询到的总条数
    $selectStmt_All_noschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);

}

if ($get_choice == 1 && $get_sex == "-1" && $_GET['school'] !="" && $_GET['school'] != -1) {
//     $selectStmt_All_hasschool->bindValue(':first_id', $id);
//     $selectStmt_All_hasschool->bindValue(':second_id', "*");
    $selectStmt_All_hasschool->bindValue(':sex_0', "");
    $selectStmt_All_hasschool->bindValue(':sex_1', "male");
    $selectStmt_All_hasschool->bindValue(':sex_2', "female");
    $selectStmt_All_hasschool->bindValue(':school', $_GET['school']);
    $selectStmt_All_hasschool->execute();
    $arr=$selectStmt_All_hasschool->fetchAll();
    $totalCount=$selectStmt_All_hasschool->rowCount();
    $selectStmt_All_hasschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);
    $display_block_2=str_replace('<option selected="selected" value="-1">不限</option>//replace', '<option value="-1">不限</option>', $display_block_2);
    $display_block_2=str_replace('<option value="'.$_GET['school'].'">'.$_GET['school'].'</option>', '<option selected="selected" value="'.$_GET['school'].'">'.$_GET['school'].'</option>', $display_block_2);

}

if ($get_choice == 1 && $get_sex == "male" && $_GET['school'] == -1) {
//     $selectStmt_All_noschool->bindValue(':first_id', $id);
//     $selectStmt_All_noschool->bindValue(':second_id', "*");
    $selectStmt_All_noschool->bindValue(':sex_0', "");
    $selectStmt_All_noschool->bindValue(':sex_1', "male");
    $selectStmt_All_noschool->bindValue(':sex_2', "*");
    $selectStmt_All_noschool->execute();
    $arr=$selectStmt_All_noschool->fetchAll();              //二维数组，存放所有符合条件的数据
    $totalCount=$selectStmt_All_noschool->rowCount();       //查询到的总条数
    $selectStmt_All_noschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);

}

if ($get_choice == 1 && $get_sex == "male" && $_GET['school'] !="" && $_GET['school'] != -1) {
//     $selectStmt_All_hasschool->bindValue(':first_id', $id);
//     $selectStmt_All_hasschool->bindValue(':second_id', "*");
    $selectStmt_All_hasschool->bindValue(':sex_0', "");
    $selectStmt_All_hasschool->bindValue(':sex_1', "male");
    $selectStmt_All_hasschool->bindValue(':sex_2', "*");
    $selectStmt_All_hasschool->bindValue(':school', $_GET['school']);
    $selectStmt_All_hasschool->execute();
    $arr=$selectStmt_All_hasschool->fetchAll();
    $totalCount=$selectStmt_All_hasschool->rowCount();
    $selectStmt_All_hasschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);
    $display_block_2=str_replace('<option selected="selected" value="-1">不限</option>//replace', '<option value="-1">不限</option>', $display_block_2);
    $display_block_2=str_replace('<option value="'.$_GET['school'].'">'.$_GET['school'].'</option>', '<option selected="selected" value="'.$_GET['school'].'">'.$_GET['school'].'</option>', $display_block_2);

}

if ($get_choice == 1 && $get_sex == "female" && $_GET['school'] == -1) {
//     $selectStmt_All_noschool->bindValue(':first_id', $id);
//     $selectStmt_All_noschool->bindValue(':second_id', "*");
    $selectStmt_All_noschool->bindValue(':sex_0', "");
    $selectStmt_All_noschool->bindValue(':sex_1', "*");
    $selectStmt_All_noschool->bindValue(':sex_2', "female");
    $selectStmt_All_noschool->execute();
    $arr=$selectStmt_All_noschool->fetchAll();              //二维数组，存放所有符合条件的数据
    $totalCount=$selectStmt_All_noschool->rowCount();       //查询到的总条数
    $selectStmt_All_noschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);

}

if ($get_choice == 1 && $get_sex == "female" && $_GET['school'] !="" && $_GET['school'] != -1) {
//     $selectStmt_All_hasschool->bindValue(':first_id', $id);
//     $selectStmt_All_hasschool->bindValue(':second_id', "*");
    $selectStmt_All_hasschool->bindValue(':sex_0', "");
    $selectStmt_All_hasschool->bindValue(':sex_1', "*");
    $selectStmt_All_hasschool->bindValue(':sex_2', "female");
    $selectStmt_All_hasschool->bindValue(':school', $_GET['school']);
    $selectStmt_All_hasschool->execute();
    $arr=$selectStmt_All_hasschool->fetchAll();
    $totalCount=$selectStmt_All_hasschool->rowCount();
    $selectStmt_All_hasschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);
    $display_block_2=str_replace('<option selected="selected" value="-1">不限</option>//replace', '<option value="-1">不限</option>', $display_block_2);
    $display_block_2=str_replace('<option value="'.$_GET['school'].'">'.$_GET['school'].'</option>', '<option selected="selected" value="'.$_GET['school'].'">'.$_GET['school'].'</option>', $display_block_2);

}

if ($get_choice == 2 && $get_sex == "-1" && $_GET['school'] == -1) {
//     $selectStmt_All_noschool->bindValue(':first_id', "*");
//     $selectStmt_All_noschool->bindValue(':second_id', $id);
    $selectStmt_All_noschool->bindValue(':sex_0', "");
    $selectStmt_All_noschool->bindValue(':sex_1', "male");
    $selectStmt_All_noschool->bindValue(':sex_2', "female");
    $selectStmt_All_noschool->execute();
    $arr=$selectStmt_All_noschool->fetchAll();              //二维数组，存放所有符合条件的数据
    $totalCount=$selectStmt_All_noschool->rowCount();       //查询到的总条数
    $selectStmt_All_noschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);

}

if ($get_choice == 2 && $get_sex == "-1" && $_GET['school'] !="" && $_GET['school'] != -1) {
//     $selectStmt_All_hasschool->bindValue(':first_id', "*");
//     $selectStmt_All_hasschool->bindValue(':second_id', $id);
    $selectStmt_All_hasschool->bindValue(':sex_0', "");
    $selectStmt_All_hasschool->bindValue(':sex_1', "male");
    $selectStmt_All_hasschool->bindValue(':sex_2', "female");
    $selectStmt_All_hasschool->bindValue(':school', $_GET['school']);
    $selectStmt_All_hasschool->execute();
    $arr=$selectStmt_All_hasschool->fetchAll();
    $totalCount=$selectStmt_All_hasschool->rowCount();
    $selectStmt_All_hasschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);
    $display_block_2=str_replace('<option selected="selected" value="-1">不限</option>//replace', '<option value="-1">不限</option>', $display_block_2);
    $display_block_2=str_replace('<option value="'.$_GET['school'].'">'.$_GET['school'].'</option>', '<option selected="selected" value="'.$_GET['school'].'">'.$_GET['school'].'</option>', $display_block_2);

}

if ($get_choice == 2 && $get_sex == "male" && $_GET['school'] == -1) {
//     $selectStmt_All_noschool->bindValue(':first_id', "*");
//     $selectStmt_All_noschool->bindValue(':second_id', $id);
    $selectStmt_All_noschool->bindValue(':sex_0', "");
    $selectStmt_All_noschool->bindValue(':sex_1', "male");
    $selectStmt_All_noschool->bindValue(':sex_2', "*");
    $selectStmt_All_noschool->execute();
    $arr=$selectStmt_All_noschool->fetchAll();              //二维数组，存放所有符合条件的数据
    $totalCount=$selectStmt_All_noschool->rowCount();       //查询到的总条数
    $selectStmt_All_noschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);

}

if ($get_choice == 2 && $get_sex == "male" && $_GET['school'] !="" && $_GET['school'] != -1) {
//     $selectStmt_All_hasschool->bindValue(':first_id', "*");
//     $selectStmt_All_hasschool->bindValue(':second_id', $id);
    $selectStmt_All_hasschool->bindValue(':sex_0', "");
    $selectStmt_All_hasschool->bindValue(':sex_1', "male");
    $selectStmt_All_hasschool->bindValue(':sex_2', "*");
    $selectStmt_All_hasschool->bindValue(':school', $_GET['school']);
    $selectStmt_All_hasschool->execute();
    $arr=$selectStmt_All_hasschool->fetchAll();
    $totalCount=$selectStmt_All_hasschool->rowCount();
    $selectStmt_All_hasschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);
    $display_block_2=str_replace('<option selected="selected" value="-1">不限</option>//replace', '<option value="-1">不限</option>', $display_block_2);
    $display_block_2=str_replace('<option value="'.$_GET['school'].'">'.$_GET['school'].'</option>', '<option selected="selected" value="'.$_GET['school'].'">'.$_GET['school'].'</option>', $display_block_2);

}

if ($get_choice == 2 && $get_sex == "female" && $_GET['school'] == -1) {
//     $selectStmt_All_noschool->bindValue(':first_id', "*");
//     $selectStmt_All_noschool->bindValue(':second_id', $id);
    $selectStmt_All_noschool->bindValue(':sex_0', "");
    $selectStmt_All_noschool->bindValue(':sex_1', "*");
    $selectStmt_All_noschool->bindValue(':sex_2', "female");
    $selectStmt_All_noschool->execute();
    $arr=$selectStmt_All_noschool->fetchAll();              //二维数组，存放所有符合条件的数据
    $totalCount=$selectStmt_All_noschool->rowCount();       //查询到的总条数
    $selectStmt_All_noschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);

}

if ($get_choice == 2 && $get_sex == "female" && $_GET['school'] !="" && $_GET['school'] != -1) {
//     $selectStmt_All_hasschool->bindValue(':first_id', "*");
//     $selectStmt_All_hasschool->bindValue(':second_id', $id);
    $selectStmt_All_hasschool->bindValue(':sex_1', "*");
    $selectStmt_All_hasschool->bindValue(':sex_2', "female");
    $selectStmt_All_hasschool->bindValue(':school', $_GET['school']);
    $selectStmt_All_hasschool->execute();
    $arr=$selectStmt_All_hasschool->fetchAll();
    $totalCount=$selectStmt_All_hasschool->rowCount();
    $selectStmt_All_hasschool->closeCursor();
    $display_block_1=preg_replace('/MatchNumber/', $totalCount, $display_block_1);
    $display_block_2=str_replace('<option selected="selected" value="-1">不限</option>//replace', '<option value="-1">不限</option>', $display_block_2);
    $display_block_2=str_replace('<option value="'.$_GET['school'].'">'.$_GET['school'].'</option>', '<option selected="selected" value="'.$_GET['school'].'">'.$_GET['school'].'</option>', $display_block_2);

}


//*********************************

$page_count = ceil($totalCount/$page_size);
if ($totalCount!=0) {
    if($page >= $page_count) {
        $page = $page_count;
    }
    $start_index=($page - 1) * $page_size;
    $end_index=$page * $page_size-1;

    for ($i=$start_index ; $i <=$end_index; $i++) {
        if ($arr[$i][student_id]!="") {
            $display_message.="
                <tr>";
            $display_message.="<td>".($i+1)."</td>";
            $display_message.="<td>".$arr[$i][student_id]."</td>";
            $display_message.="<td>".$arr[$i][name]."</td>";
            if ($arr[$i][sex]=="male") {
                $display_message.="<td>"."&ensp;男"."</td>";
            }
            else if ($arr[$i][sex]=="female"){
                $display_message.="<td>"."&ensp;女"."</td>";
            }
            else if ($arr[$i][sex]==""){
                $display_message.="<td>".""."</td>";
            }
            $display_message.="<td>".$arr[$i][school]."</td>";
            $display_message.="<td>".$arr[$i][major]."</td>";
            $pdo->prepare("set names 'utf8'");
            $select_department_basic_information->bindValue(':id', $arr[$i][first_choice]);
            $select_department_basic_information->execute();
            $arr_first=$select_department_basic_information->fetch();
            $select_department_basic_information->closeCursor();
            $select_department_basic_information->bindValue(':id', $arr[$i][second_choice]);
            $select_department_basic_information->execute();
            $arr_second=$select_department_basic_information->fetch();
            $select_department_basic_information->closeCursor();
            if ($arr_first[department_name]=="") {
                $display_message.="<td>"."未填报"."</td>";
            }
            else {
                $display_message.="<td>".$arr_first[department_name]."</td>";
            }
            if ($arr_second[department_name]=="") {
                $display_message.="<td>"."未填报"."</td>";
            }
            else {
                $display_message.="<td>".$arr_second[department_name]."</td>";
            }
            $display_message.="<td>";
            $display_message.='<a href="application_form_html.php?student_id='.$arr[$i][student_id].'"><i class="icon-search"></i> 查看</a>';
            $display_message.='<a href="application_form_output.php?student_id='.$arr[$i][student_id].'"><i class="icon-download"></i> 导出</a>';
            $display_message.='</td></tr>
                ';
        }

    }
}
$display_message.="
      </tbody>
    </table>
</div>
";
$display_message.='
<div class="pagination">
    <ul>
';
if ($totalCount!=0) {
    if ($page==1) {
        $display_message.='<li><a href="?page=1'.$choice_status.$sex_status.$school_status.'#">上一页</a></li>';
    }
    else {
        $display_message.='<li><a href="?page='.($page-1).$choice_status.$sex_status.$school_status.'">上一页</a></li>';
    }
}

for ($i=1 ; $i <=$page_count; $i++) {
    $display_message.='<li><a href="?page='.($i).$choice_status.$sex_status.$school_status.'">'.($i).'</a></li>';
}

if ($totalCount!=0) {
    if ($page_count==1) {
        $display_message.='<li><a href="?page=1'.$choice_status.$sex_status.$school_status.'#">下一页</a></li>
    </ul>
</div>
';
    }
    else if ($page==$page_count) {
        $display_message.='<li><a href="?page='.($page).$choice_status.$sex_status.$school_status.'#">下一页</a></li>
    </ul>
</div>
';
    }
    else {
        $display_message.='<li><a href="?page='.($page+1).$choice_status.$sex_status.$school_status.'">下一页</a></li>
    </ul>
</div>
';
    }
}
else {
    $display_message.='
    </ul>
</div>
';
}

echo $display_block_1.$display_sex.$display_block_2.$display_message.$display_block_3;


}
else if ($_COOKIE['Path'] && !$_COOKIE['Web_Cookie']) {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}
else {
    echo '<script type="text/javascript">location.href="sign-in.php"</script>';
}

?>