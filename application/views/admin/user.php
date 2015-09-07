<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>会员管理</h1>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    <select name="usertype">
                        <option value="">选择身份</option>
                        <?php foreach ($oSysUsertype as $k=>$v):?>
                        <option value="<?=$k?>"<?php if(!empty($arrParam['usertype']) && $arrParam['usertype']==$k) echo ' selected'; ?>><?=$v?></option>
                        <?php endforeach?>
                    </select>
                    <select name="userlevel">
                        <option value="">选择等级</option>
                        <?php foreach ($oSysUserlevel as $k=>$v):
                        if($k>0):?>
                        <option value="<?=$k?>"<?php if(!empty($arrParam['userlevel']) && $arrParam['userlevel']==$k) echo ' selected'; ?>><?=$v?></option>
                        <?php endif;
                         endforeach?>
                    </select>
                    <select name="field">
                      <option value="username"<?php if(!empty($arrParam['field']) && $arrParam['field']=='username') echo ' selected';?>>用户名</option>
                      <option value="nickname"<?php if(!empty($arrParam['field']) && $arrParam['field']=='nickname') echo ' selected';?>>昵称</option>
                      <option value="name"<?php if(!empty($arrParam['field']) && $arrParam['field']=='name') echo ' selected';?>>真实姓名</option>
                      <option value="phone"<?php if(!empty($arrParam['field']) && $arrParam['field']=='phone') echo ' selected';?>>电话</option>
                    </select>
                    <input type="text" name="txtKey" value="<?=!empty($arrParam['key']) ? $arrParam['key']:'';?>">
                    <select name="fieldDate">
                      <option value="addtime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='addtime') echo ' selected';?>>创建时间</option>
                      <option value="lastlogintime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='lastlogintime') echo ' selected';?>>登录时间</option>
                    </select>
                    <input type="text" name="begdate" value="<?php if( !empty($arrParam['begdate']) ) echo $arrParam['begdate']; ?>" readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <input type="text" name="enddate" value="<?php if( !empty($arrParam['enddate']) ) echo $arrParam['enddate']; ?>" readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <select name="orderby">
                      <option value="addtime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='addtime desc') echo ' selected';?>>创建倒序</option>
                      <option value="lastlogintime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='lastlogintime desc') echo ' selected';?>>登录倒序</option>
                    </select>
                    <button type="submit" class="btn">
                  查  询</button>
                  </form>
            </td>
        </tr>
    </table>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">用户名</td>
	            <td>昵称</td>
	            <td>用户类型</td>
	            <td>级别</td>
	            <td>真实姓名</td>
	            <td>手机</td>
	            <td>性别</td>
	            <td>所在城市</td>
	            <td>推荐</td>
	            <td>操作</td> 
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><a href="/i/index/<?=$a['id']?>" target="_blank"><?php echo $a['username'];?></a></td>
				<td><?php echo $a['nickname'];?></td>
				<td><?php if(!empty($oSysUsertype[$a['usertype']])) echo $oSysUsertype[$a['usertype']];?></td>
				<td><?php if(!empty($oSysUserlevel[$a['userlevel']])) echo $oSysUserlevel[$a['userlevel']];?></td>
				<td><?php echo $a['realname'];?></td>
				<td><?php echo $a['mobile'];?></td>
				<td><?php if($a['sex']==1) echo '男'; else if($a['sex']==2) echo '女';  else echo '';?></td>
				<td><?php echo $a['city'];?></td>
				<td><?php if(!empty($a['isrecommend'])) echo '推荐';?></td>
				<td class="con_title"> 
					<a href="/admin/message/add?touserid=<?php echo _get_key_val($a['id']);?>">发消息</a>
					<a href="/admin/user/recommend?id=<?php echo _get_key_val($a['id']);?>"><?php if(empty($a['isrecommend'])) echo '推荐';else echo '不推荐';?></a>
					<a href="/admin/user/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/user/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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