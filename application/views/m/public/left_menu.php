<div class="fl uc_menu">
    <div class="menu_head">
        <a class="m_himg" href="/m/">
            <img src="<?php echo _get_userlogo_url($this->thatUser['userlogo'])?>"/>
            <div class="head_bj"></div>
        </a>
        <h3 class="m_name"><a href="/i/index/<?=$this->thatUser['id']?>" target="_blank"><?=$this->thatUser['nickname']?></a></h3>
        <p class="m_prompt">
            <?php $agentUser = $this->cache->get('agentUser');
                if(!empty($agentUser)):?>
                <a href="/m/model/exitagt?modelid=<?=_get_key_val($agentUser['id'])?>">退出代理</a>
            <?php endif?>
            <?=_get_timehello();?>
        </p>
    </div>
    <div class="menu_box">
        <ul>
        <?php if(in_array($this->thatUser['usertype'],array(1,4,5)) ):?>
            <li<?php if( strtolower(uri_string())=='m/schedule' ) echo ' class="current"';?>><a href="/m/schedule">档期管理<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/fans' ) echo ' class="current"';?>><a href="/m/fans">互动总览<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/info' ) echo ' class="current"';?>><a href="/m/info">个人资料<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/product' ) echo ' class="current"';?>><a href="/m/product">工作价格<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/cert' ) echo ' class="current"';?>><a href="/m/cert">我的认证<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/works' ) echo ' class="current"';?>><a href="/m/works">作品管理<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/order' ) echo ' class="current"';?>><a href="/m/order">交易管理<?php if($this->loginUserNum):?><span class="o_mete"><?php echo $this->loginUserNum['be_ordernum_new'];?></span><?php endif?><i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/account' ) echo ' class="current"';?>><a href="/m/fund">资金账户<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/comment' ) echo ' class="current"';?>><a href="/m/comment">评论管理<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/client' ) echo ' class="current"';?>><a href="/m/client">客户管理<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/message' ) echo ' class="current"';?>><a href="/m/message">系统消息<i></i></a></li>

        <?php else:?>
            <li<?php if( strtolower(uri_string())=='m/model' || $this->input->get('agid') ) echo ' class="current"';?>><a href="/m/model">艺人管理<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/fans' ) echo ' class="current"';?>><a href="/m/fans">互动总览<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/info' && !$this->input->get('agid') ) echo ' class="current"';?>><a href="/m/info">机构资料<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/cert' ) echo ' class="current"';?>><a href="/m/cert">机构认证<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/order' ) echo ' class="current"';?>><a href="/m/order">交易管理<?php if($this->loginUserNum):?><span class="o_mete"><?php echo $this->loginUserNum['be_ordernum_new'];?></span><?php endif?><i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/comment' ) echo ' class="current"';?>><a href="/m/comment">评论管理<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/client' ) echo ' class="current"';?>><a href="/m/client">客户管理<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/message' ) echo ' class="current"';?>><a href="/m/message">系统消息<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/activity' ) echo ' class="current"';?>><a href="/m/activity">机构通告<i></i></a></li>
        <?php endif?>
        </ul>
    </div>
    <div class="m_level">
        <h3 class="clearfix ml_bti"><font class="fl">账户安全级别：</font><em class="fr">
            <?php $str_safety = '低';
             switch ($this->loginUser['safety']) {
                case 1:
                    $str_safety = '低';
                    break;
                case 2:
                    $str_safety = '中';
                    break;
                case 3:
                    $str_safety = '高';
                    break;
                
                default:
                    # code...
                    break;
            }?><?=$str_safety?></em></h3>
        <div class="level"><span class="rating_<?=$this->loginUser['safety']?>"></span></div>
    </div>
</div>