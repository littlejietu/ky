<div class="introd_top">
    <div class="intopimg"><img src="<?php if(!empty($oUser['bgimg'])) echo _get_image_url($oUser['bgimg']);?>" /></div>
    <div class="intcon">
        <div class="fl col_sub">
            <div class="cs_avatar"><img src="<?=_get_userlogo_url($oUser['userlogo']);?>"/></div>
            <ul class="cs_number clearfix">
                <li><strong><?=empty($oUser['concernnum'])?0:$oUser['concernnum'];?></strong><span>关注</span></li>
                <li><strong><?=empty($oUser['fansnum'])?0:$oUser['fansnum'];?></strong> <span>粉丝</span></li>
                <li><strong><?=empty($oUser['be_ordernum'])?0:$oUser['be_ordernum'];?></strong> <span>拍片次数</span></li>
            </ul>
            <div class="cs_popul"><strong><?=empty($oUser['visitnum'])?0:$oUser['visitnum'];?></strong>人气</div>
        </div>
        <div class="fl info_wrap">
        	<div class="clearfix">
            	<div class="namebox fl"><span><?=$oUser['nickname']?></span></div>
                <div class="contact attention fl">
                    <?php if($oUser['concernstatus']>0):?>
                        <a href="javascript:;" class="atte_cur"><i class="qq atte"></i>已关注</a>
                    <?php else:?>
                        <a href="javascript:;" class="atte_cur XT-fans"><i class="qq atte"></i>未关注</a>
                    <?php endif?>
                    </div>
                <?php if(!empty($oUser['qq'])):?>
            	<div class="contact fl"><a href="##"><i class="qq"></i>联系我</a></div>
                <?php endif?>
            	<div class="tips piccon fl"><a href="##" rel="牛模网签约经纪公司" class="preview"></a></div>
            </div>
            <div class="namebox"><p><?php if($oUser['sex']) echo $oUser['sex']==1?'男':'女'?> &nbsp;&nbsp; <?=$oUser['city']?> &nbsp;&nbsp;</p></div>
        </div>
    </div>
</div>

<div class="introd_title" id="introd_title">
    <ul class="clearfix">
        <li<?php if( strpos(strtolower(uri_string()),'i/works')>-1 ) echo ' class="iton"';?>><a href="/i/works/<?=$oUser['id']?>">TA的作品（<?=empty($oUser['photonum'])?0:$oUser['photonum'];?>）</a></li>
        <li<?php if( strpos(strtolower(uri_string()),'i/index')>-1 ) echo ' class="iton"';?>><a href="/i/index/<?=$oUser['id']?>">个人信息</a></li>
        <li<?php if( strpos(strtolower(uri_string()),'i/comment')>-1 ) echo ' class="iton"';?>><a href="/i/comment/<?=$oUser['id']?>">拍摄评价（<?=empty($oUser['be_commentnum'])?0:$oUser['be_commentnum'];?>） </a></li>
        <li<?php if( strpos(strtolower(uri_string()),'i/schedule')>-1 ) echo ' class="iton"';?>><a href="/i/schedule/<?=$oUser['id']?>">档期选择</a></li>
    </ul>
</div>
<input type="hidden" name="mid" id="mid" value="<?=_get_key_val( $oUser['id'] )?>">