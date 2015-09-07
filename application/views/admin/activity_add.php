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
	

	<a href="/admin/activity" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/activity/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
				<tr>
		            <td width="150" height="25" align="right"><span class="tips">*</span> 活动名称：</td>
		            <td align="left" class="padL10"><input type="text" name="title" value="<?php if( !empty($info['title']) ) echo $info['title']; ?>" /></td>
		        </tr>
		        <tr>
		            <td width="150" height="25" align="right"><span class="tips">*</span> 活动类型：</td>
		            <td align="left" class="padL10">
		            	<select name="type">
		            		<option value="0">请选择类型</option>
		            		<?php foreach ($oSysActType as $key => $v):?>
							<option value="<?=$key?>"<?php if( !empty($info['type']) && $info['type']==$key ) echo ' selected'; ?>><?=$v?></option>
							<?php endforeach;?>
						</select>
		            	</td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 活动图片：</td>
		            <td align="left" class="padL10">
		            	<div id="previews" class="drsMoveHandle">
	                        <img id="show_img" border=0 src='<?php if( !empty($info['img']) ) echo  _get_image_url($info['img']);?>'>
	                    </div>
	                    <div class="f_note">
	                        <p>尺寸：509×280像数</p>
	                        <input type="hidden"  name="img" id="img" value="<?php if( !empty($info['img']) ) echo $info['img']; else echo 'http://'; ?>">
	                        <em><i class="icoPro16"></i>仅支持JPEG，上传图片大小不能超过1M</em>
	                        <div class="file_but">
	                            <input id="img_upload" name="img_upload" value="选择照片" class="inp_file" type="file">
	                        </div>
	                    </div>
	            	</td>
		        </tr>
		        <tr>
		            <td height="25" align="right"> 工作简介：</td>
		            <td align="left" class="padL10"><input type="text" name="summary" value="<?php if( !empty($info['summary']) ) echo $info['summary']; ?>" style="width:300px" maxlength="200" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"> 工作费用：</td>
		            <td align="left" class="padL10"><input type="text" name="workfee" value="<?php if( !empty($info['workfee']) ) echo $info['workfee']; ?>" style="width:300px" maxlength="200" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 开始时间：</td>
		            <td align="left" class="padL10"><input type="text" name="begtime" value="<?php if( !empty($info['begtime']) ) echo date('Y-m-d',$info['begtime']); ?>" readonly="readonly" onclick="WdatePicker()" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 结束时间：</td>
		            <td align="left" class="padL10"><input type="text" name="endtime" value="<?php if( !empty($info['endtime']) ) echo date('Y-m-d',$info['endtime']); ?>" readonly="readonly" onclick="WdatePicker()" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 报名截止时间：</td>
		            <td align="left" class="padL10"><input type="text" name="inendtime" value="<?php if( !empty($info['inendtime']) ) echo date('Y-m-d',$info['inendtime']); ?>" readonly="readonly" onclick="WdatePicker()" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 地点：</td>
		            <td align="left" class="padL10"><input type="text" name="place" value="<?php if( !empty($info['place']) ) echo $info['place']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">具体地址：</td>
		            <td align="left" class="padL10"><input type="text" name="address" value="<?php if( !empty($info['address']) ) echo $info['address']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">参与名额：</td>
		            <td align="left" class="padL10"><input type="text" name="actnum" value="<?php if( !empty($info['actnum']) ) echo $info['actnum']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">假报名人数：</td>
		            <td align="left" class="padL10"><input type="text" name="innumfake" value="<?php if( !empty($info['innumfake']) ) echo $info['innumfake']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 报名人数：</td>
		            <td align="left" class="padL10"><input type="text" name="innum" value="<?php if( !empty($info['innum']) ) echo $info['innum']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 审核/显示：</td>
		            <td align="left" class="padL10">
		            	<input type="radio" name="display" value="1" <?php if( !empty($info['display']) && $info['display']==1 ) echo ' checked' ?> />审核显示
		            		<input type="radio" name="display" value="2" <?php if( !empty($info['display']) && $info['display']==2 ) echo ' checked' ?> />不显示
		            </td>
		        </tr>
				<tr>
		            <td></td>
		            <td class="padL10"><input type="submit" class="sub" value="提交"></td>
		        </tr>
		    </tbody>
		</table>
	</form>
</div>

<script type="text/javascript" src="<?php echo _get_cfg_path('lib')?>My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript">
<?php $timestamp = $this->timestamp;?>
$(function() {
	setTimeout(function(){
	    $('#img_upload').uploadify({
	      'formData'     : {
	        'timestamp' : '<?php echo $timestamp;?>',
	        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
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
</body>
</html>