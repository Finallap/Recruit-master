-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-08-25 12:56:38
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `recruit`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_loginfo`
--

CREATE TABLE IF NOT EXISTS `admin_loginfo` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(32) NOT NULL,
  `password` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `lastlogin` varchar(64) NOT NULL COMMENT '上次登陆时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin_loginfo`
--

INSERT INTO `admin_loginfo` (`id`, `admin_id`, `password`, `lastlogin`) VALUES
(1, 'admin', '-ÓšËøÑ¾A+S\nfYñ”y4»Èë;øÅ˜qLòüÏÆŽŽ³X$ÿhi9DryºÎæcv1>èSôË', '');

-- --------------------------------------------------------

--
-- 表的结构 `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `ip` varchar(128) NOT NULL,
  `PHP_Cookie` varchar(256) NOT NULL,
  `student_id` varchar(256) NOT NULL,
  `Channel` varchar(512) NOT NULL,
  `time` varchar(256) NOT NULL,
  `type` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `department_basic_information`
--

CREATE TABLE IF NOT EXISTS `department_basic_information` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `department_id` varchar(32) NOT NULL,
  `department_name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `department_basic_information`
--

INSERT INTO `department_basic_information` (`id`, `department_id`, `department_name`) VALUES
(1, 'example', '示例部门（请删除）');

-- --------------------------------------------------------

--
-- 表的结构 `department_login_information`
--

CREATE TABLE IF NOT EXISTS `department_login_information` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `department_id` varchar(32) NOT NULL COMMENT '部门注册id',
  `password` varchar(128) CHARACTER SET latin1 NOT NULL COMMENT '登陆密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `department_login_information`
--

INSERT INTO `department_login_information` (`id`, `department_id`, `password`) VALUES
(1, 'example', 'J\n :ôŸÄ6âsv…BÝïú{¢¾u>ì¸™ad%Îê1ÌÍ H…_”RAs–d?@ÃéÂFöê,qÐ¸Ü?aã/');

-- --------------------------------------------------------

--
-- 表的结构 `province_city`
--

CREATE TABLE IF NOT EXISTS `province_city` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `province` varchar(16) NOT NULL COMMENT '省份',
  `city` text NOT NULL COMMENT '城市',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='插入的省份-城市' AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `province_city`
--

INSERT INTO `province_city` (`id`, `province`, `city`) VALUES
(1, '北京市', 'list2[list2.length] = new Array("请选择城市", "北京", "东城区", "西城区", "崇文区", "宣武区", "朝阳区", "丰台区", "石景山区", " 海淀区（中关村）", "门头沟区", "房山区", "通州区", "顺义区", "昌平区", "大兴区", "怀柔区", "平谷区", "密云县", "延庆县", " 其他");'),
(2, '天津市', 'list2[list2.length] = new Array("请选择城市", "和平区", "河东区", "河西区", "南开区", "红桥区", "塘沽区", "汉沽区", "大港区", "西青区", "津南区", "武清区", "蓟县", "宁河县", "静海县", "其他");'),
(3, '河北省', 'list2[list2.length] = new Array("请选择城市", "石家庄市", "张家口市", "承德市", "秦皇岛市", "唐山市", "廊坊市", "衡水市", "沧州市", "邢台市", "邯郸市", "保定市", "其他");'),
(4, '山西省', 'list2[list2.length] = new Array("请选择城市", "太原市", "朔州市", "大同市", "长治市", "晋城市", "忻州市", "晋中市", "临汾市", "吕梁市", "运城市", "其他");'),
(5, '内蒙古', 'list2[list2.length] = new Array("请选择城市", "呼和浩特市", "包头市", "赤峰市", "呼伦贝尔市", "鄂尔多斯市", "乌兰察布市", "巴彦淖尔市", "兴安盟", "阿拉善盟", "锡林郭勒盟", "其他");'),
(6, '辽宁省', 'list2[list2.length] = new Array("请选择城市", "沈阳市", "朝阳市", "阜新市", "铁岭市", "抚顺市", "丹东市", "本溪市", "辽阳市", "鞍山市", "大连市", "营口市", "盘锦市", "锦州市", "葫芦岛市", "其他");'),
(7, '吉林省', 'list2[list2.length] = new Array("请选择城市", "长春市", "白城市", "吉林市", "四平市", "辽源市", "通化市", "白山市", "延边朝鲜族自治州", "其他");'),
(8, '黑龙江省', 'list2[list2.length] = new Array("请选择城市", "哈尔滨市", "七台河市", "黑河市", "大庆市", "齐齐哈尔市", "伊春市", "佳木斯市", "双鸭山市", "鸡西市", "大兴安岭地区(加格达奇)", "牡丹江", "鹤岗市", "绥化市　", "其他");'),
(9, '上海市', 'list2[list2.length] = new Array("请选择城市", "黄浦区", "卢湾区", "徐汇区", "长宁区", "静安区", "普陀区", "闸北区", "虹口区", "杨浦区", "闵行区", "宝山区", "嘉定区", "浦东新区", "金山区", "松江区", "青浦区", "南汇区", "奉贤区", "崇明县", "其他");'),
(10, '江苏省', 'list2[list2.length] = new Array("请选择城市", "南京市", "徐州市", "连云港市", "宿迁市", "淮安市", "盐城市", "扬州市", "泰州市", "南通市", "镇江市", "常州市", "无锡市", "苏州市", "其他");'),
(11, '浙江省', 'list2[list2.length] = new Array("请选择城市", "杭州市", "湖州市", "嘉兴市", "舟山市", "宁波市", "绍兴市", "衢州市", "金华市", "台州市", "温州市", "丽水市", "其他");'),
(12, '安徽省', 'list2[list2.length] = new Array("请选择城市", "合肥市", "宿州市", "淮北市", "亳州市", "阜阳市", "蚌埠市", "淮南市", "滁州市", "马鞍山市", "芜湖市", "铜陵市", "安庆市", "黄山市", "六安市", "巢湖市", "池州市", "宣城市", "其他");'),
(13, '福建省', 'list2[list2.length] = new Array("请选择城市", "福州市", "南平市", "莆田市", "三明市", "泉州市", "厦门市", "漳州市", "龙岩市", "宁德市", "其他");'),
(14, '江西省', 'list2[list2.length] = new Array("请选择城市", "南昌市", "九江市", "景德镇市", "鹰潭市", "新余市", "萍乡市", "赣州市", "上饶市", "抚州市", "宜春市", "吉安市", "其他");'),
(15, '山东省', 'list2[list2.length] = new Array("请选择城市", "济南市", "聊城市", "德州市", "东营市", "淄博市", "潍坊市", "烟台市", "威海市", "青岛市", "日照市", "临沂市", "枣庄市", "济宁市", "泰安市", "莱芜市", "滨州市", "菏泽市", "其他");'),
(16, '河南省', 'list2[list2.length] = new Array("请选择城市", "郑州市", "三门峡市", "洛阳市", "焦作市", "新乡市", "鹤壁市", "安阳市", "濮阳市", "开封市", "商丘市", "许昌市", "漯河市", "平顶山市", "南阳市", "信阳市", "周口市", "驻马店市", "其他");'),
(17, '湖北省', 'list2[list2.length] = new Array("请选择城市", "武汉市", "十堰市", "襄樊市", "荆门市", "孝感市", "黄冈市", "鄂州市", "黄石市", "咸宁市", "荆州市", "宜昌市", "随州市", "恩施土家族苗族自治州", "仙桃市", "天门市", "潜江市", "神农架林区", "其他");'),
(18, '湖南省', 'list2[list2.length] = new Array("请选择城市", "长沙市", "张家界市", "常德市", "益阳市", "岳阳市", "株洲市", "湘潭市", "衡阳市", "郴州市", "永州市", "邵阳市", "怀化市", "娄底市", "湘西土家族苗族自治州", "其他");'),
(19, '广东省', 'list2[list2.length] = new Array("请选择城市", "广州市", "清远市市", "韶关市", "河源市", "梅州市", "潮州市", "汕头市", "揭阳市", "汕尾市", " 惠州市", "东莞市", "深圳市", "珠海市", "中山市", "江门市", "佛山市", "肇庆市", "云浮市", "阳江市", "茂名市", "湛江市", " 其他");'),
(20, '广西自治区', 'list2[list2.length] = new Array("请选择城市", "南宁市", "桂林市", "柳州市", "梧州市", "贵港市", "玉林市", "钦州市", "北海市", "防城港市", "崇左市", "百色市", "河池市", "来宾市", "贺州市", "其他");'),
(21, '海南省', 'list2[list2.length] = new Array("请选择城市", "海口市", "三亚市", "其他");'),
(22, '重庆市', 'list2[list2.length] = new Array("请选择城市", "渝中区", "大渡口区", "江北区", "沙坪坝区", "九龙坡区", "南岸区", "北碚区", "万盛区", "双桥区", "渝北区", "巴南区", "万州区", "涪陵区", "黔江区", "长寿区", "合川市", "永川市", "江津市", "南川市", "綦江县", "潼南县", "铜梁县", "大足县", "璧山县", "垫江县", "武隆县", "丰都县", "城口县", "开县", "巫溪县", "巫山县", "奉节县", "云阳县", "忠县", "石柱土家族自治县", "彭水苗族土家族自治县", "酉阳土家族苗族自治县", "秀山土家族苗族自治县", "其他");'),
(23, '四川省', 'list2[list2.length] = new Array("请选择城市", "成都市", "广元市", "绵阳市", "德阳市", "南充市", "广安市", "遂宁市", "内江市", "乐山市", "自贡市", "泸州市", "宜宾市", "攀枝花市", "巴中市", "资阳市", "眉山市", "雅安", "阿坝藏族羌族自治州", "甘孜藏族自治州", "凉山彝族自治州县", "其他");'),
(24, '贵州省', 'list2[list2.length] = new Array("请选择城市", "贵阳市", "六盘水市", "遵义市", "安顺市", "毕节地区", "铜仁地区", "黔东南苗族侗族自治州", "黔南布依族苗族自治州", "黔西南布依族苗族自治州", "其他");'),
(25, '云南省', 'list2[list2.length] = new Array("请选择城市", "昆明市", "曲靖市", "玉溪市", "保山市", "昭通市", "丽江市", "普洱市", "临沧市", "宁德市", "德宏傣族景颇族自治州", "怒江傈僳族自治州", "楚雄彝族自治州", "红河哈尼族彝族自治州", "文山壮族苗族自治州", "大理白族自治州", "迪庆藏族自治州", "西双版纳傣族自治州", "其他");'),
(26, '西藏自治区', 'list2[list2.length] = new Array("请选择城市", "拉萨市", "那曲地区", "昌都地区", "林芝地区", "山南地区", "日喀则地区", "阿里地区", "其他");'),
(27, '陕西省', 'list2[list2.length] = new Array("请选择城市", "西安市", "延安市", "铜川市", "渭南市", "咸阳市", "宝鸡市", "汉中市", "安康市", "商洛市", "其他");'),
(28, '甘肃省', 'list2[list2.length] = new Array("请选择城市", "兰州市 ", "嘉峪关市", "金昌市", "白银市", "天水市", "武威市", "酒泉市", "张掖市", "庆阳市", "平凉市", "定西市", "陇南市", "临夏回族自治州", "甘南藏族自治州", "其他");'),
(29, '青海省', 'list2[list2.length] = new Array("请选择城市", "西宁市", "海东地区", "海北藏族自治州", "黄南藏族自治州", "玉树藏族自治州", "海南藏族自治州", "果洛藏族自治州", "海西蒙古族藏族自治州", "其他");'),
(30, '宁夏回族自治区', 'list2[list2.length] = new Array("请选择城市", "银川市", "石嘴山市", "吴忠市", "固原市", "中卫市", "其他");'),
(31, '新疆维吾尔自治区', 'list2[list2.length] = new Array("请选择城市", "乌鲁木齐市", "克拉玛依市", "喀什地区", "阿克苏地区", "和田地区", "吐鲁番地区", "哈密地区", "塔城地区", "阿勒泰地区", "克孜勒苏柯尔克孜自治州", "博尔塔拉蒙古自治州", "昌吉回族自治州伊犁哈萨克自治州", "巴音郭楞蒙古自治州", "河子市", "阿拉尔市", "五家渠市", "图木舒克市", "其他");'),
(32, '香港特别行政区', 'list2[list2.length] = new Array("请选择城市", "香港", "其他");'),
(33, '澳门特别行政区', 'list2[list2.length] = new Array("请选择城市", "澳门", "其他");'),
(34, '台湾省', 'list2[list2.length] = new Array("请选择城市", "台湾", "其他");'),
(35, '其它', 'list2[list2.length] = new Array("请选择城市", "其他");');

-- --------------------------------------------------------

--
-- 表的结构 `school_major`
--

CREATE TABLE IF NOT EXISTS `school_major` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `school` varchar(32) NOT NULL COMMENT '学院',
  `color` varchar(32) NOT NULL COMMENT '颜色',
  `major` text NOT NULL COMMENT '专业',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `school_major`
--

INSERT INTO `school_major` (`id`, `school`, `color`, `major`) VALUES
(1, '请选择学院', '', 'list4[list4.length] = new Array("请选择专业");'),
(2, '通信与信息工程学院', '#4572a7', 'list4[list4.length] = new Array("请选择专业", "通信工程", "电子信息工程", "广播电视工程", " 信息工程", "其他");'),
(3, '电子科学与工程学院', '#aa4643', 'list4[list4.length] = new Array("请选择专业", "电子科学与技术", "电磁场与无线技术", "微电子科学与工程", "其他");'),
(4, '光电工程学院', '#e32d2d', 'list4[list4.length] = new Array("请选择专业", "光电信息科学与工程", "电信工程及管理", " 其他");'),
(5, '计算机软件学院', '#31118f', 'list4[list4.length] = new Array("请选择专业", "计算机科学与技术", "信息安全",  "软件工程", "软件工程（嵌入式）", "软件工程（NIIT）", "其他");'),
(6, '自动化学院', '#f3ff14', 'list4[list4.length] = new Array("请选择专业", "测控技术与仪器", "电气工程及其自动化", "智能电网信息工程", "自动化", "其他");'),
(7, '材料科学与工程学院', '#05ff44', 'list4[list4.length] = new Array("请选择专业", "高分子材料与工程", "材料化学", "材料物理", "其他");'),
(8, '物联网学院', '#7579eb', 'list4[list4.length] = new Array("请选择专业", "网络工程", "物联网工程", "其他");'),
(9, '理学院', '#bf11d6', 'list4[list4.length] = new Array("请选择专业", "信息与计算科学", "应用统计学", "应用物理学", "其他");'),
(10, '地理与生物信息学院', '#d122d1', 'list4[list4.length] = new Array("请选择专业", "地理信息科学", "测绘工程", "生物医学工程", "人文地理与城乡规划", "其他");'),
(11, '传媒与艺术学院', '#66e637', 'list4[list4.length] = new Array("请选择专业", "广告学", "数字媒体艺术（艺术类）", "动画（艺术类）", "其他");'),
(12, '管理学院', '#d13939', 'list4[list4.length] = new Array("请选择专业", "工商管理", "人力资源管理", "电子商务", "物流管理", "财务管理", "信息管理与信息系统", "市场营销", "其他");'),
(13, '经济学院', '#e8f227', 'list4[list4.length] = new Array("请选择专业", "经济学", "国际经济与贸易", "经济统计学", "金融工程", "其他");'),
(14, '人文与社会科学学院', '#4572a7', 'list4[list4.length] = new Array("请选择专业", "公共事业管理", "行政管理", "社会工作", "劳动与社会保障", "其他");'),
(15, '外国语学院', '#23d9d9', 'list4[list4.length] = new Array("请选择专业", "英语", "日语", "翻译", " 其他");'),
(16, '教育科学与技术学院', '#f2ec3f', 'list4[list4.length] = new Array("请选择专业", "教育技术学", "数字媒体技术", " 其他");'),
(17, '海外教育学院', '#c224de', 'list4[list4.length] = new Array("请选择专业", "通信工程(电子与计算机工程)", "数字媒体技术(传媒艺术)", "计算机科学与技术", "财务管理", "其他");'),
(18, '贝尔英才学院', '#62ff3b', 'list4[list4.length] = new Array("请选择专业", "信息科技英才班", "理工科强化班", "信息文科强化班", "其他");'),
(19, '其他', '#f03030', 'list4[list4.length] = new Array("请选择专业", "其他");');

-- --------------------------------------------------------

--
-- 表的结构 `student_basic_information`
--

CREATE TABLE IF NOT EXISTS `student_basic_information` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL COMMENT '姓名',
  `sex` varchar(16) NOT NULL COMMENT '性别',
  `province` varchar(32) NOT NULL COMMENT '省份',
  `city` varchar(32) NOT NULL COMMENT '城市',
  `birthday` varchar(32) NOT NULL COMMENT '生日',
  `school` varchar(32) NOT NULL,
  `major` varchar(32) NOT NULL COMMENT '专业',
  `address` varchar(256) NOT NULL COMMENT '宿舍地址',
  `phone` varchar(32) NOT NULL COMMENT '联系方式',
  `qq` varchar(32) NOT NULL,
  `email` varchar(256) NOT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `student_choice`
--

CREATE TABLE IF NOT EXISTS `student_choice` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(16) NOT NULL,
  `first_choice` int(16) NOT NULL,
  `second_choice` int(16) NOT NULL,
  `if_agree_adjust` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `student_interview_condition`
--

CREATE TABLE IF NOT EXISTS `student_interview_condition` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(16) NOT NULL COMMENT '学号',
  `first_choice_first_round` varchar(16) NOT NULL DEFAULT 'unsure' COMMENT '第一志愿第一轮面试',
  `first_choice_second_round` varchar(16) NOT NULL DEFAULT 'unsure' COMMENT '第一志愿第二轮面试',
  `second_choice_first_round` varchar(16) NOT NULL DEFAULT 'unsure' COMMENT '第二志愿第一轮面试',
  `second_choice_second_round` varchar(16) DEFAULT 'unsure' COMMENT '第二志愿第二轮面试',
  `confirm_first_1` int(8) NOT NULL DEFAULT '0' COMMENT '一轮一志结果确认',
  `confirm_first_2` int(8) NOT NULL DEFAULT '0' COMMENT '二轮一志结果确认',
  `confirm_second_1` int(8) NOT NULL DEFAULT '0' COMMENT '一轮二志结果确认',
  `confirm_second_2` int(8) NOT NULL DEFAULT '0' COMMENT '二轮二志结果确认',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `student_login_information`
--

CREATE TABLE IF NOT EXISTS `student_login_information` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(16) NOT NULL COMMENT '学号',
  `password` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT '注册密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `student_more_information`
--

CREATE TABLE IF NOT EXISTS `student_more_information` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(16) NOT NULL COMMENT '学号',
  `glory` text NOT NULL COMMENT '主要荣誉',
  `hobby` text NOT NULL COMMENT '特长爱好',
  `evaluation` text NOT NULL COMMENT '自我评价',
  `impress` text NOT NULL COMMENT '对社团的第一印象',
  `wish` text NOT NULL COMMENT '对自己所报部门的期望',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `student_status`
--

CREATE TABLE IF NOT EXISTS `student_status` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(16) NOT NULL,
  `register_time` varchar(64) NOT NULL COMMENT '注册时间',
  `ip` varchar(64) NOT NULL,
  `basicinfo_fill` int(8) NOT NULL COMMENT '基本信息填写情况',
  `department_wish_fill` int(8) NOT NULL COMMENT '部门志愿填写情况',
  `moreinfo_fill` int(8) NOT NULL COMMENT '更多信息填写情况',
  `ifconfirm` int(8) NOT NULL COMMENT '报名信息确认情况',
  `confirm_time` varchar(64) NOT NULL COMMENT '确认提交时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
