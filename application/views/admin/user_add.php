<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>index.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
</head>

<body>

<div class="right_con common adduser">
	

	<a href="/admin/user" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/user/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 用户名：</td>
		            <td align="left" class="padL10"><input type="text" name="username" value="<?php if( !empty($info['username']) ) echo $info['username']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 昵称：</td>
		            <td align="left" class="padL10"><input type="text" name="nickname" value="<?php if( !empty($info['nickname']) ) echo $info['nickname']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 用户类型：</td>
		            <td align="left" class="padL10">
                  <?php if($info['usertype']):?>
                    <?=$oSysUsertype[$info['usertype']]?>
                    <input type="hidden" name="usertype" value="<?=$info['usertype']?>">
                  <?php else:?>
                    <?php foreach ($oSysUsertype as $k => $v):?>
  		            	<input type="radio" name="usertype" value="<?=$k?>" <?php if( !empty($info['usertype']) && $info['usertype']==$k ) echo ' checked' ?> /><?=$v?>
  		            	<?php endforeach;?>
                  <?php endif?>
		            </td>
            </tr>
            <tr>
                <td height="25" align="right"><span class="tips">*</span> 用户级别：</td>
                <td align="left" class="padL10">
                  <?php foreach ($oSysUserlevel as $k => $v):?>
                  <input type="radio" name="userlevel" value="<?=$k?>" <?php if( !empty($info['userlevel']) && $info['userlevel']==$k ) echo ' checked' ?> /><?=$v?>
                  <?php endforeach;?>
                </td>
            </tr>

          <?php if($info['usertype']==1):?>
            <tr>
                <td height="25" align="right"><span class="tips">*</span> 模特风格：</td>
                <td align="left" class="padL10">
                  <?php foreach ($oSysModelstyle as $key => $v):?>
                    <input type="checkbox" name="style[]" value="<?=$key?>"<?php if(strpos(','.$info['style'].',',','.$key.',')>-1) echo ' checked';?> /><?=$v?>
                  <?php endforeach;?>
                </td>
            </tr>
          <?php endif?>
          <?php if( in_array($info['usertype'], array(1,2)) ):?>
            <tr>
                <td height="25" align="right"><span class="tips">*</span> 类型：</td>
                <td align="left" class="padL10">
                  <?php foreach ($oSysType as $key => $v):?>
                    <input type="checkbox" name="type[]" value="<?=$key?>"<?php if(strpos(','.$info['type'].',',','.$key.',')>-1) echo ' checked';?> /><?=$v?>
                  <?php endforeach;?>
                </td>
            </tr>
          <?php endif?>
		        <tr>
		            <td height="25" align="right"> 密码：</td>
		            <td align="left" class="padL10"><input type="text" name="password" value="" />(为空时不修改密码)</td>
		        </tr>
		        <tr>
		            <td height="25" align="right"> 会员头像：</td>
		            <td align="left" class="padL10"><div id="previews" class="drsMoveHandle">
	               	    <img id="show_userlogo" border=0 src='<?php echo $info['userlogo']? '/'.$info['userlogo'] : _get_cfg_path('images').'imghead.jpg';?>'>
	                </div>
	                <div class="f_note">
	                    <p>尺寸：180×180像数</p>
	                    <input type="hidden"  name="userlogo" id="userlogo" value="<?=$info['userlogo']?>">
	                    <em><i class="icoPro16"></i>仅支持JPEG，上传图片大小不能超过1M</em>
	                    <div class="file_but">
	                        <input id="userlogo_upload" name="userlogo_upload" value="选择照片" class="inp_file" type="file">
	                    </div>
	                </div>
	            	</td>
		        </tr>
		        <tr>
		            <td height="25" align="right"> 形象照片：</td>
		            <td align="left" class="padL10"><div class="fr">
                        <img id="show_showimg" border=0 src='<?php echo $info['showimg']? '/'.$info['showimg'] : _get_cfg_path('images').'imghead.jpg';?>'>
                    </div>
                    <div class="f_note">
                        <p>尺寸：248×324像数</p>
                        <input type="hidden"  name="showimg" id="showimg" value="<?=$info['showimg']?>">
                        <em><i class="icoPro16"></i>可上传黑白照片, 上传图片大小不能超过1M</em>
                        <div class="file_but">
                            <input id="showimg_upload" name="showimg_upload" value="选择照片" class="inp_file" type="file">
                        </div>
                    </div>
	            	</td>
		        </tr>
            <tr>
                <td height="25" align="right"> 形象照片：</td>
                <td align="left" class="padL10"><div class="fr">
                        <img id="show_showimg2" border=0 src='<?php echo $info['showimg2']? '/'.$info['showimg2'] : _get_cfg_path('images').'imghead.jpg';?>'>
                    </div>
                    <div class="f_note">
                        <p>尺寸：248×324像数</p>
                        <input type="hidden"  name="showimg2" id="showimg2" value="<?=$info['showimg2']?>">
                        <em><i class="icoPro16"></i>可上传彩色照片, 上传图片大小不能超过1M</em>
                        <div class="file_but">
                            <input id="showimg2_upload" name="showimg2_upload" value="选择照片" class="inp_file" type="file">
                        </div>
                    </div>
                </td>
            </tr>
            <?php if($info['usertype']==1):?>
		        <tr>
		            <td height="25" align="right"> 模特卡：</td>
		            <td align="left" class="padL10"><div class="fr">
	                    <img id="show_card" border=0 src='<?php echo $info['card']? '/'.$info['card'] : _get_cfg_path('images').'imghead.jpg';?>'>
	                </div>
	                <div class="f_note">
	                    <p>尺寸：248×324像数</p>
	                    <input type="hidden"  name="card" id="card" value="<?=$info['card']?>">
	                    <em><i class="icoPro16"></i>在个人主页上显示, 上传图片大小不能超过1M</em>
	                    <div class="file_but">
	                        <input id="card_upload" name="card_upload" value="选择照片" class="inp_file" type="file">
	                    </div>
	                </div>
	            	</td>
		        </tr>
            <?php endif?>
		        <tr>
		            <td height="25" align="right"> 主页背景图：</td>
		            <td align="left" class="padL10"><div class="fr">
                        <img id="show_bgimg" border=0 src='<?php echo $info['bgimg']? '/'.$info['bgimg'] : _get_cfg_path('images').'imghead.jpg';?>'>
                    </div>
                    <div class="f_note">
                        <p>尺寸：248×324像数</p>
                        <input type="hidden"  name="bgimg" id="bgimg" value="<?=$info['bgimg']?>">
                        <em><i class="icoPro16"></i>在个人主页上显示, 上传图片大小不能超过1M</em>
                        <div class="file_but">
                            <input id="bgimg_upload" name="bgimg_upload" value="选择照片" class="inp_file" type="file">
                        </div>
                    </div>
	            	</td>
		        </tr>
		        <tr>
		            <td height="25" align="right"> 视频：</td>
		            <td align="left" class="padL10"><div class="f_note">
                        <p>尺寸：248×324像数</p>
                        <input type="hidden"  name="video" id="video" value="<?=$info['video']?>">
                        <em><i class="icoPro16"></i>在个人主页上显示, 上传图片大小不能超过1M</em>
                        <div class="file_but">
                            <input id="video_upload" name="video_upload" value="选择照片" class="inp_file" type="file">
                        </div>
                    </div>
	            	</td>
		        </tr>
		        <tr>
		            <td height="25" align="right"> 真实姓名：</td>
		            <td align="left" class="padL10"><input type="text" name="realname" value="<?php if( !empty($info['realname']) ) echo $info['realname']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 手机：</td>
		            <td align="left" class="padL10"><input type="text" name="mobile" value="<?php if( !empty($info['mobile']) ) echo $info['mobile']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 性别：</td>
		            <td align="left" class="padL10">
		            	<input type="radio" name="sex" value="1" <?php if( !empty($info['sex']) && $info['sex']==1 ) echo ' checked' ?> />男
		            		<input type="radio" name="sex" value="2" <?php if( !empty($info['sex']) && $info['sex']==2 ) echo ' checked' ?> />女
		            </td>
            </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 所在城市：</td>
		            <td align="left" class="padL10">
                  <span id="divCity"></span>
                  <input type="hidden" id="init_city_id" name="init_city_id" value="<?=$info['city_id'];?>">
                  <input type="hidden" id="city" name="city" value="<?=$info['city'];?>">
                </td>
		        </tr>
          <?php if($info['usertype']==1):?>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 身高：</td>
		            <td align="left" class="padL10"><input type="text" name="height" value="<?php if( !empty($info['height']) ) echo $info['height']; ?>" /> cm</td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 体重：</td>
		            <td align="left" class="padL10"><input type="text" name="weight" value="<?php if( !empty($info['weight']) ) echo $info['weight']; ?>" /> kg</td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 胸围：</td>
		            <td align="left" class="padL10"><input type="text" name="bust" value="<?php if( !empty($info['bust']) ) echo $info['bust']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 腰围：</td>
		            <td align="left" class="padL10"><input type="text" name="waist" value="<?php if( !empty($info['waist']) ) echo $info['waist']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 臀围：</td>
		            <td align="left" class="padL10"><input type="text" name="hips" value="<?php if( !empty($info['hips']) ) echo $info['hips']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"> 鞋码：</td>
		            <td align="left" class="padL10"><input type="text" name="shoes" value="<?php if( !empty($info['shoes']) ) echo $info['shoes']; ?>" /> 码</td>
		        </tr>	
		        <tr>
		            <td height="25" align="right"> 罩杯：</td>
		            <td align="left" class="padL10"><input type="text" name="cup" value="<?php if( !empty($info['cup']) ) echo $info['cup']; ?>" /> B</td>
		        </tr>
          <?php endif?>
		        <tr>
		            <td height="25" align="right"> QQ：</td>
		            <td align="left" class="padL10"><input type="text" name="qq" value="<?php if( !empty($info['qq']) ) echo $info['qq']; ?>" /></td>
		        </tr>
            <?php if( in_array($info['usertype'], array(1,4,5)) ):?>
            <tr>
                <td height="25" align="right"> 拍摄经历：</td>
                <td align="left" class="padL10"><input type="text" name="brand" value="<?php if( !empty($info['brand']) ) echo $info['brand']; ?>" /></td>
            </tr> 
            <tr>
                <td height="25" align="right"> 工作经历：</td>
                <td align="left" class="padL10"><input type="text" name="brandtype" value="<?php if( !empty($info['brandtype']) ) echo $info['brandtype']; ?>" /></td>
            </tr>
		        <tr>
	                <td valign="top" align="right"><font>平面拍摄：</font></td>
	                <td class="padL10"><textarea  placeholder="请输入你拍摄过的品牌"  name="planeshot" cols="60" rows="3"><?=$info['planeshot']?></textarea></td>
              	</tr>
            <?php endif?>
            <?php if($info['usertype']==1):?>
		        <tr>
                    <td valign="top" align="right"><font>获得奖项：</font></td>
                    <td class="padL10"><textarea class="txt text" placeholder="请输入你获得的奖项" name="awards" cols="60" rows="3"><?=$info['awards']?></textarea></td>
              	</tr>
              	<tr>
                    <td valign="top" align="right"><font>T台活动：</font></td>
                    <td class="padL10"><textarea class="txt text" placeholder="请输入你获得的奖项" name="tactivity" cols="60" rows="3"><?=$info['tactivity']?></textarea></td>
              	</tr>
               	<tr>
                    <td valign="top" align="right"><font>影视广告：</font></td>
                    <td class="padL10"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="telead" cols="60" rows="3"><?=$info['telead']?></textarea></td>
              	</tr>
              	<tr>
                    <td valign="top" align="right"><font>杂志拍摄：</font></td>
                    <td class="padL10"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="magazine" cols="60" rows="3"><?=$info['magazine']?></textarea></td>
              	</tr>
            <?php endif?>
            <?php if( in_array($info['usertype'], array(1,4,5)) ):?>
		        <tr>
                    <td valign="top" align="right"><font>工作报价：</font></td>
                    <td class="padL10"><textarea class="txt text" placeholder=""  name="fee" cols="60" rows="3"><?=$info['fee']?></textarea></td>
                </tr>
                <tr>
                    <td valign="top" align="right"><font>工作时间：</font></td>
                    <td class="padL10"><textarea class="txt text" placeholder=""  name="servicetime" cols="60" rows="3"><?=$info['servicetime']?></textarea></td>
                </tr>
                <tr>
                    <td valign="top" align="right"><font>注意事项：</font></td>
                    <td class="padL10"><textarea class="txt text" placeholder="" name="takenote" cols="60" rows="3"><?=$info['takenote']?></textarea></td>
               	</tr>
            <?php endif?>
            <?php if( in_array($info['usertype'], array(2)) ):?>
              <tr>
                    <td valign="top" align="right"><font>简介：</font></td>
                    <td class="padL10"><textarea class="txt text" placeholder="" name="memo" cols="60" rows="3"><?=$info['memo']?></textarea></td>
                </tr>
            <?php endif?>
		        
				<tr>
		            <td></td>
		            <td class="padL10"><input type="submit" class="sub" value="提交"></td>
		        </tr>
		    </tbody>
		</table>
	</form>
</div>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('lib')?>data/area.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('lib')?>data/multiselect.js"></script>
<script type="text/javascript">
//地区--begin
    if(typeof($('#city').val())!="undefined")
    {
        var multiSelect         = new MultiSelect('divCity','city',dataMultiArea,dataAllArea);
        multiSelect.pLabels  = '省,市';
        //multiSelect.pClass   = 'w70 mr5';
        multiSelect.pNames  = 'province_id,city_id';
        multiSelect.pStart  = 1;
        multiSelect.init(chinese_id);
        var initId = $('#init_city_id').val();
        if(initId=='' || initId==0)
            initId = chinese_id;
        multiSelect.select(initId);
        // $("#divCity select").each(function(){
        //     $(this).addClass("select-style");
        //     //$(this).wrap('<span class="standard_select"><span class="select_shelter"></span></span></div>');
        // });
    }
    //地区--end

<?php $timestamp = $this->timestamp;?>
$(function() {
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
          $('#showimg').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#showimg').val(imgpath);
          $('#showimg').nextAll('em').html('<i class="icoCor16"></i>');
          $('#show_showimg').attr('src','/'+imgpath);
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
          $('#show_showimg2').attr('src','/'+imgpath);
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
          $('#show_card').attr('src','/'+imgpath);
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
          $('#show_bgimg').attr('src','/'+imgpath);
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
          $('#video').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#video').val(imgpath);
          $('#video').nextAll('em').html('<i class="icoCor16"></i>');
          $('#show_video').attr('src','/'+imgpath);
        }
      }

    });
});
</script>
</body>
</html>