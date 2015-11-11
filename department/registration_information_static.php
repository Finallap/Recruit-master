<?php
require_once './lib/set_error_reporting.php';

require_once './lib/pdo_recruit.php';
require_once './lib/PasswordHash.php';
require_once './lib/aes.php';
require_once './lib/system_config.php';

header("Content-type: text/html;charset=utf-8");

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
    <title>报名信息统计</title>
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

<script src='lib/ichart.latest.min.js'></script>
<script type='text/javascript'>
$(function(){
      var chart = iChart.create({
            render:"ichart-render-sex",
            width:500,
            height:400,
            background_color:"#fefefe",
            gradient:true,
            color_factor:0.2,
            border:{
                  color:"BCBCBC",
                  width:2
            },
            align:"center",
            offsetx:0,
            offsety:0,
            sub_option:{
                  border:{
                        color:"#BCBCBC",
                        width:1
                  },
                  label:{
                        fontweight:500,
                        fontsize:13,
                        color:"#4572a7",
                        sign:"square",
                        sign_size:12,
                        border:{
                              color:"#BCBCBC",
                              width:1
                        },
                        background_color:"#fefefe"
                  }
            },
            shadow:true,
            shadow_color:"#666666",
            shadow_blur:30,
            showpercent:false,
            column_width:"70%",
            bar_height:"70%",
            radius:"60%",
            title:{
                  text:"性别信息统计图",
                  color:"#111111",
                  fontsize:30,
                  font:"微软雅黑",
                  textAlign:"center",
                  height:30,
                  offsetx:0,
                  offsety:30
            },
            subtitle:{
                  text:"",
                  color:"#111111",
                  fontsize:16,
                  font:"微软雅黑",
                  textAlign:"center",
                  height:20,
                  offsetx:0,
                  offsety:0
            },
            footnote:{
                  text:"",
                  color:"#111111",
                  fontsize:12,
                  font:"微软雅黑",
                  textAlign:"right",
                  height:20,
                  offsetx:0,
                  offsety:0
            },
            legend:{
                  enable:false,
                  background_color:"#fefefe",
                  color:"#333333",
                  fontsize:12,
                  border:{
                        color:"#BCBCBC",
                        width:1
                  },
                  column:1,
                  align:"right",
                  valign:"center",
                  offsetx:0,
                  offsety:0
            },
            coordinate:{
                  width:"80%",
                  height:"84%",
                  background_color:"#ffffff",
                  axis:{
                        color:"#a5acb8",
                        width:[1,"",1,""]
                  },
                  grid_color:"#d9d9d9",
                  label:{
                        fontweight:500,
                        color:"#666666",
                        fontsize:11
                  }
            },
            label:{
                  fontweight:500,
                  color:"#666666",
                  fontsize:11
            },
            type:"pie2d",
            data:[
                  {
                  name:"男",
                  value:男人数,
                  color:"#0000fe"
            },{
                  name:"女",
                  value:女人数,
                  color:"#fe0000"
            }
            ]
      });
      chart.draw();
});



$(function(){
      var chart = iChart.create({
            render:"ichart-render-choose",
            width:500,
            height:400,
            background_color:"#fefefe",
            gradient:true,
            color_factor:0.2,
            border:{
                  color:"BCBCBC",
                  width:2
            },
            align:"center",
            offsetx:0,
            offsety:0,
            sub_option:{
                  border:{
                        color:"#BCBCBC",
                        width:1
                  },
                  label:{
                        fontweight:500,
                        fontsize:13,
                        color:"#4572a7",
                        sign:"square",
                        sign_size:12,
                        border:{
                              color:"#BCBCBC",
                              width:1
                        },
                        background_color:"#fefefe"
                  }
            },
            shadow:true,
            shadow_color:"#666666",
            shadow_blur:30,
            showpercent:false,
            column_width:"70%",
            bar_height:"70%",
            radius:"60%",
            title:{
                  text:"志愿顺序统计",
                  color:"#111111",
                  fontsize:30,
                  font:"微软雅黑",
                  textAlign:"center",
                  height:30,
                  offsetx:0,
                  offsety:30
            },
            subtitle:{
                  text:"",
                  color:"#111111",
                  fontsize:16,
                  font:"微软雅黑",
                  textAlign:"center",
                  height:20,
                  offsetx:0,
                  offsety:0
            },
            footnote:{
                  text:"",
                  color:"#111111",
                  fontsize:12,
                  font:"微软雅黑",
                  textAlign:"right",
                  height:20,
                  offsetx:0,
                  offsety:0
            },
            legend:{
                  enable:false,
                  background_color:"#fefefe",
                  color:"#333333",
                  fontsize:12,
                  border:{
                        color:"#BCBCBC",
                        width:1
                  },
                  column:1,
                  align:"right",
                  valign:"center",
                  offsetx:0,
                  offsety:0
            },
            coordinate:{
                  width:"80%",
                  height:"84%",
                  background_color:"#ffffff",
                  axis:{
                        color:"#a5acb8",
                        width:[1,"",1,""]
                  },
                  grid_color:"#d9d9d9",
                  label:{
                        fontweight:500,
                        color:"#666666",
                        fontsize:11
                  }
            },
            label:{
                  fontweight:500,
                  color:"#666666",
                  fontsize:11
            },
            type:"pie2d",
            data:[
                  {
                  name:"第一志愿",
                  value:第一志愿人数,
                  color:"#fe0000"
            },{
                  name:"第二志愿",
                  value:第二志愿人数,
                  color:"#0000fe"
            }
            ]
      });
      chart.draw();
});



$(function(){
      var chart = iChart.create({
            render:"ichart-render-school",
            width:500,
            height:400,
            background_color:"#fefefe",
            gradient:true,
            color_factor:0.2,
            border:{
                  color:"BCBCBC",
                  width:2
            },
            align:"center",
            offsetx:0,
            offsety:0,
            sub_option:{
                  border:{
                        color:"#BCBCBC",
                        width:1
                  },
                  label:{
                        fontweight:500,
                        fontsize:12,
                        color:"#4572a7",
                        sign:"square",
                        sign_size:12,
                        border:{
                              color:"#BCBCBC",
                              width:1
                        },
                        background_color:"#fefefe"
                  }
            },
            shadow:true,
            shadow_color:"#666666",
            shadow_blur:30,
            showpercent:false,
            column_width:"70%",
            bar_height:"70%",
            radius:"54%",
            title:{
                  text:"学院信息统计图",
                  color:"#111111",
                  fontsize:30,
                  font:"微软雅黑",
                  textAlign:"center",
                  height:30,
                  offsetx:0,
                  offsety:30
            },
            subtitle:{
                  text:"",
                  color:"#111111",
                  fontsize:16,
                  font:"微软雅黑",
                  textAlign:"center",
                  height:20,
                  offsetx:0,
                  offsety:0
            },
            footnote:{
                  text:"",
                  color:"#111111",
                  fontsize:12,
                  font:"微软雅黑",
                  textAlign:"right",
                  height:20,
                  offsetx:0,
                  offsety:0
            },
            legend:{
                  enable:false,
                  background_color:"#fefefe",
                  color:"#333333",
                  fontsize:12,
                  border:{
                        color:"#BCBCBC",
                        width:1
                  },
                  column:1,
                  align:"right",
                  valign:"center",
                  offsetx:0,
                  offsety:0
            },
            coordinate:{
                  width:"80%",
                  height:"84%",
                  background_color:"#ffffff",
                  axis:{
                        color:"#a5acb8",
                        width:[1,"",1,""]
                  },
                  grid_color:"#d9d9d9",
                  label:{
                        fontweight:500,
                        color:"#666666",
                        fontsize:11
                  }
            },
            label:{
                  fontweight:500,
                  color:"#666666",
                  fontsize:11
            },
            type:"pie2d",
            data:[
END_OF_TEXT;

$display_block_1=str_replace('var u="URL";', 'var u="'.TRACKERURL.'";', $display_block_1);
$display_block_1=str_replace("_paq.push(['setSiteId', id]);","_paq.push(['setSiteId', ".SITEID."]);", $display_block_1);
$display_block_1=str_replace('<noscript><p><img src="URLGET" style="border:0;" alt="" /></p></noscript>', '<noscript><p><img src="'.TRACKERURL.'?idsite='.SITEID.'" style="border:0;" alt="" /></p></noscript>', $display_block_1); 

    
    
//             {
//                   name:"通信与信息工程学院",
//                   value:R通信与信息工程学院人数,
//                   color:"#4572a7"
//             },{
//                   name:"电子科学与工程学院",
//                   value:R电子科学与工程学院人数,
//                   color:"#aa4643"
//             },{
//                   name:"光电工程学院",
//                   value:R光电工程学院人数,
//                   color:"#e32d2d"
//             },{
//                   name:"计算机软件学院",
//                   value:R计算机软件学院人数,
//                   color:"#31118f"
//             },{
//                   name:"自动化学院",
//                   value:R自动化学院人数,
//                   color:"#f3ff14"
//             },{
//                   name:"材料科学与工程学院",
//                   value:R材料科学与工程学院人数,
//                   color:"#05ff44"
//             },{
//                   name:"物联网学院",
//                   value:R物联网学院人数,
//                   color:"#7579eb"
//             },{
//                   name:"理学院",
//                   value:R理学院人数,
//                   color:"#bf11d6"
//             },{
//                   name:"地理与生物信息学院",
//                   value:R地理与生物信息学院人数,
//                   color:"#d122d1"
//             },{
//                   name:"传媒与艺术学院",
//                   value:R传媒与艺术学院人数,
//                   color:"#66e637"
//             },{
//                   name:"管理学院",
//                   value:R管理学院人数,
//                   color:"#d13939"
//             },{
//                   name:"经济学院",
//                   value:R经济学院人数,
//                   color:"#e8f227"
//             },{
//                   name:"人文与社会科学学院",
//                   value:R人文与社会科学学院人数,
//                   color:"#4572a7"
//             },{
//                   name:"外国语学院",
//                   value:R外国语学院人数,
//                   color:"#23d9d9"
//             },{
//                   name:"教育科学与技术学院",
//                   value:R教育科学与技术学院人数,
//                   color:"#f2ec3f"
//             },{
//                   name:"海外教育学院",
//                   value:R海外教育学院人数,
//                   color:"#c224de"
//             },{
//                   name:"贝尔英才学院",
//                   value:R贝尔英才学院人数,
//                   color:"#62ff3b"
//             },{
//                   name:"其他",
//                   value:R其他人数,
//                   color:"#f03030"
//             }
            
            
$display_block_2=<<<END_OF_TEXT
            ]
      });
      chart.draw();
});
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
                             <li><a tabindex="-1" href="interview_situation_input.php">面试情况录入</a></li>
                  <li><a tabindex="-1" href="#">报名信息统计</a></li>
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
            <h1 class="page-title">报名信息统计</h1>

               <div class="block">
              <p class="block-heading">汇总表导出</p>
                <div class="block-body">
                <div class="row-fluid">
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
      <p class="block-heading">共查找到TotalNumber条报名记录，以下是信息统计：</p>
                <div class="block-body">
                <div class="row-fluid">
                
                <div id='ichart-render-sex'></div>
                <div id='ichart-render-choose'></div>
                <div id='ichart-render-school'></div>
                
                  <div class="clearfix"></div>
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
END_OF_TEXT;

$selectStmt_All=$pdo->prepare("select * from student_status join student_choice
    on student_status.student_id = student_choice.student_id
    join student_basic_information on student_status.student_id = student_basic_information.student_id
    where student_status.ifconfirm = '1'
    ");
$selectStmt_school_major=$pdo->prepare("select * from school_major");

$selectStmt_All->execute();
$arr=$selectStmt_All->fetchAll();
$rowcount=$selectStmt_All->rowCount();
$selectStmt_All->closeCursor();

$selectStmt_school_major->execute();
$school_arr=$selectStmt_school_major->fetchAll();
$rowcount_school=$selectStmt_school_major->rowCount();
$selectStmt_school_major->closeCursor();

$totalNumber=0;
$contain[male]=0;
$contain[female]=0;
$contain[first_choice]=0;
$contain[second_choice]=0;

for ($i = 0; $i < $rowcount; $i++) {
    if ($arr[$i][first_choice] == $id) {
        $contain[first_choice] = $contain[first_choice] + 1;
        $totalNumber++;
        $contain[$arr[$i][sex]] = $contain[$arr[$i][sex]] + 1;
        $contain[$arr[$i][school]] = $contain[$arr[$i][school]] + 1;
    }
    else if ($arr[$i][second_choice] == $id) {
        $contain[second_choice] = $contain[second_choice] + 1;
        $totalNumber++;
        $contain[$arr[$i][sex]] = $contain[$arr[$i][sex]] + 1;
        $contain[$arr[$i][school]] = $contain[$arr[$i][school]] + 1;
    }
    
}

$display_block_2=preg_replace('/TotalNumber/', $totalNumber, $display_block_2);
$display_block_2=preg_replace('/网络部/', $department_name, $display_block_2);
$display_block_1=preg_replace('/男人数/', $contain[male], $display_block_1);
$display_block_1=preg_replace('/女人数/', $contain[female], $display_block_1);
$display_block_1=preg_replace('/第一志愿人数/', $contain[first_choice], $display_block_1);
$display_block_1=preg_replace('/第二志愿人数/', $contain[second_choice], $display_block_1);

$show_school_static="";

for ($i = 0; $i < $rowcount_school; $i++) {
    $display_school_static=<<<END_OF_TEXT
            {
                  name:"replacename",
                  value:replacevalue,
                  color:"replacecolor"
            },
END_OF_TEXT;
    if ($contain[$school_arr[$i][school]] !=0) {
        $display_school_static=preg_replace('/replacename/', $school_arr[$i][school], $display_school_static);
        $display_school_static=preg_replace('/replacevalue/', $contain[$school_arr[$i][school]], $display_school_static);
        $display_school_static=preg_replace('/replacecolor/', $school_arr[$i][color], $display_school_static);
        $show_school_static.=$display_school_static;
        
    }
    
}


echo $display_block_1.$show_school_static.$display_block_2;

}
else {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
}

?>