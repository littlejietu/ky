<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>订单管理</h1>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    <select name="paystatus">
                        <option value="">支付状态</option>
                        <?php foreach ($oSysPaystatus as $k=>$v):?>
                        <option value="<?=$k?>"<?php if(!empty($arrParam['paystatus']) && $arrParam['paystatus']==$k) echo ' selected'; ?>><?=$v?></option>
                        <?php endforeach?>
                    </select>
                    
                    <select name="field">
                      <option value="no"<?php if(!empty($arrParam['field']) && $arrParam['field']=='no') echo ' selected';?>>订单编号</option>
                      <option value="title"<?php if(!empty($arrParam['field']) && $arrParam['field']=='title') echo ' selected';?>>订单标题</option>
                      <option value="seller_nickname"<?php if(!empty($arrParam['field']) && $arrParam['field']=='seller_nickname') echo ' selected';?>>卖家昵称</option>
                      <option value="sellerid"<?php if(!empty($arrParam['field']) && $arrParam['field']=='sellerid') echo ' selected';?>>卖家id</option>
                      <option value="buyer_nickname"<?php if(!empty($arrParam['field']) && $arrParam['field']=='buyer_nickname') echo ' selected';?>>买家昵称</option>
                      <option value="buyerid"<?php if(!empty($arrParam['field']) && $arrParam['field']=='buyerid') echo ' selected';?>>买家id</option>
                      
                    </select>
                    <input type="text" name="txtKey" value="<?=!empty($arrParam['key']) ? $arrParam['key']:'';?>" class="w150">
                    <select name="fieldDate">
                      <option value="addtime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='addtime') echo ' selected';?>>下单时间</option>
                      <option value="paytime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='paytime') echo ' selected';?>>支付时间</option>

                    </select>
                    <input type="text" name="begdate" class="w100" value="<?php if( !empty($arrParam['begdate']) ) echo $arrParam['begdate']; ?>"  readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <input type="text" name="enddate" class="w100" value="<?php if( !empty($arrParam['enddate']) ) echo $arrParam['enddate']; ?>" readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <select name="orderby">
                      <option value="addtime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='addtime desc') echo ' selected';?>>下单时间倒序</option>
                      <option value="paytime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='paytime desc') echo ' selected';?>>支付时间倒序</option>
                      
                    </select>
                    <button type="submit" class="btn">查  询</button>
                  	
                  </form>
            </td>
        </tr>
    </table>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="150" height="25" align="center">订单编号</td>
	            <td>订单标题</td>
	            <td>卖家昵称</td>
	            <td>总价</td>
	            <td>买家昵称</td>
	            <td>下单时间</td>
	            <td>支付时间</td>
	            <td>支付状态</td>
	            <td>确认</td>
	            <td>最后操作人</td>
	            <td>最后操作时间</td>
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['no'];?></td>
				<td><?php echo $a['title'];?></td>
				<td><?php echo $a['seller_nickname'];?></td>
				<td><?php echo $a['totalprice'];?></td>
				<td><?php echo $a['buyer_nickname'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['addtime']);?></td>
				<td><?php if($a['paytime']>0) echo date('Y-m-d H:i:s',$a['paytime']);?></td>
				<td><?php echo $a['paystatus'];?></td>
				<td><?php echo $a['reject'];?></td>
				<td><?php echo $a['op_username'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['op_time']);?></td>				
				<td class="con_title">
					<a href="/admin/order/add?id=<?php echo _get_key_val($a['id']);?>">详细</a>
					
				</td>
			</tr>
			<?php endforeach;?>
			
	    </tbody>
	</table>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td colspan="2" height="32" align="right">
                <div class="page">
                	<?=$list['pages']?>
                </div>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript" src="<?php echo _get_cfg_path('lib')?>My97DatePicker/WdatePicker.js"></script>
</body>
</html>