<div class="head_top">
	<div class="container">
    	<p class="fl htop_fl">
    	<?php if($this->loginID):?>
    		Hi,<a href="/m/"><i><?=$this->loginNickName;?></i></a> <a href="/user/login/out">[<i>退出</i>]</a>
    	<?php else:?>
    		Hi,~<a href="/user/login">[<i>请登录</i>]</a> <a href="/reg">[<i>免费注册</i>]</a>
    	<?php endif?>
    	</p>   
        <div class="fr htop_fr">
        <?php if($this->loginID):?>
            <a class="h_sche" href="/m/schedule/"><i></i>档期管理</a>
            <a class="h_orde" href="/m/order">我的订单(<i><?php if(!empty($this->loginUserNum)) echo $this->loginUserNum['be_ordernum_new'];else echo '0';?></i>)</a>
            <a class="h_drop" href="##">下拉</a>
        <?php endif?>
        </div>
    </div>
</div>

<?php include_once(VIEWPATH."public/header_menu.php");?>
