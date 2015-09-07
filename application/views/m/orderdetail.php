<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>客户管理-个人中心-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
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
                        <div class="aut_bti">我的订单</div>
                        <div class="clearfix order_top">
                          <p class="fl">订单编号：<?=$o['no']?></p>
                            <p class="fr">下单时间： <?=date('Y-m-d H:i:s',$o['addtime'])?></p>
                        </div>
                        <div class="order_con">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td width="100">拍摄内容：</td>
                                  <td class="cont"><?=!empty($o['item'])?$oSysItem[$o['item']]:'';?></td>
                                </tr>
                                <tr>
                                  <td>拍摄场景：</td>
                                  <td class="cont"><?=!empty($o['scene'])?$oSysScene[$o['scene']]:'';?></td>
                                </tr>
                                <tr>
                                  <td>计价方式：</td>
                                  <td class="cont"><?=!empty($o['time'])?$oSysTime[$o['time']]:'';?></td>
                                </tr>
                                <tr>
                                  <td>总  价：</td>
                                  <td class="cont">¥ <?=$o['totalprice']?></td>
                                </tr>
                                <tr>
                                  <td>备  注：</td>
                                  <td class="cont"><?=!empty($o['memo'])?$o['memo']:'';?></td>
                                </tr>
                                <tr>
                                  <td>期望拍片日期：</td>
                                  <td class="cont"><?=!empty($o['begtime'])&&!empty($o['endtime']) ? (date('Y-m-d', $o['begtime']).' 至 '.date('Y-m-d', $o['endtime']) ): '';?></td>
                                </tr>
                                <tr>
                                  <td>联  系 人：</td>
                                  <td class="cont"><?=!empty($o['linkman'])?$o['linkman']:''?></td>
                                </tr>
                                <tr>
                                  <td>联系方式：</td>
                                  <td class="cont"><?=!empty($o['linkway'])?$o['linkway']:''?></td>
                                </tr>
                            </tbody></table>
                            <div class="back"><a onclick="javascript:history.back(-1);" href="javascript:;" title="返回">返回</a></div>
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
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.validate.min.js"></script>
</html>