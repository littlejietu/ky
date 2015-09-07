<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
</head>
<body>
        <!--<div class="right_notice">成都滔搏渠道，成都滔搏仓渠道-从4月4日起超过13点钟禁止取消订单，请知悉！！！</div>-->
        <div class="right_con">
            <h1>公告信息</h1>
            <table cellpadding="0" cellspacing="0" bordercolor="#eee" border="1" width="100%">
                <tr height="39" style="font-size:13px;">
                    <td width="139" height="25" align="center">日期</td>
                    <td align="left" class="p60">标题</td>
                </tr>

                <?php foreach((array)$noticeList as $v) {?>
                <tr>
                        <td width="139" height="25" align="center"><?php echo date('Y-m-d H:i:s',$v->last_update)?></td>
                        <td align="left" class="con_title"><a href="<?php echo base_url('articleaction/detail/'.$v->art_id);?>"><?php echo $v->art_title?></a><span>【重要】</span><strong><?php echo ($v->is_read)?'已':'未';?>读</strong></td>
                </tr>
                <?php }?>
                <tr>
                    <td colspan="2" height="32" align="right">
                        <div class="page">
                            <?php echo $pageHtml;?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
</body>
</html>

