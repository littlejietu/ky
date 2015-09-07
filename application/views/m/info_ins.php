<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>资料-机构中心-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo _get_cfg_path('lib')?>kindeditor/themes/default/default.css" />
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
                    <form method="post" action="" id="xtform">
                      <div class="authent">
                        <div class="aut_bti">机构资料</div>
                          <?php echo validation_errors('<div class="error">', '</div>');?>
                          <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                  <td colspan="4">基本信息</td>
                              </tr>
                              <tr>
                                <td width="86">昵  称</td>
                                <td colspan="3">
                                  <?php if(!empty($o['nickname'])) 
                                          echo $o['nickname']; 
                                        else
                                          echo '<input name="nickname" type="text" class="txt" placeholder="请输入昵称"/>';

                                  ?>
                                  <?php //echo form_error('nickname');?>
                                  </td>
                              </tr>
                              <tr>
                                <td width="86">头  像</td>
                                <td colspan="3">
                                    <div id="previews" class="drsMoveHandle">
                                        <img id="show_userlogo" border=0 src='<?php echo _get_userlogo_url($o['userlogo']);?>'>
                                    </div>
                                    <div class="f_note">
                                        <p>尺寸：180×180像数</p>
                                        <input type="hidden"  name="userlogo" id="userlogo" value="<?=$o['userlogo']?>">
                                        <em><i class="icoPro16"></i>仅支持JPEG，上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="userlogo_upload" name="userlogo_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="86">展示图</td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：345×209像数</p>
                                        <input type="hidden"  name="showimg" id="showimg" value="<?=$o['showimg']?>">
                                        <em><i class="icoPro16"></i>仅支持JPEG，上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="showimg_upload" name="showimg_upload" value="选择展示图" class="inp_file" type="file">
                                        </div>
                                    </div>
                                    <div id="show_showimg">
                                        <?php if($o['showimg']):?>
                                          <a href="<?='/'.$o['showimg']?>" target="_blank">查看</a>
                                        <?php endif?>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="86">主页背景图</td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：1100×430像数</p>
                                        <input type="hidden"  name="bgimg" id="bgimg" value="<?=!empty($o['bgimg'])?$o['bgimg']:''?>">
                                        <em><i class="icoPro16"></i>在个人主页上显示, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="bgimg_upload" name="bgimg_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                    <div id="show_bgimg">
                                        <?php if(!empty($o['bgimg'])):?>
                                          <a href="<?='/'.$o['bgimg']?>" target="_blank">查看</a>
                                        <?php endif?>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <td>类型</td>
                                <td colspan="3">
                                  <?php foreach ($oSysType as $key => $v):?>
                                    <input type="checkbox" name="type[]" value="<?=$key?>"<?php if(strpos(','.$o['type'].',',','.$key.',')>-1) echo ' checked';?> /><?=$v?>
                                  <?php endforeach;?>
                                </td>
                                
                              </tr>
                              <tr>
                                <td width="86"><span class="tips">*</span>联系人姓名</td>
                                <td><input name="realname" type="text" value="<?=$o['realname']?>" class="txt" placeholder="请输入姓名"/><?php //echo form_error('realname');?></td>
                                <td></td>
                                <td>
                                  
                                </td>
                              </tr>
                              <tr>
                                <td>联系人性别</td>
                                <td class="reg-sort">
                                  <p><input type="radio" name="sex" value="1" <?php if($o['sex']==1) echo 'checked';?> id="sort_1"/><label for="sort_1">男</label></p>
                              <p><input type="radio" name="sex" value="2" <?php if($o['sex']==2) echo 'checked';?> id="sort_2"/><label for="sort_2">女</label></p>
                                </td>
                                <td></td>
                                <td></td>
                              </tr>
                               <tr>
                                  <td colspan="4">公司简介</td>
                              </tr>
                              <tr>
                                <td colspan="4"><textarea class="txt text" placeholder="请输入公司简介"  name="memo" cols="" rows=""><?=!empty($o['memo'])?$o['memo']:'';?></textarea></td>
                              </tr>
                              
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
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/info.js"></script>
<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script charset="utf-8" src="<?php echo _get_cfg_path('lib')?>kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="<?php echo _get_cfg_path('lib')?>kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript">
<?php $timestamp = $this->timestamp;?>
$(function() {
  setTimeout(function(){
    $('#userlogo_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
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
      'buttonText':'选择展示图',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
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
          $('#show_showimg').html('保存后可查看');
          //$('#show_showimg').attr('src','/'+imgpath);
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
      'buttonText':'选择展示图',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
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
          //$('#show_bgimg').attr('src','/'+imgpath);
          $('#show_bgimg').html('保存后可查看');
        }
      }

    });

  },10);
});


  var editor;
  KindEditor.ready(function(K) {
    editor = K.create('textarea[name="memo"]', {
      resizeType : 1,
      allowPreviewEmoticons : false,
      allowImageUpload : true,
      items : [
        'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
        'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
        'insertunorderedlist', '|', 'emoticons', 'image', 'link']
    });
  });

</script>
</html>