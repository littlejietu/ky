
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人主页-<?=_get_config('sitename')?></title>
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
        
    <?php include_once(VIEWPATH."i/public/top.php");?>
    <div class="personal mrgB30">
            <div class="title">基本信息</div>
            <ul class="clearfix bainfo">
            	<li><span>姓名</span> <?=$oUser['nickname']?></li>
            </ul>
            <br /><br /><br />
            <div class="title">个人说明</div>
            <div class="clearfix">
            	<div class="fl flpet">
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>个人介绍</h3>
                        <div class="p_wzi"> <?=$oUser['memo']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>工作经历</h3>
                        <div class="p_wzi"> <?=$oUser['brandtype']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>拍摄经历</h3>
                        <div class="p_wzi"> <?=$oUser['brand']?><br /></div>
                    </div>
                </div>
                <?php if($oUser['video']):?>
                <div class="fr p_video">
                    <iframe width="400px" height="260px" src="$oUser['video']" frameborder=0 allowfullscreen></iframe>
                </div>
                <?php endif?>
            </div>
            <br /><br /><br />
            <div class="title">工作说明</div>
            <div class="per_con">
                <h3 class="p_bti"><i></i>工作费用</h3>
                <div class="p_wzi"><?=$oUser['fee']?></div>
            </div>
            <div class="per_con">
                <h3 class="p_bti"><i></i>工作时间</h3>
                <div class="p_wzi"><?=$oUser['servicetime']?></div>
            </div>
            <div class="per_con">
                <h3 class="p_bti"><i></i>工作说明</h3>
                <div class="p_wzi"><?=$oUser['takenote']?></div>
            </div>
            <br /><br />
            <div class="title">精选作品</div>
            <div class="malbumdeta">
                <div class="brand-list" id="brand-waterfall">
                    <?php foreach ($oGood as $key => $a): ?>
                    <div class="item"><img src="<?=$a['img']?>" /></div>
                    <?php endforeach;?>
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
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>waterfall.js"></script>
</html>