<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>系统通知</h1>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    <select name="type">
                        <option value="">消息类型</option>
                        <option value="1"<?php if(!empty($arrParam['type']) && $arrParam['type']==1) echo ' selected'; ?>>系统消息</option>
                        <option value="2"<?php if(!empty($arrParam['type']) && $arrParam['type']==2) echo ' selected'; ?>>普通消息</option>
                    </select>
                    
                    <select name="field">
                      <option value="touserid"<?php if(!empty($arrParam['field']) && $arrParam['field']=='touserid') echo ' selected';?>>接收方id</option>
                      <option value="tonickname"<?php if(!empty($arrParam['field']) && $arrParam['field']=='tonickname') echo ' selected';?>>接收方昵称</option>
                    </select>

                    <input type="text" name="txtKey" value="<?=!empty($arrParam['key']) ? $arrParam['key']:'';?>" class="w150">

                    <select name="fieldDate">
                      <option value="addtime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='addtime') echo ' selected';?>>添加时间</option>
                    </select>

                    <input type="text" name="begtime" class="w100" value="<?php if( !empty($arrParam['begtime']) ) echo $arrParam['begtime']; ?>"  readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <input type="text" name="endtime" class="w100" value="<?php if( !empty($arrParam['endtime']) ) echo $arrParam['endtime']; ?>" readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <select name="orderby">
                      <option value="addtime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='addtime desc') echo ' selected';?>>添加时间倒序</option>
                    </select>
                    
                    <button type="submit" class="btn">查  询</button>
                  	
                  </form>
            </td>
            <td><a href="/admin/message/add" class="sub">添加</a></td>
        </tr>
    </table>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">接收方id</td>
	            <td>接收方昵称</td>
	            <td>标题</td>
	            <td>是否已读</td>
	            <td>是否删除</td>
	            <td>时间</td>	            	           
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['touserid'];?></td>
				<td><?php echo $a['tonickname'];?></td>
				<td><?php echo $a['title'];?></td>
				<td><?php if($a['readed']==1) echo '已读'; else echo '未读';?></td>
				<td><?php if($a['status']==1) echo '正常'; else echo '已删除';?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['addtime']);?></td>				
				<td class="con_title">
					<a href="/admin/message/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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