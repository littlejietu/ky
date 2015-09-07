<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>工作价格-个人中心-牛模网</title>
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
                  <div class="fl um_uitop">
                      <div class="authent">
                        <div class="aut_bti">工作价格：</div>
                          <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tbody><tr>
                                <td width="86" valign="top"><font>工作内容：</font></td>
                                <td colspan="3" valign="top" class="price">
                                  <?php foreach ($workitem as $key => $v): ?>
                                    <span><input type="checkbox" name="item" value="<?=$key?>" id="item<?=$key?>" _text="<?=$v?>"><label for="item<?=$key?>"><?=$v?></label></span>
                                  <?php endforeach;?> 
                                </td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>工作场景：</font></td>
                                <td colspan="3" valign="top" class="price">
                                  <?php foreach ($workscene as $key => $v): ?>
                                    <span><input type="radio" name="scene" value="<?=$key?>" id="scene<?=$key?>" _text="<?=$v?>"><label for="scene<?=$key?>"><?=$v?></label></span>
                                  <?php endforeach;?>
                                </td>
                              </tr>
                              <tr>
                                <td width="86">计价方式：</td>
                                <td colspan="3" class="price">
                                  <?php foreach ($worktime as $key => $v): ?>
                                    <span><input type="radio" name="time" value="<?=$key?>" id="time<?=$key?>" _text="<?=$v?>"><label for="time<?=$key?>"><?=$v?></label></span>
                                  <?php endforeach;?> 
                                </td>
                              </tr>
                              <tr style="border-bottom:none;">
                                <td style="height:80px">&nbsp;</td>
                                <td colspan="3">
                                    <div id="alertmsg" class="main_color xtmb-10"></div>
                                    <input name="btn" id="XT-Add" type="button" class="but" value="添加">
                                    <input name="btnReset" id="XT-Reset" type="button" class="but but_reset" value="重置">
                                </td>
                              </tr>
                              <tr><td colspan="4"><?php echo validation_errors('<div class="valid_error">', '</div>');?></td></tr>
                            </tbody>
                            </table>
                            <form action="" method="post">
                            <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0">
                             <tbody> 
                              <tr style="border-bottom:none;">
                                <td colspan="4" id="priceList">
                                  <?php
                                    if(!empty($list))
                                    {
                                     foreach ($list as $key => $a): ?>
                                      <div class="itemer">
                                        <?php echo _is_empty($workitem[$a['item']]).' + '._is_empty($workscene[$a['scene']]).' + '._is_empty($worktime[$a['time']]);?>
                                        <input name="code[]" type="hidden" value="<?=$a['item'].'_'.$a['scene'].'_'.$a['time'];?>">
                                        <span class="xtright">¥ <input name="price[]" type="text" class="txt txt_price" value="<?=$a['price']?>" ></span>
                                      </div>
                                    <?php endforeach;
                                    }?>
                                </td>
                              </tr>
                              <tr style="border-bottom:none;">
                                <td width="86">&nbsp;</td>
                                <td colspan="3">
                                    <input name="btn" id="XT-Submit" type="submit" class="xthide <?php echo !empty($list)?'but':''; ?>" value="提交">
                                </td>
                              </tr>
                              <div id="priceitem" class="xthide">
                                  <div class="itemer">
                                    {{item_work}}<input name="{{_eg_}}code[]" type="hidden" value="{{item_code}}">
                                    <span class="xtright">¥ <input name="{{_eg_}}price[]" type="text" class="txt txt_price" value="0" ></span>
                                  </div>
                              </div>
                          </tbody></table>
                          </form>
                        </div>
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
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/product.js"></script>
</html>