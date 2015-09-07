<html>
<head>
</head>

<body>
<a href='/m/aa/add'>添加</a><br /><br />


<table>
	<tr>
	
	<td>标题</td>
	<td>内容</td>
	<td>时间</td>
</tr>
<?php foreach ($list['rows'] as $key => $a): ?>
<tr>
	
	<td><?php echo $a['name'];?></td>
	<td><?php echo $a['memo'];?></td>
	<td><?php echo date('Y-m-d H:i:s',$a['addtime']);?></td>
	<td><a href="/m/aa/add?id=<?php echo _get_key_val($a['id']);?>">修改</a></td>
</tr>
<?php endforeach;?>
</table>

</body>
</html>