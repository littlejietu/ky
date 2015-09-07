<?php include_once("right_head.php");?>
<div class="common">
    <div class="ban">
        <a href="<?php echo base_url();?>admin/useraction/index">返回列表</a>
    </div>
        <table class="listTab">
            <tr>
                <td>用户名</td>
                <td>真实姓名</td>
                <td>电话</td>
                <td>E-MAIL</td>
                <td>用户级别</td>
                <td>是否锁定</td>
                <td>最后登录时间</td>
                <td>操作</td>
            </tr>
            <tr>
                <td><?php echo $userInfo->user_name?></td>
                <td><?php echo $userInfo->user_real_name?></td>
                <td><?php echo $userInfo->user_tel?></td>
                <td><?php echo $userInfo->user_email?></td>
                <td><?php
                    switch($userInfo->user_level){
                        case 0:
                            echo '网站制作者';
                            break;
                        case 1:
                            echo '超级管理员';
                            break;
                        case 2:
                            echo '网站管理员';
                            break;
                        case 3:
                            echo '渠道商';
                            break;
                        case 4:
                            echo '代理';
                            break;
                        default:
                            echo '代理';
                    }
                    ?></td>
                <td><a onclick="javascript:changeLock(this,'<?php echo $userInfo->user_id?>');" value="<?php echo ($userInfo->is_lock)?'0':'1';?>"><?php echo ($userInfo->is_lock)?'是':'否';?></a> </td>
                <td><?php echo date('Y-m-d H:i',$userInfo->last_login_time)?></td>
                <td>
                    <a href="<?php echo base_url();?>admin/useraction/addUser/edit/<?php echo $userInfo->user_id?>">编辑</a>
                    <a onclick="javascript:if(confirm('确认删除？')){delAdmin(<?php echo $userInfo->user_id?>);}">删除</a>
                    <a href="<?php echo base_url();?>admin/useraction/givePower/<?php echo $userInfo->user_id?>">分配权限</a>
                </td>
            </tr>
        </table>
        <div class="givepower">
          <p><b>权限分配：</b></p>
        <form action="givepower.php" method="post">
            <input type="hidden" name="act" value="save">
            <input type="hidden" name="userId" value="<?php echo $userId?>">

        <?php
            $powerArr = explode(',',$userInfo->user_power);
            foreach($power['stepFirst'] as $k => $v){
        ?>
            <p><input <?php if(in_array($v->sys_id,$powerArr)){echo 'checked="checked"';}?>  value="<?php echo $v->sys_id?>" type="checkbox" onchange="javascript:selectNextAll($(this));" class="noClassFirst" name="first[<?php echo $k?>]"><span><?php echo $v->sys_name?></span></p>
            <ul class="noClassSecond">
                <?php
                    foreach($power['stepSecond'] as $ka => $va){
                        if($va->sys_partid == $v->sys_id){
                ?>
                <li><input <?php if(in_array($va->sys_id,$powerArr)){echo 'checked="checked"';}?>  value="<?php echo $va->sys_id?>" onchange="javascript:selectFirst($(this));" type="checkbox" name="second[<?php echo $ka?>]"><span><?php echo $va->sys_name?></span></li>
                <?php }}?>
            </ul>
        <?php }?>
            <button type="submit" class="sub">提交</button>
        </form>
    </div>
</div>
</body>
</html>