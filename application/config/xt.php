<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['md5_prefix']                       = 'myxt';
$config['sitename'] = '牛模网';
$config['bail']	= array(
	1=>1000,
	2=>100,
	3=>300,
	4=>200,
	5=>100,
	);
$config['cfg_path'] = array(
	'css'=>'/assets/src/css/',
	'js'=>'/assets/src/js/',
	'images'=>'/assets/src/images/',
	'lib'=>'/assets/src/lib/',
	'admin_css'=>'/assets/admin/css/',
	'admin_js'=>'/assets/admin/js/',
	'admin_images'=>'/assets/admin/image/',
);
$config['usertype'] = array(
	1 => '模特',
	2 => '经纪公司',
	//3 => '企业',
	4 => '摄影师',
	5 => '化妆师',
);
$config['userlevel'] = array(
	0 => '普通',
	1 => '平台专属',
);
$config['workitem'] = array(
	1 => '服装拍摄',
	2 => '平面广告',
	3 => 'T台走秀',
	4 => '商业演出',
	5 => '内衣泳装',
	6 => '视频广告',
	7 => '时尚杂志',
	8 => '娱乐节目',
	9 => '其他拍摄',
	10 => '其他活动',
);
$config['workscene'] = array(
	1 => '外景',
	2 => '棚景',
);
$config['worktime'] = array(
	1 => '天',
	2 => '时',
	3 => '场',
	4 => '件',
);
$config['workprice'] = 150;
$config['orderkind'] = array(
	'book'=>1,
	'cert'=>2,
);
$config['activity'] = array(
	1 => '模特面试',
	2 => '模特工作',
	3 => '模特比赛',
);
$config['activity_en'] = array(
	1 => 'interview',
	2 => 'work',
	3 => 'game',
);
$config['get_paystatus'] = array(
	1=>'waitpay',
	2=>'payed',
	3=>'finish',
);
$config['paystatus'] = array(
	'waitpay'=>'待付款',
	'payed'=>'已付款',
	'finish'=>'成功',
);
$config['visittype'] = array(
	'home'=>1,
);
$config['modelarea'] = array(
	1=>'亚洲模特',
	2=>'欧美模特',
);
$config['modelstyle'] = array(
	1=>'韩系名媛',
	2=>'气场欧美',
	3=>'优雅复古',
	4=>'清新文艺',
	5=>'英伦学院',
	6=>'甜美日系',
	7=>'OL通勤',
	8=>'接头混搭',
	9=>'性感诱惑',
);

$config['type'] = array(
	1=>array(
	),
	2=>array(
		1=>'经纪公司',
		2=>'摄影设计',
		3=>'化妆造型',
		4=>'培训学校',
		5=>'场景基地',
		6=>'媒体杂志',
		7=>'广告传媒',
	),
	3=>array(),
	4=>array(),
	5=>array(),
);

$config['timehello'] = array(
	1=>'早上好，来个哈欠~',
	2=>'中午，午睡一下，很舒服',
	3=>'哈尼，喝杯下午茶，精神精神！',
	4=>'休息休息一下',
	);