<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>index</title>
    <link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>login.css" rel="stylesheet">
    <script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>jquery-1.8.0.min.js"></script>
	<script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>main.js"></script>
	<script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>user.js"></script>
	<script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>ajax.js"></script>
    <script language="javascript" src="<?php echo _get_cfg_path('admin_js')?>common.js"></script>
</head>
<script type="text/javascript">
document.onkeydown=function(event){
	var e = event || window.event || arguments.callee.caller.arguments[0];
	 if(e && e.keyCode==13){//回车登录
		 ajaxLogin('<?php echo base_url()?>');
	}
}; 
</script>
<body>
<div id="login">
    <div class="login_top">
        <div class="clearfix logincon">
            <div class="fl">
            <img width="147" height="43" src="<?php echo _get_cfg_path('admin_images')?>logo.png" alt="logo">
            </div>
            <div class="fr">
             <a class="lb_link" target="_blank" href="<?php echo base_url();?>">牛模网</a>
            </div>
        </div>
    </div>
    
    <div class="login_con">
        <div class="clearfix logincon">
            <div class="fl flimg"></div>
            <div class="fr login">
                <div class="loginbox">
    
                        <h3> 登录牛模网后台中心</h3>
    
                        <p class="field">
                            <label><img src="<?php echo _get_cfg_path('admin_images')?>field_1.jpg"/></label>
                            <input class="user" type="text" id="loginUser"  placeholder="用户名" />
                        </p>
    
                        <p class="field">
                            <label><img src="<?php echo _get_cfg_path('admin_images')?>field_2.jpg"/></label>
                            <input class="pass" type="password" id="loginPassword"  placeholder="密码" />
                        </p>
                        
                        <p class="field fl" style="width:150px;float:left;">
                            <label><img src="<?php echo _get_cfg_path('admin_images')?>field_3.jpg"/></label>
                            <input class="code" type="text" id="loginCode" placeholder="验证码" style="width:85px;"/>
                            
                            <div id="codeimg" class="codeimg" onClick="javascript:;">
                                <img class="xtml-15" id="yzimg" src="/util/captcha_admin?<?php echo rand(10000,9999);?>" onclick="this.src='/util/captcha_admin?'+Math.random()" alt="验证码" >
                            </div><span id="error_code"></span>
                        </p>

                       
    
                        <div class="but fl" onClick="javascript:ajaxLogin('<?php echo base_url()?>');">登&nbsp;录</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="login_copyt">
    Copyright©2014 c2mmall.com 浙ICP备 15002230号 全案策划：<a target="_blank" href="http://www.lebang.com/"> LEBANG . com</a>
    </div>
    
    <span class="error"></span>
</div>
<?php include_once('publish/foot.php');?>

