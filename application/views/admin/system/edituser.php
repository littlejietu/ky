<?php include_once("right_head.php");?>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url();?>admin/useraction/index" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
      <table class="addTable" >
        <tr>
          <td align="right">用户名：</td><td><input id="username" value="<?php echo $userInfo->user_name?>" must="ture"  class="normalText"/><span class="tips">*</span></td>
          <td align="right">邮箱：</td><td><input id="email" value="<?php echo $userInfo->user_email?>" class="normalText"/></td>
        </tr>
        <tr>
          <td align="right">密码：</td><td><input type="password" id="userpassword" must="ture" class="normalText"/><span class="tips">*</span></td>
          <td align="right">重复密码：</td><td><input type="password" id="userpasswordreset" must="ture" class="normalText"/><span class="tips">*</span></td>
        </tr>
        <tr>
          <td align="right">手机：</td><td><input id="tel" value="<?php echo $userInfo->user_tel?>" class="normalText"/></td>
          <td align="right">真实姓名：</td><td><input id="realname" value="<?php echo $userInfo->user_real_name?>" class="normalText"/></td>
        </tr>
        <tr>
          <td valign="top" align="right">级别：</td>
          <td colspan="3">
            <label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="1" <?php if($userInfo->user_level==1){echo 'checked ="checked"';}?>>超级管理员</label>
            <label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="2" <?php if($userInfo->user_level==2){echo 'checked ="checked"';}?>>普通管理员</label>
            <label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="3" <?php if($userInfo->user_level==3){echo 'checked ="checked"';}?>>渠道商</label>
          </td>
        </tr>
        <tr>
          <td></td>
          <td colspan="3"><span class="sub" onClick="return subForm(editUser(<?php echo $userInfo->user_id?>,'<?php echo base_url()?>'));" style=" text-align: center">提&nbsp;&nbsp;交</span></td>
        </tr>
      </table>
    </div>

</div>
</body>
</html>