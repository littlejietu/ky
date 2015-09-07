<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>认证管理</h1>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    <select name="status">
                        <option value="">认证状态</option>
                        <option value="1"<?php if(!empty($arrParam['status']) && $arrParam['status']==1) echo ' selected'; ?>>成功</option>
                        <option value="-1"<?php if(!empty($arrParam['status']) && $arrParam['status']==-1) echo ' selected'; ?>>失败</option>
                    </select>
                       
                    <select name="field">
                      <option value="realname"<?php if(!empty($arrParam['field']) && $arrParam['field']=='realname') echo ' selected';?>>真实姓名</option>
                      <option value="idno"<?php if(!empty($arrParam['field']) && $arrParam['field']=='idno') echo ' selected';?>>身份证</option>
                      <option value="mobile"<?php if(!empty($arrParam['field']) && $arrParam['field']=='mobile') echo ' selected';?>>手机号</option>
                      <option value="company"<?php if(!empty($arrParam['field']) && $arrParam['field']=='company') echo ' selected';?>>所属经纪公司</option>
                      
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
	            <td width="250" height="25" align="center">用户</td>
	            <td>用户名</td>
	            <td>真实姓名</td>
	            <td>身份证</td>	           
           		<td>手机号</td>
	            <td>所属经纪公司</td>
	            <td>保证金</td>
	            <td>添加时间</td>
	            <td>认证时间</td>
	            <td>认证状态</td>	                       	           
	            <td>最后操作人</td>
	            <td>最后操作时间</td>
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['userid'];?></td>
				<td><?php echo $a['username'];?></td>
				<td><?php echo $a['realname'];?></td>
				<td><?php echo $a['idno'];?></td>
				<td><?php echo $a['mobile'];?></td>								
				<td><?php echo $a['company'];?></td>
				<td><?php echo $a['bail'];?></td>
				<td><?php if($a['addtime']>0) echo date('Y-m-d H:i:s',$a['addtime']);?></td>
				<td><?php if($a['certtime']>0) echo date('Y-m-d H:i:s',$a['certtime']);?></td>
				<td><?php if($a['status']==1) echo '成功'; else if($a['status']==-1) echo '失败'; else if($a['status']==2) echo '已支付';  else echo '';?></td>
				<td><?php echo $a['op_username'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['op_time']);?></td>
				<td class="con_title">
					<a href="/admin/cert/add?userid=<?php echo _get_key_val($a['userid']);?>">修改</a>
					<a href="/admin/cert/del?userid=<?php echo _get_key_val($a['userid']);?>">删除</a>
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