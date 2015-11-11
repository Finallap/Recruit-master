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
            <div class="faq-content">
    <h1 class="page-title">个人用户FAQ</h1>

    <div class="well">
        <h2>常见问题检索</h2>
        <ol>
            <li><a href="#q1">线上报名的流程是什么？</a></li>
            <li><a href="#q2">自己的学号被恶意注册了怎么办？</a></li>
            <li><a href="#q3">忘记密码怎么办？</a></li>
            <li><a href="#q4">信息填写提交后就不能修改了么？</a></li>
            <li><a href="#q5">信息填写完毕后不点击确定有什么影响？</a></li>
            <li><a href="#q5">所有报名信息都是必须填写的么？</a></li>
            <li><a href="#q5">我还有更多的问题怎么办？</a>        </li>
        </ol>
        <hr>

        <h2>常见问题解答</h2>
        <a href="#" style="float: right; line-height: 1.25em; display: inline-block; padding: .75em 0em;"><i class="icon-circle-arrow-up"></i> Top</a>
        <h3 id="q1">线上报名的流程是什么？</h3>
        <p>答： ①使用自己学号注册； <br>
          ②填写基本资料； <br>
          ③填写部门志愿； <br>
          ④填写更多资料； <br>
          ⑤确认信息填写无误后，点击报名确认； <br>
          ⑥报名完成； <br>
        ⑦查看面试情况，等待好消息。 </p>
        <hr>
<a href="#" style="float: right; line-height: 1.25em; display: inline-block; padding: .75em 0em;"><i class="icon-circle-arrow-up"></i> Top</a>
        <h3 id="q2">自己的学号被恶意注册了怎么办？</h3>
        <p>答：当自己的学号被恶意注册时，请点击右上方“社团与系统”选项卡下的“关于系统”页面，页面中有社团超级管理员的联系方式，请联系他们说明情况将被恶意注册的学号删除，删除后便又能正常注册。</p>
        <hr>
        <a href="#" style="float: right; line-height: 1.25em; display: inline-block; padding: .75em 0em;"><i class="icon-circle-arrow-up"></i> Top</a>
        <h3 id="q3">忘记密码怎么办？</h3>
        <p>答：忘记密码时，请点击右上方“社团与系统”选项卡下的“关于系统”页面，页面中有社团超级管理员的联系方式，请联系他们将你的密码重置，密码重置后的密码为学号，请及时修改。</p>
        <hr>
        <a href="#" style="float: right; line-height: 1.25em; display: inline-block; padding: .75em 0em;"><i class="icon-circle-arrow-up"></i> Top</a>
        <h3 id="q4">信息填写提交后就不能修改了么？</h3>
        <p>答：在信息保存但没点击确认报名之前，都可以返回再次修改填写报名资料。 </p>
在所有的报名信息（基本资料、部门志愿、更多资料）填写完成并点击报名确认后，信息便无法再次更改。需再更改请联系超级管理员，方式请见上两问。
<hr>
        <a href="#" style="float: right; line-height: 1.25em; display: inline-block; padding: .75em 0em;"><i class="icon-circle-arrow-up"></i> Top</a>
        <h3 id="q5">信息填写完毕后不点击确定有什么影响？</h3>
        <p>答：当信息填写完毕并确认无误后，请务必点击报名确认。否则报名信息无法在报名填写的部门的后台中检索到，报名无效。</p>
        <hr>
           <a href="#" style="float: right; line-height: 1.25em; display: inline-block; padding: .75em 0em;"><i class="icon-circle-arrow-up"></i> Top</a>
        <h3 id="q6">所有报名信息都是必须填写的么？</h3>
        <p>答：所有信息录入的框都必须填写才能提交，实在找不到填写的内容时候，大家也可填写“无”。不过为了大家面试能取得个好成绩，建议大家还是都填写内容。</p>
        <hr>
           <a href="#" style="float: right; line-height: 1.25em; display: inline-block; padding: .75em 0em;"><i class="icon-circle-arrow-up"></i> Top</a>
        <h3 id="q7">我还有更多的问题怎么办？</h3>
        <p>答：关于线上报名系统使用的更多问题咨询超级管理员（方式见上），关于社团和部门招新面试的问题直接联系社团学长学姐好了~</p>
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

