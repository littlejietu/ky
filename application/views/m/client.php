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
                        <div class="aut_bti clearfix">
                          <h3 class="fl">客户管理</h3>
              <a class="fr addto TX-win-open" href="javascript:;"><i></i>添加客户</a>
                        </div>
                        <table class="tran_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <th width="250">联系人</th>
                              <th width="110">联系方式</th>
							  <th>备注</th>
                              <th width="120">操作</th>
                            </tr>
                            <?php foreach ($list['rows'] as $key => $a): ?>
                            <tr>
                              <td><?php echo $a['linkman'];?></td>
                              <td><?php echo $a['contact'];?></td>
							  <td><?=$a['memo']?></td>
                              <td class="operat">
                                <a href="javascript:;" class="t_delete XT-del" _val="<?=_get_key_val($a['id'])?>"><i></i>删除</a>
                                <a href="javascript:;" class="t_editor XT-modify" _val="<?=_get_key_val($a['id'])?>"><i></i>编辑</a>
                              </td>
                            </tr>
                            <?php endforeach;?>
                           
                        </table>
                        <table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
                        <tr>
                                <td colspan="2" height="32" align="right">
                                    <div class="page">
                                      <?=$list['pages']?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
<div class="popover-mask"></div>
<div class="popover complaint addcust">
  <div class="compl_top"><span class="fl">添加客户</span><input type="hidden" name="clientid" id="clientid" value=""><a href="javascript:;" title="关闭" class="close fr TX-win-close">×</a></div>
  <div class="compl_con">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="80"><font>联 系 人：</font></td>
              <td><input name="linkman" id="linkman" type="text" class="txt"/></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td width="80"><font>联系方式：</font></td>
              <td><input name="contact" id="contact" type="text" class="txt"/></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td valign="top"><font>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</font></td>
              <td><textarea class="txt text" name="memo" id="memo" cols="" rows=""></textarea></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td>&nbsp;</td>
               <td><input class="but" id="TX-create" name="" type="button" value="保存"/></td>
            </tr>
        </table>
    </div>
</div>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/client.js"></script>
</html>