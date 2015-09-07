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
<!--banner start -->
<div id="slideBox" class="banner">
   <div class="hd">
    <?php if(count($adlist)>1):?>
      <a class="prev" title="上一页">上一页</a>
      <a class="next" title="下一页">下一页</a>
    <?php endif?>
      <ul></ul>
   </div>
   <div class="bd">
     <ul>
        <?php foreach ($adlist as $key => $a):?>
            <li _src="url(<?=$a['img']?>)"><a href="<?=$a['url']?>" target="_blank"></a></li>
        <?php endforeach;?>
     </ul>
   </div>
</div>
<!-- banner end-->
<div class="mainbody">
    <div class="recom">
    	<ul class="clearfix">
        	<?php foreach ($rmdlist1 as $key => $a):?>
            <li>
                <a href="/i/index/<?=$a['id']?>">
                    <img alt="<?=$a['nickname']?>" src="<?=_get_userlogo_url($a['userlogo'])?>"/>
                	<p><span><?=$a['nickname']?></span></p>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="women">
        <div class="container">
        	<div class="bti clearfix"><img class="fl" alt="women" src="<?php echo _get_cfg_path('images')?>bti_1.png"/><a class="fr more" href="/model?s=2">More +</a></div>
        	<ul class="clearfix">
            	<?php foreach ($rmdlist2 as $key => $a):?>
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
        </div>
    </div>
    <div class="recom">
    	<ul class="clearfix">
        	<?php foreach ($rmdlist3 as $key => $a):?>
            <li>
                <a href="/i/index/<?=$a['id']?>">
                    <img alt="<?=$a['nickname']?>" src="<?=_get_userlogo_url($a['userlogo'])?>"/>
                    <p><span><?=$a['nickname']?></span></p>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="women">
        <div class="container">
        	<div class="bti clearfix"><img class="fl" alt="MEN" src="<?php echo _get_cfg_path('images')?>bti_2.png"/><a class="fr more" href="/model?s=1">More +</a></div>
        	<ul class="clearfix">
                <?php foreach ($rmdlist4 as $key => $a):?>
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
        </div>
    </div>
    <div class="insti">
        <div class="container">
        	<div class="bti clearfix"><img class="fl" alt="institutions" src="<?php echo _get_cfg_path('images')?>bti_3.png"/><a class="fr more" href="/ins">More +</a></div>
        	<div class="our_insti">
            	<ul class="clearfix">
                    <?php foreach ($rmdlist5 as $key => $a): ?>
                    <li>
                        <a href="/i/index/<?=$a['id']?>" title="<?=$a['company']?>"><img src="<?=$a['showimg'];?>"/></a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="advert">
        <div class="container">
          <div class="slideTxtBox advert_stb">
                <div class="hd">
                    <ul><?php foreach ($oSysAct as $k => $v):?>
                           <li value="/home/model?type=<?=$k?>"><?=$v?></li>
                        <?php endforeach;?></ul>

                </div>
                <div class="bd">
                    <ul style="display: block;">
                        <li class="recom_te ne_con">
                            <ul class="clearfix">
                                <?php foreach ($actlist1 as $key => $a): ?>
                                <li>
                                    <a class="picimg" href="javascript:void(0);">
                                        <img src="<?=$a['img'];?>"/>
                                        <div class="notl_hover">
                                            <p>工作时间： <?=date('Y-m-d',$a['begtime'])?>       工作地点： <?=$a['place']?>     <?php if($a['actnum']):?>名额： <?=$a['actnum']?>名<?php endif?>   人数： <?=($a['innum']+$a['innumfake']);?>名</p>
                                            <p>面试地点： <?=$a['address']?> </p>
                                            <p>工作内容： <?=$a['summary']?> </p>
                                            <p><?php if($a['workfee']):?>工作费用： <?=$a['workfee']?><?php endif;?>      报名截止： <?=date('Y-m-d',$a['endtime'])?></p>
                                        </div>
                                    </a>
                                    <div class="clearfix">
                                        <p class="fl nebti"><?=$a['title'];?> <a href="/act/enterlist?aid=<?=$a['id']?>"><em><?=($a['innum']+$a['innumfake']);?>人 报名</em></a></p>
                                        <?php if($a['inendtime']>=time()):?>
                                            <a class="fr status XT-enter" _val="<?=_get_key_val($a['id']);?>" title="<?=$a['title'];?>" href="javascript:;">报名</a>
                                        <?php else:?>
                                            <span class="fr status">已结束</span>
                                        <?php endif?>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                    </ul>
                    <ul style="display: none;">
                        <li class="recom_te ne_con">
                            <ul class="clearfix">
                                <?php foreach ($actlist2 as $key => $a): ?>
                                <li>
                                    <a class="picimg" href="javascript:void(0);">
                                        <img src="<?=$a['img'];?>"/>
                                        <div class="notl_hover">
                                            <p>工作时间： <?=date('Y-m-d',$a['begtime'])?>       工作地点： <?=$a['place']?>    <?php if($a['actnum']):?>名额： <?=$a['actnum']?>名<?php endif?>    人数： <?=($a['innum']+$a['innumfake']);?>名</p>
                                            <p>面试地点： <?=$a['address']?> </p>
                                            <p>工作内容： <?=$a['summary']?> </p>
                                            <p><?php if($a['workfee']):?>工作费用： <?=$a['workfee']?><?php endif;?>       报名截止： <?=date('Y-m-d',$a['endtime'])?></p>
                                        </div>
                                    </a>
                                    <div class="clearfix">
                                        <p class="fl nebti"><?=$a['title'];?> <a href="/act/enterlist?aid=<?=$a['id']?>"><em><?=($a['innum']+$a['innumfake']);?>人 报名</em></a></p>
                                        <?php if($a['inendtime']>=time()):?>
                                            <a class="fr status XT-enter" _val="<?=_get_key_val($a['id']);?>" title="<?=$a['title'];?>" href="javascript:;">报名</a>
                                        <?php else:?>
                                            <span class="fr status">已结束</span>
                                        <?php endif?>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                    </ul>
                    <ul style="display: none;">
                        <li class="recom_te ne_con">
                            <ul class="clearfix">
                                <?php foreach ($actlist3 as $key => $a): ?>
                                <li>
                                    <a class="picimg" href="javascript:void(0);">
                                        <img src="<?=$a['img'];?>"/>
                                        <div class="notl_hover">
                                            <p>工作时间： <?=date('Y-m-d',$a['begtime'])?>       工作地点： <?=$a['place']?>    <?php if($a['actnum']):?>名额： <?=$a['actnum']?>名<?php endif?>    人数： <?=($a['innum']+$a['innumfake']);?>名</p>
                                            <p>面试地点： <?=$a['address']?> </p>
                                            <p>工作内容： <?=$a['summary']?> </p>
                                            <p><?php if($a['workfee']):?>工作费用： <?=$a['workfee']?><?php endif;?>       报名截止： <?=date('Y-m-d',$a['endtime'])?></p>
                                        </div>
                                    </a>
                                    <div class="clearfix">
                                        <p class="fl nebti"><?=$a['title'];?> <a href="/act/enterlist?aid=<?=$a['id']?>"><em><?=($a['innum']+$a['innumfake']);?>人 报名</em></a></p>
                                        <?php if($a['inendtime']>=time()):?>
                                            <a class="fr status XT-enter" _val="<?=_get_key_val($a['id']);?>" title="<?=$a['title'];?>" href="javascript:;">报名</a>
                                        <?php else:?>
                                            <span class="fr status">已结束</span>
                                        <?php endif?>
                                    </div>
                                </li>
                                <?php endforeach;?>             
                            </ul>
                        </li>
                    </ul>
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
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
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
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/act.js"></script>
<script type="text/javascript">
/* banner */
$(document).ready(function(){
	$(".banner").slide({
		titCell: ".hd ul",
		mainCell: ".bd ul",
		effect: "fold",
		autoPlay: true,
		autoPage: true,
		trigger: "click",
		startFun: function(i) {
			var curLi = jQuery(".banner .bd li").eq(i);
			if ( !! curLi.attr("_src")) {
				curLi.css("background-image", curLi.attr("_src")).removeAttr("_src")
			}
		}
	});
});

/* 外层tab切换 */
jQuery(".slideTxtBox").slide({
		startFun: function(i) {
			var curLi = jQuery(".slideTxtBox .hd li").eq(i).attr('value');
			jQuery(".slideTxtBox .bd ul").eq(i).find('iframe').attr('src',curLi);
		}
});
</script>
</html>