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
	

	<a href="/admin/client" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/client/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
		        
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 联系人；</td>
		            <td align="left" class="padL10"><input type="text" name="linkman" value="<?php if( !empty($info['linkman']) ) echo $info['linkman']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 联系方式；</td>
		            <td align="left" class="padL10"><input type="text" name="contact" value="<?php if( !empty($info['contact']) ) echo $info['contact']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"> 备注；</td>
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