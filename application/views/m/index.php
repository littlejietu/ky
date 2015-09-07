<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人中心-牛模网</title>
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
                  <div class="fl um_uitop">
                      <div class="brotop clearfix">
                          <div class="fl broad"><p class="b_pti">今日订单播报</p><span class="b_num"><em><?=$o['be_ordernum_t']?></em> <a href="/m/fund">查看</a></span></div>
                            <div class="fl broad b_gain"><p class="b_pti">本月收益总额</p><span class="b_num"><em><?=$o['be_fund_m']?></em></span></div>
                            <div class="fr beye"><a href="/m/order">更多</a></div>
                        </div>
                        <?php foreach ($adlist as $key => $a):?>
                        <div class="umbcon"><a href="<?=$a['url']?>" target="_blank"><img src="<?=_get_image_url($a['img'])?>"></a></div>
                        <?php endforeach;?>
                    </div>
                    <div class="fr um_wind">
                      <?php include_once(VIEWPATH."m/public/right.php");?>
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
<script type="text/javascript" src="<?=_get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?=_get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?=_get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>

</html>