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
	<?php echo validation_errors('<div class="error">', '</div>');?>

	<a href="/admin/aa" class="topBtn">返回列表</a>
	<form action="/admin/aa/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
				<tr>
		            <td width="150" height="25" align="right">标题：</td>
		            <td align="left" class="padL10"><input type="text" name="name" value="<?php if( !empty($info['name']) ) echo $info['name']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">内容：</td>
		            <td align="left" class="padL10"><input type="text" name="memo" value="<?php if( !empty($info['memo']) ) echo $info['memo']; ?>" /></td>
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