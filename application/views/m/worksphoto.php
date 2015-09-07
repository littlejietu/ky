<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>作品上传-个人中心-牛模网</title>
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
                        <div class="aut_bti"><h3>作品上传</h3></div>
                        <div class="uploadworks">
                            <div class="upload_top clearfix">
                              <p class="fl">上传照片</p>
                              <div class="fl st_select">
                                    <input type="hidden" name="" class="st_select_input">
                                    <div class="st_select_txt">请选择要上传的相册</div>
                                    <div class="st_select_btn"></div>
                                    <ul class="st_select_list" style="display: none;">
                                        <?php foreach ($albumlist as $key => $a): ?>
                                        <li _val="<?=_get_key_val($a['id'])?>"><?=$a['title']?></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                                <!--<p class="fr"><a href="##">反馈问题</a><a href="##">使用帮助</a></p>-->
                            </div>
                            <div class="upload_list">
                              <ul class="clearfix" id="X-photo-list">
                                  <?php foreach ($photolist as $key => $a): ?>
                                  <li>
                                      <img src="<?=$a['img']?>">
                                      <div class="udl_bti"><p><?=$a['title']?></p><a _val="<?=_get_key_val($a['id'])?>" class="delete"></a></div>
                                  </li>
                                  <?php endforeach;?>
                                </ul>
                            </div>
                            <div class="upload_bottom aut_tab clearfix">
                              <div><input name="" type="button" id="photo_upload" class="but" value="开始上传"></div>
                              <p class="fl" id="err-msg"></p>
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
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/photo.js"></script>
<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript">
<?php $timestamp = $this->timestamp;?>
$(function() {
  setTimeout(function(){
    $('#photo_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'photo',
        'uid' : "<?php if($this->input->get('agid')) echo $this->input->get('agid'); else echo $this->thatUser['id'];?>",
        'albumid' : 0
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'上传作品',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadphotoimg',
      'onUploadStart': function (file) {
          $('#err-msg').html('');
          $("#photo_upload").uploadify("settings", "formData", { 'albumid': $('#albumid').val() });   
      },
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#err-msg').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          var imgname=data[2];
          var imgid=data[3];
          var html = '<img src="'+imgpath+'"><div class="udl_bti"><p>'+imgname+'</p><a _val="'+imgid+'" class="delete"></a></div>'
          $('#X-photo-list').append('<li>'+html+'</li>');
        }
      }

    });
  },10);
});
</script>
</html>