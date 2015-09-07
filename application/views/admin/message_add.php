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
	

	<a href="/admin/message" class="topBtn">返回列表</a> <a href="/admin/user" class="topBtn">返回会员列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/message/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">
		<input type="hidden" name="touserid" value="<?php if( !empty($userinfo['id']) ) echo $userinfo['id']; ?>" />
		<input type="hidden" name="tonickname" value="<?php if( !empty($userinfo['nickname']) ) echo $userinfo['nickname']; ?>" />
		<table class="addTable">
			<tbody>
				 <tr>
		            <td height="25" align="right"><span class="tips">*</span> 接收人：</td>
		            <td align="left" class="padL10"><?=$userinfo['nickname']?></td>
		        </tr>
		        
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 标题：</td>
		            <td align="left" class="padL10"><input type="text" name="title" value="<?php if( !empty($info['title']) ) echo $info['title']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 内容：</td>
		            <td align="left" class="padL10"><textarea type="text" name="content" cols="40" rows="10" ><?php if( !empty($info['content']) ) echo $info['content']; ?></textarea></td>
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