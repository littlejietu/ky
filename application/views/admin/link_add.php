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
	

	<a href="/admin/link" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/link/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
				<tr>
		            <td width="150" height="25" align="right"><span class="tips">*</span> 标题：</td>
		            <td align="left" class="padL10"><input type="text" name="title" value="<?php if( !empty($info['title']) ) echo $info['title']; ?>" /></td>
		        </tr>
		        <tr>
		            <td width="150" height="25" align="right"><span class="tips">*</span> url；</td>
		            <td align="left" class="padL10"><input type="text" name="url" value="<?php if( !empty($info['url']) ) echo $info['url']; else echo 'http://'; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">排序；</td>
		            <td align="left" class="padL10"><input type="text" name="sort" value="<?php if( !empty($info['sort']) ) echo $info['sort']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 显示</td>
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

</body>
</html>