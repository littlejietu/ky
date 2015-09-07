<div class="header">
    <div class="container clearfix">
       <div class="fl logo"><a href="/" title="返回首页"><img alt="牛模网logo" src="<?php echo _get_cfg_path('images')?>logo.png" height="30"/></a></div>
       <div class="fr nav">
          <ul class="clearfix">
             <li>
                <a class="" href="/model">
                    <p>
                        <span class="navimg"><img alt="模特" src="<?php echo _get_cfg_path('images')?>nav_1.jpg" height="16"/></span>
                        <span class="navzi">模特</span>
                    </p>
                </a>
             </li>
             <li>
                 <a<?php if( strtolower(uri_string())=='ins' ) echo ' class="nav_on"';?> href="/ins">
                    <p>
                         <span class="navimg"><img alt="机构" src="<?php echo _get_cfg_path('images')?>nav_2.jpg" height="16"/></span>
                         <span class="navzi">机构</span>
                     </p>
                 </a>
             </li>
             <li>
                 <a<?php if( strtolower(uri_string())=='act' ) echo ' class="nav_on"';?> href="/act">
                    <p>
                        <span class="navimg"><img alt="通告" src="<?php echo _get_cfg_path('images')?>nav_3.jpg" height="16"/></span>
                        <span class="navzi">通告</span>
                    </p>
                 </a>
             </li>
             
             <li class="nav_search">
                <a href="/search" title="搜索"><img alt="搜索" src="<?php echo _get_cfg_path('images')?>nsos.jpg" height="20"/></a>
             </li>
          </ul>
       </div>
    </div>
    <div class="header_bg"></div>
</div><!--header-->