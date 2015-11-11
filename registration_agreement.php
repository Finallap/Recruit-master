<?php
include_once 'lib/system_config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>用户协议</title> 
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
      var u=<?php echo '"'.TRACKERURL.'"'?>;
      _paq.push(['setTrackerUrl', u+'piwik.php']);
      _paq.push(['setSiteId', <?php echo SITEID;?>]);
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
      g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <noscript><p><img src=<?php echo '"'.TRACKERURL.'?idsite='.SITEID.'"'?> style="border:0;" alt="" /></p></noscript>
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
                        <a href="javascript:history.go(-1);" id="drop3" role="button" class="dropdown-toggle">
                             返回上一页
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
              </ul>

          </div>
        </div>
    </div>
    

    <div class="container-fluid">
        
        <div class="row-fluid">
          <div class="span9 offset2">
            <h1 class="page-title">用户协议</h1>
            <div class="well">
              <ul class="nav nav-tabs">
      <li class="active"><a href="#">用户协议</a></li>
      <li><a href="index.php">返回首页</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <p>注册协议须知： <br>
          请务必认真阅读和理解本《用户服务协议》（以下简称《协议》）中规定的所有权利和限制。除非您接受本《协议》条款，否则您无权注册、登录或使用本协议所涉及的相关服务。您一旦注册、登录、使用或以任何方式使用本《协议》所涉及的相关服务的行为将视为对本《协议》的接受，即表示您同意接受本《协议》各项条款的约束。如果您不同意本《协议》中的条款，请不要注册、登录或使用本《协议》相关服务。  本《协议》是用户与本网站之间的法律协议。 <br>
  <strong>一、服务简介 </strong><br>
          本站运用自己的操作为注册学生实现社团招新全部流程。基于本站所提供的网络服务的重要性，注册会员应同意提供详尽、准确的个人资料。 <br>
          本站对注册学生的电子邮件、手机号等隐私资料进行保护，承诺不会在未获得注册会员许可的情况下擅自将注册会员的个人资料信息出  租或出售给任何第三方。 <br>
          如果注册学生提供的资料包含有不正确的信息，本站保留结束注册会员使用网络服务资格的权利。 <br>
  <strong>二、注册学生的帐户，密码和安全性 </strong><br>
          注册学生一旦注册成功，成为本站的合法的注册对象参与招新。您可随时根据需要改变您的密码。注册学生将对注册会员名和密码安全负全部责任。另外，每个注册学生都要对以其注册账号进行的所有活动和事件负全责。注册学生若发现任何非法使用注册学生帐户或存在安全漏洞的情况，请立即通告本站。 <br>
  <strong>三、通告 </strong><br>
          所有发给注册学生的通告都可通过重要页面的公告或电子邮件或短信传送。本站的活动信息也将定期通过页面公告及电子邮件方式或者短信向注册学生发送。注册会员协议条款的修改、服务变更、或其它重要事件的通告会以电子邮箱或者短信进行通知。 <br>
  <strong>四、责任限制 </strong><br>
          如因不可抗力或其他本站无法控制的原因使本站销售系统崩溃或无法正常使用导致网上交易无法完成或丢失有关的信息、记录等，本站不承担责任。但是本站会尽可能合理地协助处理善后事宜，并努力使注册者避免损失。 <br>
  <strong>五、法律管辖和适用 </strong><br>
          本协议的订立、执行和解释及争议的解决均应适用中国法律。 <br>
          如发生本站服务条款与中国法律相抵触时，则这些条款将完全按法律规定重新解释，而其它合法条款则依旧保持对注册会员产生法律效力和影响。 <br>
          本协议的规定是可分割的，如本协议任何规定被裁定为无效或不可执行，该规定可被删除而其余条款应予以执行。 <br>
          六、<strong>其他规定</strong> <br>
          如本用户协议中的任何内容无论因何种原因完全或部分无效或不具有执行力，本用户协议的其余内容仍应有效并且对协议各方有约束力。<br>
        </p>
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

