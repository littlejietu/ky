
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if($oUser['usertype']==1):?>个人主页<?php else:?>机构主页<?php endif?>-牛模网</title>
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
	<div class="introd container">
        
    <?php
      if( in_array($oUser['usertype'], array(1,4,5)) )
        include_once(VIEWPATH."i/public/top.php");
      if($oUser['usertype']==2)
        include_once(VIEWPATH."i/public/top_ins.php");?>
        <div class="appraisal mrgB30">
            <ul>
                <?php $i=0;
                 foreach ($list['rows'] as $key => $a): 
                  $i++;?>
                <li class="clearfix estim">
                   <div class="fl em_lef"><h3><?=$i + ($list['page']-1)*$list['pagesize']?></h3><h4><?=$a['nickname'];?></h4><span><?php echo date('Y-m-d H:i:s',$a['addtime']);?></span></div>
                   <div class="fr em_rit">
                       <div class="apprtop">
                           <div class="fl a_rev"><span>身材样貌：</span><p class="star_on"><i class="star_<?=$a['figure'];?>">5</i></p></div>
                           <div class="fl a_rev"><span>专业技能：</span><p class="star_on"><i class="star_<?=$a['skill'];?>">5</i></p></div>
                           <div class="fl a_rev"><span>工作效率：</span><p class="star_on"><i class="star_<?=$a['efficiency'];?>">5</i></p></div>
                           <div class="fl a_rev"><span>工作态度：</span><p class="star_on"><i class="star_<?=$a['attitude'];?>">5</i></p></div>
                       </div>
                       <div class="apprcon"><?=$a['memo'];?></div>
                   </div>
                </li>
                <?php endforeach;?>
            </ul>
            <br>
            <div class="page">
              <?=$list['pages']?>
            </div>
            <div class="fabiao" style="display:none">
                <input type="hidden" name="act" value="online">
                <div class="xzw_starSys clearfix">
                    <h3 class="fl" style="width:80px">发表评论</h3>
                    <div id="xzw_starBox">
                      <ul class="star" id="star">
                          <li><a href="javascript:void(0)" title="1" class="one-star">1</a></li>
                          <li><a href="javascript:void(0)" title="2" class="two-stars">2</a></li>
                          <li><a href="javascript:void(0)" title="3" class="three-stars">3</a></li>
                          <li><a href="javascript:void(0)" title="4" class="four-stars">4</a></li>
                          <li><a href="javascript:void(0)" title="5" class="five-stars">5</a></li>
                      </ul>
                      <div class="current-rating" id="showb"></div>
                      <input class="szhi" id="szhi" name="title" value="" type="hidden">
                    </div>
                    <div class="description"></div>
                </div>
                <input type="hidden" name="name" value="">
                <textarea id="starcontent" name="content" cols="" rows="" class="texta"></textarea>
                <br><br>
                <input name="" type="submit" class="but" value="提交评论">
                <br><br>
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
</html>