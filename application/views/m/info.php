<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>资料-个人中心-牛模网</title>
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
                    <form method="post" action="" id="xtform">
                   	  <div class="authent">
                   	    <div class="aut_bti">个人资料</div>
                          <?php echo validation_errors('<div class="error">', '</div>');?>
                          <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0">
                           	  <tr>
                               	  <td><a href="javascript:;" id="XT-info-base">基本信息</a>&nbsp;&nbsp;<a href="javascript:;" id="XT-info-pic">图片设置</a></td>
                              </tr>
                          </table>
                          <?php
                          if($o['usertype']==1)
                            include_once(VIEWPATH."m/public/info_model_inc.php");
                          else if(in_array($o['usertype'], array(4,5)) )
                            include_once(VIEWPATH."m/public/info_photo_inc.php");
                          ?>
                            <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0" id="tb-XT-info-pic" style="display:none">
                              <tr>
                                <tr>
                                <td width="86">形象照片</td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：248×324像数</p>
                                        <input type="hidden"  name="showimg" id="showimg" value="<?=$o['showimg']?>">
                                        <em><i class="icoPro16"></i>请上传黑白照片, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="showimg_upload" name="showimg_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div><br>
                                    <div id="show_showimg">
                                        <?php if($o['showimg']):?>
                                          <a href="<?='/'.$o['showimg']?>" target="_blank">查看</a>
                                        <?php endif?>
                                    </div>
                                    
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：248×324像数</p>
                                        <input type="hidden"  name="showimg2" id="showimg2" value="<?=$o['showimg2']?>">
                                        <em><i class="icoPro16"></i>请上传彩色照片, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="showimg2_upload" name="showimg2_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                    <div id="show_showimg2">
                                        <?php if($o['showimg2']):?>
                                          <a href="<?='/'.$o['showimg2']?>" target="_blank">查看</a>
                                        <?php endif?>
                                    </div>
                                </td>
                              </tr>
                              <?php if($o['usertype']==1):?>
                               <tr>
                                <td width="86">模特卡</td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：1070×500像数</p>
                                        <input type="hidden"  name="card" id="card" value="<?=$o['card']?>">
                                        <em><i class="icoPro16"></i>在个人主页上显示, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="card_upload" name="card_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                    <div id="show_card">
                                        <?php if($o['card']):?>
                                          <a href="<?='/'.$o['card']?>" target="_blank">查看</a>
                                        <?php endif?>
                                    </div>
                                </td>
                              </tr>
                              <?php endif?>
                              <?php if($o['status']==1):?>
                              <tr>
                                <td width="86">主页背景图</td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：1100×430像数</p>
                                        <input type="hidden"  name="bgimg" id="bgimg" value="<?=$o['bgimg']?>">
                                        <em><i class="icoPro16"></i>在个人主页上显示, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="bgimg_upload" name="bgimg_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                    <div id="show_bgimg">
                                        <?php if($o['bgimg']):?>
                                          <a href="<?='/'.$o['bgimg']?>" target="_blank">查看</a>
                                        <?php endif?>
                                    </div>
                                </td>
                              </tr>
                              <?php endif?>
                              <?php if($o['usertype']==1):?>
                              <tr>
                                <td width="86">视频</td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <input type="hidden"  name="video" id="video" value="<?=$o['video']?>">
                                        <em><i class="icoPro16"></i>在个人主页上显示, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="video_upload" name="video_upload" value="选择视频" class="inp_file" type="file">
                                        </div>
                                    </div>
                                    <div id="show_video">
                                        <?php if($o['video']):?>
                                          <a href="<?='/'.$o['video']?>" target="_blank">下载查看</a>
                                        <?php endif?>
                                    </div>
                                </td>
                              </tr>
                              <?php endif?>
                          </table>
                          <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0" id="tb-XT-info-pic">
                          <tr style="border-bottom:none;">
                                <td style="height:80px">&nbsp;</td>
                                <td colspan="3">
                                    <input name="submit" type="submit" class="but" value="保存"/>
                                    <input name="" type="button" class="but but_reset" value="重置"/>
                                </td>
                              </tr>
                          </table>
                        </div>
                      </form>
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

<?php if($o['usertype']==1):?>
<div class="popover-mask"></div>
<div class="popover">
  <div class="compl_top"><span class="fl">详细个人尺寸数据</span><a href="javascript:;" title="关闭" class="close fr TX-win-close">×</a></div>
  <div class="popbod pp_mtzl">
      <div class="fl pobimg"><img src="<?php echo _get_cfg_path('images')?>mt_zl.png" style="height:380px;"/></div>
        <div class="fr poptab">
          <form action="/m/info/setbody" method="post">
            <input type="hidden" name="id" value="<?=_get_key_val($o['id']);?>">
            <input type="hidden" name="t" value="<?=$o['usertype'];?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="95"><font>身高(A)：</font></td>
                    <td width="150"><input name="bd_height" type="text" class="txt" placeholder="Height (A)" value="<?=$o['height']?>"/></td>
                    <td width="95"><font>胸围(B)：</font></td>
                    <td><input name="bd_bust" type="text" class="txt" placeholder="Bust / Chest (B)" value="<?=$o['bust']?>"/></td>
                </tr>
                <tr>
                    <td><font>腰围(C)：</font></td>
                    <td><input name="bd_waist" type="text" class="txt" placeholder="Waist (C)" value="<?=$o['waist']?>"/></td>
                    <td><font>臂围：</font></td>
                    <td><input name="bd_hipd" type="text" class="txt" placeholder="" value="<?=$oBody['hipd']?>"/></td>
                </tr>
                <tr>
                    <td><font>领围(F)：</font></td>
                    <td><input name="bd_collarf" type="text" class="txt" placeholder="Collar (F)" value="<?=!empty($oBody['collarf'])?$oBody['collarf']:'';?>"/></td>
                    <td><font>肩宽(G)：</font></td>
                    <td><input name="bd_shoulderg" type="text" class="txt" placeholder="Shoulder(G)" value="<?=!empty($oBody['shoulderg'])?$oBody['shoulderg']:'';?>"/></td>
                </tr>
                <tr>
                    <td><font>臂长(H)：</font></td>
                    <td><input name="bd_sleeveh" type="text" class="txt" placeholder="Sleeve Length(H)" value="<?=!empty($oBody['sleeveh'])?$oBody['sleeveh']:'';?>"/></td>
                    <td><font>外侧裤长：</font></td>
                    <td><input name="bd_outseam" type="text" class="txt" placeholder="Outseam (I)" value="<?=!empty($oBody['outseam'])?$oBody['outseam']:'';?>"/></td>
                </tr>
                <tr>
                    <td><font>内侧裤长：</font></td>
                    <td><input name="bd_inseamj" type="text" class="txt" placeholder="Inseam (J)" value="<?=!empty($oBody['inseamj'])?$oBody['inseamj']:'';?>"/></td>
                    <td><font>头围(K)：</font></td>
                    <td><input name="bd_hatk" type="text" class="txt" placeholder="Hat Size (K)" value="<?=!empty($oBody['hatk'])?$oBody['hatk']:'';?>"/></td>
                </tr>
                <tr>
                    <td><font>腕围(L)：</font></td>
                    <td><input name="bd_wristl" type="text" class="txt" placeholder="Wrist (L)" value="<?=!empty($oBody['wristl'])?$oBody['wristl']:'';?>"/></td>
                    <td><font>大腿围(M)：</font></td>
                    <td><input name="bd_thighm" type="text" class="txt" placeholder="Thigh (M)" value="<?=!empty($oBody['thighm'])?$oBody['thighm']:'';?>"/></td>
                </tr>
                <tr>
                    <td><font>小腿围(N)：</font></td>
                    <td><input name="bd_calfn" type="text" class="txt" placeholder="Calf (N)" value="<?=!empty($oBody['calfn'])?$oBody['calfn']:'';?>"/></td>
                    <td><font>鞋码：</font></td>
                    <td><input name="bd_shoes" type="text" class="txt" placeholder="Shoes" value="<?=$o['shoes']?>"/></td>
                </tr>
                <tr>
                    <td><font>头发：</font></td>
                    <td><input name="bd_hair" type="text" class="txt" placeholder="Hair Color" value="<?=!empty($oBody['hair'])?$oBody['hair']:'';?>"/></td>
                    <td><font>眼睛：</font></td>
                    <td><input name="bd_eye" type="text" class="txt" placeholder="Eye Color" value="<?=!empty($oBody['eye'])?$oBody['eye']:'';?>"/></td>
                </tr>
                <tr><td height="20"></td></tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="3"><input class="but" name="" type="submit" value="保存"/></td>
                </tr>
            </table>
          </form>
        </div>
    </div>
</div>
<?php endif?>


</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('lib')?>data/area.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('lib')?>data/multiselect.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/info.js"></script>

<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript">


<?php $timestamp = $this->timestamp;?>
$(function() {
  setTimeout(function(){
    $('#userlogo_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : "<?php echo md5($this->config->item('encryption_key') . $timestamp );?>",
        'type' : 'userlogo',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择照片',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi' : false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#userlogo').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#userlogo').val(imgpath);
          $('#userlogo').nextAll('em').html('<i class="icoCor16"></i>');
          $('#show_userlogo').attr('src','/'+imgpath);
        }
      }

    });
    $('#showimg_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'showimg',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择照片',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi' : false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#showimg').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#showimg').val(imgpath);
          $('#showimg').nextAll('em').html('<i class="icoCor16"></i>');
          //$('#show_showimg').html('<a href="/'+imgpath+'" target="_blank">查看</a>');
          $('#show_showimg').html('保存后可查看');
        }
      }

    });
    $('#showimg2_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'showimg',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择照片',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi' : false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#showimg2').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#showimg2').val(imgpath);
          $('#showimg2').nextAll('em').html('<i class="icoCor16"></i>');
          //$('#show_showimg2').html('<a href="/'+imgpath+'" target="_blank">查看</a>');
          $('#show_showimg2').html('保存后可查看');
        }
      }

    });
    $('#card_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'card',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择照片',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi':false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#card').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#card').val(imgpath);
          $('#card').nextAll('em').html('<i class="icoCor16"></i>');
          //$('#show_card').html('<a href="/'+imgpath+'" target="_blank">查看</a>');
          $('#show_card').html('保存后可查看');
        }
      }

    });
    $('#bgimg_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'bgimg',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择照片',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi':false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#bgimg').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#bgimg').val(imgpath);
          $('#bgimg').nextAll('em').html('<i class="icoCor16"></i>');
          //$('#show_bgimg').html('<a href="/'+imgpath+'" target="_blank">查看</a>');
          $('#show_bgimg').html('保存后可查看');
        }
      }

    });
   $('#video_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'video',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择视频',
      'fileTypeExts': '*.flv',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadvideo',
      'multi':false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#video').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#video').val(imgpath);
          $('#video').nextAll('em').html('<i class="icoCor16"></i>上传成功');
          $('#show_video').html('保存后可下载查看');
        }
      }

    });
  },10);
});
</script>
</html>