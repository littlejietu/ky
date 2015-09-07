<html>
<head>
</head>

<body>

<?php echo validation_errors('<div class="error">', '</div>');?>

<form action="/m/aa/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

	标题<input type="text" name="name" value="<?php if( !empty($info['name']) ) echo $info['name']; ?>" /><br />
	内容<input type="text" name="memo" value="<?php if( !empty($info['memo']) ) echo $info['memo']; ?>" /><br />

	<input type="submit" value="提交">

</form>


</body>
</html>