
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人主页-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="<?php echo _get_cfg_path('js')?>DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>
<div class="mainbody" id="mainbody">
	<div class="introd container">
        
<?php include_once(VIEWPATH."i/public/top.php");?>  
<div class="schedule clearfix">
            <div class="clearfix">
                <div class="time_top">
                    <form action="" method="post">
                        <input type="hidden" name="y" id="y" value="<?=$YM['y']?>">
                        <input type="hidden" name="m" id="m" value="<?=$YM['m']?>">
                        <div class="time">
                            <span id="total_nian"><?=$YM['y']?>.</span><span id="total_yue"><?=$YM['m']?></span>
                        </div>
                        <div class="nianyue fr">
                            <div class="time_select" id="nian"><?=$YM['y']?>年</div>
                            <div class="time_select_click"><i></i></div>
                            <div class="select" id="nianfen" style="display: none;">
                                <ul>
                                  <?php $thatY = date("Y",$oUser['addtime']);
                                   for($i=(date("Y")+1);$i>( $thatY>(date("Y")-9)?$thatY:(date("Y")-9) );$i--){?>
                                  <li><?=$i?>年</li>
                                  <?php }?>
                                </ul>
                            </div>
                            <div class="time_select" id="yue"><?=$YM['m']?>月</div>
                            <div class="time_select_click"><i></i></div>
                            <div class="select" id="yuefen">
                                <ul>
                                  <li>01月</li>
                                  <li>02月</li>
                                  <li>03月</li>
                                  <li>04月</li>
                                  <li>05月</li>
                                  <li>06月</li>
                                  <li>07月</li>
                                  <li>08月</li>
                                  <li>09月</li>
                                  <li>10月</li>
                                  <li>11月</li>
                                  <li>12月</li>
                                </ul>
                            </div>
                        </div>
                        <!--nianyue-->
                        <button type="submit" class="time_select_button" style="display:none;"></button>
                    </form>
                </div>
            </div>
            <div class="piao_list">
                <div class="piao_con_tit">
                    <ul>
                        <li>星期日</li>
                        <li>星期一</li>
                        <li>星期二</li>
                        <li>星期三</li>
                        <li>星期四</li>
                        <li>星期五</li>
                        <li>星期六</li>
                    </ul>
                </div>

                <?php
                        
            $now_year=$YM['y'];//取得年份
            $now_mondy=$YM['m'];//取得月份
            $now_date=$now_year.'-'.$now_mondy;
            if($now_mondy==02){
              if($now_year%4==0 && $now_year%100!=0){$mondy_total=28;}
              elseif($now_year%100==0 && $now_year%400==0){$mondy_total=28;}
              else{$mondy_total=29;}
            }
            elseif($now_mondy==01||$now_mondy==03||$now_mondy==05||$now_mondy==07||$now_mondy==08||$now_mondy==10||$now_mondy==12){$mondy_total=31;}//取得月份中的日起数
            else{$mondy_total=30;}
              $date_first=date("w",strtotime($now_date."-01"));//第一天的日期
            if(($date_first>4&&$mondy_total==31)||($date_first>5&&$mondy_total==30)){$total_num=42;}
            else{$total_num=35;}//判断总共有多少个显示日期的格子
                    ?>
                    <div class="piao_con">
                      <div style="float:left;width:740px; margin-top:1px;display:none"></div>
                      <?php 
            for($i=0;$i<$total_num;$i++){
              $the_date=$YM['y'].'-'.str_pad($YM['m'],2,"0",STR_PAD_LEFT).'-'.str_pad(($i-$date_first+1),2,"0",STR_PAD_LEFT);//得到完整日期
              if($i%7==0)
                   echo '<div class="con_day">';
              ?>
                <?php $arrItem = array('class'=>'','title'=>'','dayno'=>'','date'=>'');
                  if($i%2==1)
                    $arrItem['class'] = ' bg_day';

                  if($i>=$date_first && $i-$date_first<$mondy_total)
                    $arrItem['dayno']='<p class="d_number">'.($i-$date_first+1).'</p>';

                  $tmp_title='';
                  //已有预约
                  foreach ($list['rows'] as $key => $a) {
                      if(strtotime($the_date) == strtotime(date('Y-m-d',$a['datetime'])))
                      {

                        $HI = '';
                        if( $a['endtime']>$a['datetime'] &&   $a['endtime']-$a['datetime'] <24*60*60 )
                        {
                          $HI =date('H:i',$a['datetime']);
                          $HI .='-'.date('H:i',$a['endtime']);
                        }
                        $title = $a['title'];//strlen($a['title'])<=30 ? $a['title'] : substr($a['title'],0,30).'..';
                        $tmp_title.='<p class="arr_con">'.$title.'<i>'.$HI.'</i></p>';
                      }
                  }
                  if(!empty($tmp_title)){
                    $arrItem['class'].=' teba_kan';
                    $arrItem['title']='<div class="arrang">'.$tmp_title.'</div>';
                  }
                  else if(!empty($arrItem['dayno']) && strtotime($the_date)>time())
                  {
                    $arrItem['class'].=' d_reser';
                    $arrItem['title']='<i class="res_b"></i><p class="res_zi">有空哦，快来预约</p>';
                    $arrItem['date']=' _date='.$the_date;
                  }
                ?>
                        
                          
                      <div class="day<?=$arrItem['class']?>"<?=$arrItem['date']?>>
                        <?=$arrItem['dayno']?>
                        <?=$arrItem['title']?>
                      </div>

                <?php
                if($i%7==6)
                  echo '</div>';
            }
            ?>
                 
                </div>

            </div>
        </div>
      
    </div>
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>

<div id="share">
	<a id="totop" title="" href="javascript:void(0);">返回顶部</a>
</div>


<div class="popover-mask"></div>
<div class="popover">
  <div class="poptit"> <a href="javascript:;" title="关闭" class="close">×</a></div>
  <div class="popbod">
    <div class="fl popimg"><img src="<?php echo _get_cfg_path('images')?>mt_12.jpg"/></div>
      <div class="fr poptab">
        <form id="xtform" method="post" action="/i/schedule/book">
          <input type="hidden" name="booked_userid" value="<?=_get_key_val($oUser['id'])?>" />
          <input type="hidden" name="begtime" id="begtime" value=""/>
          <input type="hidden" name="price" id="price" value=""/>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="80"><font>价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 格：</font></td>
                  <td><span class="moneysign"></span> <em class="money price">面议</em></td>
                </tr>
                <tr>
                  <td><font>工作内容：</font></td>
                  <td>
                    <select name="item" id="item" class="txt sele">
                        <?php foreach ($oItemList as $k => $v):?>
                        <option value="<?=$k?>"><?=$v?></option>
                        <?php endforeach;?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><font>工作场景：</font></td>
                  <td>
                     <div class="clearfix scene XT-Scene">
                        <?php foreach ($oSceneList as $k => $v):?>
                         <a href="javascript:;" onclick="filt(this)" name="<?=$k?>"><?=$v?></a>
                        <?php endforeach;?>
                        <input name="scene" id="scene" value="0" type="hidden">
                     </div> 
                  </td>
                </tr>
                <tr>
                  <td><font>计价方式：</font></td>
                  <td>
                      <div class="clearfix scene XT-Time">
                        <?php foreach ($oTimeList as $k => $v):?>
                          <a href="javascript:;" onclick="filt(this)" name="<?=$k?>"><?=$v?></a>
                        <?php endforeach;?>
                        <input name="time" id="time" value="0" type="hidden">
                      </div>
                  </td>
                </tr>
                <tr>
                  <td><font>数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 量：</font></td>
                  <td>
                    <div class="i_tips" style="display:none"></div>
                    <div class="i_box">
                        <a href="javascript:;" class="J_minus">-</a>
                        <input type="text" value="1" class="J_input" name="num" id="num" />
                        <a href="javascript:;" class="J_add">+</a>
                    </div>
                  </td>
                </tr>
                <tr>
                   <td valign="top"><font>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 注：</font></td>
                   <td><textarea class="txt text" name="" cols="" rows=""></textarea></td>
                </tr>
                <tr>
                  <td><font>拍片日期：</font></td>
                  <td><span id="photo_date"></span></td>
                </tr>
                <tr><td colspan="2"><p class="line"></p></td></tr>
                <tr>
                  <td><font>联&nbsp;系&nbsp;&nbsp;人：</font></td>
                  <td><input class="txt" name="linkman" id="linkman" type="text" value="<?php if($this->loginID>0) echo $this->loginNickName;?>"/></td>
                </tr>
                <tr>
                  <td><font>联系方式：</font></td>
                  <td><input class="txt" name="linkway" id="linkway" type="text" value="<?php if($this->loginUser) echo $this->loginUser['mobile'];?>"/></td>
                </tr>
                <tr><td height="25" colspan="2" id="err-message" class="main_color"></td></tr>
                <tr>
                   <td colspan="2"><input class="but" name="" id="XT-Book" type="button" value="立即下单"/></td>
                </tr>
            </table>
          </form>
        </div>
  </div>
  <script type="text/javascript">
  var arrProduct = new Array();
  <?php $i = 0;
   foreach ($oProductList as $k => $v):
      $i++;?>
    arrProduct[<?=$i?>]=["<?=$k?>","<?=$v?>"];
  <?php endforeach;?>

  var arrIST = new Array();
  <?php foreach ($oItem_Scene_Time as $k => $a):

          $tmp=''; 
          foreach($a as $kk=>$aa){
            $time_list='';
            foreach ($aa['time_list'] as $kkk => $aaa) {
              $time_list.='{k:'.$kkk.',name:"'.$aaa.'"},';
            }
            $time_list=trim($time_list,',');
            $tmp.='{k:'.$aa['scene_key'].',name:"'.$aa['scene_name'].'",tim:['.$time_list.']},';
          }
          $tmp=trim($tmp,',');
    ?>
    arrIST[<?=$k?>]=[<?=$tmp;?>];
  <?php endforeach;?>
  </script>
</div>
</body>

<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/i/schedule.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>main.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.form.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>Quantity.js"></script>

</html>