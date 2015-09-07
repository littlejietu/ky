<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>index.css" rel="stylesheet">
</head>

<body>

<div class="right_con common adduser">
	

	<a href="/admin/ad_place" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/ad_place/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
				<tr>
		            <td width="150" height="25" align="right"><span class="tips">*</span> 广告位名称：</td>
		            <td align="left" class="padL10"><input type="text" name="title" value="<?php if( !empty($info['title']) ) echo $info['title']; ?>" /></td>
		        </tr>
		        <tr>
		            <td width="150" height="25" align="right"> 金额：</td>
		            <td align="left" class="padL10"><input type="text" name="price" value="<?php if( !empty($info['price']) ) echo $info['price']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span>广告代码：</td>
		            <td align="left" class="padL10"><input type="text" name="adcode" value="<?php if( !empty($info['adcode']) ) echo $info['adcode']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span>广告尺寸</td>
		            <td align="left" class="padL10"><input type="text" name="size" value="<?php if( !empty($info['size']) ) echo $info['size']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 是否停用：</td>
		            <td align="left" class="padL10">
		            	<input type="radio" name="status" value="1" <?php if( !empty($info['status']) && $info['status']==1 ) echo ' checked' ?> />使用
		            		<input type="radio" name="status" value="-1" <?php if( !empty($info['status']) && $info['status']==-1 ) echo ' checked' ?> />停用
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

</body>
</html>