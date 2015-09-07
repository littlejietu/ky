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
	

	<a href="/admin/order" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/order/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">
		<table class="addTable">
			<tbody>
				<tr>
		            <td height="25" align="right">订单编号：</td>
		            <td align="left" class="padL10"><?=$info['no']; ?></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">订单标题：</td>
		            <td align="left" class="padL10"><?=$info['title']; ?></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">卖家：</td>
		            <td align="left" class="padL10">id:<?=$info['sellerid']; ?> &nbsp;&nbsp;&nbsp;&nbsp; 用户名:<?=$info['seller_username']; ?> &nbsp;&nbsp;&nbsp;&nbsp; 昵称:<?=$info['seller_nickname']; ?></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">总价：</td>
		            <td align="left" class="padL10"><?=$info['totalprice']; ?></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">订单类型：</td>
		            <td align="left" class="padL10"><?=$info['kind']; ?></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">买家：</td>
		            <td align="left" class="padL10"><?=$info['buyerid']; ?>&nbsp;&nbsp;&nbsp;&nbsp;用户名:<?=$info['buyer_username']; ?> &nbsp;&nbsp;&nbsp;&nbsp; 昵称:<?=$info['buyer_nickname']; ?></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">下单时间：</td>
		            <td align="left" class="padL10"><?=date('Y-m-d H:i:s',$info['addtime']); ?></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">支付时间：</td>
		            <td align="left" class="padL10"><?php if($info['paytime']>0) echo date('Y-m-d H:i:s',$info['paytime']); ?></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">支付状态：</td>
		            <td align="left" class="padL10"><?=$info['paystatus']; ?></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">是否删除：</td>
		            <td align="left" class="padL10">
		            	<?php if($info['status']==1 ): ?>
		            		正常
		            	<?php elseif($info['status']==-1): ?>
		            		已删除
		            	<?php endif?>
	                </td>
		        </tr>
		        <tr>
		            <td height="25" align="right">是否拒绝：</td>
		            <td align="left" class="padL10">
		            	<?php if($info['reject']==1 ): ?>
		            		不拒绝
		            	<?php elseif($info['reject']==-1): ?>
		            		拒绝
		            	<?php endif?>
	                </td>
		        </tr>
		    </tbody>
		</table>
	</form>
</div>

</body>
</html>