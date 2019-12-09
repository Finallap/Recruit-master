<?php
include_once 'lib/system_config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>社团简介</title> 
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
            <h1 class="page-title">社团简介</h1>
            <div class="well">
              <ul class="nav nav-tabs">
      <li class="active"><a href="#">社团简介</a></li>
      <li><a href="index.php">返回首页</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">社团简介</div>
      
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

