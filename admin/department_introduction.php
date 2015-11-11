<?php
include_once 'lib/system_config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>部门简介</title> 
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
                        <a href="" id="drop3" role="button" class="dropdown-toggle" onclick="javascript:history.back(-1);">
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
            <h1 class="page-title">部门简介</h1>
            <div class="well">
              <ul class="nav nav-tabs">
      <li class="active"><a href="#">部门简介</a></li>
      <li><a href="index.php">返回首页</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <p>【发展部】<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发展部隶属于交流企划中心，是社团与校内外社团沟通联系的桥梁。负责紧密联系社团内部各个部门、社团内部联谊活动的举办、外场活动的策划及执行；定期与校内其余社团进行联系交流；同时还具有和其余高校的相似性质的社团交流、学习，共同举办活动的职责。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发展部是最具活力的部门，其中的成员无一不是活泼开朗善于交际的人才，也正是有了发展部的努力，才有了学生发展中心内部和睦的社团氛围、以及和其余社团的良好关系。亲爱的学弟学妹，如果你对自己的组织能力和交际能力有自信，就快快投入到发展部的怀抱来吧，向我们证明你注定成为我们的一员！<br><br>
【企划部】<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;隶属于交流企划中心，是学生发展中心的组织策划部门。负责组织策划各种学业指导活动，社团内部活动以及特色的校内活动，包括失物招领活动，帮助同学寻找失物；各学院查课活动，了解各学院班级上课签到情况，督促同学们的学习。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学弟学妹们，如果你想在锻炼自己的策划能力、组织活动的能力的同时，帮助到其他同学，如果你想充实自己的大学生活，在锻炼中不断成长，那就请加入我们企划部吧，没有你行不行，只有你敢不敢！！<br><br>
【秘书处】<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;隶属于办公中心，是社团各个部门与主席团的沟通联系部门。负责学生事务大厅物资采购与保管，待登报学生证资料的整理，社团内部各个部门的通讯联系工作，会议的统筹安排及会议记录主持等工作。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这里，秘书处就是闪闪发光的万能部门，有着不可或缺的独特地位，在秘书处的努力下，学生发展中心的发展会更加完美！亲爱的小鲜肉，如果你喜欢秘书处，如果你能够胜任秘书处的职位，请勇敢地递上你的报名表！<br><br>
【考评部】<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;隶属于办公中心，考评部致力于服务、引导社团的发展。负责制定、修改、完善并监督实行各项规章制度、工作的执行情况，承担学生事务大厅值班工作的记录以及评分，各项荣誉评比的考核评定工作，保证工作落实的公平性、公正性和公开性。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用“高冷”对待每一项工作和任务；用“逗比”和每一个同学相处；用“文艺”彰显我们的内涵，用自己的努力为学生发展中心保驾护航。亲爱的同学们： 新的起点已经开始，新的生活也拉开序幕，意气风发的你一定想要在这里提高你们的能力，大显身手吧？那就加入我们吧！这里有你渴望得到的锻炼和友谊！<br><br>
【业务服务部】<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;隶属于大厅服务中心，是学生发展中心的核心部门。负责学生事务大厅的日常值班以及各项业务的办理，包括学生证、校园卡的相关办理业务，失物招领与登记，物品借用与寄存等。业务服务部的成员拥有熟练办理业务的能力，进一步准确高效的提高服务水平，努力让每一个带着问题来的同学带着满意离开。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;业务服务部是学生事务大厅正常运行的核心力量，如果你愿意脚踏实地服务全校师生，加入我们吧，与学生发展中心一起进步，和我们一起带领其他部门走向高大上吧！这里有你想要的能力体现！<br><br>
【网络服务部】<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;主要负责学生事务大厅线上线下的咨询工作。下分为微信答疑组和权益服务组。微信答疑组负责微信线上人工答疑，为全校师生解答疑惑； 权益服务组受理校内投诉问题，建立了校内微信维权投诉通道，打造线上线下一体化的校内维权平台。同时根据同学们的需求展开必要的调研工作，为学校决策提供参考。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如果你爱生活，爱服务，手机控，够逗比，那你一定能成为我们一员。（附部门现男女比例1:7）<br><br>
【宣传部】<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;隶属于新媒体中心，是树立学生发展中心形象的重要部门和进行对外宣传的桥梁。负责协助其他部门开展各项活动的宣传工作，设计宣传海报、制作宣传视频以及各种拍照工作，利用各种途径提高社团的校内影响力。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;宣传部是学生发展中心与外界的桥梁，致力于提升社团格调，极具文化气息。魔力快门捕捉时光定格瞬间，绚丽视频剪辑青春演绎成长，多彩海报张扬个性突显内涵，小伙伴们创意无限志趣相投，各显神通亲如一家。这里是学生发展中心的门面，这里是文艺逗比青年的归属，这里是技术人才培育的摇篮。如果你想用双手描绘属于自己的篇章，那就加入我们吧！ <br><br>
【采编部】<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;负责学生事务中心官方微信的信息采集、文案编辑、图文制作以及线上活动的宣传策划。从严谨的官方通知到温暖的南邮小贴士，从精彩的校园生活到跳跃的思想盛宴，涉及南邮内外的方方面面，致力于打造线上全新服务模式，让同学们了解南邮最全的资讯信息，感受校园内外的多姿风采，在不同时间、不同地点均能享受微星人的贴心服务。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;亲爱的们，如果你是文字控、策划达人、摄影迷，如果你有观点、有想法、有热情，来加入我们吧，这里，是你们的地盘！让我们砥砺想法，共同进步！<br><br>
【网络部】<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;隶属于技术中心，是学生发展中心的新兴部门。负责学生事务中心微信平台以及网站的开发维护。网络部热衷于web前后端以及各种运用方面的技术部门，深入研究Linux服务器运维方面的知识。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;虽然网络部是一个技术部门，但是不要怕，只要你对技术学习有着一颗热忱的心，并有着强大的战斗力，欢迎加入我们，你将是下一个成为“大神”的“菜鸟”！ <br><br>

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

