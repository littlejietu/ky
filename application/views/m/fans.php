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
                        <div class="aut_bti">互动总览</div>
                        <div class="brotop inter_top">
                          <div class="fl broad"><span class="b_num"><em><?=$oUsernum['concernnum']?></em> <a href="/m/fans">关注</a></span></div>
                            <div class="fl broad"><span class="b_num"><em><?=$oUsernum['fansnum']?></em> <a href="/m/fans?havefans=1">粉丝</a></span></div>
                            <div class="fl broad b_gain"><span class="b_num"><em><?=$oUsernum['be_ordernum']?></em> <a href="/m/order">拍片次数</a></span></div>
                        </div>
                        <div class="inter_con">
                          <div class="clearfix">
                              <h3 class="fl ic_bti"><?php if(!empty($arrParam['havefans']) && $arrParam['havefans']==1) echo "我的粉丝"; else echo "我的关注";?></h3>
                              <div class="search fr">
                        <form><input type="text" onblur="if (this.value ==''){this.value='输入关键字'}" onfocus="if (this.value =='输入关键字'){this.value =''}" value="<?php if(!empty($arrParam['keyword'])) echo $arrParam['keyword']; else echo "输入关键字";?>" name="keyword">
                            <input type="hidden" name="havefans" value="<?php if(!empty($arrParam['havefans'])) echo $arrParam['havefans']?>">
                            <input class="search1" type="submit" value="" name=""></form>
                                </div>
                            </div>
                            <div class="inter_li">
                              <ul class="clearfix">
                                <?php foreach ($list['rows'] as $key => $a): ?>
                                  
                                  <li>
                                      
                                      <div class="intimg fl"><a href="/i/index/<?=$a['userid']?>" target="_blank"><img src="<?=_get_userlogo_url($a['userlogo']);?>"></a></div>
                                        <div class="imtcon fr">
                                          <h3><span><?=$a['nickname'];?></span><em>√已关注</em></h3>
                                           
                                            <p>通过 <a href="/">平台找人</a> 关注</p>
                                        </div>
                                  </li>
                                <?php endforeach;?>                                  
                              </ul>
                            </div>
                        </div>
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