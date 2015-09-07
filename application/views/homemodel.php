
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通告</title>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="fl atb_fl">
    <?php if(!empty($oAct)):?>
    <div class="fl wrap">
        <h2><?=$oAct['title']?></h2>
        <p><?=date('Y-m-d H:i',$oAct['addtime'])?></p>
        <div class="newcon"><?=$oAct['summary']?></div>
        <a class="more" href="/act/detail?id=<?=$oAct['id']?>">MORE</a> 
    </div>
    <img class="fr" src="<?=_get_image_url($oAct['img2'])?>"/>
    <?php endif?>
</div>
<div class="fr atb_fr">
  <div id="adswitch" class="picBtnTop">
    <div class="hd">
        <ul>
            <?php foreach ($actlist as $key => $a):?>
            <li><i></i><p><?=$a['title']?></p></li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="bd">
        <ul>
            <?php foreach ($actlist as $key => $a):?>
            <li>
            	<a href="/act/detail?id=<?=$a['id']?>" title="<?=$a['title']?>"><img src="<?=_get_image_url($a['img2'])?>" /></a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
  </div>
</div>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>
jQuery("#adswitch").slide({ mainCell:".bd ul",effect:"top",autoPlay:true,triggerTime:0 });
</script>
</html>