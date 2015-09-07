<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>客户管理-个人中心-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>
<div class="mainbody" id="mainbody">
	<div class="container">
        <?php if($o['reject']==1):?>
        <div class="pay_title">提交订单</div>
        <div id="subOrder">
            <div class="subOrder">
            <form action="/public/pay/done" method="post">
            	<input type="hidden" name="orderid" value="<?=_get_key_val($o['id'])?>" />
            	<input type="hidden" name="orderno" value="<?=$o['no']?>" />
                <div class="subOrder1">
                    <h1>订单提交成功！还差一步，请继续完成在线支付！</h1>
                    <p>订单号：<span><?=$o['no']?></span> </p>
                    <p>订单查询：您可通过“<a href="/m">会员中心</a>”>>“<a href="/m/order">我的订单</a>”查询您的订单状态。</p>
                </div>
                <div class="subOrder2"><input name="radio" type="radio" value="" class="radio" /><img src="<?php echo _get_cfg_path('images')?>pay_1.jpg" /><p>支付￥<span><?=$o['totalprice']?></span></p></div>
                <div class="subOrder2"><input name="radio" type="radio" value="" class="radio"/><img src="<?php echo _get_cfg_path('images')?>pay_2.jpg" /><i>（推荐）</i><p>支付￥<span><?=$o['totalprice']?></span></p></div>
                <div class="subOrder3"><input type="submit" class="but zf-btn"value="确认支付"/></div>
            </form>
            </div>
        </div>
        <?php else:?>
            <div class="pay_title">请先得到对方的同意</div>
        <?php endif?>
    </div>
</div>
<?php include_once(VIEWPATH."public/footer.php");?>

</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script>
/* 付款提交 */
$('.subOrder2').bind('click',function() {
	//$('input:radio').eq[0].removeAttr("checked");
	$('.subOrder2').css('background','url(<?php echo _get_cfg_path("images")?>brand.jpg) no-repeat');
	$('.subOrder2 p').hide();
	$('input:radio').val('');
	$('input:radio',this).val('text');
	$.each($("input[name='radio']"),function(){
		if($(this).val() =="text")
		{
			$(this).attr("checked","checked");
		}
	});
	   
	$(this).css('background','url(<?php echo _get_cfg_path("images")?>branda.jpg) no-repeat');
	$('p',this).show();
});
</script>
</html>