<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>资金帐户-个人中心-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="<?php echo _get_cfg_path('js')?>DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>
<div class="mainbody" id="mainbody">
    <div class="container mrgB30">
        <div class="member clearfix">
            <?php include_once(VIEWPATH."m/public/left_menu.php");?>
            <div class="fr uc_content">
            	<?php include_once(VIEWPATH."m/public/notice.php");?>
                <div class="clearfix uitopg">
                    <div class="transa">
                        <div class="aut_bti clearfix">
                            <h3 class="fl">资金账户</h3>
                            <div class="fr t_sosu">
                              <form action="/m/fund" method="post">
                                <p class="fl sele sele_ta"><a href="/m/order?paystatus=1">待付款</a><a href="/m/order?paystatus=3">已完成</a><a href="/m/order?paystatus=2">待完成</a></p>
                                <input name="keyword" type="text" class="txt fl" value="<?php echo $keyword;?>" placeholder="请输入关键词">
                                <input name="" class="but fr" type="submit" value="搜 索">
                              </form>
                            </div>
                        </div>
                        <div class="brotop clearfix fund_brot">
                            <div class="fl broad"><p class="b_pti">本月总订单数</p><span class="b_num"><em><?=$o['be_ordernum_m']?></em> <a href="/m/order">查看</a></span></div>
                            <div class="fl broad b_gain"><p class="b_pti">本月收益总额</p><span class="b_num"><em><?=$o['be_fund_m']?></em> </span></div>
                            <div class="fl aut_tab"><form action="?" method="post"><input name="account" type="text" class="txt fl" value="<?php echo $o['account'];?>" placeholder="请输入银行/支付宝帐户"><input type="submit" class="but" value="提交"></form></div>
                        </div>
                        <div class="fund_list">
                            <div class="dl_title">正在交易中 （<?=count($list['rows'])?>）</div>
                            <ul class="fund_uli">
                                <?php foreach ($list['rows'] as $key => $a): ?>
                                <li>
                                    <div class="fl">
                                        <p><i><?=$a['no'];?></i>   <em><?=$a['title'];?></em></p>
                                        <p><strong>预约时间： <?=date('Y-m-d',$a['begtime'])?></strong>    <strong>下单时间： <?=date('Y-m-d H:i:s',$a['addtime'])?></strong></p>
                                    </div>
                                    <span class="fr">已付款</span>
                                </li>
                                <?php endforeach;?>
                            </ul>
                            <div class="page">
                              <?=$list['pages']?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
</html>