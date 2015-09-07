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
	

	<a href="/admin/ad" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/ad/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 广告名称：</td>
		            <td align="left" class="padL10"><input type="text" name="title" value="<?php if( !empty($info['title']) ) echo $info['title']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 广告位id：</td>
		            <td align="left" class="padL10">
		            	<select name="placeid">
		            	<option>请选择广告位</option>
	            		<?php foreach ($arrPlace as $key => $a):?>
	            			<option value="<?=$a['id']?>"<?php if( !empty($info['placeid']) && $info['placeid']==$a['id'] ) echo ' selected';?>><?=$a['title']?>(<?=$a['size']?>, <?=$a['price']?>元)</option>
	            		<?php endforeach;?>
		            	</select>
		            </td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 图片地址：</td>
		            <td align="left" class="padL10"><div id="previews" class="drsMoveHandle">
	                        <img id="show_img" width="400" border=0 src='<?php if( !empty($info['img']) ) echo  _get_image_url($info['img']);?>'>
	                    </div>
	                    <div class="f_note">
	                        <input type="hidden"  name="img" id="img" value="<?php if( !empty($info['img']) ) echo $info['img']; else echo 'http://'; ?>">
	                        <em><i class="icoPro16"></i>支持JPEG/PNG，上传图片大小不能超过1M</em>
	                        <div class="file_but">
	                            <input id="img_upload" name="img_upload" value="选择照片" class="inp_file" type="file">
	                        </div>
	                    </div>
	                </td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 链接地址：</td>
		            <td align="left" class="padL10"><input type="text" name="url" value="<?php if( !empty($info['url']) ) echo $info['url']; else echo 'http://';?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 简介：</td>
		            <td align="left" class="padL10"><textarea type="text" name="summary" cols="50" rows="6"><?php if( !empty($info['summary']) ) echo $info['summary']; ?></textarea></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 备注：</td>
		            <td align="left" class="padL10"><textarea type="text" name="memo" cols="50" rows="6"><?php if( !empty($info['memo']) ) echo $info['memo']; ?></textarea></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 金额：</td>
		            <td align="left" class="padL10"><input type="text" name="price" value="<?php if( !empty($info['price']) ) echo $info['price']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 开始时间：</td>
		            <td align="left" class="padL10"><input type="text" name="begtime" value="<?php if( !empty($info['begtime']) ) echo date('Y-m-d',$info['begtime']); ?>" readonly="readonly" onclick="WdatePicker()"  /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 结束时间：</td>
		            <td align="left" class="padL10"><input type="text" name="endtime" value="<?php if( !empty($info['endtime']) ) echo date('Y-m-d', $info['endtime']); ?>" readonly="readonly" onclick="WdatePicker()"  /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 排序：</td>
		            <td align="left" class="padL10"><input type="text" name="sort" value="<?php if( !empty($info['sort']) ) echo $info['sort']; ?>" /></td>
		        </tr>		        		        
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span>显示：</td>
		            <td align="left" class="padL10">
		            	<input type="radio" name="display" value="1" <?php if( !empty($info['display']) && $info['display']==1 ) echo ' checked' ?> />显示
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

});
</script>
</body>
</html>