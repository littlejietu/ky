<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>客户管理</h1>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    <select name="field">
                      <option value="userid"<?php if(!empty($arrParam['field']) && $arrParam['field']=='userid') echo ' selected';?>>用户id</option>
                      <option value="nickname"<?php if(!empty($arrParam['field']) && $arrParam['field']=='nickname') echo ' selected';?>>昵称</option>
                      <option value="linkman"<?php if(!empty($arrParam['field']) && $arrParam['field']=='linkman') echo ' selected';?>>联系人</option>
                      <option value="contact"<?php if(!empty($arrParam['field']) && $arrParam['field']=='contact') echo ' selected';?>>联系方式</option>
                      
                    </select>
                    <input type="text" name="txtKey" value="<?=!empty($arrParam['key']) ? $arrParam['key']:'';?>" class="w150">
                    <select name="fieldDate">
                      <option value="addtime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='addtime') echo ' selected';?>>添加时间</option>
                      <option value="certtime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='certtime') echo ' selected';?>>认证时间</option>
                    </select>

                    <input type="text" name="begtime" class="w100" value="<?php if( !empty($arrParam['begtime']) ) echo $arrParam['begtime']; ?>"  readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <input type="text" name="endtime" class="w100" value="<?php if( !empty($arrParam['endtime']) ) echo $arrParam['endtime']; ?>" readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <select name="orderby">
                      <option value="addtime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='addtime desc') echo ' selected';?>>添加时间倒序</option>
                      <option value="certtime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='certtime desc') echo ' selected';?>>认证时间倒序</option>
                    </select>
                    <button type="submit" class="btn">查  询</button>
                  	
                  </form>
            </td>
        </tr>
    </table>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">id</td>
	            <td>昵称</td>
	            
	            <td>联系人</td>
	            <td>联系方式</td>
	            <td>备注</td>	           
	            <td>时间</td>	            	           
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['id'];?></td>
				<td><?php echo $a['nickname'];?></td>
				
				<td><?php echo $a['linkman'];?></td>
				<td><?php echo $a['contact'];?></td>
				<td><?php echo $a['memo'];?></td>				
				<td><?php echo date('Y-m-d H:i:s',$a['addtime']);?></td>				
				<td class="con_title">
					<a href="/admin/client/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/client/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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