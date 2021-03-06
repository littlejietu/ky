<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>评论管理</h1>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    <select name="display">
                        <option value="">显示状态</option>
                        <option value="1"<?php if(!empty($arrParam['display']) && $arrParam['display']==1) echo ' selected'; ?>>显示</option>
                        <option value="2"<?php if(!empty($arrParam['display']) && $arrParam['display']==2) echo ' selected'; ?>>不显示</option>
                    </select>
                    
                    <select name="field">
                      <option value="touserid"<?php if(!empty($arrParam['field']) && $arrParam['field']=='touserid') echo ' selected';?>>被评价用户id</option>
                      <option value="tonickname"<?php if(!empty($arrParam['field']) && $arrParam['field']=='tonickname') echo ' selected';?>>被评价昵称</option>
                      <option value="userid"<?php if(!empty($arrParam['field']) && $arrParam['field']=='userid') echo ' selected';?>>评价人用户id</option>
                      <option value="nickname"<?php if(!empty($arrParam['field']) && $arrParam['field']=='nickname') echo ' selected';?>>评价人昵称</option>
                      <option value="memo"<?php if(!empty($arrParam['field']) && $arrParam['field']=='memo') echo ' selected';?>>评价内容</option>
                      
                      
                    </select>
                    <input type="text" name="txtKey" value="<?=!empty($arrParam['key']) ? $arrParam['key']:'';?>" class="w150">
                    <select name="fieldDate">
                      <option value="addtime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='addtime') echo ' selected';?>>添加时间</option>
                      

                    </select>
                    <input type="text" name="begdate" class="w100" value="<?php if( !empty($arrParam['begdate']) ) echo $arrParam['begdate']; ?>"  readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <input type="text" name="enddate" class="w100" value="<?php if( !empty($arrParam['enddate']) ) echo $arrParam['enddate']; ?>" readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <select name="orderby">
                      
                      <option value="addtime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='addtime desc') echo ' selected';?>>添加时间倒序</option>
                      
                      
                    </select>
                    <button type="submit" class="btn">查  询</button>
                  	
                  </form>
            </td>
        </tr>
    </table>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td>被评价昵称</td>
	            <td>评价人用户</td>
	            <td>评价人昵称</td>
	            <td>回复</td>
	            <td>身材样貌</td>
	            <td>专业技能</td>
	            <td>工作效率</td>
	            <td>工作态度</td>
	            <td>评价内容</td>
	            <td>是否精华</td>
	            <td>时间</td>
	            <td>显示</td>
	            <td>最后操作人</td>
	            <td>最后操作时间</td>
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['tonickname'];?></td>
				<td><?php echo $a['userid'];?></td>
				<td><?php echo $a['nickname'];?></td>
				<td><?php echo $a['commentid'];?></td>
				<td><?php echo $a['figure'];?></td>
				<td><?php echo $a['skill'];?></td>
				<td><?php echo $a['efficiency'];?></td>
				<td><?php echo $a['attitude'];?></td>
				<td><?php echo $a['memo'];?></td>
				<td><?php echo $a['good'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['addtime']);?></td>
				<td><?php if($a['display']==1) echo '显示'; else if($a['display']==2) echo '不显示';  else echo '';?></td>
				<td><?php echo $a['op_nickname'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['op_time']);?></td>
				<td class="con_title">
					<a href="/admin/comment/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/comment/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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