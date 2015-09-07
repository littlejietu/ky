<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>模特-牛模网</title>
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
    <div class="women models">
        <div class="container">
            <div class="search_bti">
                <h2>搜索结果</h2>
                <div class="search_enter">
                <form method="post" action=""><input name="keyword" type="text" onblur="if (this.value ==''){this.value='输入关键字'}" onfocus="if (this.value =='输入关键字'){this.value =''}" value="输入关键字" placeholder="输入关键字" name=""><input class="search1" type="submit" value="搜索" name="">
                </form>
                </div>
            </div>

        	<ul class="clearfix">
                <?php foreach ($list['rows'] as $key => $a):?>
            	<li>
                    <a href="/i/index/<?=$a['id']?>" target="_blank" title="<?=$a['nickname']?>">
                        <div class="mtimg">
                            <img class="show" alt="<?=$a['nickname']?>" originalsrc="<?=$a['showimg']?>"/>
                            <img class="hide" alt="<?=$a['nickname']?>" originalsrc="<?=$a['showimg2']?>"/>
                        </div>
                        <span class="womzi"><?=$a['nickname']?></span>
                    </a>
                </li>
                <?php endforeach;?>                            	
            </ul>
            <br /><br />
            <div class="page">
              <?=$list['pages']?>
            </div>
            <br /><br />
        </div>
    </div>    
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
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