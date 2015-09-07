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
	

	<a href="/admin/orderbook" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/orderbook/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
				 <td height="25" align="right"><span class="tips">*</span> 工作内容；</td>
		            <td align="left" class="padL10">
		            	
		            </td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 工作场景；</td>
		            <td align="left" class="padL10">
		            	<input type="radio" name="scene" value="1" <?php if( !empty($info['scene']) && $info['scene']==1 ) echo ' checked' ?> />室内
		            		<input type="radio" name="scene" value="2" <?php if( !empty($info['scene']) && $info['scene']==2 ) echo ' checked' ?> />室外
		            </td>
		        </tr>
		        <tr>
		            <td height="25" align="right">计价方式；</td>
		            <td align="left" class="padL10">
		            	<select>
		            		<option>时</option>
		            		<option>天</option>
		            		<option>件</option>
		            		<option>场</option>
		            	</select>
		            	<input type="text" name="pertime" value="<?php if( !empty($info['pertime']) ) echo $info['pertime']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">预定价格；</td>
		            <td align="left" class="padL10"><input type="text" name="price" value="<?php if( !empty($info['price']) ) echo $info['price']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">备 注；</td>
		            <td align="left" class="padL10"><input type="text" name="memo" value="<?php if( !empty($info['memo']) ) echo $info['memo']; ?>" /></td>
		        </tr>
		        
		         <tr>
		            <td height="25" align="right">期望拍片开始日期；</td>
		            <td align="left" class="padL10"><input type="text" name="begtime" value="<?php if( !empty($info['begtime']) ) echo $info['begtime']; ?>" /></td>
		        </tr>
		        
		         <tr>
		            <td height="25" align="right">期望拍片结束日期；</td>
		            <td align="left" class="padL10"><input type="text" name="endtime" value="<?php if( !empty($info['endtime']) ) echo $info['endtime']; ?>" /></td>
		        </tr>
		        
		         <tr>
		            <td height="25" align="right">联 系 人；</td>
		            <td align="left" class="padL10"><input type="text" name="linkman" value="<?php if( !empty($info['linkman']) ) echo $info['linkman']; ?>" /></td>
		        </tr>
		        
		         <tr>
		            <td height="25" align="right">联系方式；</td>
		            <td align="left" class="padL10"><input type="text" name="linkway" value="<?php if( !empty($info['linkway']) ) echo $info['linkway']; ?>" /></td>
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