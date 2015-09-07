<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$o['title']?>-报名列表-牛模网</title>
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
    <div class="inst_tion">
        <div class="container">
            
            <div class="signup_top">共有<span><?=($o['innum']+$o['innumfake'])?></span>人报名</div>
            <div class="signup_list">
                <ul class="clearfix">
                    <?php foreach ($list['rows'] as $key => $a): ?>
                    <li>
                        <a href="/i/index/<?=$a['userid']?>" title="<?=$a['nickname']?>"><img width="160" alt="<?=$a['nickname']?>" src="<?=_get_userlogo_url($a['userlogo'])?>"></a>
                    </li>
                    <?php endforeach;?>                  
                </ul>
            </div>
        </div>
    </div>   
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
</html>