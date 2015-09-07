<?php $sysMsgList = $this->cache->get('sysMsgList');
 if(!empty($sysMsgList)):?>
<div class="txtScroll-top help_notice">
    <div class="bd">
        <span class="not_ico"></span>
        <ul class="infoList">
        	<?php foreach ($sysMsgList as $key => $a):?>
            	<li><a href="/m/message/detail/<?=$a['id']?>"><?=$a['title']?></a></li>
        	<?php endforeach;?>
        </ul>
    </div>
    <div class="close" onclick="helpClose(this)">关闭</div>
</div>
<?php endif?>