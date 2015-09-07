<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>广告管理</h1>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td height="32">
                <form class="form-horizontal" role="form" method="post">
<?php //print_r($ad_placeList);?>
                    <select name="ad_place">
                        <option value="">广告位</option>
                        <?php foreach ($ad_placeList as $k=>$v):?>
                        <option value="<?=$v['id']?>"<?php if(!empty($arrParam['ad_place']) && $arrParam['ad_place']==$k) echo ' selected'; ?>><?=$v['title']?></option>
                        <?php endforeach?>
                    </select>
                    
                    <select name="field">
                      <option value="title"<?php if(!empty($arrParam['field']) && $arrParam['field']=='title') echo ' selected';?>>广告名称</option>
                      <option value="adcode"<?php if(!empty($arrParam['field']) && $arrParam['field']=='adcode') echo ' selected';?>>广告代码</option>
                      <option value="summary"<?php if(!empty($arrParam['field']) && $arrParam['field']=='summary') echo ' selected';?>>简介</option>
                      
                    </select>
                    <input type="text" name="txtKey" value="<?=!empty($arrParam['key']) ? $arrParam['key']:'';?>" class="w150">
                    <select name="fieldDate">
                      <option value="begtime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='begtime') echo ' selected';?>>开始时间</option>
                      <option value="endtime"<?php if(!empty($arrParam['fieldDate']) && $arrParam['fieldDate']=='endtime') echo ' selected';?>>结束时间</option>
                    </select>

                    <input type="text" name="begtime" class="w100" value="<?php if( !empty($arrParam['begtime']) ) echo $arrParam['begtime']; ?>"  readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <input type="text" name="endtime" class="w100" value="<?php if( !empty($arrParam['endtime']) ) echo $arrParam['endtime']; ?>" readonly="readonly" onclick="WdatePicker()" placeholder="请选择日期">
                    <select name="orderby">
                      <option value="begtime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='begtime desc') echo ' selected';?>>开始时间倒序</option>
                      <option value="endtime desc"<?php if(!empty($arrParam['orderby']) && $arrParam['orderby']=='endtime desc') echo ' selected';?>>结束时间倒序</option>
                    </select>
                    <button type="submit" class="btn">查  询</button>
                  	
                  </form>
            </td>
            <td><a href='/admin/ad/add' class="sub">添加</a></td>
        </tr>
    </table>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">广告名称</td>
	            <td>广告位</td>
	            <td>图片地址</td>           
           		<td>金额</td>
	            <td>开始时间</td>
	            <td>结束时间</td>
	            <td>排序</td>
	            <td>显示</td>	            	           
	            <td>最后操作人</td>
	            <td>最后操作时间</td>
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><a href="<?php echo $a['url'];?>" target="_blank"><?php echo $a['title'];?></a></td>
				<td><?php echo $a['placeid'];?></td>
				<td><img src="<?php echo _get_image_url($a['img']);?>" width="150"></td>
				<td><?php echo $a['price'];?></td>								
				<td><?php echo $a['begtime'];?></td>
				<td><?php echo $a['endtime'];?></td>
				<td><?php echo $a['sort'];?></td>
				<td><?php if($a['display']==1) echo '显示'; else if($a['display']==2) echo '不显示';  else echo '';?></td>								
				<td><?php echo $a['op_username'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['op_time']);?></td>
				<td class="con_title">
					<a href="/admin/ad/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/ad/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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