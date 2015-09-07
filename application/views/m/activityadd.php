<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>机构通告-个人中心-牛模网</title>
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
                    <div class="authent">
                      <form action="/m/activity/add<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">
                        <div class="aut_bti"><?php if(!empty($info['id'])) echo '修改';else echo '添加';?>通告</div>
                        
                        <div class="jsq_uet">

                            <table class="aut_tab i_notice_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                  <td>名称</td>
                                  <td><input  type="text" class="txt" placeholder="名称"  name="title" value="<?php if( !empty($info['title']) ) echo $info['title']; ?>" /></td>
                                </tr>
                                  <tr>
                                  <td width="86">通告性质</td>
                                  <td>
                                  <select name="type" class="txt">
                                  <option value="0">请选择类型</option>
                                  <?php foreach ($oSysActType as $key => $v):?>
                                  <option value="<?=$key?>"<?php if( !empty($info['type']) && $info['type']==$key ) echo ' selected'; ?>><?=$v?></option>
                                  <?php endforeach;?>
                                  </select>
                                  </td>
                                </tr>
                            </tbody></table>
                        </div>
                        
                        <div id="ID_BankLoanAmount" class="jsq_uet" style="display:block;">
                            <table class="aut_tab i_notice_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td width="86">工作时间</td>
                                  <td>
                                      <input type="text" id="c10"  onclick="J.calendar.get({to:'c11,min'});" class="txt" placeholder="开始时间" name="begtime" value="<?php if( !empty($info['begtime']) ) echo date('Y-m-d',$info['begtime']); ?>">
                                      <span>至</span>
                                      <input type="text" id="c11" onclick="J.calendar.get({to:'c10,max'});" class="txt" placeholder="截止时间" name="endtime" value="<?php if( !empty($info['endtime']) ) echo date('Y-m-d',$info['endtime']); ?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td>工作地点</td>
                                  <td><input  type="text" class="txt" placeholder="工作地点"  name="place" value="<?php if( !empty($info['place']) ) echo $info['place']; ?>" /></td>
                                </tr>
                                <tr>
                                  <td>工作内容</td>
                                  <td><input type="text" class="txt" placeholder="工作内容" name="summary" value="<?php if( !empty($info['summary']) ) echo $info['summary']; ?>" style="width:300px" maxlength="200" /></td>
                                </tr>
                            </tbody></table>
                        </div>
                        
                        <div id="ID_FundLoanAmount" class="jsq_uet" style="display:block">
                           <table class="aut_tab i_notice_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td width="86">名额</td>
                                  <td><input type="text" class="txt" placeholder="名额" name="actnum" value="<?php if( !empty($info['actnum']) ) echo $info['actnum']; ?>" /></td>
                                </tr>
                                <tr>
                                  <td>工作费用</td>
                                  <td><input type="text" class="txt" placeholder="工作费用" name="workfee" value="<?php if( !empty($info['workfee']) ) echo $info['workfee']; ?>" style="width:300px" maxlength="200" /></td>
                                </tr>
                            </tbody></table> 
                        </div>
                        <div class="jsq_uet">
                            <table class="aut_tab i_notice_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                    <td>报名截止时间</td>
                                    <td><input type="text" id="c1" onclick="J.calendar.get();" class="txt" placeholder="报名截止时间" name="inendtime" value="<?php if( !empty($info['inendtime']) ) echo date('Y-m-d',$info['inendtime']); ?>" readonly="readonly" onclick="WdatePicker()" /></td>
                                </tr>
                                <tr>
                                    <td width="86">通告封面</td>
                                    <td>
                                        <div id="previews" class="drsMoveHandle">
                                            <img id="show_img" border=0 src='<?php if( !empty($info['img']) ) echo  _get_image_url($info['img']);?>'>
                                        </div>
                                        <div class="f_note">
                                            <p>尺寸：509×280像数</p>
                                            <input type="hidden"  name="img" id="img" value="<?php if( !empty($info['img']) ) echo $info['img']; ?>">
                                            <em><i class="icoPro16"></i>仅支持JPEG，上传图片大小不能超过1M</em>
                                            <div class="file_but">
                                                <input id="img_upload" name="img_upload" value="选择照片" class="inp_file" type="file">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                        
                        <div class="jsq_uet">
                            <table class="aut_tab i_notice_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr style="border-bottom:none;">
                                    <td width="86">&nbsp;</td>
                                    <td><input name="" type="submit" class="but" value="<?php if(!empty($info['id'])) echo '修改';else echo '添加';?>"></td>
                                </tr>
                            </tbody></table>
                        </div>
                      </form>
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
<script type="text/javascript" src="<?php echo _get_cfg_path('lib')?>datepicker/lhgcore.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('lib')?>datepicker/lhgcalendar.js"></script>
<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript">
<?php $timestamp = $this->timestamp;?>
$(function() {
  setTimeout(function(){
      $('#img_upload').uploadify({
        'formData'     : {
          'timestamp' : '<?php echo $timestamp;?>',
          'token'     : "<?php echo md5($this->config->item('encryption_key') . $timestamp );?>",
          'type' : 'img',
          'uid' : 0
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
            $('#img').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
          }else if(data[0] == 200 && data[1]!=''){
            var imgpath=data[1];
            $('#img').val(imgpath);
            $('#img').nextAll('em').html('<i class="icoCor16"></i>');
            $('#show_img').attr('src','/'+imgpath);
          }
        }

      });

    
  },10);
});
</script>
</html>