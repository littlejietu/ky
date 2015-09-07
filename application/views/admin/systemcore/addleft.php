<?php include_once("right_head.php");?>
<div class="common">
    <form action="addLeft" method="post">
        <input type="hidden" name="act" value="add">
        <?php if(!empty($leftInfo)){?>
        <input type="hidden" name="id" value="<?php echo $leftInfo->sys_id?>">
        <?php }?>
    <table class="addTable">
        <tr>
            <td style="width: 30%">分类：</td>
            <td style="width: 70%"><select name="sys_partid" class="normalSelect">
                <option value="0">一级分类</option>
                <?php foreach((array)$leftList['stepFirst'] as $k => $v){?>
                    <option value="<?php echo $v->sys_id?>" <?php if($sysPartId == $v->sys_id){echo 'selected';}?> <?php if(!empty($leftInfo) && $leftInfo->sys_partid == $v->sys_id){echo 'selected';}?> ><?php echo $v->sys_name?></option>
                    <?php
                        foreach($leftList['stepSecond'] as $ka => $va){
                            if($va->sys_partid == $v->sys_id){
                    ?>
                                <option value="<?php echo $va->sys_id?>">&nbsp;&nbsp;<?php echo $va->sys_name?></option>
                    <?php }}?>
                <?php }?>

            </select></td>
            

        </tr>
        <tr>
            <td>栏目名称：</td>
            <td><input type="text" name="sys_name" value="<?php if(!empty($leftInfo)) {echo $leftInfo->sys_name;}?>" must="ture"><span class="tips">*</span></td>
      
        </tr>
        <tr>
            <td>栏目链接</td>
            <td><input type="text" name="sys_link" value="<?php if(!empty($leftInfo)) {echo $leftInfo->sys_link;}?>" must="ture"><span class="tips">*</span></td>
            
        </tr>
        <tr>
            <td>是否显示</td>
            <td><label class="right_label"><input type="radio" name="is_show" value="1" <?php if(!isset($leftInfo->is_show) or (isset($leftInfo->is_show) && $leftInfo->is_show)){echo 'checked';}?>>是</label>
                <label class="right_label"><input type="radio" name="is_show" value="0" <?php if((isset($leftInfo->is_show) && !$leftInfo->is_show)){echo 'checked';}?>>否</label></td>
           
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button type="submit" class="sub" onclick="return subForm()">提交</button></td>
            
        </tr>
    </table>
    </form>
</div>
</body>
</html>