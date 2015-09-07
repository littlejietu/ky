<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="<?php echo _get_cfg_path('js')?>DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>

<?php include_once(VIEWPATH."public/header.php");?>

<div class="mainbody" id="mainbody">
    <div id="register" class="container mrgB30">
        <div class="reg_title">注册会员</div>
        <div class="register">
            
            <div class="reg-left">
                <div id="reg-vertical" class="reg-scrollbox clearfix">
                    <div class="reg-slyWrap example2" style="float:right;">
                        <div class="reg-scrollbar">
                            <div class="handle"></div>
                        </div>
                        <div class="reg-sly" data-options='{ "scrollBy": 100, "startAt": 0 }'>
                            <div>
                              <p><strong>1、工作条款的确认和接纳</strong>  牛魔网平台由之江巧克力（杭州）动漫有限公司运营，涉及具体产品工作的将由有资质的工作商提供。用户通过完成注册程序并点击一下“递交”的按钮，这表示用户明确知晓以上事实，并与之江巧克力（杭州）动漫有限公司达成协议并
                接受所有的工作条款。 </p>
                             <p><strong>2、工作简介</strong>  之江巧克力（杭州）动漫有限公司运用自己的操作系统通过国际互联网络为用户提供网络会员工作。用户必须： </p>
                             <p>⑴提供设备，包括个人电脑一台、调制解调器一个及配备上网装置。</p>
                             <p>⑵个人上网和支付与此工作有关的电话费用。 考虑到蔡志忠工作室平台网络会员工作的重要性，用户同意： </p>
                             <p>⑴提供及时、详尽及准确的个人资料。 </p>
                             <p>⑵不断更新注册资料，符合及时、详尽准确的要求。所有原始键入的资料将引用为注册资料。 另外，用户可授权之江巧克力（杭州）动漫有限公司向第三方透露其基本资料，但之江巧克力（杭州）动漫有限公司不能公开用户的补充资料。</p>
                             <p>⑵不断更新注册资料，符合及时、详尽准确的要求。所有原始键入的资料将引用为注册资料。 另外，用户可授权之江巧克力（杭州）动漫有限公司向第三方透露其基本资料，但之江巧克力（杭州）动漫有限公司不能公开用户的补充资料。</p>
                            </div>
                        </div>
                    </div>
                </div><!--scrollbox-->
                <div class="reg1">
                  <input checked="checked" type="checkbox"  name="rem" id="rem" value="rem" />
                  <label for="rem">我已经阅读并同意《工作条款》</label>
                </div>
            </div>
            <!--reg-left-->
            <form id="afrm" action="/reg/save" method="post">
            <div class="reg-right fr">
            	<div class="reg_top">
                	<a href="javascript:void(0);" id="xt_reg1" class="reg_tel curr"><i></i>手机注册</a>
                    <!--<a href="javascript:void(0);" id="xt_reg2" class="reg_mail"><i></i>邮箱注册</a>-->
                </div>
                <ul class="reg_con">
                	<li class="reg-sort">
                        <?php foreach ($usertype as $key => $value): ?>
						  <p><input type="radio" name="usertype" value="<?php echo $key;?>" id="sort_<?php echo $key;?>"/><label for="sort_<?php echo $key;?>"><?php echo $value;?></label></p>
                        <?php endforeach;?>
                    </li>
                </ul>
                <ul class="reg_con xt_reg1_rgn">
                    <li class="reg-user">
                        <input name="mobile" placeholder="手机" type="text" class="text2" id="mobile"/>
                        <!--<input name="" type="button" class="ru_but but" value="绑定手机"/>-->
                        <span class="ok"></span><span class="no">手机不能为空</span>
                    </li>
                    <li class="reg-code"><input name="code_phone" placeholder="验证码"  type="text" class="text2"/><input type="button" id="getCode" class="code_time" value=" 获取验证码 "></li>
                    <li class="reg-pwd"><input name="password_phone" placeholder="密码" type="password" class="text2" id="password_phone"/><span class="ok"></span><span class="no">登录密码不能少于 6 个字符</span></li>
                    <li class="reg-pwd1"><input name="repassword_phone"  placeholder="确定密码" type="password" class="text2" id="repassword_phone"/><span class="ok"></span><span class="no">两次密码不相同</span></li>
                </ul>
                <ul class="reg_con xthide xt_reg2_rgn">
                    <li class="reg-email">
                        <input name="email" placeholder="邮箱" value="邮箱" type="text" class="text2" id="email"/>
                        <span class="ok"></span><span class="no">邮箱不能为空</span>
                    </li>
                    <li class="reg-pwd"><input name="password_email" placeholder="密码" value="密码" type="text" class="text2" id="pwd"/><span class="ok"></span><span class="no">登录密码不能少于 6 个字符</span></li>
                    <li class="reg-pwd1"><input name="repassword_email"  placeholder="确定密码" value="确定密码" type="text" class="text2" id="pwd1"/><span class="ok"></span><span class="no">两次密码不相同</span></li>
                </ul>
                <div class="reg_con xtmb-10"><input type="submit" class="but" value="注 册"/>&nbsp;&nbsp;<span id="J_result_info"></span></div>
                <div class="iban_bot reg_bot">
                	<span>您还可以用以下方式直接登录：</span>
                    <a class="iban_bota sina" href="#">微博</a><a class="iban_qq" href="#">QQ</a>
                </div>
            </div>
            <!--reg-right-->
            <input type="hidden" name="version" value="phone" />
            </form>
        </div>
    </div>
</div>

<?php include_once(VIEWPATH."public/footer.php");?>

<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>

<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.sly.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>sly.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.form.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.validate.js"></script>

<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/user/register.js"></script>
</body>
</html>