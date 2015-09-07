<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>广告位管理</h1>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
                    
                    
                    <select name="field">
                      <option value="title"<?php if(!empty($arrParam['field']) && $arrParam['field']=='title') echo ' selected';?>>广告位名称</option>
                      <option value="adcode"<?php if(!empty($arrParam['field']) && $arrParam['field']=='adcode') echo ' selected';?>>广告代码</option>
                    </select>

                    <input type="text" name="txtKey" value="<?=!empty($arrParam['key']) ? $arrParam['key']:'';?>" class="w150">
                   
                   
                    <button type="submit" class="btn">查  询</button>
                  	
                  </form>
            </td>
            <td><a href='/admin/ad_place/add' class="sub">添加</a></td>
        </tr>
    </table>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">广告位名称</td>
	            <td>广告代码</td>
	            <td>尺寸单位</td>
	            <td>是否停用</td>	            
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['title'];?></td>
				<td><?php echo $a['adcode'];?></td>
				<td><?php echo $a['size'];?></td>
				<td><?php if($a['status']==1) echo '使用'; else if($a['status']==-1) echo '停用';  else echo '';?></td>				
				<td class="con_title">
					<a href="/admin/ad_place/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/ad_place/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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

</body>
</html>