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
$selectStmt_student_basic_information=$pdo->prepare("select * from student_basic_information where student_id=:student_id");
$selectStmt_province_city=$pdo->prepare("select * from province_city where province=:province");
$selectStmt_school_major=$pdo->prepare("select * from school_major where school=:school");
$selectStmt_student_status=$pdo->prepare("select * from student_status where student_id=:student_id");
$update_student_basic_information=$pdo->prepare("update student_basic_information set name=:name,sex=:sex,province=:province,city=:city,birthday=:birthday,school=:school,major=:major,address=:address,phone=:phone,qq=:qq,email=:email where student_id=:student_id");
$update_student_status=$pdo->prepare("update student_status set basicinfo_fill=:basicinfo_fill where student_id=:student_id");

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
    <title>基本信息录入</title> 
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
            var DATE_FORMAT = /^[0-9]{4}-[0-1]?[0-9]{1}-[0-3]?[0-9]{1}$/; 
			var birthday = document.getElementById("birthday").value;  //检查生日格式
						
			var flag=0;//性别选择标志
			var radio=document.getElementsByName("sex");
   			for(var i=0;i<radio.length;i++)
   			{
         		if(radio.item(i).checked==true)
             	{
     				flag=1;
                  	break;
       			}
   			}
			  
            if(document.getElementById("name").value == ""){  
                alert("姓名不能为空!"); 
				return false;  
            }
        	else if(!flag) {
                alert("请选择性别!");
			return false;
        	}
            else if(document.getElementById("city").value == "请选择城市"){  
                alert("请选择城市!"); 
				return false;  
            }
            else if(document.getElementById("birthday").value == ""){  
                alert("出生日期不能为空!"); 
				return false;  
            }
			else if(!DATE_FORMAT.test(birthday)){  
                alert("出生日期格式有误，正确格式应为\"2012-01-01\".");
			    return false;    
			}
			else if(document.getElementById("phone").value == ""){  
                alert("联系电话不能为空!"); 
				return false;  
            }
			else if(document.getElementById("qq").value == ""){  
                alert("QQ不能为空!");  
				return false;
            }
            else if(document.getElementById("email").value == ""){  
                alert("请填写Email!");  
				return false;
            }
            else if(document.getElementById("address").value == ""){  
                alert("请填写宿舍地址!");  
				return false;
            }
            else if(document.getElementById("major").value == "请选择专业"){  
                alert("请选择专业!"); 
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
                            <li><a tabindex="-1" href="#">基本资料设置</a></li>
                            <li><a tabindex="-1" href="volunteer_setting.php">部门志愿设置</a></li>
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
            <h1 class="page-title">基本信息录入</h1>
            <div class="well">
              <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">信息录入</a></li>
      <li><a href="index.php">返回首页</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <form action="basic_information_setting.php" method="post" id="tabs" onSubmit="return check()">
        <label>姓名</label>
        <input type="text" id="name" value="
END_OF_TEXT;
        
$display_block_3=<<<END_OF_TEXT
" name="name" class="input-xlarge"><br>
        性别：
END_OF_TEXT;

$display_block_4=<<<END_OF_TEXT

        <label></label>
        <label>籍贯</label>
        <select id="province" name="province" onchange="selectprovince(this);" class="input-small"></select>
		<select id="city" name="city" class="input-large"></select>
        <label>出生日期</label>
        <input type="text"  id="birthday" value="
END_OF_TEXT;
    
$display_block_5=<<<END_OF_TEXT
" name="birthday" class="input-xlarge">
        <label>联系电话</label>
        <input type="text"  id="phone" value="
END_OF_TEXT;
        
$display_block_6=<<<END_OF_TEXT
" name="phone" class="input-xlarge">
        <label>QQ</label>
        <input type="text" id="qq" value="
END_OF_TEXT;
        
$display_block_7=<<<END_OF_TEXT
" name="qq" class="input-xlarge">
        <label>Email</label>
        <input type="text" id="email" value="
END_OF_TEXT;
        
$display_block_8=<<<END_OF_TEXT
" name="email" class="input-xlarge">
        <label>宿舍地址</label>
        <textarea rows="3" id="address" name="address" class="input-xlarge">
END_OF_TEXT;
        
$display_block_9=<<<END_OF_TEXT
</textarea>
        <label>学院</label>
        <select id="school" name="school" onchange="selectschool(this);" class="input-xlarge"></select>
        <label>专业</label>
		<select id="major" name="major" class="input-xlarge"></select>
    <label style="float：left;width:112px;">
      <input name="submit" type="submit" value="保存" class="btn btn-primary">
      <input type="reset" value="重置" class="btn">
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


<script type="text/javascript">
    var list1 = new Array;
    var list2 = new Array;
END_OF_TEXT;
    
    
$display_block_10=<<<END_OF_TEXT
var ddlProvince = document.getElementById("province");
    var ddlCity = document.getElementById("city");
    for(var i =0;i<list1.length; i++)
    {
        var option = document.createElement("option");
        option.appendChild(document.createTextNode(list1[i]));
        option.value = list1[i];
        ddlProvince.appendChild(option);
        //city initialize
        var firstprovince = list2[0];
        for (var j = 0; j < firstprovince.length; j++) {
            var optioncity = document.createElement("option");
            optioncity.appendChild(document.createTextNode(firstprovince[j]));
            optioncity.value = firstprovince[j];
            ddlCity.appendChild(optioncity);
        }
    }
    function indexof(obj,value)
    {
        var k=0;
        for(;k<obj.length;k++)
        {
            if(obj[k] == value)
            return k;
        }
        return k;
    }
    function selectprovince(obj) {
        ddlCity.options.length = 0;//clear
        var index = indexof(list1,obj.value);
        var list2element = list2[index];
        for(var i =0;i<list2element.length; i++)
        {
            var option = document.createElement("option");
            option.appendChild(document.createTextNode(list2element[i]));
            option.value = list2element[i];
            ddlCity.appendChild(option);
        }
    }
</script>

<script type="text/javascript">
    var list3 = new Array;
    var list4 = new Array;
END_OF_TEXT;
    


$display_block_11=<<<END_OF_TEXT

    var ddlschool = document.getElementById("school");
    var ddlmajor = document.getElementById("major");
    for(var i =0;i<list3.length; i++)
    {
        var option = document.createElement("option");
        option.appendChild(document.createTextNode(list3[i]));
        option.value = list3[i];
        ddlschool.appendChild(option);
        //major initialize
        var firstschool = list4[0];
        for (var j = 0; j < firstschool.length; j++) {
            var optionmajor = document.createElement("option");
            optionmajor.appendChild(document.createTextNode(firstschool[j]));
            optionmajor.value = firstschool[j];
            ddlmajor.appendChild(optionmajor);
        }
    }
    function indexof(obj,value)
    {
        var k=0;
        for(;k<obj.length;k++)
        {
            if(obj[k] == value)
            return k;
        }
        return k;
    }
    function selectschool(obj) {
        ddlmajor.options.length = 0;//clear
        var index = indexof(list3,obj.value);
        var list4element = list4[index];
        for(var i =0;i<list4element.length; i++)
        {
            var option = document.createElement("option");
            option.appendChild(document.createTextNode(list4element[i]));
            option.value = list4element[i];
            ddlmajor.appendChild(option);
        }
    }
</script>
END_OF_TEXT;





$pdo->query("set names 'utf8'");
$selectStmt_student_basic_information->bindValue(':student_id', $student_id);
$selectStmt_student_basic_information->execute();
$arr=$selectStmt_student_basic_information->fetch();
$selectStmt_student_basic_information->closeCursor();

$name=$arr[name];
$sex_stdin=$arr[sex];
$province=$arr[province];
$city=$arr[city];
$birthday=$arr[birthday];
$school=$arr[school];
$major=$arr[major];
$address=$arr[address];
$phone=$arr[phone];
$qq=$arr[qq];
$email=$arr[email];

if ($sex_stdin=="male") {
    $sex_stdout='<input name="sex" id="sex" type="radio" value="male" checked>男   ';
    $sex_stdout.='<input name="sex" id="sex" type="radio" value="female">女';
}
else if ($sex_stdin=="female"){
    $sex_stdout='<input name="sex" id="sex" type="radio" value="male">男   ';
    $sex_stdout.='<input name="sex" id="sex" type="radio" value="female" checked>女';
}
else {
    $sex_stdout='<input name="sex" id="sex" type="radio" value="male">男   ';
    $sex_stdout.='<input name="sex" id="sex" type="radio" value="female">女';
}

if ($province!="") {
    $province_status="
    
    ".'list1[list1.length] = "'."$province".'";'."
    ";
    $selectStmt_province_city->bindValue(':province', $province);
    $selectStmt_province_city->execute();
    $city_choice_arr=$selectStmt_province_city->fetch();
    $selectStmt_province_city->closeCursor();
    $city_status="
    ".$city_choice_arr[city]."
    ";
    $stmt=$pdo->query("select * from province_city");
    foreach ($stmt as $row) {
        if ($row[province] != $province) {
            $province_status.='list1[list1.length] = "'."$row[province]".'";'."
    ";
            $city_status.=$row[city]."
    ";
        }
    }
    
    if ($city!="") {
        $search='/, "'.$city.'"/';
        $replace="$city";
        $city_status=preg_replace($search, "", $city_status,1);
        $city_status=preg_replace('/请选择城市/', $city, $city_status,1);
    }
    
}
else {
    $province_status="
    
    ";
    $city_status="
    ";
    $stmt=$pdo->query("select * from province_city");
    foreach ($stmt as $row) {
        $province_status.='list1[list1.length] = "'."$row[province]".'";'."
    ";
        $city_status.=$row[city]."
    ";
    }
}

if ($school != "") {
    $school_status="
    
    ".'list3[list3.length] = "'.$school.'";'."
    ";
    $selectStmt_school_major->bindValue(':school', $school);
    $selectStmt_school_major->execute();
    $major_choice_arr=$selectStmt_school_major->fetch();
    $selectStmt_school_major->closeCursor();
    $major_status="
    ".$major_choice_arr[major]."
    ";
    $stmt=$pdo->query("select * from school_major");
    foreach ($stmt as $row) {
        if ($row[school] != $school && $row[school]!="请选择学院") {
            $school_status.='list3[list3.length] = "'.$row[school].'";'."
    ";
            $major_status.=$row[major]."
    ";
        }
    }
    
    if ($major!="") {
        $search='/, "'.$major.'"/';
        $replace="$major";
        $major_status=preg_replace($search, "", $major_status,1);
        $major_status=preg_replace('/请选择专业/', $major, $major_status,1);
    }
    
    
}
else {
    $school_status="
        
    ";
    $major_status="
    ";
    $stmt=$pdo->query("select * from school_major");
    foreach ($stmt as $row) {
        $school_status.='list3[list3.length] = "'.$row[school].'";'."
    ";
        $major_status.=$row[major]."
    ";
    }
}

//****************


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
        $name=$_POST['name'];
        $sex_stdin=$_POST["sex"];
        $province=$_POST['province'];
        $city=$_POST['city'];
        $major=$_POST['major'];
        $birthday=$_POST['birthday'];
        $school=$_POST['school'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $qq=$_POST['qq'];
        $email=$_POST['email'];
        
        $check_sql_inject=$name.$separator.$sex_stdin.$separator.$province.$separator.$city.$separator.$major.$separator.$birthday.$separator.
        $school.$separator.$address.$separator.$phone.$separator.$qq.$separator.$email;
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
        $check_xss_attack=$name.$separator.$sex_stdin.$separator.$province.$separator.$city.$separator.$major.$separator.$birthday.$separator.
        $school.$separator.$address.$separator.$phone.$separator.$qq.$separator.$email;
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
        
        clean_xss($name);
        clean_xss($sex_stdin);
        clean_xss($province);
        clean_xss($city);
        clean_xss($birthday);
        clean_xss($school);
        clean_xss($major);
        clean_xss($address);
        clean_xss($phone);
        clean_xss($qq);
        clean_xss($email);
        
        $pdo->query("set names 'utf8'");
        $update_student_basic_information->bindValue(':name', $name);
        $update_student_basic_information->bindValue(':sex', $sex_stdin);
        $update_student_basic_information->bindValue(':province', $province);
        $update_student_basic_information->bindValue(':city', $city);        
        $update_student_basic_information->bindValue(':birthday', $birthday);
        $update_student_basic_information->bindValue(':school', $school);
        $update_student_basic_information->bindValue(':major', $major);
        $update_student_basic_information->bindValue(':address', $address);
        $update_student_basic_information->bindValue(':phone', $phone);
        $update_student_basic_information->bindValue(':qq', $qq);
        $update_student_basic_information->bindValue(':email', $email);
        $update_student_basic_information->bindValue(':student_id', $student_id);
        $update_student_basic_information->execute();
        $update_student_basic_information->closeCursor();
        
        if (trim($name)!="" && trim($sex_stdin)!="" && trim($province)!="" && trim($city)!="请选择城市" && trim($birthday)!="" && trim($major)!="请选择专业" && trim($school)!="" &&
            trim($address)!="" && trim($phone)!="" && trim($qq)!="" && trim($email)!="") {
                $update_student_status->bindValue(':basicinfo_fill', "1");
                $update_student_status->bindValue(':student_id', $student_id);
                $update_student_status->execute();
                $update_student_status->closeCursor();
                
        }
        else {
            $update_student_status->bindValue(':basicinfo_fill', "0");
            $update_student_status->bindValue(':student_id', $student_id);
            $update_student_status->execute();
            $update_student_status->closeCursor();
        }
        
        
        if ($status_check_arr[department_wish_fill]==0) {
            echo '<script type="text/javascript">location.href="volunteer_setting.php"</script>';
        }
        else if ($status_check_arr[moreinfo_fill]==0) {
            echo '<script type="text/javascript">location.href="more_information_setting.php"</script>';
        }
        else {
            echo '<script type="text/javascript">location.href="information_confirmation.php"</script>';
        }
    }
    
}

echo $display_block_1.$student_id.$display_block_2.$name.$display_block_3.$sex_stdout.$display_block_4.$birthday.$display_block_5.$phone.$display_block_6.
$qq.$display_block_7.$email.$display_block_8.$address.$display_block_9.$province_status.$city_status.$display_block_10.$school_status.$major_status.$display_block_11;

}
else {
    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
    echo '<script type="text/javascript">alert("您的登陆超时，请重新登录");location.href="sign-in.php"</script>';
    
}


?>