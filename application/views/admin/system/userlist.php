<?php include_once("right_head.php");?>
<div class="common">
    <div class="goodsTitle">
        <a href="addUser" class="topBtn">添加</a>
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td width="5%">用户名</td>
            <td width="5%">真实姓名</td>
            <td width="10%">电话</td>
            <td width="10%">E-MAIL</td>
            <td width="10%">用户级别</td>
            <td width="30%">用户权限</td>
            <td width="5%">是否锁定</td>
            <td width="10%">最后登录时间</td>
            <td width="15%">操作</td>
        </tr>
        <?php foreach($userList as $value){?>
        <tr height="30">
            <td><?php echo $value->user_name?></td>
            <td><?php echo $value->user_real_name?></td>
            <td><?php echo $value->user_tel?></td>
            <td><?php echo $value->user_email?></td>
            <td><?php
                switch($value->user_level){
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
                        echo '代理1';
                        break;
                    case 5:
                        echo '代理2';
                        break;
                    case 6:
                        echo '代理3';
                        break;
                    case 7:
                        echo '代理4';
                        break;
                    case 8:
                        echo '代理5';
                        break;
                    default:
                        echo '代理';
                }
            ?></td>
            <td><?php echo $value->user_power?></td>
            <td><a onclick="javascript:changeLock(this,'<?php echo $value->user_id?>');" value="<?php echo ($value->is_lock)?'0':'1';?>"><?php echo ($value->is_lock)?'是':'否';?></a> </td>
            <td><?php echo date('Y-m-d H:i',$value->last_login_time)?></td>
            <td>
                <a href="<?php echo base_url();?>admin/useraction/addUser/edit/<?php echo $value->user_id?>">编辑</a><span class="caozuo_line">|</span>
                <a onclick="javascript:if(confirm('确认删除？')){delAdmin(<?php echo $value->user_id?>);}">删除</a><span class="caozuo_line">|</span>
                <a href="<?php echo base_url();?>admin/useraction/givePower/<?php echo $value->user_id?>">分配权限</a>
            </td>
        </tr>
        <?php }?>
    </table>

</div>
</body>
</html>