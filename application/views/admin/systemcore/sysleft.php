<?php include_once("right_head.php");?>
<div class="common">
    <?php if( $userLevel < 1){?>
    <div class="goodsTitle"><a href="<?php echo base_url()?>admin/indexaction/addLeft" class="topBtn">添加栏目</a></div>
    <?php }?>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
       <tr height="39" style="font-size:13px;">
            <td style="width: 5%">编号</td>
            <td style="width: 30%">栏目名称</td>
            <td style="width: 5%">排序</td>
            <?php if( $userLevel < 2){?>
            <td style="width: 60%">操作</td>
            <?php }?>
        </tr>
        <?php foreach((array)$myLeft['stepFirst'] as $k => $v){?>
        <tr height="30">
            <td align="left" style="padding:0 0 0 10px;"><?php echo $v->sys_id?></td>
            <td align="left" style="padding:0 0 0 100px;"><?php echo $v->sys_name?></td>
            <td><input onchange="javascript:changeSequence($(this).val(), <?php echo $v->sys_id?>);" value="<?php echo $v->sequence?>" class="normalText" style="width:40px;height:25px;margin:0 20px;"/></td>
            <?php if( $userLevel < 1){?>
            <td><a href="<?php echo base_url()?>admin/indexaction/addLeft/id/<?php echo $v->sys_id?>">编辑</a><span class="caozuo_line">|</span>&nbsp;&nbsp;<a style="cursor: pointer" onclick="javascript:if(confirm('删除当前栏目将导致当前栏目下子栏目完全删除，确认删除？')){delLeft(<?php echo $v->sys_id?>);}">删除</a></td>
            <?php }?>
        </tr>
            <?php
            foreach($myLeft['stepSecond'] as $ka => $va){
                if($va->sys_partid == $v->sys_id){
            ?>
        <tr height="30">
            <td align="left" style="padding:0 0 0 10px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $va->sys_id?></td>
            <td align="left" style="padding:0 0 0 100px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $va->sys_name?></td>
            <td><input onfocus="javascript:if($(this).val() == 0){$(this).val('');}" onblur="javascript:if($(this).val() == ''){$(this).val(0);}" onchange="javascript:changeSequence($(this).val(), <?php echo $va->sys_id?>);" value="<?php echo $va->sequence?>" class="normalText" style="width:40px;height:25px;margin:0 20px;"/></td>
            <?php if( $userLevel < 2){?>
            <td><a href="<?php echo base_url()?>admin/indexaction/addLeft/add/<?php echo $va->sys_id?>">编辑</a><span class="caozuo_line">|</span>&nbsp;&nbsp;<a style="cursor: pointer" onclick="javascript:if(confirm('删除当前栏目将导致当前栏目下子栏目完全删除，确认删除？')){delLeft(<?php echo $va->sys_id?>);}">删除</a></td>
            <?php }?>
        </tr>
            <?php }}?>
        <?php }?>
    </table>
</div>
</body>
</html>