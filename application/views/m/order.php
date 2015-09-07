<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>交易管理-个人中心-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
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
                          <h3 class="fl">我的订单</h3>
                            <div class="fr t_sosu">
                              <form action="" method="post">
                                <p class="fl sele sele_ta"><a href="?paystatus=1">待付款</a><a href="?paystatus=3">已完成</a><a href="?paystatus=2">待完成</a></p>
                                <input name="keyword" type="text" class="txt fl" value="<?php echo $keyword;?>" placeholder="请输入关键词">
                                <input name="" class="but fr" type="submit" value="搜 索">
                              </form>
                            </div>
                        </div>
                        <table class="tran_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                              <th width="120">订单编号</th>
                              <th>工作内容</th>
                              <?php if($this->loginInsID):?><th width="90">所属艺人</th><?php endif?>
                              <th width="90">总价</th>
                              <th width="90">预约时间</th>
                              <th width="90">下单时间</th>
                              <th width="80">订单状态</th>
                              <th width="150">操作</th>
                            </tr>
                            <?php foreach ($list['rows'] as $key => $a): ?>
                            <tr>
                              <td><a href="/m/order/detail?id=<?=_get_key_val($a['id'])?>"><?php echo $a['no'];?></a></td>
                              <td><div class="t_cont"><a href="/m/order/detail?id=<?=_get_key_val($a['id'])?>"><?php echo $a['title'];?></a></div></td>
                              <?php if($this->loginInsID):?><td><?php echo $a['seller_nickname'];?></td><?php endif?>
                              <td><?php echo $a['totalprice'];?></td>
                              <td><?php if($a['endtime']>$a['begtime']) echo date('m-d',$a['begtime']).'至'.date('m-d',$a['endtime']); else echo date('Y-m-d',$a['begtime']);?></td>
                              <td><?php echo date('m-d H:i:s',$a['addtime']);?></td>
                              <td><?php if($a['paystatus']=='waitpay'):?>
                                    <?php if( $a['reject']==1 ):?>
                                      <a href="/m/pay?id=<?=_get_key_val($a['id'])?>"><?php echo $oSysPaystatus[$a['paystatus']];?></a>
                                    <?php elseif( $a['reject']==-1 ):?>
                                      已过期
                                    <?php else:?>
                                      等待确认
                                    <?php endif?>
                                <?php elseif( $a['paystatus']=='payed' ):?>
                                  <?php if( $a['commentstatus']==1 ):?>
                                    <a href="/m/comment/add?orderid=<?=_get_key_val($a['id'])?>">已评价</a>
                                  <?php elseif( $a['commentstatus']==2 ):?>
                                    已互评
                                  <?php else:?>
                                    <a href="/m/comment/add?orderid=<?=_get_key_val($a['id'])?>">待评价</a>
                                  <?php endif?>
                                <?php else:?>
                                  <?php echo $oSysPaystatus[$a['paystatus']];?>
                                <?php endif?>
                              </td>
                              <td><?php if($a['sellerid']==$this->thatUser['id'] || ($this->loginInsID>0 && $a['sellerid']<>$this->loginID && $a['buyerid']<>$this->loginID ) ):?>
                                  <?php if($a['reject']==-1):?>已过期<?php elseif($a['reject']==1):?>已确认<?php else:?><a class="t_delete" href="/m/order/agree?id=<?=_get_key_val($a['id'])?>">确认</a><?php endif?>
                                  <?php if(empty($a['reject'])):?><a class="XT-modify" href="javascript:;" _val="<?=_get_key_val($a['id'])?>">编辑</a><?php endif?><a class="t_delete" href="/m/order/del?id=<?=_get_key_val($a['id'])?>">删除</a>
                                <?php endif?>
                              </td>
                            </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                    </div>

                    <div class="page">
                      <?=$list['pages']?>
                    </div>



                   
                </div>

            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
<div class="popover-mask"></div>
<div class="popover complaint addcust">
  <div class="compl_top"><span class="fl">编辑价格</span><input type="hidden" name="orderid" id="orderid" value=""><a href="javascript:;" title="关闭" class="close fr TX-win-close">×</a></div>
  <div class="compl_con">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="80"><font>订单号：</font></td>
              <td><span id="spanOrderId"></span></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td width="80"><font>工作内容：</font></td>
              <td><span id="spanTitle"></span></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td width="80"><font>价格：</font></td>
              <td><input name="price" id="price" type="text" class="txt"/></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td>&nbsp;</td>
               <td><input class="but" id="TX-save" name="" type="button" value="保存"/></td>
            </tr>
        </table>
    </div>
</div>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/order.js"></script>
</html>