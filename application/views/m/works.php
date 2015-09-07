<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>作品管理-个人中心-牛模网</title>
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
                        <div class="aut_bti clearfix"><h3 class="fl">作品管理</h3><span class="fr">可自主上传作品，相册</span></div>
                        <div class="works malbums mworks">
                          <div class="aut_bti mw_upload clearfix">
                              <a class="fl addto ato_1" href="/m/works/photo<?php if($this->input->get('agid')) echo '?agid='.$this->input->get('agid');?>"><i></i>上传照片</a>
                                <a class="fl addto" id="TX-create-album" href="javascript:;"><i></i>创建相册</a>
                            </div>
                            <ul class="clearfix">
                                <?php foreach ($list['rows'] as $key => $a): ?>
                                <li>
                                    <a href="javascript:;">
                                        <img src="<?=$a['showimg']?>">
                                        <div class="mwk_hover">
                                          <?php if($a['kind']<>1):?>
                                          <p>
                                              <span class="mh_1 XT-album" _val="<?=_get_key_val($a['id'])?>"></span>
                                              <span class="mh_2 XT-del-album" _val="<?=_get_key_val($a['id'])?>"></span>
                                          </p>
                                          <?php endif?>
                                        </div>
                                        <div class="wor_wzi">
                                            <h3><span id="X-tit-<?=_get_key_val($a['id'])?>"><?=$a['title']?></span><span>（<?=$a['photonum']?>张）</span></h3>
                                            <p>创建时间：<?=date('Y-m-d H:i:s',$a['addtime'])?></p>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach;?>
                              </ul>
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

<div class="popover-mask"></div>
<div class="popover complaint">
  <div class="compl_top"><span class="fl" id="X-title">创建相册</span><input type="hidden" name="albumid" id="albumid" value=""><input type="hidden" name="agid" id="agid" value="<?=$this->input->get('agid')?>"><a href="javascript:;" id="TX-win-close" title="关闭" class="close fr">×</a></div>
  <div class="compl_con">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="80"><font>相册名称：</font></td>
              <td><input style="width:300px" id="title" class="txt" name="title" type="text" placeholder="请输入相册名称"/></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td valign="top"><font>相册描述：</font></td>
              <td><textarea class="txt text" id="memo" name="memo" cols="" rows="" placeholder="请添加相册描述"></textarea></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td>&nbsp;</td>
               <td><input class="but" name="" id="TX-create" type="button" value="保存"/><span id="T-msg"></span></td>
            </tr>
        </table>
    </div>
</div>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/works.js"></script>
</html>