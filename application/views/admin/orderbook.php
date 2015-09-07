<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>预约列表</h1>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    <select name="field">
                	  <option value="orderid"<?php if(!empty($arrParam['field']) && $arrParam['field']=='orderid') echo ' selected';?>>订单id</option>
                      <option value="sellerid"<?php if(!empty($arrParam['field']) && $arrParam['field']=='sellerid') echo ' selected';?>>用户id</option>
                      
                      <option value="linkman"<?php if(!empty($arrParam['field']) && $arrParam['field']=='linkman') echo ' selected';?>>联系人</option>
                      <option value="linkway"<?php if(!empty($arrParam['field']) && $arrParam['field']=='linkway') echo ' selected';?>>联系方式</option>
                      
                    </select>
                    <input type="text" name="txtKey" value="<?=!empty($arrParam['key']) ? $arrParam['key']:'';?>" class="w150">
                    <select name="fieldDate">
                      <option value="begtime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='begtime') echo ' selected';?>>拍片开始日期</option>
                      <option value="endtime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='endtime') echo ' selected';?>>拍片结束日期</option>
                    </select>

                    <input type="text" name="begtime" class="w100" value="<?php if( !empty($arrParam['begtime']) ) echo $arrParam['begtime']; ?>"  readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <input type="text" name="endtime" class="w100" value="<?php if( !empty($arrParam['endtime']) ) echo $arrParam['endtime']; ?>" readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <select name="orderby">
                      <option value="begtime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='begtime desc') echo ' selected';?>>拍片开始日期间倒序</option>
                      <option value="endtime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='endtime desc') echo ' selected';?>>拍片结束日期倒序</option>
                    </select>
                    <button type="submit" class="btn">查  询</button>
                  	
                  </form>
            </td>
        </tr>
    </table>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">用户</td>
	            <td>订单编号</td>
	            <td>工作内容</td>
	            <td>工作场景</td>
	            <td>计价方式</td>
	            <td>预定价格</td>
	            <td>备 注</td>
	            <td>期望拍片开始日期</td>
	            <td>期望拍片结束日期</td>
	            <td>联 系 人</td>
	            <td>联系方式</td>
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['sellerid'];?></td>
				<td><?php echo $a['no'];?></td>
				<td><?php echo $oSysWorkitem[$a['item']];?></td>
				<td><?php echo $oSysWorkscene[$a['scene']];?></td>
				<td><?php echo $oSysWorktime[$a['time']];?></td>
				<td><?php echo $a['price'];?></td>
				<td><?php echo $a['memo'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['begtime']);?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['endtime']);?></td>
				<td><?php echo $a['linkman'];?></td>
				<td><?php echo $a['linkway'];?></td>				
				<td class="con_title">
					<a href="/admin/orderbook/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/orderbook/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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