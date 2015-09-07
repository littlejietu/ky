
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="<?php echo _get_cfg_path('js')?>js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>


<body class="resize">
<!--header-->
<?php include_once(VIEWPATH."public/header_menu.php");?>
<div id="slideBox" class="ibanner">
    <div class="iban">
        <h3>登录账号</h3>
        <div class="fl iban_form">
            <form id="xtform" action="" method="post">
                <input type="hidden" id="forword_url" value="{$result.forword_url}">
                <ul>
                    <li>
                        <img src="<?php echo _get_cfg_path('images')?>iban_formimg1.jpg" />
                        <input id="name" name="username" type="text" placeholder="用户名"/>
                        <img src="<?php echo _get_cfg_path('images')?>iban_formtt.jpg" />
                    </li>
                    <li>
                        <img src="<?php echo _get_cfg_path('images')?>iban_formimg2.jpg" />
                        <input id="password" name="password" type="password" placeholder="密码"/>
                        <img src="<?php echo _get_cfg_path('images')?>iban_formtt.jpg" /></li>
                    <li>
                        <img src="<?php echo _get_cfg_path('images')?>iban_formimg3.jpg" />
                        <input class="iban_foin" name="login_code" id="code" type="text" placeholder="验证码"/>
                        <img class="mrgR10" src="<?php echo _get_cfg_path('images')?>iban_formtt.jpg" />
                        <img class="xtml-15" id="yzimg" src="/util/captcha?<?php echo rand(10000,9999);?>" onclick="this.src='/util/captcha?'+Math.random()" alt="验证码" >
                    </li>
                    <li>
                        <input checked="checked" type="checkbox"  name="rem" id="rem" value="rem" />
                        <label for="rem">记住帐号</label>
                        <p class="fr f_prompt" id="prompt">请输入正确的密码</p>
                    </li>
                    <li class="iban_forin">
                        <input class="but" name="submit" value="登   录" type="submit" onclick="return formC();"/>
                    </li>
                    <li>
                        <p class="logmm fl">忘记密码？<a href="##">点击这里</a></p>
                        <a class="iban_forma fr" href="/reg" title="免费注册">免费注册</a>
                    </li>
                </ul>
            </form>
        </div>
        <div class="iban_bot"><span>社交账号直接登录</span>
            <a class="iban_bota" href="#">微博</a><a class="iban_qq" href="#">QQ</a>
        </div>
    </div>
    <div class="hd">
        <ul></ul>
        <a class="prev" title="上一页">上一页</a>
        <a class="next" title="下一页">下一页</a>
    </div>
    <div class="bd">
        <ul>
            <li _src="url(/upload/banner/banner2.jpg)"><a href="##"></a></li>
            <li _src="url(/upload/banner/banner3.jpg)"><a href="##"></a></li>
        </ul>
    </div>
</div>
<div class="ifooter">
    <div class="container clearfix">
        <a class="fl" href="index.php"><img src="<?php echo _get_cfg_path('images')?>logo.png" alt="logo"/></a>
        <p class="fr">
            <a href="#" title="工作条款">工作条款</a>牛模网版权所有&copy;2004-2015
        </p>
    </div>
</div>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>

<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.form.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/user/login.js"></script>

</body>
</html>
