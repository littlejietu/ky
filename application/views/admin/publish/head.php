<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>牛模网平台管理系统</title>
    <link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>jquery-1.8.0.min.js"></script>
	<script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>main.js"></script>
	<script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>user.js"></script>
	<script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>ajax.js"></script>
    <script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>source.js"></script>
    <script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>common.js"></script>
    <!--[if IE 6]>
    <script src="<?php echo _get_cfg_path('admin_js')?>iepng.js" type="text/javascript"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input,a,span');
    </script>
    <![endif]-->
</head>

<body style="background:#f7f7f7;">
<div class="head">
    <div class="top clearfix">
        <a href="<?php echo base_url();?>"  class="logo"></a>

    </div>
    <div class="nav">
        <ul>
            <li><a class="on" href="/">首页</a></li>
            <li><a href="javascript:logout('<?php echo base_url();?>');">退出</a></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="main_right">