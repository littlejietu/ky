
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$oUser['nickname']?>-机构主页-牛模网</title>
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
	<div class="introd container">
        
    <?php
      if($oUser['usertype']==1)
        include_once(VIEWPATH."i/public/top.php");
      if($oUser['usertype']==2)
        include_once(VIEWPATH."i/public/top_ins.php");?>

        <div class="clearfix">
            <div class="fl wsti">
                <ul>
                    <li<?php if(!$arrParam['t'] || $arrParam['t']==1) echo ' class="cur"';?>><a href="?t=1">模特</a></li>
                    <li<?php if($arrParam['t']==4) echo ' class="cur"';?>><a href="?t=4">摄影师</a></li>
                    <li<?php if($arrParam['t']==5) echo ' class="cur"';?>><a href="?t=5">化妆师</a></li>
                </ul>
            </div>
            <div class="women artiste fr">
                <ul class="clearfix">
                    <?php foreach ($list['rows'] as $key => $a):?>
                    <li>
                        <a href="/i/model/info/<?=$a['id']?>" title="<?=$a['nickname']?>">
                            <div class="mtimg">
                                <img class="show" alt="<?=$a['nickname']?>" originalsrc="<?=_get_userlogo_url($a['showimg'])?>"/>
                                <img class="hide" alt="<?=$a['nickname']?>" originalsrc="<?=_get_userlogo_url($a['showimg2'])?>"/>
                            </div>
                            <span class="womzi"><?=$a['nickname']?></span>
                        </a>
                    </li>
                    <?php endforeach;?>
                </ul>

                <div class="page">
                  <?=$list['pages']?>
                </div>
            </div>
        </div>


    </div>
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>main.js"></script>
<style>.artiste{width:1020px;background:#fff;min-height:500px;padding:15px;width:1030px;margin:0 0 30px;}.artiste li{margin:0 14px 14px 0}</style>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>lyz.delayLoading.min.js"></script>
<script type="text/javascript">
$(function () {
    $("img").delayLoading({
        defaultImg: "<?php echo _get_cfg_path('images')?>loading.jpg",   // 预加载前显示的图片
        errorImg: "",                       // 读取图片错误时替换图片(默认：与defaultImg一样)
        imgSrcAttr: "originalSrc",          // 记录图片路径的属性(默认：originalSrc，页面img的src属性也要替换为originalSrc)
        beforehand: 0,                      // 预先提前多少像素加载图片(默认：0)
        event: "scroll",                    // 触发加载图片事件(默认：scroll)
        duration: "normal",                 // 三种预定淡出(入)速度之一的字符串("slow", "normal", or "fast")或表示动画时长的毫秒数值(如：1000),默认:"normal"
        container: window,                  // 对象加载的位置容器(默认：window)
        success: function (imgObj) {},      // 加载图片成功后的回调函数(默认：不执行任何操作)
        error: function (imgObj) {}         // 加载图片失败后的回调函数(默认：不执行任何操作)
    });
});
</script>
</html>