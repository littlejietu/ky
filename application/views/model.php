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
	<div class="container">
        <div class="mode_title clearfix">
            <a class="fl picimg" href="<?=_create_url('model', array_merge($arrParam, array('sex'=>1)) )?>"><img src="<?=_get_cfg_path('images')?>models_1.jpg"/></a>
            <a class="fr picimg" href="<?=_create_url('model', array_merge($arrParam, array('sex'=>2)) )?>"><img src="<?=_get_cfg_path('images')?>models_2.jpg"/></a>
        </div>
        <div class="m_sort">
        	<ul class="clearfix" style="width:100%">
            	<li style="width:48.5%"><a href="<?=_create_url('model', array_merge($arrParam, array('area'=>1)) )?>">亚洲模特</a></li>
                <li style="width:48.5%;float:right;margin-right:0;"><a href="<?=_create_url('model', array_merge($arrParam, array('area'=>2)) )?>">欧美模特</a></li>
                <!--<li><a href="##">平面模特</a></li>
                <li><a href="##">T台模特</a></li>
                <li><a href="##">影视模特</a></li>
                <li><a href="##">新人模特</a></li>
                <li><a href="##">活动模特</a></li>-->
            </ul>
        </div>
        <div class="m_filter">
        	<div class="filterBox" style="display:<?php if(!empty($arrParam)) echo 'block';else echo 'none';?>">
                <!--<div class="values"><span class="label">类型：</span>
                    <p class="clearfix"><a href="##" class="curr" title="不限">不限</a><a href="##" title="韩系名媛">韩系名媛</a><a href="##" title="气场欧美">气场欧美</a><a href="##" title="优雅复古">优雅复古</a><a href="##" title="清新文艺">清新文艺</a><a href="##" title="英伦学院">英伦学院</a><a href="##" title="甜美日系">甜美日系</a><a href="##" title="OL通勤">OL通勤</a><a href="##" title="接头混搭">接头混搭</a><a href="##" title="性感诱惑">性感诱惑</a></p>
                </div>-->
                <div class="values"><span class="label">风格：</span>
                <p class="clearfix">
                    <a <?php if(empty($arrParam['style'])):?> class="curr"<?php endif?> href="<?php if(!empty($arrParam['style'])){$tmp_arrParam = $arrParam; unset($tmp_arrParam['style']); echo _create_url('model', $tmp_arrParam );}?>" title="不限">不限</a>
                    <?php foreach ($oSysModelstyle as $key => $v):?>
                        <a href="<?=_create_url('model', array_merge($arrParam, array('style'=>$key)) )?>" title="<?=$v?>"<?php if(!empty($arrParam['style']) && $arrParam['style']==$key) echo ' class="curr"';?>><?=$v?></a>
                    <?php endforeach;?>
                </p>
            </div>
            <!--
                <div class="values"><span class="label">地区：</span>
                    <p class="clearfix"><a href="##" class="curr" title="不限">不限</a><a href="##" title="160-170cm ">160-170cm</a><a href="##" title="170-180cm">170-180cm</a><a href="##" title="＞180cm">＞180cm</a></p>
                </div>-->
                <div class="values"><span class="label">身高：</span>
                    <p class="clearfix"><a <?php if(empty($arrParam['height'])):?> class="curr"<?php endif?> href="<?php if(!empty($arrParam['style'])){$tmp_arrParam = $arrParam; unset($tmp_arrParam['height']); echo _create_url('model', $tmp_arrParam );}?>" title="不限">不限</a>
                        <a href="<?=_create_url('model', array_merge($arrParam, array('height'=>'160-170')) )?>" title="160-170cm" <?php if(!empty($arrParam['height']) && $arrParam['height']=='160-170') echo ' class="curr"';?>>160-170cm</a>
                        <a href="<?=_create_url('model', array_merge($arrParam, array('height'=>'170-180')) )?>" title="170-180cm" <?php if(!empty($arrParam['height']) && $arrParam['height']=='170-180') echo ' class="curr"';?>>170-180cm</a>
                        <a href="<?=_create_url('model', array_merge($arrParam, array('height'=>'180')) )?>" title="＞180cm" <?php if(!empty($arrParam['height']) && $arrParam['height']=='180') echo ' class="curr"';?>>＞180cm</a></p>
                </div>
                <div class="values"><span class="label">排序：</span>
                    <p class="clearfix">
                        <a href="<?=_create_url('model', array_merge($arrParam, array('orderby'=>'1')) )?>" <?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='1') echo ' class="curr"';?>>按时间</a>
                        <a href="<?=_create_url('model', array_merge($arrParam, array('orderby'=>'2')) )?>" <?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='2') echo ' class="curr"';?>>按关注度</a>
                        <a href="<?=_create_url('model', array_merge($arrParam, array('orderby'=>'3')) )?>" <?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='3') echo ' class="curr"';?>>订单量</a></p>
                </div>
            </div>
            <div class="control_bar">
            	<a class="button_less <?php if(!empty($arrParam)) echo 'spred';?>" href="javascript:void(0);">更多选项<span class="ifont"></span></a>
            </div>
        </div>
    </div>
    <div class="women models">
        <div class="container">
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