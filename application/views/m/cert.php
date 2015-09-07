<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的认证-个人中心-<?=_get_config('sitename')?></title>
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
                          <div class="aut_bti">我的认证</div>
                          <?php $res = $this->input->get('res');
                          if($this->input->get('res'))
                          {
                            $msg = '保存失败';
                            if($res==200)
                              $msg = '保存成功';

                              echo '<div style="color:red">'.$msg.'</div>';
                          }?>
                          <?php if($o && ($o['status']==1 || $o['status']==2) ):?>
                            <?php if($o['status']==1):?>
                              认证成功
                            <?php else:?>
                              缴费中..
                            <?php endif?>
                            <table class="aut_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td width="86">真实姓名</td>
                                  <td><?=$o['realname']?></td>
                                </tr>
                                <tr>
                                  <td>身份证号</td>
                                  <td><?=$o['idno']?></td>
                                </tr>
                                <tr>
                                  <td>手机号码</td>
                                  <td><?=$o['mobile']?></td>
                                </tr>
                                <tr>
                                  <td>身份证照片</td>
                                  <td>
                                      <img border=0 src='<?php echo '/'.$o['idnoimg'];?>'>
                                  </td>
                                </tr>
                                <?php if($o['company']):?>
                                <tr>
                                  <td>所属经纪公司</td>
                                  <td><?=$o['company']?></td>
                                </tr>
                                <?php endif?>
                                <tr>
                                  <td>工作担保金</td>
                                  <td><input class="money" type="text" value="¥ <?=$o['bail']?>" disabled=""><span class="remark">备注：担保金在注销账号时，返予您的账户。</span></td>
                                </tr>
                            </tbody></table>
                          <?php else:?>
                            <?php if($o && $o['status']==-1):?>
                              认证失败
                            <?php endif?>
                          <form method="post" action="" id="xtform">
                            <table class="aut_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td width="86"><span class="tips">*</span>真实姓名</td>
                                  <td><input name="realname" type="text" class="txt" value="<?php echo !empty($o['realname'])?$o['realname']:$this->loginUser['realname']; ?>" placeholder="请输入姓名"></td>
                                </tr>
                                <tr>
                                  <td><span class="tips">*</span>身份证号</td>
                                  <td><input name="idno" type="text" class="txt" placeholder="请输入身份证号" value="<?php if(!empty($o['idno'])) echo $o['idno']?>"></td>
                                </tr>
                                <tr>
                                  <td><span class="tips">*</span>手机号码</td>
                                  <td><input name="mobile" type="text" class="txt" placeholder="请输入手机号码" value="<?php echo !empty($o['mobile'])?$o['mobile']:$this->loginUser['mobile']; ?>"></td>
                                </tr>
                                <tr>
                                  <td><span class="tips">*</span>身份证照片</td>
                                  <td>
                                      
                                          <div id="previews" class="drsMoveHandle">
                                              <img id="show_idnoimg" border=0 src='<?php if(!empty($o['idnoimg'])) echo '/'.$o['idnoimg'];?>'>
                                          </div>
                                          <div class="f_note ">
                                              <p>尺寸：180×180像数</p>
                                              <input type="hidden"  name="idnoimg" id="idnoimg" value="<?php if(!empty($o['idnoimg'])) echo $o['idnoimg']?>">
                                              <em><i class="icoPro16"></i>仅支持JPEG，上传图片大小不能超过1M</em>
                                              <div class="file_but">
                                                  <input id="idnoimg_upload" name="idnoimg_upload" value="选择身份证" class="inp_file" type="file">
                                              </div>
                                          </div>
                                      
                                  </td>
                                </tr>
                                <tr>
                                  <td>所属经纪公司</td>
                                  <td><input name="company" type="text" class="txt" placeholder="请输入所属经纪公司" value="<?php if(!empty($o['company'])) echo $o['company'];?>"></td>
                                </tr>
                                <tr>
                                  <td>工作担保金</td>
                                  <td><input class="money" type="text" value="¥ <?php if(!empty($o['bail'])) echo $o['bail']; else echo $sysBail;?>" disabled="">
                                      <input name="bail" type="hidden" value="<?php if(!empty($o['bail'])) echo $o['bail']; else echo $sysBail;?>"><span class="remark">备注：担保金在注销账号时，返予您的账户。</span></td>
                                </tr>
                                <tr style="border-bottom:none;">
                                  <td style="height:80px">&nbsp;</td>
                                  <td><input name="" type="submit" class="but" value="保存" style="margin-right:20px"><a class="but" href="/m/cert/gotopay" target="_blank">前去缴纳</a></td>
                                </tr>
                            </tbody></table>
                          </form>
                          <?php endif?>
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
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/cert.js"></script>
<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript">
<?php $timestamp = $this->timestamp;?>
$(function() {
  setTimeout(function(){
    $('#idnoimg_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'idnoimg',
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
          $('#idnoimg').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#idnoimg').val(imgpath);
          $('#idnoimg').nextAll('em').html('<i class="icoCor16"></i>');
          $('#show_idnoimg').attr('src','/'+imgpath);
        }
      }

    });
  },10);
});
</script>

</html>