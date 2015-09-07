<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>评论管理-个人中心-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="<?php echo _get_cfg_path('js')?>DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>
<div class="mainbody" id="mainbody">
    <div class="container mrgB30">
        <div class="member clearfix">
            <?php include_once(VIEWPATH."m/public/left_menu.php");?>
            <div class="fr uc_content">
              <?php include_once(VIEWPATH."m/public/notice.php");?>
                <div class="clearfix uitopg">
                    <div class="transa">
                        <div class="aut_bti clearfix"><h3>评价交易</h3></div>
                        <form action="" method="post">
                          <input type="hidden" name="orderid" value="<?=$info['orderid']?>">
                          <input type="hidden" name="commentid" value="<?=$info['commentid']?>">
                        <div class="fabiao ordapp">
                          <div class="clearfix scor_star">
                                <div class="op_rate fl">
                                    <span class="fl">身材样貌：</span>
                                    <a href="javascript:;" onclick="filt(this)" name="1">非常差<i class="one_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="2">很差<i class="two_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="3">一般<i class="three_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="4">很好<i class="four_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="5">非常好<i class="five_rate"></i></a>
                                    <input name="figure" id="figure" value="0" type="hidden">
                                </div>
                                <div class="op_rate fl">
                                    <span class="fl">专业技能：</span>
                                    <a href="javascript:;" onclick="filt(this)" name="1">非常差<i class="one_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="2">很差<i class="two_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="3">一般<i class="three_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="4">很好<i class="four_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="5">非常好<i class="five_rate"></i></a>
                                    <input name="skill" id="skill" value="0" type="hidden">
                                </div>
                                <div class="op_rate fl">
                                    <span class="fl">工作效率：</span>
                                    <a href="javascript:;" onclick="filt(this)" name="1">非常差<i class="one_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="2">很差<i class="two_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="3">一般<i class="three_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="4">很好<i class="four_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="5">非常好<i class="five_rate"></i></a>
                                    <input name="efficiency" id="efficiency" value="0" type="hidden">
                                </div>
                                <div class="op_rate fl">
                                    <span class="fl">工作态度：</span>
                                    <a href="javascript:;" onclick="filt(this)" name="1">非常差<i class="one_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="2">很差<i class="two_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="3">一般<i class="three_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="4">很好<i class="four_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="5">非常好<i class="five_rate"></i></a>
                                    <input name="attitude" id="attitude" value="0" type="hidden">
                                </div>
                            </div>
                            <textarea id="starcontent" name="memo" cols="" rows="" class="texta" placeholder="亲，你的评价很重要哦~~"></textarea>
                            <br><br>
                            <input name="" type="submit" class="but" value="提交评论">
                            <br><br>
                        </div>
                      </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
</html>