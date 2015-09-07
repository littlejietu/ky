                            <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0" id="tb-XT-info-base">
                              <tr>
                                <td width="86"><span class="tips">*</span>艺  名</td>
                                <td colspan="3">
                                  <?php if(!empty($o['nickname'])) 
                                          echo $o['nickname']; 
                                        else
                                          echo '<input name="nickname" type="text" class="txt" placeholder="请输入昵称"/>';

                                  ?>
                                  <?php //echo form_error('nickname');?>
                                  </td>
                              </tr>
                              <tr>
                                <td width="86">头  像</td>
                                <td colspan="3">
                                    <div id="previews" class="drsMoveHandle">
                                   	    <img id="show_userlogo" border=0 src='<?php echo $o['userlogo']? '/'.trim($o['userlogo'],'/') : _get_cfg_path('images').'imghead.jpg';?>'>
                                    </div>
                                    <div class="f_note">
                                        <p>尺寸：180×180像数</p>
                                        <input type="hidden"  name="userlogo" id="userlogo" value="<?=$o['userlogo']?>">
                                        <em><i class="icoPro16"></i>支持JPG,PNG，上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="userlogo_upload" name="userlogo_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="86"><span class="tips">*</span>真实姓名</td>
                                <td><input name="realname" type="text" value="<?=$o['realname']?>" class="txt" placeholder="请输入姓名"/><?php //echo form_error('realname');?></td>
                                <td><span class="tips">*</span>身高</td>
                                <td><input name="height" type="text" class="txt" value="<?=$o['height']?>" placeholder="请输入身高"/> cm<?php //echo form_error('height');?></td>
                              </tr>
                              <tr>
                                <td>性别</td>
                                <td class="reg-sort">
                                	<p><input type="radio" name="sex" value="1" <?php if($o['sex']==1) echo 'checked';?> id="sort_1"/><label for="sort_1">男</label></p>
                        			<p><input type="radio" name="sex" value="2" <?php if($o['sex']==2) echo 'checked';?> id="sort_2"/><label for="sort_2">女</label></p>
                                </td>
                                <td><span class="tips">*</span>体重</td>
                                <td><input name="weight" type="text" class="txt" value="<?=$o['weight']?>" placeholder="请输入体重"/> Kg</td>
                              </tr>
                              <tr>
                                <td>所在城市</td>
                                <td>
                                  <span id="divCity"></span>
                                  <input type="hidden" id="init_city_id" name="init_city_id" value="<?=$o['city_id'];?>">
                                  <input type="hidden" id="city" name="city" value="<?=$o['city'];?>">
                                </td>
                                <td><span class="tips">*</span>三围</td>
                                <td><input name="bust" type="text" class="txt" style="width:30px" value="<?=$o['bust']?>" placeholder="胸围"/>-
                                <input name="waist" type="text" class="txt" style="width:30px" value="<?=$o['waist']?>" placeholder="腰围"/>-
                                <input name="hips" type="text" class="txt" style="width:30px" value="<?=$o['hips']?>" placeholder="臀围"/></td>
                              </tr>
                              <tr>
                                <td>罩杯</td>
                                <td><input name="cup" type="text" class="txt" value="<?=$o['cup']?>" placeholder="请输入你的罩杯"/></td>
                                <td>鞋码</td>
                                <td><input name="shoes" type="text" class="txt" value="<?=$o['shoes']?>" placeholder="请输入你的鞋码"/>码</td>
                              </tr>
                               <tr>
                                <td>联系</td>
                                <td colspan="3"><input name="qq" type="text" class="txt" value="<?=$o['qq']?>" placeholder="请输入你的联系方式"/></td>
                                
                              </tr>
                              <tr>
                                <td>风格</td>
                                <td colspan="3">
                                  <?php foreach ($oSysModelstyle as $key => $v):?>
                                    <input type="checkbox" name="style[]" value="<?=$key?>"<?php if(strpos(','.$o['style'].',',','.$key.',')>-1) echo ' checked';?> /><?=$v?>
                                  <?php endforeach;?>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td colspan="3"><a href="javascript:;" class="TX-win-open" style="color:#f00;">详细个人尺寸数据</a></td>
                              </tr>
                               <tr>
                               	  <td colspan="4">个人说明</td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>拍摄经历</font></p></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="brand" cols="" rows=""><?=$o['brand']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>工作经历</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌类型"  name="brandtype" cols="" rows=""><?=$o['brandtype']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>平面拍摄</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="planeshot" cols="" rows=""><?=$o['planeshot']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>获得奖项</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你获得的奖项" name="awards" cols="" rows=""><?=$o['awards']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>T台活动</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你获得的奖项" name="tactivity" cols="" rows=""><?=$o['tactivity']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>影视广告</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="telead" cols="" rows=""><?=$o['telead']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>杂志拍摄</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="magazine" cols="" rows=""><?=$o['magazine']?></textarea></td>
                              </tr>   
                              <tr>
                                  <td colspan="4">工作说明</td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>工作报价</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder=""  name="fee" cols="" rows=""><?=$o['fee']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>工作时间</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder=""  name="servicetime" cols="" rows=""><?=$o['servicetime']?></textarea></td>
                              </tr>
                              <tr style="border-bottom:none;">
                                <td width="86" valign="top"><font>注意事项</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="" name="takenote" cols="" rows=""><?=$o['takenote']?></textarea></td>
                              </tr>
                            </table>