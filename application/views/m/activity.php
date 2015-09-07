<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>机构通告-个人中心-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>
<div class="mainbody" id="mainbody">
    <div class="container mrgB30">
        <div class="member clearfix">
            <?php include_once(VIEWPATH."m/public/left_menu.php");?>
            <div class="fr uc_content">
            	<?php include_once(VIEWPATH."m/public/notice.php");?>

              <div class="clearfix uitopg">
                    <div class="authent">
                        <div class="aut_bti clearfix"><h3 class="fl">机构通告</h3>
                          <a class="fr addto" href="/m/activity/add"><i></i>发布通告</a>
                        </div>
                        <div class="ne_con ne_con_list">
                            <ul class="clearfix">
                                <?php foreach ($list['rows'] as $key => $a): ?>  
                                <li>
                                    <a class="picimg" href="/m/activity/add?id=<?=_get_key_val($a['id'])?>">
                                        <img src="<?=_get_image_url($a['img']);?>"/>
                                        <div class="notl_hover">
                                            <p>工作时间： <?=date('Y-m-d',$a['begtime'])?>       工作地点： <?=$a['place']?>        名额： <?=$a['actnum']?>名</p>
                                            <p>面试地点： <?=$a['address']?></p>
                                            <p>工作内容： <?=$a['summary']?>       报名截止： <?=$a['inendtime']?></p>
                                        </div>
                                    </a>
                                    <div class="clearfix">
                                        <p class="fl nebti nebti_1"> <?=$a['title']?></p>
                                        <p class="fr nebti nebti_2"><em onclick="window.location.href='/m/activity/enterlist?aid=<?=$a['id']?>'"> <?=($a['innumfake']+$a['innum'])?>人 报名</em></p>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                

            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>

</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/activity.js"></script>
<style>.ne_con li a.picimg{position:relative;}.notl_hover{background:url(../model/images/women_b.png) repeat center center;position:absolute;bottom:0;left:0;right:0;color:#fff;font-size:13px;padding:15px 20px;line-height:22px;}.ne_con_list li{width:415px;height:270px;margin:0 15px 10px 0;}.ne_con_list li a.picimg,.ne_con_list li a.picimg img{width:415px;height:228px;}.nebti_1,.nebti_2{margin-top:0;}.nebti_1{width:280px;}.nebti_2{width:120px;}.nebti_2 em{border:none;line-height:35px;cursor:pointer;}</style>

</html>